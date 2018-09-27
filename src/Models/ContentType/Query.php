<?php
/*
 * Dependency loading
 * */

namespace Contentstack\Models\ContentType;

use Contentstack\Support\Utility;
use Contentstack\Models\ContentType\BaseQuery;

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
            return Utility::contentstackRequest($this, 'assets');
        }else if($this->type == 'contentType'){
            return Utility::contentstackRequest($this);
    }
    }

    /*
     * findOne
     * Get single entry based on the specified subquery
     * @deprecated since verion 1.1.0
     * */
    public function findOne() {
        $this->operation = __FUNCTION__;
        $this->_query['limit'] = 1;
        if($this->type == 'assets'){
            return Utility::contentstackRequest($this, 'assets');
        }else if($this->type == 'contentType'){
            return Utility::contentstackRequest($this);
    }

    }
}
