<?php
/*
 * Dependency loading
 * */

namespace Contentstack\Stack\ContentType\Query;

use Contentstack\Stack\ContentType\BaseQuery\BaseQuery;
use Contentstack\Utility;

require_once __DIR__."/base_query.php";
require_once __DIR__."/../utility.php";

class Query extends BaseQuery {
    var $operation;
    var $_query;

    /*
     * Query
     * Query Class to initalize your Query
     * @param
     * */
    public function __construct($data = '', $type = '') {
        $this->_query = array();
        $this->type = $type;
        parent::__construct($data, $this);
    
    }

    /*
     * find
     * Get all entries based on the specified subquery
     * */
    public function find() {
        $this->operation = __FUNCTION__;
        if($this->type == 'assets'){
            return Utility\request($this, 'assets');
        }else if($this->type == 'contentType'){
            return Utility\request($this);
    }
        
    }

    /*
     * findOne
     * Get single entry based on the specified subquery
     * */
    public function findOne() {
        $this->operation = __FUNCTION__;
        $this->_query['limit'] = 1;
        if($this->type == 'assets'){
            return Utility\request($this, 'assets');
        }else if($this->type == 'contentType'){
            return Utility\request($this);
    }
        
    }
}