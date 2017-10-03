<?php
/*
 * Dependency loading
 * */

namespace Contentstack\Stack\Assets\AssetsQuery;


use Contentstack\Utility;

require_once __DIR__."/../utility.php";

class AssetsQuery {
    var $subQuery;

    /*
     * Query
     * Query Class to initalize your Query
     * @param
     * */
    public function __construct($stack = '') { 

        $this->queryObject = $stack;
        $this->queryObject->_query = array();
        $this->subQuery = array();
        //\Contentstack\Utility\debug($this);

    }

     /*
     * toJSON
     * To transform the Result object to server response content
     * @return Result|array
     * */
    public function toJSON() {

        $this->json_translate = true;
        return $this->queryObject;
    }

     public function includeCount() {

        $this->queryObject->_query = call_user_func('addBoolean', 'include_count', $this->queryObject->_query);
        return $this->queryObject;
    }

    public function includeRelativeUrl() {

        $this->queryObject->_query = call_user_func('addBoolean', 'relative_urls', $this->queryObject->_query);
        return $this->queryObject;
    }

    public function ascending($field_uid = '') {

        $this->queryObject->_query = call_user_func('sorting', 'asc', $this->queryObject->_query, $field_uid);
        return $this->queryObject;
    }

    public function descending($field_uid = '') {

        $this->queryObject->_query = call_user_func('sorting', 'desc', $this->queryObject->_query, $field_uid);
        return $this->queryObject;
    }

   
}