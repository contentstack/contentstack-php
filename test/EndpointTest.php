<?php

use Contentstack\Contentstack;
use Contentstack\ContentstackRegion;
use Contentstack\Endpoint;
use PHPUnit\Framework\TestCase;

class EndpointTest extends TestCase
{
    protected function setUp(): void
    {
        Endpoint::resetCache();
    }

    // -------------------------------------------------------------------------
    // Default region (us / na)
    // -------------------------------------------------------------------------

    public function testDefaultRegionReturnsAllEndpoints(): void
    {
        $endpoints = Endpoint::getContentstackEndpoint();
        $this->assertIsArray($endpoints);
        $this->assertArrayHasKey('contentDelivery', $endpoints);
        $this->assertArrayHasKey('contentManagement', $endpoints);
    }

    public function testDefaultRegionContentDelivery(): void
    {
        $url = Endpoint::getContentstackEndpoint('us', 'contentDelivery');
        $this->assertSame('https://cdn.contentstack.io', $url);
    }

    public function testDefaultRegionContentManagement(): void
    {
        $url = Endpoint::getContentstackEndpoint('us', 'contentManagement');
        $this->assertSame('https://api.contentstack.io', $url);
    }

    // -------------------------------------------------------------------------
    // Region aliases resolve to the same region
    // -------------------------------------------------------------------------

    /**
     * @dataProvider naAliasProvider
     */
    public function testNaRegionAliasesResolveToSameEndpoint(string $alias): void
    {
        $url = Endpoint::getContentstackEndpoint($alias, 'contentDelivery');
        $this->assertSame('https://cdn.contentstack.io', $url);
    }

    public static function naAliasProvider(): array
    {
        return [
            'id na'       => ['na'],
            'alias us'    => ['us'],
            'alias aws-na' => ['aws-na'],
            'alias aws_na' => ['aws_na'],
            'upper NA'    => ['NA'],
            'upper US'    => ['US'],
        ];
    }

    // -------------------------------------------------------------------------
    // All seven regions — contentDelivery spot-checks
    // -------------------------------------------------------------------------

    /**
     * @dataProvider regionContentDeliveryProvider
     */
    public function testContentDeliveryUrlByRegion(string $region, string $expected): void
    {
        $url = Endpoint::getContentstackEndpoint($region, 'contentDelivery');
        $this->assertSame($expected, $url);
    }

    public static function regionContentDeliveryProvider(): array
    {
        return [
            'na'       => ['na',       'https://cdn.contentstack.io'],
            'eu'       => ['eu',       'https://eu-cdn.contentstack.com'],
            'au'       => ['au',       'https://au-cdn.contentstack.com'],
            'azure-na' => ['azure-na', 'https://azure-na-cdn.contentstack.com'],
            'azure-eu' => ['azure-eu', 'https://azure-eu-cdn.contentstack.com'],
            'gcp-na'   => ['gcp-na',   'https://gcp-na-cdn.contentstack.com'],
            'gcp-eu'   => ['gcp-eu',   'https://gcp-eu-cdn.contentstack.com'],
        ];
    }

    /**
     * @dataProvider regionContentManagementProvider
     */
    public function testContentManagementUrlByRegion(string $region, string $expected): void
    {
        $url = Endpoint::getContentstackEndpoint($region, 'contentManagement');
        $this->assertSame($expected, $url);
    }

    public static function regionContentManagementProvider(): array
    {
        return [
            'na'       => ['na',       'https://api.contentstack.io'],
            'eu'       => ['eu',       'https://eu-api.contentstack.com'],
            'au'       => ['au',       'https://au-api.contentstack.com'],
            'azure-na' => ['azure-na', 'https://azure-na-api.contentstack.com'],
            'azure-eu' => ['azure-eu', 'https://azure-eu-api.contentstack.com'],
            'gcp-na'   => ['gcp-na',   'https://gcp-na-api.contentstack.com'],
            'gcp-eu'   => ['gcp-eu',   'https://gcp-eu-api.contentstack.com'],
        ];
    }

    // -------------------------------------------------------------------------
    // ContentstackRegion constants resolve correctly
    // -------------------------------------------------------------------------

