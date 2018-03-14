<?php
require_once __DIR__ . '/REST.php';
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/utility.php';

require_once __DIR__ . '/../src/index.php';

use Contentstack\Test\REST;

use PHPUnit\Framework\TestCase;

class ModularBlockTest extends TestCase {
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

    public function testFind() {
        $_entries = self::$Stack->ContentType('test_multiple')->Query()->toJSON()->find();
       
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === MODULAR_ENTRY_COUNT));
        //$this->assertTrue(checkEntriesSorting($_entries[0]));
    }

    public function testFindOne() {
        $_entry = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->findOne();
        $_findentry = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->find();
        $this->assertEquals($_entry['title'], $_findentry[0][0]['title']);
    }

    public function testAddParam() {
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->addParam('include_count', 'true')->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertArrayHasKey(1, $_entries);
        $this->assertTrue((count($_entries[0]) === MODULAR_ENTRY_COUNT));
        $this->assertTrue(($_entries[1] === MODULAR_ENTRY_COUNT));  
    }

    public function testFindSkip() {
        $_entries1 = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries1);
        $this->assertTrue((count($_entries1[0]) === MODULAR_ENTRY_COUNT));
        $skip = 1;
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->skip($skip)->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === MODULAR_ENTRY_COUNT - $skip));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $this->assertEquals($_entries[0], array_slice($_entries1[0], $skip));
    }

    public function testFindLimit() {
        $limit = 1;
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->limit($limit)->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === $limit));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
    }

    public function testFindSkipLimit() {
        $_entries1 = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries1);
        $this->assertTrue((count($_entries1[0]) === MODULAR_ENTRY_COUNT));
        $limit = 4;
        $skip = 1;
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->skip($skip)->limit($limit)->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === $limit));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $this->assertEquals($_entries[0], array_slice($_entries1[0], $skip, $limit));
    }

    public function testFindCount() {
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->count()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue(($_entries[0] === MODULAR_ENTRY_COUNT));
    }

    public function testFindIncludeCount() {
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->includeCount()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertArrayHasKey(1, $_entries);
        $this->assertTrue((count($_entries[0]) === MODULAR_ENTRY_COUNT));
        $this->assertTrue(($_entries[1] === MODULAR_ENTRY_COUNT));
    }


    // public function testFindIncludeReference() {
    // $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->includeReference(array('reference', 'modular_blocks.test2.referenc_test'))->find();
    //     Contentstack\Utility\debug($_entries);
    //     $this->assertArrayHasKey(0, $_entries);
    //     $this->assertTrue((count($_entries[0]) === MODULAR_ENTRY_COUNT));
    //     for($i = 0; $i < count($_entries[0]); $i++) {
    //         $_title = 'Reference_test';
    //         $this->assertArrayHasKey(0, $_entries[0][$i]['modular_blocks'][0]['test2']['referenc_test']);
    //         $this->assertArrayHasKey(0, $_entries[0][$i]['modular_blocks'][0]['test2']['referenc_test']);
    //         $this->assertTrue(($_entries[0][$i]['modular_blocks'][1]['referenc_test']['title'] === $_title));
    //         //$this->assertTrue(($_entries[0][$i]['group']['reference'][0]['title'] === ));
    //     }
    // }


    public function testFindWhere() {
    $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->where('modular_blocks.test1.single_line', 'Raam')->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertArrayHasKey(0, $entries[0]);
        $this->assertTrue(($entries[0][0]['modular_blocks'][0]['test1']['single_line'] === 'Raam'));
    }

    public function testFindContainedIn() {
        $_set = ["Shyaam", "Rahul"];
        $_actualCount = 2;
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->containedIn('modular_blocks.test1.single_line', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue((array_search($entries[0][$key]['modular_blocks'][0]['test1']['single_line'], $_set) !== false));
        }
    }

    public function testFindNotContainedIn() {
        $_set = ["Shyaam", "Rahul"];
        $_actualCount = 3;
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->notContainedIn('modular_blocks.test1.single_line', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue((array_search($entries[0][$key]['modular_blocks'][0]['test1']['single_line'], $_set) === false));
        }
    }

    public function testFindLessThan() {
        $_set = 14;
        $_actualCount = 1;
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->lessThan('modular_blocks.test1.number', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['modular_blocks'][0]['test1']['number'] < $_set));
        }
    }

    public function testFindGreaterThan() {
        $_set = 14;
        $_actualCount = 2;
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->greaterThan('modular_blocks.test1.number', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['modular_blocks'][0]['test1']['number'] > $_set));
        }
    }

    public function testFindGreaterThanEqualTo() {
        $_set = 14;
        $_actualCount = 3;
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->greaterThanEqualTo('modular_blocks.test1.number', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['modular_blocks'][0]['test1']['number'] >= $_set));
        }
    }

    public function testFindNotEqualTo() {
        $_set = 'Rahul';
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->notEqualTo('modular_blocks.test2.single_line', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['modular_blocks'][1]['test2']['single_line'] !== $_set));
        }
    }

    public function testFindExists() {
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->exists('modular_blocks.test1.boolean')->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === MODULAR_ENTRY_COUNT));
    }


    public function testFindNotExists() {
    $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->notExists('modular_blocks.test3.boolean')->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === MODULAR_ENTRY_COUNT));
    }

    public function testFindAscending() {
        $field = 'created_at';
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->ascending($field)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === MODULAR_ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($entries[0], $field, 'asc'));
    }

    public function testFindDescending() {
        $field = 'created_at';
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->toJSON()->descending('created_at')->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === MODULAR_ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($entries[0], $field, 'desc'));
    }

    public function testFindLogicalOrQueryObject() {

        $count =  2;
        $query1 = self::$Stack->ContentType(CT_ModularContentType)->Query()->where('modular_blocks.test1.single_line', 'Rohit');
        $query2 = self::$Stack->ContentType(CT_ModularContentType)->Query()->where('modular_blocks.test1.number', 10);
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->logicalOR($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertEquals(count($entries[0]), $count);
        $this->assertTrue((count($entries[0]) === $count));
    }

   
    public function testFindLogicalAndQueryObject() {
        $count = 1;
         $query1 = self::$Stack->ContentType(CT_ModularContentType)->Query()->where('modular_blocks.test1.single_line', 'Rohit');
        $query2 = self::$Stack->ContentType(CT_ModularContentType)->Query()->where('modular_blocks.test1.number', 10);
        $entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->logicalAND($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertEquals(count($entries[0]), $count);
        $this->assertTrue((count($entries[0]) === $count));
    }

    public function testFindOnlyDefault() {
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->only(array('modular_blocks.test1.single_line', 'updated_at'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === MODULAR_ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (count(array_keys($_entries[0][$i])) === 3 && isset($_entries[0][$i]['updated_at']) && isset($_entries[0][$i]['modular_blocks'][0]['test1']['single_line']) && isset($_entries[0][$i]['uid']));
        }
        $this->assertTrue($flag);
    }

   
    public function testFindRegEx() {
        $regexp = "^Hello";
        $count = 1;
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->regex('modular_blocks.test2.multi_line', $regexp)->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === $count));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (preg_match("/{$regexp}/", $_entries[0][$i]['modular_blocks'][1]['test2']['multi_line']));
        }
        $this->assertTrue($flag);
    }

    public function testFindRegE1xWithOpt() {
        $regexp = "^Hello";
        $opts = "i";
        $count = 1;
        $_entries = self::$Stack->ContentType(CT_ModularContentType)->Query()->includeCount()->regex('modular_blocks.test2.multi_line', $regexp, $opts)->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === $count));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (preg_match("/{$regexp}/{$opts}", $_entries[0][$i]['modular_blocks'][1]['test2']['multi_line']));
        }
        $this->assertTrue($flag);
    }
}