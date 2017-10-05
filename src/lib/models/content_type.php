<?php
/*
 * Dependency loading
 * */
namespace Contentstack\Stack\ContentType;

use Contentstack\Stack\ContentType\Entry\Entry;
use Contentstack\Stack\ContentType\Query\Query;

require_once __DIR__.'/entry.php';
require_once __DIR__.'/query.php';

/*
 * Class ContentType
 * */
class ContentType {
    var $uid = '';
    var $stack = '';

    /*
     * ContentType
     * ContentType Class to initalize your ContentType
     * @param
     *      contentTypeId - valid content type uid
     * */
    public function __construct($uid = '', $stack = '') {
        $this->uid = $uid;
        $this->stack = $stack;
    }

    /*
     * Entry
     * Entry object to create the "Query" on the specified ContentType
     * @returns Entry
     * */
    public function Entry($entry_uid = '') {
        return new Entry($entry_uid, $this);
    }

    /*
     * Query
     * Query object to create the "Query" on the specified ContentType
     * @returns Query
     * */
    public function Query() {
        return new Query($this);
    }
}