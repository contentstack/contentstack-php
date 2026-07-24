<?php

use PHPUnit\Framework\TestCase;
use Contentstack\Support\Utility;
use Contentstack\Stack\ContentType;
use Contentstack\Stack\ContentType\Entry;
use Contentstack\Stack\ContentType\Query;

class VariantsTest extends TestCase
{
    private function contentType()
    {
        return new ContentType('ct_uid', '');
    }

    public function testFormatVariantUids()
    {
        $this->assertEquals('uid1, uid2', Utility::formatVariantUids(array('uid1', 'uid2')));
        $this->assertEquals('uid1', Utility::formatVariantUids('uid1'));
    }

    public function testEntryVariantsRequiresVariantUids()
    {
        $this->expectException(\Exception::class);
        $this->contentType()->Entry()->variants('');
    }

    public function testQueryVariantsRejectsEmptyArray()
    {
        $this->expectException(\Exception::class);
        $this->contentType()->Query()->variants(array());
    }

    public function testVariantsStoresBranchOnQueryObject()
    {
        $query = $this->contentType()->Query()->variants('variant_uid', 'main');
        $this->assertEquals('variant_uid', $query->variantUid);
        $this->assertEquals('main', $query->variantBranch);
    }

    public function testEntryVariantsChainsToEntry()
    {
        $entry = $this->contentType()->Entry('entry_uid')->variants(array('v1', 'v2'));
        $this->assertInstanceOf(Entry::class, $entry);
        $this->assertEquals(array('v1', 'v2'), $entry->variantUid);
    }
}
