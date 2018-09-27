<?php

namespace Contentstack\Models\ContentType;

use Contentstack\Support\Utility;

/*
 * BaseQuery
 * Base Class where all the Queries will be created
 * */
abstract class BaseQuery {
    var $subQuery;

    public function __construct($data = '', $parent = '') {

        if($data->type === 'assets'){
            $this->assets = $data;
            $this->queryObject = $parent;
            $this->queryObject->_query = array();
            $this->subQuery = array();

        }elseif ($data->type === 'asset'){
            $this->stack = $data;
            $this->queryObject = $parent;
            $this->queryObject->_query = array();
            $this->subQuery = array();
        }else{
            $this->contentType = $data;
            $this->queryObject = $parent;
            $this->queryObject->_query = array();
            $this->subQuery = array();
        }
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

    /*
     * To exclude the fields from the result set
     * @param
     *      $field_uids|array - field uids as array
     * @return Query
     * */
    public function except($level = 'BASE', $field_uids = array()) {
        $this->queryObject->_query = call_user_func('contentstackProjection', 'except', $this->queryObject->_query, $level, $field_uids);
        return $this->queryObject;
    }

    /*
     * To project the fields in the result set
     * @param
     *      $field_uids - field uids as array
     * @return Query
     * */
    public function only($level = 'BASE', $field_uids = array()) {
    $this->queryObject->_query = call_user_func('contentstackProjection', 'only', $this->queryObject->_query, $level, $field_uids);
        return $this->queryObject;
    }

    /*
     * To include reference(s) of other content type in entries
     * @param
     *      $references - array of reference field uids
     * @return Query
     * */
    public function includeReference($field_uids = array()) {
        $this->queryObject->_query = call_user_func('contentstackReferences', 'include', $this->queryObject->_query, $field_uids);
        return $this->queryObject;
    }

    /*
     * contentstackSearch
     * To search the given string in the entries
     * @param
     *      $search - string to be search in entries
     * @return Query
     * */
    public function search($search = '') {
        $this->queryObject->_query = call_user_func('contentstackSearch', 'typeahead', $this->queryObject->_query, $search);
        return $this->queryObject;
    }

    /*
     * regex
     * To perform the regular expression test on the specified field
     * @param
     *      $field_uid - field on which the regular expression test is going to perform
     *      $regex - Regular Expression Object
     * @return
     * */
    public function regex() {
        $this->subQuery = call_user_func_array('contentstackRegexp', array('$regex', $this->subQuery, func_get_args()));
        return $this->queryObject;
    }

    /*
     * logicalAND
     * Logical AND queries are pushed
     * @param
     *      $query - Query Object or plain json object
     * @return Query
     * */
    public function logicalAND() {
        $this->subQuery = call_user_func('contentstackLogical', '$and', $this->subQuery, func_get_args());
        return $this->queryObject;
    }

    /*
     * or
     * Logical OR queries are pushed
     * @param
     *      $query - Query Object or plain json object
     * @return Query
     * */
    public function logicalOR() {
        $this->subQuery = call_user_func('contentstackLogical', '$or', $this->subQuery, func_get_args());
        return $this->queryObject;
    }

    /*
     * ascending
     * To sort the entries in ascending order of the specified field
     * @param
     *      field_uid - field uid to be sorted
     * @return Query
     * */
    public function ascending($field_uid = '') {
        $this->queryObject->_query = call_user_func('contentstackSorting', 'asc', $this->queryObject->_query, $field_uid);
        return $this->queryObject;
    }

    /*
     * descending
     * To sort the entries in descending order of the specified field
     * @param
     *      field_uid - field uid to be sorted
     * @return Query
     * */
    public function descending($field_uid = '') {
        $this->queryObject->_query = call_user_func('contentstackSorting', 'desc', $this->queryObject->_query, $field_uid);
        return $this->queryObject;
    }

    /*
     * notExists
     * To check field doesn't exists
     * @param
     *      field_uid - field uid against the value not existence is checked
     * @return Query
     * */
    public function notExists($field_uid = '') {
        $this->subQuery = call_user_func('contentstackExistence', '$exists', $this->subQuery, $field_uid, false);
        return $this->queryObject;
    }

    /*
     * exists
     * To check field exists
     * @param
     *      field_uid - field uid against the value existence is checked
     * @return Query
     * */
    public function exists($field_uid = '') {
        $this->subQuery = call_user_func('contentstackExistence', '$exists', $this->subQuery, $field_uid, true);
        return $this->queryObject;
    }

    /*
     * includeSchema
     * @deprecated since verion 1.1.0
     * @Alternate includeContentType
     * To include schema along with entries
     * @param
     * @return Query
     * */
    public function includeSchema() {
        $this->queryObject->_query = call_user_func('contentstackAddBoolean', 'include_schema', $this->queryObject->_query);
        return $this->queryObject;
    }

    /*
     * includeContentType
     * To include content_type along with entries
     * @param
     * @return Query
     * */
    public function includeContentType() {
        $this->queryObject->_query = call_user_func('contentstackAddBoolean', 'include_content_type', $this->queryObject->_query);
        return $this->queryObject;
    }

    /*
     * includeCount
     * To include the count of entries based on the results
     * @param
     * @return Query
     * */
    public function includeCount() {
        $this->queryObject->_query = call_user_func('contentstackAddBoolean', 'include_count', $this->queryObject->_query);
        return $this->queryObject;
    }

    /*
     * count
     * To get only count result
     * @param
     * @return Query
     * */
    public function count() {
        $this->operation = __FUNCTION__;
        $this->queryObject->_query = call_user_func('contentstackAddBoolean', 'count', $this->queryObject->_query);
        return $this->queryObject;
    }

    /*
     * includeOwner
     * To include the owner of entries based on the results
     * @param
     * @return Query
     * */
    public function includeOwner() {
        $this->queryObject->_query = call_user_func('contentstackAddBoolean', 'include_owner', $this->queryObject->_query);
        return $this->queryObject;
    }

    /*
     * addParam
     * To add query parameter in query
     * @param
     *      key - Name of key in string
     *      value - Value of the key in string
     * @return Query
     * */
    public function addParam($key = '', $value = '') {
       $this->queryObject->_query  = call_user_func('contentstackAddParam', $key, $this->queryObject->_query, $value);
        return $this->queryObject;
    }

    /*
     * language
     * To set the language code in the query
     * @param
     *      langCode - Language code by default is "en-us"
     * @return Query
     * */
    public function language($lang = '') {
        $this->queryObject->_query = call_user_func('contentstackLanguage', $this->queryObject->_query, 'locale', $lang);
        return $this->queryObject;
    }
    /*
     * skip
     * Skip the specified number of entries from result set
     * @param
     *      skip - valid number
     * @return Query
     * */
    public function skip($skip = 0) {
        $this->queryObject->_query = call_user_func('contentstackPagination', 'skip', $this->queryObject->_query, $skip);
        return $this->queryObject;
    }
    /*
     * tags
     * Result set entries should have tags specified
     * @param
     *      tags|array - array of tags you want to match in the entries tags
     * @return Query
     * */
    public function tags($tags = array()) {
        $this->queryObject->_query = call_user_func('contentstackTags', 'tags', $this->queryObject->_query, $tags);
        return $this->queryObject;
    }

    /*
     * limit
     * Limit the specified number of entries from result set
     * @param
     *      limit - valid number
     * @return Query
     * */
    public function limit($limit = '') {

        $this->queryObject->_query = call_user_func('contentstackPagination', 'limit', $this->queryObject->_query, $limit);
        return $this->queryObject;
    }

    /*
     * containedIn
     * Query the field value from the given set of values
     * @param
     *      $field_uid - field in the entry against which comparision needs to be done
     *      $value     - array value against which comparision is going to happen
     * @return Query
     * */
    public function containedIn($field = '', $value = array()) {
        $this->subQuery = call_user_func('contentstackContains', '$in', $this->subQuery, $field, $value);
        return $this->queryObject;
    }

    /*
     * notContainedIn
     * Query the field value other than the given set of values
     * @param
     *      $field_uid - field in the entry against which comparision needs to be done
     *      $value     - array value against which comparision is going to happen
     * @return Query
     * */
    public function notContainedIn($field = '', $value = array()) {
        $this->subQuery = call_user_func('contentstackContains', '$nin', $this->subQuery, $field, $value);
        return $this->queryObject;
    }

    /*
     * where
     * Query the field which has exact value as specified
     * @params
     *      $field_uid - field in the entry against which comparision needs to be done
     *      $value     - value against which comparision is going to happe  n
     * @return Query
     * */
    public function where($key = '', $value = '') {
        if(!Utility::isEmpty($key)) $this->subQuery[$key] = $value;
        return $this->queryObject;
    }

    /*
     * lessThan
     * Query the field which has less value than specified one
     * @params
     *      $field_uid - field in the entry against which comparision needs to be done
     *      $value     - value against which comparision is going to happen
     * */
    public function lessThan($field = '', $value = '') {
        $this->subQuery = call_user_func('contentstackComparision', '$lt', $this->subQuery, $field, $value);
        return $this->queryObject;
    }

    /*
     * lessThanEqualTo
     * Query the field which has less or equal value than specified one
     * @params
     *      $field_uid - field in the entry against which comparision needs to be done
     *      $value     - value against which comparision is going to happen
     * */
    public function lessThanEqualTo($field = '', $value = '') {
        $this->subQuery = call_user_func('contentstackComparision', '$lte', $this->subQuery, $field, $value);
        return $this->queryObject;
    }

    /*
     * greaterThan
     * Query the field which has greater value than specified one
     * @params
     *      $field_uid - field in the entry against which comparision needs to be done
     *      $value     - value against which comparision is going to happen
     * */
    public function greaterThan($field = '', $value = '') {
        $this->subQuery = call_user_func('contentstackComparision', '$gt', $this->subQuery, $field, $value);
        return $this->queryObject;
    }

    /*
     * greaterThanEqualTo
     * Query the field which has greater or equal value than specified one
     * @params
     *      $field_uid - field in the entry against which comparision needs to be done
     *      $value     - value against which comparision is going to happen
     * */
    public function greaterThanEqualTo($field = '', $value = '') {
        $this->subQuery = call_user_func('contentstackComparision', '$gte', $this->subQuery, $field, $value);
        return $this->queryObject;
    }

    /*
     * notEqualTo
     * Query the field which has not equal to value than specified one
     * @params
     *      $field_uid - field in the entry against which comparision needs to be done
     *      $value     - value against which comparision is going to happen
     * */
    public function notEqualTo($field = '', $value = '') {
        $this->subQuery = call_user_func('contentstackComparision', '$ne', $this->subQuery, $field, $value);
        return $this->queryObject;
    }

    /*
     * query is used to add the raw/array query to filter the entries
     * @param
     *      array|query - array formatted query
     * @return Query
     * */
    public function query($_query = array()) {
        if($_query && is_array($_query)) {
            $this->subQuery = json_encode($_query);
            return $this->queryObject;
        }
        throw contentstackCreateError("Provide valid query");
    }

    /*
     * Get the raw/array query from the current instance of Query/Entry
     * @return query
     * */
    public function getQuery() {
        try {
            return json_decode(json_encode($this->subQuery), true);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}
