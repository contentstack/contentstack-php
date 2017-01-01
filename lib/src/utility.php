<?php
/*
 * Utility/Helper where all the helper and utility functions will be available.
 * */
namespace Contentstack\Utility;

require_once __DIR__ . "/models/result.php";

use Contentstack\Result\Result;

if (!function_exists('validateInput')) {
    /*
     * Validation for all the parameters required for the SDK
     * @param
     *      string|type  - type of the value to be validated
     *      object|input - value of the respective type
     * */
    function validateInput($type = '', $input = array()) {
        $msg = '';
        try {
            switch ($type) {
                case 'stack' :
                    if(!(isKeySet($input,'api_***') && isKeySet($input, 'access_token') && isKeySet($input, 'environment')))
                        $msg = 'Please provide valid api_***, access_token and environment';
                    break;
                case 'port' :
                    if(isEmpty($input) || !is_numeric($input))
                        $msg = 'Please provide valid string for '.$type;
                    break;
                case 'protocol' :
                    if(isEmpty($input) || !is_string($input) || !array_search($input, array('http', 'https')))
                        $msg = 'Please provide valid string for '.$type.' And it should be either http or https';
                    break;
                case 'host' :
                case 'access_token' :
                case 'environment' :
                case 'api_***' :
                    if(isEmpty($input) || !is_string($input))
                        $msg = 'Please provide valid string for '.$type;
                    break;
            }
            if(!isEmpty($msg)) throw new \Exception($msg);
            return $input;
        } catch (\Exception $e) {
            echo "Validation Exception: ".$e->getMessage();
            throw new \Exception($e->getMessage());
        }
    }
}

if(!function_exists('getDomain')) {
    /*
     * getDomain
     * Get the domain from the current object
     * @param
     *      Stack instance
     * @return String
     * */
    function getDomain($query) {
        $stack = $query;
        if($query && isset($query->contentType)) $stack = $query->contentType->stack;
        return $stack->getProtocol().'://'.$stack->getHost().':'.$stack->getPort().VERSION;
    }
}

if(!function_exists('URL')) {
    /*
     * URL
     * URL method to create the url based on the request
     * @param
     *  @queryObject - Object - Query Object
     * @return URL()string
     * */
    function URL($queryObject = '', $type = '') {
        $URL = '';
        switch ($type) {
            case 'set_environment':
                $URL = getDomain($queryObject).ENVIRONMENTS.''.$queryObject->contentType->stack->getEnvironment();
                break;
            case 'get_last_activites':
                $URL = getDomain($queryObject).CONTENT_TYPES;
                break;
            default:
                $URL = getDomain($queryObject).CONTENT_TYPES.$queryObject->contentType->uid.ENTRIES;
                if(isset($queryObject->entryUid)) $URL.=$queryObject->entryUid;
        }
        $queryParams = generateQueryParams($queryObject);
        return $URL.'?'.$queryParams;
    }
}

if(!function_exists('headers')) {
    /*
     * header
     * Header transformation as it required format
     * @param
     *  array - input headers in *** value pair
     * @return array
     * */
    function headers($query = '') {
        $headers = array();
        if($query) {
            if(isset($query->header)) {
                $headers = $query->header;
            } else if($query && isset($query->contentType)){
                $headers = $query->contentType->stack->header;
            }
        }
        return $headers;
    }
}

if(!function_exists('generateQuery')) {
    /*
     * generateQuery
     * POST formatted query for the API server
     * @param
     *  array - Query array
     * @return json
     * */
    function generateQuery($query = array()) {
        $result = array();
        if(isset($query->contentType)) {
            $query->_query['environment'] = $query->contentType->stack->getEnvironment();
            $subQuery = array();
            if(count($query->subQuery) > 0) $subQuery['query'] = json_encode($query->subQuery);
            $result = array_merge($query->_query, $subQuery);
        } else {
            $query->_query['environment'] = $query->getEnvironment();
            $result = array_merge($result, $query->_query);
        }
        return $result;
    }
}

if(!function_exists('generateQueryParams')) {
    /*
     * generateQueryParams
     * Sending the GET requests with all the parameters in POST as well as GET
     * @param
     *  array - Query array
     * @return QueryParameters
     * */
    function generateQueryParams($query = array()) {
        $QueryParams = generateQuery($query);
        $Headers     = headers($query);
        $result      = array_merge($QueryParams, $Headers);
        return http_build_query($result);
    }
}

if(!function_exists('wrapResult')) {
    /*
     * wrapResult
     * wrapResult
     * @param
     *
     * @return ResultWrapped Object
     * */
    function wrapResult($result = '', $queryObject = '') {
        $result = $wrapper = json_decode($result, true);
        if($result && $queryObject && isset($queryObject->operation)) {
            $flag =  (isset($queryObject->json_translate) && $queryObject->json_translate);
            switch ($queryObject->operation) {
                case 'findOne':
                    if(isKeySet($result, 'entries') && count($result['entries']) > 0) {
                        $wrapper = ($flag) ? $result['entries'][0] : new Result($result['entries'][0]);
                    } else {
                        $wrapper = json_encode(array("error_code" => 119, "error_message" => "The requested entry doesn't exists"));
                    }
                    break;
                case 'fetch':
                    if(isKeySet($result, 'entry')) $wrapper = (!$flag) ? new Result($result['entry']) : $result['entry'];
                    break;
                case 'find':
                    $wrapper = array();
                    if(isKeySet($result, 'entries')) {
                        for($i = 0, $_i = count($result['entries']); $i < $_i && !$flag; $i++) {
                            $result['entries'][$i] = new Result($result['entries'][$i]);
                        }
                        array_push($wrapper, $result['entries']);
                    }
                    if(\Contentstack\Utility\isKeySet($result, 'schema')) array_push($wrapper, $result['schema']);
                    if(\Contentstack\Utility\isKeySet($result, 'content_type')) array_push($wrapper, $result['content_type']);
                    if(\Contentstack\Utility\isKeySet($result, 'count')) array_push($wrapper, $result['count']);
                    break;
            }
        }
        return $wrapper;
    }
}

if (!function_exists('request')) {
    /*
     * request
     * request to the API server based on the data
     * @param
     *  @queryObject - Object - Query Object
     * @return Result
     * */
    function request($queryObject = '', $type = '') {
        $server_output = '';
        if($queryObject) {
            $ch = curl_init(URL($queryObject, $type));
            // debug(URL($queryObject, $type));
            // setting the GET request
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            // receive server response ...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec ($ch);
            // wrapper the server result
            $server_output = wrapResult($server_output, $queryObject);
            curl_close ($ch);
        }
        return $server_output;
    }
}

if (!function_exists('isKeySet')) {
    /*
     * Validate the *** is set or not
     * */
    function isKeySet($input = array(), $*** = '') {
        return ($*** && isset($input[$***])) ? true : false;
    }
}

if (!function_exists('isEmpty')) {
    /*
     * Validate the String
     * */
    function isEmpty($input) {
        return (empty($input));
    }
}

if (!function_exists('getLastActivites')) {
    /*
     * Get Last activities
     * */
    function getLastActivites($queryObject) {
        return request($queryObject, 'get_last_activites');
    }
}

if (!function_exists('debug')) {
    /*
     * DEBUGGING MESSAGE
     * */
    function debug($input, $exit = false) {
        echo "<pre>";
        print_r($input);
        echo "</pre>";
        if($exit) exit();
    }
}

