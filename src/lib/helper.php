<?php
if(!function_exists('getFunctionName')) {
    /*
     * To get the Query method name
     * @return string|function-name
     * */
    function getFunctionName() {
        $stack = debug_backtrace();
        if(count($stack) > 2) {
            return $stack[3]['function'];
        }
        return $stack[0]['function'];
    }
}

if(!function_exists('createError')) {
    /*
     * Create exception object based on messages
     * @param
     *      string|msg - Exception message to be delivered
     * @return Exception
     * */
    function createError($msg = '') {
        if(!\Contentstack\Utility\isEmpty($msg)) return new Exception($msg);
    }
}

if (!function_exists('search')) {
    /*
     * search
     * search
     * @param
     *      $operator - query operator
     *      $query - Query object
     *      $value - value to be search
     * @return $query
     * */
    function search($operator = '', $query = array(), $value = '') {
        if(!(!\Contentstack\Utility\isEmpty($value) && is_string($value)))
            throw createError('Invalid input for "'.getFunctionName().'". String value expected.');
        $query[$operator] = $value;
        return $query;
    }
}

if (!function_exists('references')) {
    /*
     * references
     * references
     * @param
     *      $query - Query object
     *      $values - array of fields to be included in the result set
     * @return $query
     * */
    function references($operator = '', $query = array(), $value = array()) {
        if(!is_array($value))
            throw createError('Invalid input for includeReferences. Array expected.');
        $query[$operator] = $value;
        return $query;
    }
}

if (!function_exists('projection')) {
    /*
     * projection
     * projection
     * @param
     *      $query - Query object
     *      $values - array of fields to be included in the result set
     * @return $query
     * */
    function projection($operator = '', $query = array(), $level = 'BASE', $value = array()) {
        if(is_array($level)) {
            $value = $level;
            $level = 'BASE';
        }
        if(!(!\Contentstack\Utility\isEmpty($level) && is_string($level) && is_array($value))) throw createError('Invalid Input');
        if(!\Contentstack\Utility\isKeySet($query, $operator)) $query[$operator] = array();
        if(!\Contentstack\Utility\isKeySet($query[$operator], $level)) $query[$operator][$level] = array();
        $query[$operator][$level] = array_merge($query[$operator][$level], $value);
        return $query;
    }
}

if (!function_exists('regexp')) {
    /*
     * regexp
     * regexp
     * @param
     *      $operator - query operator
     *      $query - Query object
     *      $key - key of the query
     *      $value - value to be set against key
     *      $options - options for the regular expression
     * @return $query
     * */
    function regexp($operator = '', $query = array(), $values = array()) {
        if(count($values) === 2 || count($values) === 3) {
            if(\Contentstack\Utility\isEmpty($values[0]) && \Contentstack\Utility\isEmpty($values[1]) && is_string($values[0]) && is_string($values[1]))
                throw createError('Invalid input for regex.Key must be string and value must be valid RegularExpression');
            if(isset($values[2]) && !(is_string($values[2]) && strlen($values[2]) > 0)) {
                throw createError('Invalid options for regex. Please provide the valid options');
            }
            $query[$values[0]] = array($operator => $values[1]);
            if(isset($values[2]))
                $query[$values[0]]['$options'] = $values[2];
            return $query;
        } else {
            throw createError('Invalid input for regex. At least 2 or maximum 3 arguments are required.');
        }
    }
}

if (!function_exists('tags')) {
    /*
     * tags
     * tags
     * @param
     *      $operator - query operator
     *      $query - Query object
     *      $value - array of tags
     * @return $query
     * */
    function tags($operator = '', $query = array(), $value = '') {
        if(!(is_array($value) && count($value) > 0))
            throw createError('Invalid input for tags.Value must be valid array of tags');
        $query[$operator] = $value;
        return $query;
    }
}

if (!function_exists('search')) {
    /*
     * search
     * search
     * @param
     *      $operator - query operator
     *      $query - Query object
     *      $value - search string
     * @return $query
     * */
    function search($operator = '', $query = array(), $value = '') {
        if(!(is_string($value) && strlen($value) > 0))
            throw createError('Invalid input for search.Value must be of type string');
        $query[$operator] = $value;
        return $query;
    }
}

