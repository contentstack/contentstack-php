<?php
require_once __DIR__ . '/REST.php';
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/utility.php';

require_once __DIR__ . '/../src/index.php';

use Contentstack\Test\REST;

use PHPUnit\Framework\TestCase;

class EntriesTest extends TestCase {
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
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
    }

    public function testFindOne() {
        $_entry = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->findOne();
       // $this->assertObjectHasAttribute('object', $_entry);
        $this->assertEquals($_entry['title'], getResultEntries(CT_ContentType, ENTRY_COUNT - 1)['title']);
    }

    public function testFetch() {
        $_object = getResultEntries(CT_ContentType, 0);
        $_uid = $_object['uid'];
        $_entry = self::$Stack->ContentType(CT_ContentType)->Entry($_uid)->toJSON()->fetch();
        $this->assertEquals($_entry['title'], $_object['title']);
    }

    public function testAddParam() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->addParam('include_count', 'true')->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertArrayHasKey(1, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(($_entries[1] === ENTRY_COUNT));  
    }

    public function testFindSkip() {
        $_entries1 = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries1);
        $this->assertTrue((count($_entries1[0]) === ENTRY_COUNT));
        $skip = 1;
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->skip($skip)->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT - $skip));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $this->assertEquals($_entries[0], array_slice($_entries1[0], $skip));
    }

    public function testFindLimit() {
        $limit = 1;
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->limit($limit)->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === $limit));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
    }

    public function testFindSkipLimit() {
        $_entries1 = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries1);
        $this->assertTrue((count($_entries1[0]) === ENTRY_COUNT));
        $limit = 4;
        $skip = 1;
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->skip($skip)->limit($limit)->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === $limit));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $this->assertEquals($_entries[0], array_slice($_entries1[0], $skip, $limit));
    }

    public function testFindCount() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->count()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue(($_entries[0] === ENTRY_COUNT));
    }

    public function testFindIncludeCount() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->includeCount()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertArrayHasKey(1, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(($_entries[1] === ENTRY_COUNT));
    }

    public function testFindIncludeSchema() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->includeSchema()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertArrayHasKey(1, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $this->assertTrue((count($_entries[1]) === count(self::$rest->get('content_types')[1]['schema'])));
    }

    public function testFindIncludeContentType() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->includeContentType()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertArrayHasKey(1, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $this->assertTrue($_entries[1]['uid'] === CT_ContentType);
    }

    public function testFindIncludeContentTypeIncludeCount() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->includeCount()->includeContentType()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertArrayHasKey(1, $_entries);
        $this->assertArrayHasKey(2, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $this->assertTrue($_entries[1]['uid'] === CT_ContentType);
        $this->assertTrue($_entries[2] === ENTRY_COUNT);
    }

    public function testFindIncludeSchemaIncludeCount() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->includeCount()->includeSchema()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertArrayHasKey(1, $_entries);
        $this->assertArrayHasKey(2, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $this->assertTrue((count($_entries[1]) === count(self::$rest->get('content_types')[1]['schema'])));
        $this->assertTrue(($_entries[2]) === ENTRY_COUNT);
    }

    public function testFindIncludeReference() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->includeReference(array('reference', 'group.reference'))->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        for($i = 0; $i < count($_entries[0]); $i++) {
            $index = ($i % 2);
            $this->assertArrayHasKey(0, $_entries[0][$i]['reference']);
            $this->assertArrayHasKey(0, $_entries[0][$i]['group']['reference']);
            $this->assertTrue(($_entries[0][$i]['reference'][0]['title'] === self::$rest->get('entries.reference')[$index]['title']));
            $this->assertTrue(($_entries[0][$i]['group']['reference'][0]['title'] === self::$rest->get('entries.reference')[~$index + 2]['title']));
        }
    }

    public function testFindWhere() {
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->where('title', 'CB1-1')->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertArrayHasKey(0, $entries[0]);
        $this->assertTrue(($entries[0][0]['title'] === 'CB1-1'));
    }

    public function testFindContainedIn() {
        $_set = [8, 9, 10, 11];
        $_actualCount = (count($_set) - 1);
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->containedIn('number1', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue((array_search($entries[0][$key]['number1'], $_set) !== false));
        }
    }

    public function testFindNotContainedIn() {
        $_set = [8, 9, 10, 11];
        $_actualCount = ENTRY_COUNT - (count($_set) - 1);
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->notContainedIn('number1', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue((array_search($entries[0][$key]['number1'], $_set) === false));
        }
    }

    public function testFindLessThan() {
        $_set = 8;
        $_actualCount = 7;
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->lessThan('group.number', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['group']['number'] < $_set));
        }
    }

    public function testFindLessThanEqualTo() {
        $_actualCount = $_set = 8;
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->lessThanEqualTo('group.number', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['group']['number'] <= $_set));
        }
    }

    public function testFindGreaterThan() {
        $_set = 8;
        $_actualCount = ENTRY_COUNT - $_set;
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->greaterThan('group.number', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['group']['number'] > $_set));
        }
    }

    public function testFindGreaterThanEqualTo() {
        $_set = 8;
        $_actualCount = (ENTRY_COUNT - $_set) + 1;
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->greaterThanEqualTo('group.number', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['group']['number'] >= $_set));
        }
    }

    public function testFindNotEqualTo() {
        $_set = 5;
        $_actualCount = ENTRY_COUNT - 1;
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->notEqualTo('group.number', $_set)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(($entries[0][$key]['group']['number'] !== $_set));
        }
    }

    public function testFindExists() {
        $_actualCount = ENTRY_COUNT;
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->exists('boolean')->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === $_actualCount));
        foreach ($entries[0] as $key => $val) {
            $this->assertTrue(isset($entries[0][$key]['boolean']));
        }
    }

    public function testFindNotExists() {
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->notExists('boolean')->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertFalse((count($entries[0]) === ENTRY_COUNT));
    }

    public function testFindAscending() {
        $field = 'created_at';
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->ascending($field)->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($entries[0], $field, 'asc'));
    }

    public function testFindDescending() {
        $field = 'created_at';
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->toJSON()->descending('created_at')->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertTrue((count($entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($entries[0], $field, 'desc'));
    }

    public function testFindLogicalOrQueryObject() {
        $_value = 5;
        $count = ENTRY_COUNT - 1;
        $query1 = self::$Stack->ContentType(CT_ContentType)->Query()->greaterThan('number1', $_value);
        $query2 = self::$Stack->ContentType(CT_ContentType)->Query()->lessThan('number1', $_value);
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->logicalOR($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertEquals(count($entries[0]), $count);
        $this->assertTrue(checkEntriesSorting($entries[0]));
    }

    public function testFindLogicalOrRawQuery() {
        $_value = 5;
        $count = ENTRY_COUNT - 1;
        $query1 = self::$Stack->ContentType(CT_ContentType)->Query()->greaterThan('number1', $_value)->getQuery();
        $query2 = self::$Stack->ContentType(CT_ContentType)->Query()->lessThan('number1', $_value)->getQuery();
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->logicalOR($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertEquals(count($entries[0]), $count);
        $this->assertTrue(checkEntriesSorting($entries[0]));
    }

    public function testFindLogicalAndQueryObject() {
        $_value = 5;
        $count = 1;
        $query1 = self::$Stack->ContentType(CT_ContentType)->Query()->greaterThanEqualTo('number1', $_value);
        $query2 = self::$Stack->ContentType(CT_ContentType)->Query()->lessThanEqualTo('number1', $_value);
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->logicalAND($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertEquals(count($entries[0]), $count);
        $this->assertTrue(checkEntriesSorting($entries[0]));
    }

    public function testFindLogicalAndRawQuery() {
        $_value = 5;
        $count = 1;
        $query1 = self::$Stack->ContentType(CT_ContentType)->Query()->greaterThanEqualTo('number1', $_value);
        $query2 = self::$Stack->ContentType(CT_ContentType)->Query()->lessThanEqualTo('number1', $_value);
        $entries = self::$Stack->ContentType(CT_ContentType)->Query()->logicalAND($query1, $query2)->toJSON()->find();
        $this->assertArrayHasKey(0, $entries);
        $this->assertEquals(count($entries[0]), $count);
        $this->assertTrue(checkEntriesSorting($entries[0]));
    }

    public function testFindOnlyDefault() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->only(array('title', 'updated_at'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (count(array_keys($_entries[0][$i])) === 3 && isset($_entries[0][$i]['updated_at']) && isset($_entries[0][$i]['title']) && isset($_entries[0][$i]['uid']));
            /*$flag = $flag && (count(array_keys($_entries[0][$i])) === 4 && isset($_entries[0][$i]['url']) && isset($_entries[0][$i]['updated_at']) && isset($_entries[0][$i]['title']) && isset($_entries[0][$i]['uid']));*/
        }
        $this->assertTrue($flag);
    }

    public function testFindOnlyBaseDefault() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->only('BASE', array('title', 'updated_at'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (count(array_keys($_entries[0][$i])) === 3 && isset($_entries[0][$i]['updated_at']) && isset($_entries[0][$i]['title']) && isset($_entries[0][$i]['uid']));
            /*$flag = $flag && (count(array_keys($_entries[0][$i])) === 4 && isset($_entries[0][$i]['url']) && isset($_entries[0][$i]['updated_at']) && isset($_entries[0][$i]['title']) && isset($_entries[0][$i]['uid']));*/
        }
        $this->assertTrue($flag);
    }

    public function testFindExceptDefault() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->except(array('title'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (!array_search('title', array_keys($_entries[0][$i])));
        }
        $this->assertTrue($flag);
    }

    public function testFindExceptBaseDefault() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->except('BASE', array('title'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (!array_search('title', array_keys($_entries[0][$i])));
        }
        $this->assertTrue($flag);
    }

    public function testFindOnlyReference() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->includeReference(array('reference'))->only('reference', array('title'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (count(array_keys($_entries[0][$i]['reference'][0])) === 2);
            for($j = 0; $j < count($_entries[0][$i]['reference']); $j++) {
                $flag = $flag && (isset($_entries[0][$i]['reference'][$j]['title']) && isset($_entries[0][$i]['reference'][$j]['uid']) && isset($_entries[0][$i]['reference'][$j]['uid']));
            }
        }
        $this->assertTrue($flag);
    }

    public function testFindExceptReference() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->includeReference(array('reference'))->except('reference', array('title'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        // it is not working as "title" is also included in the result set
        for($i = 0; $i < count($_entries[0]); $i++) {
            for($j = 0; $j < count($_entries[0][$i]['reference']); $j++) {
                $flag = $flag && (!isset($_entries[0][$i]['reference'][$j]['title']));
            }
        }
        $this->assertTrue($flag);
    }

    public function testFindRegEx() {
        $regexp = "CB1-[0-9]+";
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->regex('title', $regexp)->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (preg_match("/{$regexp}/", $_entries[0][$i]['title']));
        }
        $this->assertTrue($flag);
    }

    public function testFindRegE1xWithOpt() {
        $regexp = "^cb1-[0-9]+";
        $opts = "i";
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->includeCount()->regex('title', $regexp, $opts)->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (preg_match("/{$regexp}/{$opts}", $_entries[0][$i]['title']));
        }
        $this->assertTrue($flag);
    }

    public function testFindTags() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->tags(array('tag-1'))->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (!array_search('tag-1', $_entries[0][$i]['tags']));
        }
        $this->assertTrue($flag);
    }

    public function testFindSearch() {
        $_entries = self::$Stack->ContentType(CT_ContentType)->Query()->search('CB')->toJSON()->find();
        $this->assertArrayHasKey(0, $_entries);
        $this->assertTrue((count($_entries[0]) === ENTRY_COUNT));
        $this->assertTrue(checkEntriesSorting($_entries[0]));
        $flag = true;
        for($i = 0; $i < count($_entries[0]); $i++) {
            $flag = $flag && (!strpos(json_encode($_entries[0][$i]), 'CB-'));
        }
        $this->assertTrue($flag);
    }

// modular Testcases //

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