<?php
require_once __DIR__ . '/REST.php';
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/utility.php';

require_once __DIR__ . '/../src/index.php';

use Contentstack\Test\REST;

use PHPUnit\Framework\TestCase;

class ImageTransformTest extends TestCase {
    public static $rest;
    public static $Stack;
    /*
     * Setup before the test suites executes
     * @test
     */
    public static function setUpBeforeClass() : void {
        self::$rest = new REST();
        self::$Stack = Contentstack\Contentstack::Stack(self::$rest->getAPIKEY(), self::$rest->getAccessToken(),  self::$rest->getEnvironmentName());
        if (self::$rest->getHost() !== NULL) {
            self::$Stack->setHost(self::$rest->getHost());
        }
    }
    /*
     * Tear Down after the test suites executes
     */
    public static function tearDownAfterClass() : void {
        if(ENV !== 'TEST_LOCAL') {
            self::$rest->deleteStack();
        }
    }

    public function testSingleParamsImageTransform() {
         $_object = self::$Stack->Assets()->Query()->toJSON()->find();
         $_uid = $_object[0][0]['uid'];
         $_asset = self::$Stack->Assets($_uid)->fetch();
         $_url   = $_asset->get('url');
         if($_url){
             $_resizeimagetransformation = self::$Stack->ImageTrasform($_url, array('height'=> 100, 'weight'=> 100, 'disable' => 'upscale'));
             $resize_data     = parse_url($_resizeimagetransformation, PHP_URL_QUERY);
             parse_str($resize_data, $get_array_resize);
             $resize_default_array = array('height'=> 100,'weight'=> 100, 'disable' => 'upscale');
             $this->assertEquals($get_array_resize, $resize_default_array);
        }       
    }

    public function testTwoParamsImageTransform() {
         $_object = self::$Stack->Assets()->Query()->toJSON()->find();
         $_uid = $_object[0][0]['uid'];
         $_asset = self::$Stack->Assets($_uid)->fetch();
         $_url   = $_asset->get('url');
         if($_url){
             $_cropimagetransformation = self::$Stack->ImageTrasform($_url, array('crop'=> 100,200));
             $crop_data       = parse_url($_cropimagetransformation, PHP_URL_QUERY);
             parse_str($crop_data, $get_array_crop);
             $crop_default_array = array('crop'=> 100,200);
             $this->assertEquals($get_array_crop, $crop_default_array);
        }       
    }

    public function testThreeParamsImageTransforma() {
         $_object = self::$Stack->Assets()->Query()->toJSON()->find();
         $_uid = $_object[0][0]['uid'];
         $_asset = self::$Stack->Assets($_uid)->fetch();
         $_url   = $_asset->get('url');
         if($_url){
             $_resizecropimagetransformation = self::$Stack->ImageTrasform($_url, array('height'=> 100, 'weight'=> 100, 'disable' => 'upscale', 'crop'=> 100,200, 'orient'=> 2));
             $resizecrop_data = parse_url($_resizecropimagetransformation, PHP_URL_QUERY);
             parse_str($resizecrop_data, $get_array_resizecrop);
             $resizecrop_default_array = array('height'=> 100,'weight'=> 100, 'disable' => 'upscale', 'crop'=> 100,200, 'orient'=> 2);
             $this->assertEquals($get_array_resizecrop, $resizecrop_default_array);
         }       
    }
}