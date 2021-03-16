<?php
/**
 * BaseQuery
 * Base Class where all the Queries will be created
 * 
 * PHP version 5
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2020 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */

namespace Contentstack\Stack\ContentType\BaseQuery;
use Contentstack\Support\Utility;

require_once __DIR__ . "/../../Support/helper.php";
require_once __DIR__."/../../Support/Utility.php";
/**
 * BaseQuery
 * Base Class where all the Queries will be created
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2020 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
abstract class BaseQuery
{
    var $subQuery;
    /**
     * BaseQuery constructor
     * 
     * @param string $data   - data for query
     * @param string $parent - parent of query
     * */
    public function __construct($data = '', $parent = '') 
    {

        if ($data->type === 'assets') {
            $this->assets = $data;
            $this->queryObject = $parent;
            $this->queryObject->_query = array();
            $this->subQuery = array();
            
        } elseif ($data->type === 'asset') {
            $this->stack = $data;
            $this->queryObject = $parent;
            $this->queryObject->_query = array();
            $this->subQuery = array();
        } else {
            $this->contentType = $data;
            $this->queryObject = $parent;
            $this->queryObject->_query = array();
            $this->subQuery = array();        
        }
    }

    /**
     * To transform the Result object to server response content
     * 
     * @return Result|array
     * */
    public function toJSON() 
    {
        $this->json_translate = true;
        return $this->queryObject;
    }

    /**
     * To exclude the fields from the result set
     * 
     * @param string $level      - 
     * @param array  $field_uids - field uids as array
     * 
     * @return Query
     * */
    public function except($level = 'BASE', $field_uids = array()) 
    {
        if ($field_uids && is_array($field_uids)) {
            $this->queryObject->_query = call_user_func(
                'contentstackProjection', 
                'except', 
                $this->queryObject->_query, 
                $level, 
                $field_uids
            );
            return $this->queryObject;
        }
        throw contentstackCreateError('field_uids must be an array');
    }

    /**
     * To project the fields in the result set
     * 
     * @param string $level      - 
     * @param array  $field_uids - field uids as array
     * 
     * @return Query
     * */
    public function only($level = 'BASE', $field_uids = array()) 
    {
        if ($field_uids && is_array($field_uids)) {
            $this->queryObject->_query = call_user_func(
                'contentstackProjection', 
                'only', 
                $this->queryObject->_query, 
                $level, 
                $field_uids
            );
            return $this->queryObject;
        }
        throw contentstackCreateError('field_uids must be an array');
    }

    /**
     * To include reference(s) of other content type in entries
     * 
     * @param $field_uids - array of reference field uids
     * 
     * @return Query
     * */
    public function includeReference($field_uids = array()) 
    {
        if (is_array($field_uids)) {
            $this->queryObject->_query = call_user_func(
                'contentstackReferences', 
                'include', 
                $this->queryObject->_query,
                $field_uids
            );
            return $this->queryObject;
        }
        throw contentstackCreateError('field_uids must be an array');
    }

    /**
     * To search the given string in the entries
     * 
     * @param $search - string to be search in entries
     * 
     * @return Query
     * */
    public function search($search = '') 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackSearch', 
            'typeahead', 
            $this->queryObject->_query, 
            $search
        );
        return $this->queryObject;
    }

    /**
     * To perform the regular expression test on the specified field
     * 
     * @param $field_uid - field on which the regular 
     *                   expression test is going to perform
     * @param $regex     - Regular Expression Object
     * 
     * @return Query
     * */
    public function regex() 
    {
        $this->subQuery = call_user_func_array(
            'contentstackRegexp', 
            array(
                '$regex', 
                $this->subQuery, 
                func_get_args()
                )
        );
        return $this->queryObject;
    }
    
    /**
     * Logical AND queries are pushed
     * 
     * @param $query - Query Object or plain json object
     * 
     * @return Query
     * */
    public function logicalAND() 
    {
        $this->subQuery = call_user_func(
            'contentstackLogical', 
            '$and', 
            $this->subQuery, 
            func_get_args()
        );
        return $this->queryObject;
    }

    /**
     * Logical OR queries are pushed
     * 
     * @param $query - Query Object or plain json object
     * 
     * @return Query
     * */
    public function logicalOR()
    {
        $this->subQuery = call_user_func(
            'contentstackLogical', 
            '$or', 
            $this->subQuery, 
            func_get_args()
        );
        return $this->queryObject;
    }

    /**
     * To sort the entries in ascending order of the specified field
     * 
     * @param $field_uid - field uid to be sorted
     * 
     * @return Query
     * */
    public function ascending($field_uid = '') 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackSorting', 
            'asc', 
            $this->queryObject->_query, 
            $field_uid
        );
        return $this->queryObject;
    }

    /**
     * To sort the entries in descending order of the specified field
     * 
     * @param $field_uid - field uid to be sorted
     * 
     * @return Query
     * */
    public function descending($field_uid = '') 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackSorting', 
            'desc', 
            $this->queryObject->_query, 
            $field_uid
        );
        return $this->queryObject;
    }

    /**
     * To check field doesn't exists
     * 
     * @param $field_uid - field uid against the 
     *                   value not existence is checked
     * 
     * @return Query
     * */
    public function notExists($field_uid = '') 
    {
        $this->subQuery = call_user_func(
            'contentstackExistence', 
            '$exists', 
            $this->subQuery, 
            $field_uid, 
            false
        );
        return $this->queryObject;
    }

    /**
     * To check field exists
     * 
     * @param $field_uid - field uid against the 
     *                   value existence is checked
     * 
     * @return Query
     * */
    public function exists($field_uid = '') 
    {
        $this->subQuery = call_user_func(
            'contentstackExistence', 
            '$exists', 
            $this->subQuery, 
            $field_uid, 
            true
        );
        return $this->queryObject;
    }

    /** 
     * To include fallback content if specified locale content is not publish.
     * 
     * @return Query
    */
    public function includeFallback() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'include_fallback', 
            $this->queryObject->_query
        );
        
        return $this->queryObject;
    }
    /**
     * To include schema along with entries
     * 
     * @deprecated since verion 1.1.0
     * @Alternate  includeContentType
     * 
     * @return Query
     * */
    public function includeSchema() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'include_schema', 
            $this->queryObject->_query
        );
        
        return $this->queryObject;
    }

    /**
     * This method includes the content type UIDs of 
     * the referenced entries returned in the response.
     * 
     * @return Query
     * */
    public function includeReferenceContentTypeUID() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'include_reference_content_type_uid', 
            $this->queryObject->_query
        );
        return $this->queryObject;
    }

    /**
     * To include content_type along with entries
     * 
     * @return Query
     * */
    public function includeContentType() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'include_content_type', 
            $this->queryObject->_query
        );
        return $this->queryObject;
    }

    /**
     * To include the count of entries based on the results
     * 
     * @return Query
     * */
    public function includeCount() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'include_count', 
            $this->queryObject->_query
        );
        return $this->queryObject;
    }

    /**
     * To get only count result
     * 
     * @return Query
     * */
    public function count() 
    {
        $this->operation = __FUNCTION__;
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'count', 
            $this->queryObject->_query
        );
        return $this->queryObject;
    }

    /**
     * To include the owner of entries based on the results
     *
     * @return Query
     * */
    public function includeOwner() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'include_owner', 
            $this->queryObject->_query
        );
        return $this->queryObject;
    }

    /**
     * To add query parameter in query
     * 
     * @param string $key   - Name of key in string
     * @param string $value - Value of the key in string
     * 
     * @return Query
     * */
    public function addParam($key = '', $value = '') 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddParam', 
            $key, 
            $this->queryObject->_query, 
            $value
        );
        return $this->queryObject;
    }

    /**
     * To set the language code in the query
     * 
     * @param $lang - Language code by default is "en-us"
     * 
     * @return Query
     * */
    public function language($lang = '') 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackLanguage', 
            'locale', 
            $this->queryObject->_query, 
            $lang
        );
        return $this->queryObject;
    }
    /**
     * Skip the specified number of entries from result set
     * 
     * @param int $skip - valid number
     * 
     * @return Query
     * */
    public function skip($skip = 0)
    {
        $this->queryObject->_query = call_user_func(
            'contentstackPagination', 
            'skip', 
            $this->queryObject->_query, 
            $skip
        );
        return $this->queryObject;
    }
    /**
     * Result set entries should have tags specified
     * 
     * @param array $tags - array of tags you want to match in the entries tags
     * 
     * @return Query
     * */
    public function tags($tags = array()) 
    {
        if (is_array($tags)) {
            $this->queryObject->_query = call_user_func(
                'contentstackTags', 
                'tags', 
                $this->queryObject->_query, 
                $tags
            );
            return $this->queryObject;
        }
        throw contentstackCreateError('tags must be an array');
    }

    /**
     * Limit the specified number of entries from result set
     * 
     * @param int $limit - valid number
     * 
     * @return Query
     * */
    public function limit($limit = '') 
    {

        $this->queryObject->_query = call_user_func(
            'contentstackPagination', 
            'limit', 
            $this->queryObject->_query, 
            $limit
        );
        return $this->queryObject;
    }

    /**
     * Query the field value from the given set of values
     * 
     * @param string $field - field in the entry against which 
     *                      comparision needs to be done
     * @param array  $value - array value against which 
     *                      comparision is going to happen
     * 
     * @return Query
     * */
    public function containedIn($field = '', $value = array()) 
    {
        if (is_array($value)) {
            $this->subQuery = call_user_func(
                'contentstackContains', 
                '$in', 
                $this->subQuery, 
                $field, 
                $value
            );
            return $this->queryObject;
        }
        throw contentstackCreateError('value must be an array');
    }

    /**
     * Query the field value other than the given set of values
     * 
     * @param string $field - field in the entry against which 
     *                      comparision needs to be done
     * @param array  $value - array value against which 
     *                      comparision is going to happen
     * 
     * @return Query
     * */
    public function notContainedIn($field = '', $value = array()) 
    {
        if (is_array($value)) {
            $this->subQuery = call_user_func(
                'contentstackContains', 
                '$nin',
                $this->subQuery, 
                $field, 
                $value
            );
            return $this->queryObject;
        }
        throw contentstackCreateError('value must be an array');
    }

    /**
     * Query the field which has exact value as specified
     * 
     * @param string $key   - field in the entry against which 
     *                      comparision needs to be done
     * @param string $value - value against which comparision is going to happen
     * 
     * @return Query
     * */
    public function where($key = '', $value = '') 
    {
        if (!Utility::isEmpty($key)) {
            $this->subQuery[$key] = $value;
        }
        return $this->queryObject;
    }

    /**
     * Query the field which has less value than specified one
     * 
     * @param string $field - field in the entry against which 
     *                      comparision needs to be done
     * @param string $value - value against which comparision is going to happen
     * 
     * @return Query
     * */
    public function lessThan($field = '', $value = '') 
    {
        $this->subQuery = call_user_func(
            'contentstackComparision', 
            '$lt', 
            $this->subQuery, 
            $field, 
            $value
        );
        return $this->queryObject;
    }

    /**
     * Query the field which has less or equal value than specified one
     * 
     * @param string $field - field in the entry against which 
     *                      comparision needs to be done
     * @param string $value - value against which comparision is going to happen
     * 
     * @return Query
     * */
    public function lessThanEqualTo($field = '', $value = '') 
    {
        $this->subQuery = call_user_func(
            'contentstackComparision', 
            '$lte', 
            $this->subQuery, 
            $field, 
            $value
        );
        return $this->queryObject;
    }

    /**
     * Query the field which has greater value than specified one
     * 
     * @param string $field - field in the entry against which 
     *                      comparision needs to be done
     * @param string $value - value against which comparision is going to happen
     * 
     * @return Query
     * */
    public function greaterThan($field = '', $value = '') 
    {
        $this->subQuery = call_user_func(
            'contentstackComparision', 
            '$gt', 
            $this->subQuery, 
            $field, 
            $value
        );
        return $this->queryObject;
    }

    /**
     * Query the field which has greater or equal value than specified one
     * 
     * @param string $field - field in the entry against which 
     *                      comparision needs to be done
     * @param string $value - value against which comparision is going to happen
     * 
     * @return Query
     * */
    public function greaterThanEqualTo($field = '', $value = '') 
    {
        $this->subQuery = call_user_func(
            'contentstackComparision',
            '$gte', 
            $this->subQuery, 
            $field, 
            $value
        );
        return $this->queryObject;
    }

    /**
     * Query the field which has not equal to value than specified one
     * 
     * @param string $field - field in the entry against which 
     *                      comparision needs to be done
     * @param string $value - value against which comparision is going to happen
     * 
     * @return Query
     * */
    public function notEqualTo($field = '', $value = '') 
    {
        $this->subQuery = call_user_func(
            'contentstackComparision', 
            '$ne', $this->subQuery, 
            $field, $value
        );
        return $this->queryObject;
    }

    /**
     * Add Query is used to add the raw/array query to filter the entries
     * 
     * @param array $_query - array formatted query
     * 
     * @return Query
     * */
    public function addQuery($_query = array()) 
    {
        if (is_array($_query)) {
            $this->subQuery = $_query;
            return $this->queryObject;
        }
        throw contentstackCreateError("Provide valid query");
    }

    /**
     * Get the raw/array query from the current instance of Query/Entry
     * 
     * @return query
     * */
    public function getQuery()
    {
        try {
            return json_decode(json_encode($this->subQuery), true);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }   
}