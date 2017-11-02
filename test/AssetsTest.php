<?php
require_once __DIR__ . '/REST.php';
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/utility.php';

require_once __DIR__ . '/../src/index.php';

use Contentstack\Test\REST;

use PHPUnit\Framework\TestCase;

class AssetsTest extends TestCase {
    public static $rest;
    public static $Stack;
    /*
     * Setup before the test suites executes
     * @test
     */
    public static function setUpbeforeClass() {
        self::$rest = new REST();
        self::$Stack = Contentstack\Contentstack::Stack(self::$rest->getAPIKEY(), self::$rest->getAccessToken(),  self::$rest->getEnvironmentName());
    }
    /*
     * Tear Down after the test suites executes
     */
    public static function tearDownAfterClass() {
        if(ENV !== 'TEST_LOCAL') {
            self::$rest->deleteStack();
        }
    }

    public function testAssetsFind() {
         $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
         $this->assertArrayHasKey(0, $_assets);
         $this->assertTrue(checkAssetsSorting($_assets[0])); 
    }

    public function testAssetsFetch() {
         $_object = self::$Stack->Assets()->Query()->toJSON()->find();
         $_uid = $_object[0][0]['uid'];
         $_asset = self::$Stack->Assets($_uid)->fetch();
         $this->assertEquals($_asset->get('title'), $_object[0][0]['title']);
    }

    public function testFindAssetsLimit() {
        $limit = 1;
        $_assets = self::$Stack->Assets()->Query()->toJSON()->limit($limit)->find();
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === $limit));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
    }

     public function testFindAssetsCount() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->count()->find();
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue(($_assets[0] === $assets_count));
    }

    public function testFindAssetsIncludeCount() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->includeCount()->find();
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertArrayHasKey(0, $_assets);
        $this->assertArrayHasKey(1, $_assets);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(($_assets[1] === $assets_count));
    }

    public function testFindAssetsWhere() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $_assetsUid = $_assets[0][0]['uid'];
        $assets = self::$Stack->Assets()->Query()->toJSON()->where('uid', $_assetsUid)->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertArrayHasKey(0, $assets[0]);
        $this->assertTrue(($assets[0][0]['uid'] === $_assetsUid));
    }

       public function testFindAssetsAscending() {
        $field = 'created_at';
        $_assets = self::$Stack->Assets()->Query()->toJSON()->ascending('created_at')->find();
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkassetsSorting($_assets[0], $field, 'asc'));
    }

    public function testFindAssetsDescending() {
        $field = 'created_at';
        $_assets = self::$Stack->Assets()->Query()->toJSON()->descending('created_at')->find();
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkassetsSorting($_assets[0], $field, 'desc'));
    }


    public function testFindAssetsExists() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $_assets_count = count($_assets[0]);
        $assets = self::$Stack->Assets()->Query()->toJSON()->exists('title')->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue((count($assets[0]) === $_assets_count));
        foreach ($assets[0] as $key => $val) {
            $this->assertTrue(isset($assets[0][$key]['title']));
        }
    }

     public function testFindAssetsNotExists() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $_assets_count = count($_assets[0]);
        $assets = self::$Stack->Assets()->Query()->toJSON()->notExists('title')->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertFalse((count($assets[0]) === $_assets_count));
    }

    public function testFindAssetsLessThan() {
        $_set = 9684;
        $assets = self::$Stack->Assets()->Query()->toJSON()->lessThan('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $key => $val) {
            $this->assertTrue(($assets[0][$key]['file_size'] < $_set));
        }
    }

    public function testFindAssetsLessThanEqualTo() {
        $_set = 9684;
        $assets = self::$Stack->Assets()->Query()->toJSON()->lessThanEqualTo('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $key => $val) {
            $this->assertTrue(($assets[0][$key]['file_size'] <= $_set));
        }
    }

     public function testFindAssetsGreaterThan() {
        $_set = 7575;
        $assets = self::$Stack->Assets()->Query()->toJSON()->greaterThan('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $key => $val) {
            $this->assertTrue(($assets[0][$key]['file_size'] > $_set));
        }
    }

     public function testFindAssetsGreaterThanEqualTo() {
        $_set = 7575;
        $assets = self::$Stack->Assets()->Query()->toJSON()->greaterThanEqualTo('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $key => $val) {
            $this->assertTrue(($assets[0][$key]['file_size'] >= $_set));
        }
    }

    public function testFindAssetsNotEqualTo() {
        $_set = 7575;
        $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $_assets_count = count($_assets[0]) - 1;
        $assets = self::$Stack->Assets()->Query()->toJSON()->notEqualTo('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue((count($assets[0]) === $_assets_count));
        foreach ($assets[0] as $key => $val) {
            $this->assertTrue(($assets[0][$key]['file_size'] !== $_set));
        }
    }


 public function testFindAssetsLogicalOrQueryObject() {
        $_value = 7575;
        $query1 = self::$Stack->Assets()->Query()->greaterThan('file_size', $_value);
        $query2 = self::$Stack->Assets()->Query()->lessThan('file_size', $_value);
        $assets = self::$Stack->Assets()->Query()->logicalOR($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue(checkAssetsSorting($assets[0]));
    }

    public function testFindAssetsLogicalOrRawQuery() {
        $_value = 7575;
        $query1 = self::$Stack->Assets()->Query()->greaterThan('file_size', $_value)->getQuery();
        $query2 = self::$Stack->Assets()->Query()->lessThan('file_size', $_value)->getQuery();
        $assets = self::$Stack->Assets()->Query()->logicalOR($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue(checkAssetsSorting($assets[0]));
    }

    public function testFindAssetsLogicalAndQueryObject() {
        $_value = 7575;
        $query1 = self::$Stack->Assets()->Query()->greaterThanEqualTo('file_size', $_value);
        $query2 = self::$Stack->Assets()->Query()->lessThanEqualTo('file_size', $_value);
        $assets = self::$Stack->Assets()->Query()->logicalAND($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue(checkAssetsSorting($assets[0]));
    }

    public function testFindAssetsLogicalAndRawQuery() {
        $_value = 7575;
        $query1 = self::$Stack->Assets()->Query()->greaterThanEqualTo('file_size', $_value);
        $query2 = self::$Stack->Assets()->Query()->lessThanEqualTo('file_size', $_value);
        $assets = self::$Stack->Assets()->Query()->logicalAND($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue(checkAssetsSorting($assets[0]));
    }


     public function testFindAssetsOnlyBaseDefault() {
        $_assets = self::$Stack->Assets()->Query()->only('BASE', array('title', 'updated_at'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
//            $flag = $flag && (count(array_keys($_entries[0][$i])) === 3 && isset($_entries[0][$i]['updated_at']) && isset($_entries[0][$i]['title']) && isset($_entries[0][$i]['uid']));
            $flag = $flag && (count(array_keys($_assets[0][$i])) === 4 && isset($_assets[0][$i]['url']) && isset($_assets[0][$i]['updated_at']) && isset($_assets[0][$i]['title']) && isset($_assets[0][$i]['uid']));
        }
        $this->assertTrue($flag);
    }

    public function testFindAssetsExceptDefault() {
        $_assets = self::$Stack->Assets()->Query()->except(array('boolean'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (!array_search('boolean', array_keys($_assets[0][$i])));
        }
        $this->assertTrue($flag);
    }

    public function testFindAssetsSearch() {
        $_assets = self::$Stack->Assets()->Query()->search('image/jpeg')->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (!strpos(json_encode($_assets[0][$i]), 'image/jpeg'));
        }
        $this->assertTrue($flag);
    }
   
}