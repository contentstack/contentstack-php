<?php
/*
 * Utility/Helper where all the helper and utility functions will be available.
 * */
namespace Contentstack\Utility;

 require_once __DIR__ . "/models/result.php";
require_once __DIR__ . "/models/csexception.php";

use Contentstack\Error\CSException;
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
        if($query && isset($query->stack)) $stack = $query->stack;
        if($query && isset($query->assets)) 
            $stack = $query->assets->stack;
        return $stack->getProtocol().'://'.$stack->getHost().':'.$stack->getPort().VERSION;
        
    }
}

if(!function_exists('contentstackUrl')) {
    /*
     * contentstack_url
     * contentstack_url method to create the url based on the request
     * @param
     *  @queryObject - Object - Query Object
     * @return URL()string
     * */
    function contentstackUrl($queryObject = '', $type = '') {
        $URL = '';
        switch ($type) {
            case 'set_environment':
                $URL = getDomain($queryObject).ENVIRONMENTS.''.$queryObject->contentType->stack->getEnvironment();
                break;
            case 'get_last_activites':
                $URL = getDomain($queryObject).CONTENT_TYPES;
                break;
            case 'getcontentTypes':
                $URL = getDomain($queryObject).CONTENT_TYPES;
                break;    
            case 'asset':
                $URL = getDomain($queryObject).ASSETS.$queryObject->assetUid;
                break;
            case 'assets':
                $URL = getDomain($queryObject).ASSETS;
                break;                      
            default:

            $URL = getDomain($queryObject).CONTENT_TYPES.$queryObject->contentType->uid.ENTRIES;
           // \Contentstack\Utility\debug($queryObject);
            // if($queryObject->_query && $queryObject->_query['include_global_field_schema']) {
            //     $URL = getDomain($queryObject).CONTENT_TYPES.$queryObject->uid;    
            // } else {
            //     $URL = getDomain($queryObject).CONTENT_TYPES.$queryObject->contentType->uid.ENTRIES;                    
            // }
            if(isset($queryObject->entryUid)) $URL.=$queryObject->entryUid;
        }
        
        $queryParams = generateQueryParams($queryObject);
        // \Contentstack\Utility\debug(($URL));
        // \Contentstack\Utility\debug(($queryParams));
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
            } else if($query && isset($query->stack)){
                $headers = $query->stack->header;
            } else if($query && isset($query->contentType)){
                $headers = $query->contentType->stack->header;
            } else{
                $headers = $query->assets->stack->header;
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
            $include_schema = array_search('include_schema', array_***s($query->_query));
            $include_content_type = array_search('include_content_type', array_***s($query->_query));
            if($include_schema < $include_content_type){
            foreach ($query->_query as $*** => $value) {
                if($*** == 'include_schema'){ 
                    unset($query->_query['include_schema']);
                    $query->_query["include_schema"] = "true";
                    }
                }
            }

            $result = array_merge($query->_query, $subQuery);
        } elseif (isset($query->stack)) {       
            $query->_query['environment'] = $query->stack->getEnvironment();
            $result = array_merge($result, $query->_query);

        }elseif(isset($query->assets)) {
            $query->_query['environment'] = $query->assets->stack->getEnvironment();
            $subQuery = array();
            if(count($query->subQuery) > 0) 
                $subQuery['query'] = json_encode($query->subQuery);
            $result = array_merge($query->_query, $subQuery);
        }
        else {
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
                    if(isKeySet($result, 'entry'))
                        $wrapper = (!$flag) ? new Result($result['entry']) : $result['entry'];
                    if(isKeySet($result, 'asset'))
                        $wrapper = (!$flag) ? new Result($result['asset']) : $result['asset'];
                    if(\Contentstack\Utility\isKeySet($result, 'schema')) 
                        array_push($wrapper, $result['schema']);
                    if(\Contentstack\Utility\isKeySet($result, 'content_type')) 
                        array_push($wrapper, $result['content_type']);    
                    break;
                case 'find':
                    $wrapper = array();
                    if(isKeySet($result, 'entries')) {
                       if(!is_numeric($result['entries'])) {
                        for($i = 0, $_i = count($result['entries']); $i < $_i && !$flag; $i++) {
                            $result['entries'][$i] = new Result($result['entries'][$i]);
                        }
                    }
                        array_push($wrapper, $result['entries']);
                    }
                    if(isKeySet($result, 'assets')) {
                       if(!is_numeric($result['assets'])) {
                        for($i = 0, $_i = count($result['assets']); $i < $_i && !$flag; $i++) {
                            $result['assets'][$i] = new Result($result['assets'][$i]);
                        }
                       } 
                    array_push($wrapper, $result['assets']);    
                    }
                
                    if(\Contentstack\Utility\isKeySet($result, 'schema')) 
                        array_push($wrapper, $result['schema']);
                    if(\Contentstack\Utility\isKeySet($result, 'content_type')) 
                        array_push($wrapper, $result['content_type']);
                    if(\Contentstack\Utility\isKeySet($result, 'count')) array_push($wrapper, $result['count']);
                    break;
            }
        }
        return $wrapper;
    }
}

if (!function_exists('contentstackRequest')) {
    
    /*
     * contentstack_request
     * contentstack_request to the API server based on the data
     * @param
     *  @queryObject - Object - Query Object
     * @return Result
     * */

    function contentstackRequest($queryObject = '', $type = ''){
        $server_output = '';
        
        if($queryObject) {
            $http = curl_init(contentstackUrl($queryObject, $type));  

            // setting the GET request
            curl_setopt($http, CURLOPT_HEADER, FALSE);
            // setting the GET request
            curl_setopt($http, CURLOPT_CUSTOMREQUEST, "GET");
            // receive server response ...
            curl_setopt($http, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($http);
                     
            // status code extraction
            $httpcode = curl_getinfo($http, CURLINFO_HTTP_CODE);
            //\Contentstack\Utility\debug(($httpcode));
            // close the curl            
            curl_close ($http);
            if($httpcode > 199 && $httpcode < 300) {
                
                // wrapper the server result
                $response = wrapResult($response, $queryObject);
                                     
            } else {
                throw new CSException($response, $httpcode);
            }
        }
        return $response;
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
        print_r ($input);
        echo "</pre>";
        if($exit) exit();
    }
}