if (!function_exists('comparision')) {
    /*
     * comparision
     * comparision
     * @param
     *      $operator - query operator
     *      $query - Query object
     *      $key - key of the query
     *      $value - value to be set against key
     * @return $query
     * */
    function comparision($operator = '', $query = array(), $key = '', $value = '') {
        if(!(!\Contentstack\Utility\isEmpty($key) && is_string($key) && !\Contentstack\Utility\isEmpty($value)))
            throw createError('Invalid input for "'.getFunctionName().'". Key must be string and value should be valid not empty.');
        $query[$key] = array($operator => $value);
        return $query;
    }
}

if (!function_exists('logical')) {
    /*
     * logical
     * logical operations
     * @param
     *      $operator - query operator
     *      $query - Query object
     *      $value - array of Query object or json query
     * @return $query
     * @ignore
     * */
    function logical($operator = '', $query = array(), $value = array()) {
        if(!(is_array($value) && count($value) > 0))
            throw createError('Invalid input for "'.getFunctionName().'". At least one Query or array object is expected');
        foreach($value as $key => $_qry) {
            if(!\Contentstack\Utility\isKeySet($query, $operator)) $query[$operator] = array();
            if($_qry instanceof \Contentstack\Stack\ContentType\BaseQuery\BaseQuery)
                array_push($query[$operator], $_qry->subQuery);
            else if(is_array($_qry))
                array_push($query[$operator], $_qry);
            else {
                unset($query[$operator]);
                throw createError('Query objects are expected as arguments');
            }
        }
        return $query;
    }
}

if (!function_exists('contains')) {
    /*
     * contains
     * contains
     * @param
     *      $operator - query operator
     *      $query - Query object
     *      $key - key of the query
     *      $value - array of value to be set against key
     * @return $query
     * */
    function contains($operator = '', $query = array(), $key = '', $value = array()) {
        if (!(!\Contentstack\Utility\isEmpty($key) && is_string($key) && is_array($value)))
            throw createError('Invalid input for "'.getFunctionName().'". Key should be string and value must be array.');
        $query[$key] = array($operator => $value);
        return $query;
    }
}

if (!function_exists('pagination')) {
    /*
     * pagination
     * Creates the skip and limit parameters
     * @param
     *      $operator - key of the query
     *      $query - Query object
     *      $value - value to be set against key
     * @return $query
     * */
    function pagination($operator = '', $query = array(), $value = '') {
        if (!(!\Contentstack\Utility\isEmpty($value) && is_numeric($value)))
            throw createError('Invalid input for "'.getFunctionName().'", it should be Numeric.');
        $query[$operator] = $value;
        return $query;
    }
}

if (!function_exists('language')) {
    /*
     * language
     * Set the locale on the Query
     * @param
     *      $operator - key of the query
     *      $query - Query object
     *      $value - value to be set against key
     * @return $query
     * */
    function language($operator = '', $query = array(), $value = '') {
        if (!(!\Contentstack\Utility\isEmpty($value) && is_string($value)))
            throw createError('Invalid input for "'.getFunctionName().'", it should be String.');
        $query[$operator] = $value;
        return $query;
    }
}

if (!function_exists('sorting')) {
    /*
     * sort
     * sort the field based on the query
     * @param
     *      $operator - key of the query
     *      $query - Query object
     *      $field_uid - field_uid which is to be use for sorting
     * @return $query
     * */
    function sorting($operator = '', $query = array(), $key = '') {
        if (!(!\Contentstack\Utility\isEmpty($key) && is_string($key)))
            throw createError('Invalid input for "'.getFunctionName().'". Value should be valid field in entry');
        $query[$operator] = $key;
        return $query;
    }
}

if (!function_exists('addBoolean')) {
    /*
     * addBoolean
     * Set the boolean parameter on the Query
     * @param
     *      $operator - key of the query
     *      $query - Query object
     *      $value - value to be set against key
     * @return $query
     * */
    function addBoolean($operator = '', $query = array()) {
        $query[$operator] = 'true';
        return $query;
    }
}

if (!function_exists('existence')) {
    /*
     * existence
     * Set the boolean parameter on the Query
     * @param
     *      $operator - $operator of the query
     *      $query - Query object
     *      $key - field_uid against which query to be checked
     *      $value - value to be set against key
     * @return $query
     * */
    function existence($operator = '', $query = array(), $key = '', $value = false) {
        if (!(!\Contentstack\Utility\isEmpty($key) && is_string($key)))
            throw createError('Invalid input for "'.getFunctionName().'". Key should be valid String field uid');
        $query[$key] = array($operator => $value);
        return $query;
    }
}

