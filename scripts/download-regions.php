<?php

/**
 * Downloads the Contentstack regions registry from the official source and
 * saves it to src/assets/regions.json.
 *
 * Invoked automatically by Composer on post-install-cmd and post-update-cmd,
 * and manually via: composer refresh-regions
 *
 * Uses the PHP curl extension when available, falls back to file_get_contents.
 */

$url  = 'https://artifacts.contentstack.com/regions.json';
$dest = dirname(__DIR__) . '/src/assets/regions.json';
$dir  = dirname($dest);

if (!is_dir($dir) && !mkdir($dir, 0755, true)) {
    fwrite(STDERR, "contentstack/contentstack: Failed to create directory {$dir}\n");
    exit(1);
}

$data = null;

// --- Attempt 1: PHP curl extension (preferred, respects SSL certs) ----------
if (extension_loaded('curl')) {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($response !== false && $httpCode === 200) {
        $data = $response;
    } elseif ($curlError) {
        fwrite(STDERR, "contentstack/contentstack: curl error: {$curlError}\n");
    }
}

// --- Attempt 2: file_get_contents fallback ----------------------------------
if ($data === null) {
    $ctx  = stream_context_create([
        'http' => [
            'timeout'       => 30,
            'ignore_errors' => false,
        ],
        'ssl'  => [
            'verify_peer'      => true,
            'verify_peer_name' => true,
        ],
    ]);
    $data = @file_get_contents($url, false, $ctx);
}

// --- Validate and write -----------------------------------------------------
if ($data === false || $data === null) {
    fwrite(STDERR, "contentstack/contentstack: Warning — could not download regions.json. " .
        "The SDK will attempt to download it at runtime on first use.\n");
    exit(0); // non-fatal: runtime fallback in Endpoint::loadRegions() handles it
}

$decoded = json_decode($data, true);
if (!is_array($decoded) || !isset($decoded['regions']) || !is_array($decoded['regions'])) {
    fwrite(STDERR, "contentstack/contentstack: Warning — downloaded data is not a valid regions.json.\n");
    exit(0);
}

if (file_put_contents($dest, $data) === false) {
    fwrite(STDERR, "contentstack/contentstack: Warning — could not write regions.json to {$dest}.\n");
    exit(0);
}

$regionCount = count($decoded['regions']);
echo "contentstack/contentstack: regions.json downloaded ({$regionCount} regions).\n";
