<?php
require_once __DIR__ . '/REST.php';
require_once __DIR__ . '/constants.php';

require_once __DIR__ . '/utility.php';
use Contentstack\Test\REST;
use Contentstack\Contentstack;

use PHPUnit\Framework\TestCase;
use Contentstack\Support\Utility;
class SyncTest extends TestCase {
    public static $rest;
    public static $Stack;
    /*
     * Setup before the test suites executes
     * @test
     */
    public static function setUpBeforeClass() : void {
        self::$rest = new REST();
        self::$Stack = Contentstack::Stack(self::$rest->getAPIKEY(), self::$rest->getAccessToken(),  self::$rest->getEnvironmentName());
        if (self::$rest->getHost() !== NULL) {
            self::$Stack->setHost(self::$rest->getHost());
        }
    }
    /*
     * Tear Down after the test suites executes
     */
    public static function tearDownAfterClass() : void{
        if(ENV !== 'TEST_LOCAL') {
            // self::$rest->deleteStack();
        }
    }

    public function testSyncInit() {
         $_result = self::$Stack->sync(array('init'=> 'true'));
         $this->assertEquals(18, count($_result['items']));
         $this->assertNotNull($_result['sync_token']);
         $this->assertEquals(18, $_result['total_count']);
         $this->assertEquals(100, $_result['limit']);

    }

    public function testSyncInitContentType() {
        $_result = self::$Stack->sync(array('init'=> 'true', "content_type_uid"=> CT_ContentType));
        $this->assertEquals(11, count($_result['items']));
        $this->assertNotNull($_result['sync_token']);
        $this->assertEquals(11, $_result['total_count']);
        $this->assertEquals(100, $_result['limit']);
    }

    public function testSyncInitLocale() {
        $_result = self::$Stack->sync(array('init'=> 'true', "locale"=> 'hi-in'));
        $this->assertEquals(3, count($_result['items']));
        $this->assertNotNull($_result['sync_token']);
        $this->assertEquals(3, $_result['total_count']);
        $this->assertEquals(100, $_result['limit']);
    }

    public function testSyncInitType() {
        $_result = self::$Stack->sync(array('init'=> 'true', "type"=> 'asset_published'));
        $this->assertEquals(4, count($_result['items']));
        $this->assertNotNull($_result['sync_token']);
        $this->assertEquals(4, $_result['total_count']);
        $this->assertEquals(100, $_result['limit']);
    }

    public function testSyncInitMultipleQuery() {
        $_result = self::$Stack->sync(array('init'=> 'true', "type"=> 'entry_published', "locale"=> 'hi-in', "content_type_uid"=> CT_ContentType));
        $this->assertEquals(1, count($_result['items']));
        $this->assertNotNull($_result['sync_token']);
        $this->assertEquals(1, $_result['total_count']);
        $this->assertEquals(100, $_result['limit']);
    }
}
