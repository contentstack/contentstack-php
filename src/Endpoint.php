<?php
/**
 * Endpoint — Contentstack region-to-URL resolver.
 *
 * PHP version 7.2+
 *
 * @category  PHP
 * @package   Contentstack
 * @copyright 2012-2024 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://www.contentstack.com/docs/developers/php/
 */
namespace Contentstack;

/**
 * Resolves Contentstack service endpoint URLs for any supported region.
 *
 * Region data is loaded from src/assets/regions.json (bundled) and cached
 * in-memory for the lifetime of the PHP process.  When the bundled file is
 * absent the class attempts a live download from the Contentstack CDN so the
 * SDK continues to work even when the file was not created during installation.
 */
class Endpoint
{
    /** @var array<string,mixed>|null */
    private static $regionsData = null;

    /** @var string */
    const REGIONS_URL = 'https://artifacts.contentstack.com/regions.json';

    /**
     * Resolve a Contentstack service endpoint URL for a given region.
     *
     * @param  string $region     Region ID or alias (e.g. 'us', 'eu', 'azure-na', 'gcp-eu').
     *                            Defaults to 'us' (AWS North America).
     * @param  string $service    Optional service key (e.g. 'contentDelivery',
     *                            'contentManagement', 'auth', 'graphqlDelivery').
     *                            When empty, all endpoints for the region are returned.
     * @param  bool   $omitHttps  When true, strips the 'https://' prefix from every URL.
     *
     * @return string|array<string,string>  Single URL string when $service is provided,
     *                                      associative array of all service URLs otherwise.
     *
     * @throws \InvalidArgumentException  When region is empty, unknown, or service is not found.
     * @throws \RuntimeException          When regions.json cannot be read or parsed.
     */
    public static function getContentstackEndpoint(
        string $region = 'us',
        string $service = '',
        bool $omitHttps = false
    ) {
        if ($region === '') {
            throw new \InvalidArgumentException(
                'Empty region provided. Please put valid region.'
            );
        }

        $data       = self::loadRegions();
        $normalized = strtolower(trim($region));
        $regionRow  = self::findRegionByIdOrAlias($data['regions'], $normalized);

        if ($regionRow === null) {
            throw new \InvalidArgumentException("Invalid region: {$region}");
        }

        if ($service !== '') {
            if (!array_key_exists($service, $regionRow['endpoints'])) {
                throw new \InvalidArgumentException(
                    "Service \"{$service}\" not found for region \"{$regionRow['id']}\""
                );
            }
            $url = $regionRow['endpoints'][$service];
            return $omitHttps ? self::stripHttps($url) : $url;
        }

        $endpoints = $regionRow['endpoints'];
        return $omitHttps ? self::stripHttpsFromMap($endpoints) : $endpoints;
    }

    /**
     * Load and cache regions.json.
     *
     * Resolution order:
     *   1. In-memory static cache (zero I/O after first call)
     *   2. src/assets/regions.json on disk (written by composer install script)
     *   3. Live download from artifacts.contentstack.com (fallback)
     *
     * @return array<string,mixed>
     */
    private static function loadRegions(): array
    {
        if (self::$regionsData !== null) {
            return self::$regionsData;
        }

        $path = __DIR__ . '/assets/regions.json';

        if (!file_exists($path)) {
            self::downloadAndSave($path);
        }

        if (!file_exists($path)) {
            throw new \RuntimeException(
                'contentstack/contentstack: regions.json not found and could not be downloaded. ' .
                'Run "composer install" or "composer refresh-regions" and ensure network access.'
            );
        }

        $raw = file_get_contents($path);
        if ($raw === false) {
            throw new \RuntimeException(
                'contentstack/contentstack: Could not read regions.json.'
            );
        }

        $decoded = json_decode($raw, true);
        if (!is_array($decoded) || !isset($decoded['regions'])) {
            throw new \RuntimeException(
                'contentstack/contentstack: regions.json is corrupt. ' .
                'Run "composer refresh-regions" to re-download it.'
            );
        }

        self::$regionsData = $decoded;
        return self::$regionsData;
    }

    /**
     * Download regions.json from the Contentstack CDN and save to disk.
     * Tries the PHP curl extension first, falls back to file_get_contents.
     * Silent on failure — the caller decides whether a missing file is fatal.
     *
     * @param string $dest Absolute path to write the file to.
     */
    private static function downloadAndSave(string $dest): void
    {
        $dir = dirname($dest);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $data = null;

        if (extension_loaded('curl')) {
            $ch = curl_init(self::REGIONS_URL);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_SSL_VERIFYPEER => true,
            ]);
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($response !== false && $httpCode === 200) {
                $data = $response;
            }
        }

        if ($data === null) {
            $ctx  = stream_context_create(['http' => ['timeout' => 30]]);
            $data = @file_get_contents(self::REGIONS_URL, false, $ctx);
        }

        if (!$data) {
            return;
        }

        $decoded = json_decode($data, true);
        if (is_array($decoded) && isset($decoded['regions'])) {
            file_put_contents($dest, $data);
        }
    }

    /**
     * Find a region entry by its id or any alias (case-insensitive).
     *
     * @param  array<int,array<string,mixed>> $regions
     * @param  string                         $input   Already lowercased input.
     * @return array<string,mixed>|null
     */
    private static function findRegionByIdOrAlias(array $regions, string $input): ?array
    {
        foreach ($regions as $row) {
            if ($row['id'] === $input) {
                return $row;
            }
        }
        foreach ($regions as $row) {
            foreach ($row['alias'] as $alias) {
                if (strtolower($alias) === $input) {
                    return $row;
                }
            }
        }
        return null;
    }

    /**
     * Strip the https:// (or http://) scheme from a URL string.
     */
    private static function stripHttps(string $url): string
    {
        return (string) preg_replace('/^https?:\/\//', '', $url);
    }

    /**
     * Strip https:// from every value in an endpoint map.
     *
     * @param  array<string,string> $endpoints
     * @return array<string,string>
     */
    private static function stripHttpsFromMap(array $endpoints): array
    {
        $result = [];
        foreach ($endpoints as $key => $url) {
            $result[$key] = self::stripHttps($url);
        }
        return $result;
    }

    /**
     * Reset the internal region cache (intended for testing only).
     */
    public static function resetCache(): void
    {
        self::$regionsData = null;
    }
}
