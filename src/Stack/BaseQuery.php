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
 * @copyright 2012-2021 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */

namespace Contentstack\Stack;
use Contentstack\Support\Utility;

require_once __DIR__ . "/../Support/helper.php";

/**
 * BaseQuery
 * Base Class where all the Queries will be created
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2021 Contentstack. All Rights Reserved
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
     * @example  //Converting response array to JSON format 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('CONTENT_TYPE_UID')->Query()->toJSON()->find();
     * 
     * @return JSON
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
     * @example In the Product content type, if we need to retrieve the data of entries of all the 
     * other fields except the Price in USD parameter, you can send the parameter as:
     * 
     * except(string $level = 'BASE', array $field_uids = array())
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Entry('CONTENTTYPE_UID')->toJSON()->except('BASE',array('price'))->fetch();
     *
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
     * @example In the Product content type, if we need to retrieve the data of only the Price in USD
     *  parameter of all the entries, you can send the parameter as: 
     * 
     * only(string $level = 'BASE', array $field_uids = array())
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Entry('  ')->toJSON()->only('BASE',array('price'))->fetch();
     * 
     * @return Query|Entry
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
     * @example //In the Product content type, there is a reference field called Categories, which refers entries of another content type. Let’s assume that you had 
     * created an entry for the Product content type, and the value selected in the Categories field was ‘Mobiles’. If you fetch the entry using 
     * the ‘Get a Single Entry’ API request, you would get all the details of the entry in the response, but the value against the Categories field 
     * would be UID of the referenced entry (i.e., UID of the ‘Mobiles’ entry in this case).
     * 
     *  //In order to fetch the details of the entry used in the Categories reference field, you need to 
     *  //use the include[] parameter in the following manner:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $results = $stack->ContentType('product')->Query()->toJSON()->includeReference(array('categories'))->find();
     * 
     * @return Query
     * */
    public function includeReference($field_uids = array()) 
    {
        if ($field_uids && is_array($field_uids)) {
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
     * @deprecated since verion 2.2.0
     * @param $search - string to be search in entries
     * 
     * @example In the Product content type, you have a entry text 'contentstack' in your content type, and you want to retrieve all the entries within this content type that have 
     * values for this field anywhere with 'contentstack'.
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->search('contentstack')->find();
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
     * @example In the Product content type, you have a field named Color ("uid":"color") in your content type, and you want to retrieve all the entries within this content type that have 
     * values for this field starting with 'Bl'.
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->regex('color','^B1')->find();
     * 
     * Now, in order to perform a case-insensitive search, you can use the $options key to specify any regular expressions options:
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->regex('color','^B1','i')->find();
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
     * @example Let’s say you want to retrieve entries in which the Title field is set to 'Redmi Note 
     * 3' and the Color field is 'Gold'. The query to be used for such a case would be:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $query1 = $stack->ContentType('product')->Query()->where('title', 'Redmi Note 3');
     * $query2 = $stack->ContentType('product')->Query()->where('color', 'Gold');
     * $entries = $stack->ContentType('product')->Query()->logicalAND($query1, $query2)->toJSON()->find();
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
     * @example Let’s say you want to retrieve entries in which either the value for the Color field is 'Gold' or 'Black'. 
     * The query to be used for such a case would be:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $query1 = $stack->ContentType('product')->Query()->where('color', 'Black');
     * $query2 = $stack->ContentType('product')->Query()->where('color', 'Gold');
     * $entries = $stack->ContentType('product')->Query()->logicalOR($query1, $query2)->toJSON()->find();
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
     * @example In the Product content type, if you wish to sort the entries with respect to their prices in ascending order.
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->ascending('price')->find();
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
     * @example In the Product content type, if you wish to sort the entries with respect to their prices in descending order.
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->descending('price')->find();
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
     * @example In the Product content type, if we need to retrieve the data of entries of all the other fields except the Price in USD parameter.
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->notExists('price')->find();
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
     * @example In the Product content type, if we need to retrieve the data of only the Price in USD parameter of all the entries.
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->exists('price')->find();
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
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeFallback()->find();
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
     * To include branch of publish content.
     * 
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeBranch()->find();
     * 
     * @return Query
    */
    public function includeBranch() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'include_branch', 
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
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeSchema()->find();
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
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeReferenceContentTypeUID()->find();
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
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeContentType()->find();
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
     * To include Embedded Items along with entries
     * 
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeEmbeddedItems()->find();
     * 
     * @return Query
     * */
    public function includeEmbeddedItems() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackReferences', 
            'include_embedded_items', 
            $this->queryObject->_query,
            ["BASE"]
        );
        return $this->queryObject;
    }

    /**
     * To include the count of entries based on the results
     * 
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeCount()->find();
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
     * To include the Metadata of entries based on the results
     * 
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeMetadata()->find();
     * 
     * @return Query
     * */


    public function includeMetadata() 
    {
        $this->queryObject->_query = call_user_func(
            'contentstackAddBoolean', 
            'include_metadata', 
            $this->queryObject->_query
        );
        return $this->queryObject;
    }


    /**
     * To get only count result
     * 
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->count()->find();
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
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->includeOwner()->find();
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
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->addParam('include_count', 'true')->toJSON()->find();
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
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->language('en-us')->find();
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
     * @example The skip parameter will skip a specific number of entries in the output. So, for example, if the content type contains around 12 entries 
     * and you want to skip the first 2 entries to get only the last 10 in the response body, you need to specify ‘2’ here.
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->skip(2)->find();
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
     * @example 
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->tags(array('Vivo','Gold'))->find();
     * 
     * @return Query
     * */
    public function tags($tags = array()) 
    {
        if ($tags && is_array($tags)) {
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
     * @example The limit parameter will return a specific number of entries in the output. 
     * So for example, if the content type contains more than 100 entries and you wish to fetch only the first 2 entries, you need to specify '2' as value in this parameter.
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->limit(2)->find();
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
     * @example 
     * Example 1 - Array Equals Operator Within Group
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->containedIn('title',array('Redmi','Samsung'))->find();
     * 
     * 
     * Example 2 - Array Equals Operator Within Modular Blocks
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->containedIn("additional_info.deals.deal_name", ["Christmas Deal", "Summer Deal"])->find();
     *  
     * @return Query
     * */
    public function containedIn($field = '', $value = array()) 
    {
        if ($value && is_array($value)) {
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
     * @example 
     * Example 1 - Array Not-equals Operator Within Group
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->notContainedIn("title", ["Electronics", "Apparel"])->find();
     * 
     * Example 2 - Array Not-equals Operator Within Modular Blocks
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->notContainedIn("additional_info.deals.deal_name", ["Christmas Deal", "Summer Deal"]) ->find();
     * 
     * @return Query
     * */
    public function notContainedIn($field = '', $value = array()) 
    {
        if ($value && is_array($value)) {
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
     * @example  In the Products content type, you have a field named Title ("uid":"title") field. If, for instance,
     *  you want to retrieve all the entries in which the value for the Title field is 'Redmi 3S', you can set the parameters as:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->where('title','Redmi 3S')->find();
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
     * @example Let’s say you want to retrieve all the entries that have value of the Price in USD field set to a value that is less than but not equal to 600. You can send the parameter as:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->lessThan('price','600')->find();
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
     * @example Let’s say you want to retrieve all the entries that have value of the Price in USD field set to a value that is less than or equal to 146. To achieve this, send the parameter as:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->lessThanEqualTo('price','146')->find();
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
     * @example Let’s say you want to retrieve all the entries that have value of the Price in USD field set to a value that is greater than but not equal to 146. You can send the parameter as:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->greaterThan('price','146')->find();
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
     * @example Let’s say you want to retrieve all the entries that have value of the Price in USD field set to a value that is less than and equal to 146. You can send the parameter as:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->greaterThanEqualTo('price','146')->find();
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
     * @example Let’s say you want to retrieve all the entries that have value of the Price in USD field set to a value that is not equal to 500. You can send the parameter as:
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $result = $stack->ContentType('product')->Query()->toJSON()->notEqualTo('price','500')->find();
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
     * @example
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $_set = ['vivo', 'samsung', 'redmi 3', 'apple'];
     * $query1 = $stack->ContentType('product')->Query()->lessThan('title', $_set)->getQuery();
     * $_entries = $stack->ContentType('product')->Query()->addQuery($query1)->toJSON()->find();
     * 
     * @return Query
     * */
    public function addQuery($_query = array()) 
    {
        if ($_query && is_array($_query)) {
            $this->subQuery = $_query;
            return $this->queryObject;
        }
        throw contentstackCreateError("Provide valid query");
    }

    /**
     * Get the raw/array query from the current instance of Query/Entry
     * 
     * @example
     * 
     * use Contentstack\Contentstack;
     * $stack = Contentstack::Stack("API_KEY", "DELIVERY_TOKEN", "ENVIRONMENT");
     * $query1 = $stack->ContentType('product')->Query()->greaterThan('price', '5000')->getQuery();
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