<?php
/*
 * Dependency loading
 * */

namespace Contentstack\Stack\Assets\QueryAssets;

use Contentstack\Stack\Assets\AssetsQuery\AssetsQuery;
use Contentstack\Utility;

require_once __DIR__."/assetsquery.php";
require_once __DIR__."/../utility.php";

class QueryAssets extends AssetsQuery {
    var $operation;
    var $_query;
    var $assets;

    /*
     * Query
     * Query Class to initalize your Query
     * @param
     * */
    public function __construct($stack = '') {
        $this->_query = array();
        $this->assets = $stack;
        parent::__construct($this);
       // \Contentstack\Utility\debug($this);
    }

    /*
     * find
     * Get all entries based on the specified subquery
     * */
    public function find() {
        $this->operation = __FUNCTION__;
        return Utility\request($this, assets);
    }

    /*
     * findOne
     * Get single entry based on the specified subquery
     * */
    public function findOne() {
        $this->operation = __FUNCTION__;
        $this->_query['limit'] = 1;
        return Utility\request($this);
    }


}