    public function testRegionConstantUS(): void
    {
        $url = Endpoint::getContentstackEndpoint(ContentstackRegion::US, 'contentDelivery');
        $this->assertSame('https://cdn.contentstack.io', $url);
    }

    public function testRegionConstantEU(): void
    {
        $url = Endpoint::getContentstackEndpoint(ContentstackRegion::EU, 'contentDelivery');
        $this->assertSame('https://eu-cdn.contentstack.com', $url);
    }

    public function testRegionConstantAU(): void
    {
        $url = Endpoint::getContentstackEndpoint(ContentstackRegion::AU, 'contentDelivery');
        $this->assertSame('https://au-cdn.contentstack.com', $url);
    }

    public function testRegionConstantAzureNA(): void
    {
        $url = Endpoint::getContentstackEndpoint(ContentstackRegion::AZURE_NA, 'contentDelivery');
        $this->assertSame('https://azure-na-cdn.contentstack.com', $url);
    }

    public function testRegionConstantAzureEU(): void
    {
        $url = Endpoint::getContentstackEndpoint(ContentstackRegion::AZURE_EU, 'contentDelivery');
        $this->assertSame('https://azure-eu-cdn.contentstack.com', $url);
    }

    public function testRegionConstantGcpNA(): void
    {
        $url = Endpoint::getContentstackEndpoint(ContentstackRegion::GCP_NA, 'contentDelivery');
        $this->assertSame('https://gcp-na-cdn.contentstack.com', $url);
    }

    public function testRegionConstantGcpEU(): void
    {
        $url = Endpoint::getContentstackEndpoint(ContentstackRegion::GCP_EU, 'contentDelivery');
        $this->assertSame('https://gcp-eu-cdn.contentstack.com', $url);
    }

    // -------------------------------------------------------------------------
    // omitHttps flag
    // -------------------------------------------------------------------------

    public function testOmitHttpsStripsSchemeFromSingleService(): void
    {
        $url = Endpoint::getContentstackEndpoint('eu', 'contentDelivery', true);
        $this->assertSame('eu-cdn.contentstack.com', $url);
    }

    public function testOmitHttpsStripsSchemeFromAllServices(): void
    {
        $endpoints = Endpoint::getContentstackEndpoint('na', '', true);
        $this->assertIsArray($endpoints);
        foreach ($endpoints as $key => $url) {
            $this->assertStringNotContainsString('https://', $url, "Service {$key} still has https://");
            $this->assertStringNotContainsString('http://', $url, "Service {$key} still has http://");
        }
    }

    public function testOmitHttpsFalseRetainsScheme(): void
    {
        $url = Endpoint::getContentstackEndpoint('na', 'contentManagement', false);
        $this->assertStringStartsWith('https://', $url);
    }

    // -------------------------------------------------------------------------
    // Return-all-endpoints (no service)
    // -------------------------------------------------------------------------

    public function testNoServiceReturnsArray(): void
    {
        $result = Endpoint::getContentstackEndpoint('au');
        $this->assertIsArray($result);
        $this->assertGreaterThan(1, count($result));
    }

    public function testNoServiceContainsCorrectUrls(): void
    {
        $endpoints = Endpoint::getContentstackEndpoint('au');
        $this->assertSame('https://au-cdn.contentstack.com', $endpoints['contentDelivery']);
        $this->assertSame('https://au-api.contentstack.com', $endpoints['contentManagement']);
    }

    // -------------------------------------------------------------------------
    // Case-insensitive alias matching
    // -------------------------------------------------------------------------

    public function testUppercaseAliasResolves(): void
    {
        $url = Endpoint::getContentstackEndpoint('AWS-NA', 'contentDelivery');
        $this->assertSame('https://cdn.contentstack.io', $url);
    }

    public function testUnderscoreAliasResolves(): void
    {
        $url = Endpoint::getContentstackEndpoint('azure_na', 'contentDelivery');
        $this->assertSame('https://azure-na-cdn.contentstack.com', $url);
    }

    public function testGcpUnderscoreAliasResolves(): void
    {
        $url = Endpoint::getContentstackEndpoint('gcp_eu', 'contentManagement');
        $this->assertSame('https://gcp-eu-api.contentstack.com', $url);
    }

