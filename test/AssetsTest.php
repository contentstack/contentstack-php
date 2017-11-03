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

    public function testAsssetsFindSkip() {
        $_assets1 = self::$Stack->Assets()->Query()->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets1);
        $assets_count = count($_assets1[0]);
        $this->assertTrue((count($_assets1[0]) === $assets_count));
        $skip = 1;
        $_assets = self::$Stack->Assets()->Query()->toJSON()->skip($skip)->find();
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === $assets_count - $skip));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $this->assertEquals($_assets[0], array_slice($_assets1[0], $skip));
    }

    public function testAsssetsFindSkipLimit() {
        $_assets1 = self::$Stack->Assets()->Query()->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets1);
        $limit = 2;
        $skip = 1;
        $_assets = self::$Stack->Assets()->Query()->toJSON()->skip($skip)->limit($limit)->find();
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === $limit));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $this->assertEquals($_assets[0], array_slice($_assets1[0], $skip, $limit));
    }

    public function testAsssetsFindLimit() {
        $limit = 1;
        $_assets = self::$Stack->Assets()->Query()->toJSON()->limit($limit)->find();
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === $limit));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
    }

     public function testAsssetsFindCount() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->count()->find();
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue(($_assets[0] === $assets_count));
    }

    public function testAsssetsFindIncludeCount() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->includeCount()->find();
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertArrayHasKey(0, $_assets);
        $this->assertArrayHasKey(1, $_assets);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(($_assets[1] === $assets_count));
    }

    public function testAsssetsFindWhere() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $_assetsUid = $_assets[0][0]['uid'];
        $assets = self::$Stack->Assets()->Query()->toJSON()->where('uid', $_assetsUid)->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertArrayHasKey(0, $assets[0]);
        $this->assertTrue(($assets[0][0]['uid'] === $_assetsUid));
    }

    public function testAsssetsFindContainedIn() {
        $_set = ['image/jpeg', 'image/jpg'];
        $assets = self::$Stack->Assets()->Query()->toJSON()->containedIn('content_type', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $*** => $val) {
            $this->assertTrue((array_search($assets[0][$***]['content_type'], $_set) !== false));
        }
    }

     public function testAsssetsFindNotContainedIn() {
        $_set = ['image/jpeg', 'image/jpg'];
        $assets= self::$Stack->Assets()->Query()->toJSON()->notContainedIn('content_type', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $*** => $val) {
            $this->assertTrue((array_search($assets[0][$***]['content_type'], $_set) === false));
        }
    }

       public function testAsssetsFindAscending() {
        $field = 'created_at';
        $_assets = self::$Stack->Assets()->Query()->toJSON()->ascending('created_at')->find();
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkassetsSorting($_assets[0], $field, 'asc'));
    }

    public function testAsssetsFindDescending() {
        $field = 'created_at';
        $_assets = self::$Stack->Assets()->Query()->toJSON()->descending('created_at')->find();
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkassetsSorting($_assets[0], $field, 'desc'));
    }

    public function testAsssetsFindLessThan() {
        $_set = 9684;
        $assets = self::$Stack->Assets()->Query()->toJSON()->lessThan('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $*** => $val) {
            $this->assertTrue(($assets[0][$***]['file_size'] < $_set));
        }
    }

    public function testAsssetsFindLessThanEqualTo() {
        $_set = 9684;
        $assets = self::$Stack->Assets()->Query()->toJSON()->lessThanEqualTo('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $*** => $val) {
            $this->assertTrue(($assets[0][$***]['file_size'] <= $_set));
        }
    }

     public function testAsssetsFindGreaterThan() {
        $_set = 7575;
        $assets = self::$Stack->Assets()->Query()->toJSON()->greaterThan('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $*** => $val) {
            $this->assertTrue(($assets[0][$***]['file_size'] > $_set));
        }
    }

     public function testAsssetsFindGreaterThanEqualTo() {
        $_set = 7575;
        $assets = self::$Stack->Assets()->Query()->toJSON()->greaterThanEqualTo('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        foreach ($assets[0] as $*** => $val) {
            $this->assertTrue(($assets[0][$***]['file_size'] >= $_set));
        }
    }

    public function testAsssetsFindNotEqualTo() {
        $_set = 7575;
        $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $_assets_count = count($_assets[0]) - 1;
        $assets = self::$Stack->Assets()->Query()->toJSON()->notEqualTo('file_size', $_set)->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue((count($assets[0]) === $_assets_count));
        foreach ($assets[0] as $*** => $val) {
            $this->assertTrue(($assets[0][$***]['file_size'] !== $_set));
        }
    }

     public function testAsssetsFindExists() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $_assets_count = count($_assets[0]);
        $assets = self::$Stack->Assets()->Query()->toJSON()->exists('title')->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue((count($assets[0]) === $_assets_count));
        foreach ($assets[0] as $*** => $val) {
            $this->assertTrue(isset($assets[0][$***]['title']));
        }
    }

     public function testAsssetsFindNotExists() {
        $_assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $_assets_count = count($_assets[0]);
        $assets = self::$Stack->Assets()->Query()->toJSON()->notExists('title')->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertFalse((count($assets[0]) === $_assets_count));
    }


 public function testAsssetsFindLogicalOrQueryObject() {
        $_value = 7575;
        $query1 = self::$Stack->Assets()->Query()->greaterThan('file_size', $_value);
        $query2 = self::$Stack->Assets()->Query()->lessThan('file_size', $_value);
        $assets = self::$Stack->Assets()->Query()->logicalOR($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue(checkAssetsSorting($assets[0]));
    }

    public function testAsssetsFindLogicalOrRawQuery() {
        $_value = 7575;
        $query1 = self::$Stack->Assets()->Query()->greaterThan('file_size', $_value)->getQuery();
        $query2 = self::$Stack->Assets()->Query()->lessThan('file_size', $_value)->getQuery();
        $assets = self::$Stack->Assets()->Query()->logicalOR($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue(checkAssetsSorting($assets[0]));
    }

    public function testAsssetsFindLogicalAndQueryObject() {
        $_value = 7575;
        $query1 = self::$Stack->Assets()->Query()->greaterThanEqualTo('file_size', $_value);
        $query2 = self::$Stack->Assets()->Query()->lessThanEqualTo('file_size', $_value);
        $assets = self::$Stack->Assets()->Query()->logicalAND($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue(checkAssetsSorting($assets[0]));
    }

    public function testAsssetsFindLogicalAndRawQuery() {
        $_value = 7575;
        $query1 = self::$Stack->Assets()->Query()->greaterThanEqualTo('file_size', $_value);
        $query2 = self::$Stack->Assets()->Query()->lessThanEqualTo('file_size', $_value);
        $assets = self::$Stack->Assets()->Query()->logicalAND($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $assets);
        $this->assertTrue(checkAssetsSorting($assets[0]));
    }

    public function testAsssetsFindOnlyDefault() {
        $_assets = self::$Stack->Assets()->Query()->only(array('title', 'updated_at'))->toJSON()->find();
        $_assets_count = self::$Stack->Assets()->Query()->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue((count($_assets[0]) === count($_assets_count[0])));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (count(array_***s($_assets[0][$i])) === 4 && isset($_assets[0][$i]['updated_at']) && isset($_assets[0][$i]['title']) && isset($_assets[0][$i]['uid']));
        }
        $this->assertTrue($flag);
    }

    public function testAsssetsFindRegEx() {
        $regexp = "[0-9]";
        $_assets = self::$Stack->Assets()->Query()->regex('title', $regexp)->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue(checkassetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (preg_match("/{$regexp}/", $_assets[0][$i]['title']));
        }
        $this->assertTrue($flag);
    }

    public function testAsssetsFindRegE1xWithOpt() {
        $regexp = "[0-9]";
        $opts = "i";
        $_assets = self::$Stack->Assets()->Query()->includeCount()->regex('title', $regexp, $opts)->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue(checkassetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (preg_match("/{$regexp}/{$opts}", $_assets[0][$i]['title']));
        }
        $this->assertTrue($flag);
    }

    public function testAsssetsFindTags() {
        $_assets = self::$Stack->Assets()->Query()->tags(array('tag-1'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $this->assertTrue(checkassetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (!array_search('tag-1', $_assets[0][$i]['tags']));
        }
        $this->assertTrue($flag);
    }

    public function testAsssetsFindExceptBaseDefault() {
        $_assets = self::$Stack->Assets()->Query()->except('BASE', array('title'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $_assets_count = self::$Stack->Assets()->Query()->toJSON()->find();
        $this->assertTrue((count($_assets[0]) === count($_assets_count[0])));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (!array_search('title', array_***s($_assets[0][$i])));
        }
        $this->assertTrue($flag);
    }


     public function testAsssetsFindOnlyBaseDefault() {
        $_assets = self::$Stack->Assets()->Query()->only('BASE', array('title', 'updated_at'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (count(array_***s($_assets[0][$i])) === 4 && isset($_assets[0][$i]['url']) && isset($_assets[0][$i]['updated_at']) && isset($_assets[0][$i]['title']) && isset($_assets[0][$i]['uid']));
        }
        $this->assertTrue($flag);
    }

    public function testAsssetsFindExceptDefault() {
        $_assets = self::$Stack->Assets()->Query()->except(array('boolean'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_assets);
        $assets = self::$Stack->Assets()->Query()->toJSON()->find();
        $assets_count = count($assets[0]);
        $this->assertTrue((count($_assets[0]) === $assets_count));
        $this->assertTrue(checkAssetsSorting($_assets[0]));
        $flag = true;
        for($i = 0; $i < count($_assets[0]); $i++) {
            $flag = $flag && (!array_search('boolean', array_***s($_assets[0][$i])));
        }
        $this->assertTrue($flag);
    }

    public function testAsssetsFindSearch() {
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