    // -------------------------------------------------------------------------
    // Error cases
    // -------------------------------------------------------------------------

    public function testEmptyRegionThrowsInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Empty region provided');
        Endpoint::getContentstackEndpoint('');
    }

    public function testUnknownRegionThrowsInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid region: invalid-region');
        Endpoint::getContentstackEndpoint('invalid-region');
    }

    public function testUnknownServiceThrowsInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Service "unknownService" not found');
        Endpoint::getContentstackEndpoint('na', 'unknownService');
    }

    // -------------------------------------------------------------------------
    // Contentstack::getContentstackEndpoint() proxy
    // -------------------------------------------------------------------------

    public function testContentstackProxyReturnsSameResult(): void
    {
        $viaEndpoint = Endpoint::getContentstackEndpoint('eu', 'contentDelivery');
        $viaProxy    = Contentstack::getContentstackEndpoint('eu', 'contentDelivery');
        $this->assertSame($viaEndpoint, $viaProxy);
    }

    public function testContentstackProxyDefaultRegion(): void
    {
        $url = Contentstack::getContentstackEndpoint('us', 'contentManagement');
        $this->assertSame('https://api.contentstack.io', $url);
    }

    public function testContentstackProxyOmitHttps(): void
    {
        $url = Contentstack::getContentstackEndpoint('gcp-na', 'contentDelivery', true);
        $this->assertSame('gcp-na-cdn.contentstack.com', $url);
    }

    public function testContentstackProxyAllEndpoints(): void
    {
        $endpoints = Contentstack::getContentstackEndpoint('azure-eu');
        $this->assertIsArray($endpoints);
        $this->assertArrayHasKey('contentDelivery', $endpoints);
    }

    // -------------------------------------------------------------------------
    // Stack host resolution via Endpoint
    // -------------------------------------------------------------------------

    public function testStackUsHostResolvesToDefaultCdn(): void
    {
        $stack = Contentstack::Stack('api_key', 'delivery_token', 'env', ['region' => 'us']);
        $this->assertSame('cdn.contentstack.io', $stack->getHost());
    }

    public function testStackEuHostResolvesViaEndpoint(): void
    {
        $stack = Contentstack::Stack('api_key', 'delivery_token', 'env', ['region' => 'eu']);
        $this->assertSame('eu-cdn.contentstack.com', $stack->getHost());
    }

    public function testStackAuHostResolvesViaEndpoint(): void
    {
        $stack = Contentstack::Stack('api_key', 'delivery_token', 'env', ['region' => 'au']);
        $this->assertSame('au-cdn.contentstack.com', $stack->getHost());
    }

    public function testStackAzureNaHostResolvesViaEndpoint(): void
    {
        $stack = Contentstack::Stack('api_key', 'delivery_token', 'env', ['region' => 'azure-na']);
        $this->assertSame('azure-na-cdn.contentstack.com', $stack->getHost());
    }

    public function testStackGcpEuHostResolvesViaEndpoint(): void
    {
        $stack = Contentstack::Stack('api_key', 'delivery_token', 'env', ['region' => 'gcp-eu']);
        $this->assertSame('gcp-eu-cdn.contentstack.com', $stack->getHost());
    }

    public function testStackRegionConstantAuResolvesCorrectly(): void
    {
        $stack = Contentstack::Stack('api_key', 'delivery_token', 'env', ['region' => ContentstackRegion::AU]);
        $this->assertSame('au-cdn.contentstack.com', $stack->getHost());
    }

    public function testStackExplicitHostOverridesRegion(): void
    {
        $stack = Contentstack::Stack('api_key', 'delivery_token', 'env', [
            'region' => 'eu',
            'host'   => 'custom.cdn.example.com',
        ]);
        $this->assertSame('custom.cdn.example.com', $stack->getHost());
    }

    public function testStackSetHostStillWorks(): void
    {
        $stack = Contentstack::Stack('api_key', 'delivery_token', 'env', ['region' => 'eu']);
        $stack->setHost('override.cdn.example.com');
        $this->assertSame('override.cdn.example.com', $stack->getHost());
    }
}
