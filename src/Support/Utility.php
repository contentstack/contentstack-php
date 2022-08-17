<?php
/**
 * Utility/Helper where all the helper and utility functions will be available.
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
namespace Contentstack\Support;

use Contentstack\Error\CSException;
use Contentstack\Stack\Result;

/**
 * Utility/Helper where all the helper and utility functions will be available.
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2021 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
class Utility
{
    /**
     * Validation for all the parameters required for the SDK
     * 
     * @param string $type  - type of the value to be validated
     * @param object $input - value of the respective type
     * 
     * @return array
     * */
    public static function validateInput($type = '', $input = array())
    {
        $msg = '';
        try {
            switch ($type) {
            case 'stack' :
                if ($input['region']) {
                    if (!(Utility::isKeySet($input, 'api_key') 
                        && Utility::isKeySet($input, 'access_token') 
                        && Utility::isKeySet($input, 'environment') 
                        && Utility::isKeySet($input, 'region'))
                    ) {
                        $msg = 'Please provide valid api_key, 
                            access_token, 
                            environment and region';
                    }
                    break;
                } else {
                    if (!(Utility::isKeySet($input, 'api_key') 
                        && Utility::isKeySet($input, 'access_token') 
                        && Utility::isKeySet($input, 'environment'))
                    ) {
                        $msg = 'Please provide valid api_key, 
                        access_token and environment';
                    }
                    break;
                }

            case 'port' :
                if (Utility::isEmpty($input) || !is_numeric($input)) {
                    $msg = 'Please provide valid string for '.$type;
                }
                break;
            case 'protocol' :
                if (Utility::isEmpty($input) 
                    || !is_string($input) 
                    || !array_search($input, array('http', 'https'))
                ) {
                    $msg = 'Please provide valid string for '
                    .$type.' And it should be either http or https';
                }
                break;
            case 'host' :
            case 'access_token' :
            case 'environment' :
            case 'api_key' :
                if (Utility::isEmpty($input) || !is_string($input)) {
                    $msg = 'Please provide valid string for '.$type;
                }
                break;
            }
            if (!Utility::isEmpty($msg)) {
                throw new \Exception($msg);
            }
            return $input;
        } catch (\Exception $e) {
            echo "Validation Exception: ".$e->getMessage();
            throw new \Exception($e->getMessage());
        }
    }

    public static function isLivePreview($query) {
        if ($query && isset($query->contentType)) { 
            return ($query->contentType->stack->live_preview['enable'] == true && array_key_exists('content_type_uid', $query->contentType->stack->live_preview) && strcmp($query->contentType->uid, $query->contentType->stack->live_preview['content_type_uid']) == 0);
        }
        return false;
    }

    /**
     * Get the domain from the current object
     * 
     * @param Stack $query - Instance of S.tack
     * 
     * @return String
     * */
    public static function getDomain($query)
    {
        $stack = $query;  
        if ($query && isset($query->contentType)) { 
            $stack = $query->contentType->stack;
        }
        if ($query && isset($query->stack)) {
            $stack = $query->stack;
        }
        if ($query && isset($query->assets)) {
            $stack = $query->assets->stack;
        }
        $host = $stack->getHost();
        if (Utility::isLivePreview($query)) {
            $host = $stack->live_preview['host'];
        }
        return $stack->getProtocol()
            .'://'.$host
            .':'
            .$stack->getPort().VERSION;
    }

    /**
     * Contentstack URL method to create the url based on the request
     * 
     * @param object $queryObject - Query Object
     * @param string $type        - type for url
     * 
     * @return string
     * */
    public static function contentstackUrl($queryObject = '', $type = '')
    {
        $URL = '';
        switch ($type) {
        case 'set_environment':
            if (!Utility::isLivePreview($queryObject)) {
                $URL = Utility::getDomain($queryObject).ENVIRONMENTS.''
                .$queryObject->contentType->stack->getEnvironment();
            }
            break;
        case 'get_last_activites':
            $URL = Utility::getDomain($queryObject).CONTENT_TYPES;
            break;
        case 'getcontentTypes':
            $URL = Utility::getDomain($queryObject).CONTENT_TYPES;
            break;    
        case 'asset':
            $URL = Utility::getDomain($queryObject).ASSETS.$queryObject->assetUid;
            break;
        case 'assets':
            $URL = Utility::getDomain($queryObject).ASSETS;
            break;
        case 'sync':
            $URL = Utility::getDomain($queryObject).SYNC;
            break;                     
        default:
            $URL = Utility::getDomain($queryObject).CONTENT_TYPES
            .$queryObject->contentType->uid.ENTRIES;
            if (isset($queryObject->entryUid)) {
                $URL.=$queryObject->entryUid;
            }
        }
        
        $queryParams = Utility::generateQueryParams($queryObject);
        return $URL.'?'.$queryParams;

    }

    /**
     * Header transformation as it required format
     * 
     * @param array $query - input headers in key value pair
     * 
     * @return array
     * */
    public static function headers($query = '')
    {
        $headers = array();
        if ($query) {
            if (isset($query->header)) {
                $headers = $query->header;
            } elseif ($query && isset($query->stack)) {
                $headers = $query->stack->header;
            } elseif ($query && isset($query->contentType)) {
                $headers = $query->contentType->stack->header;
            } else {
                $headers = $query->assets->stack->header;
            }
        }
        return $headers;
    }

    /**
     * POST formatted query for the API server
     * 
     * @param array $query - Query array
     * 
     * @return json
     * */
    public static function generateQuery($query = array())
    {
        $result = array();
        if (isset($query->contentType)) {
            $query->_query['environment'] = $query->contentType
                ->stack->getEnvironment();
            $subQuery = array();
            if (count($query->subQuery) > 0) {
                $subQuery['query'] = json_encode($query->subQuery);
            }

            $include_schema = array_search(
                'include_schema',
                array_keys($query->_query)
            );
            $include_content_type = array_search(
                'include_content_type', 
                array_keys($query->_query)
            );

            if ($include_schema < $include_content_type) {
                foreach ($query->_query as $key => $value) {
                    if ($key == 'include_schema') { 
                        unset($query->_query['include_schema']);
                        $query->_query["include_schema"] = "true";
                    }
                }
            }

            $result = array_merge($query->_query, $subQuery);
        } elseif (isset($query->stack)) {       
            $query->_query['environment'] = $query->stack->getEnvironment();
            $result = array_merge($result, $query->_query);

        } elseif (isset($query->assets)) {
            $query->_query['environment'] = $query->assets->stack->getEnvironment();
            $subQuery = array();
            if (count($query->subQuery) > 0) {
                $subQuery['query'] = json_encode($query->subQuery);
            }
            $result = array_merge($query->_query, $subQuery);
        } else {
            $query->_query['environment'] = $query->getEnvironment();
            $result = array_merge($result, $query->_query);
        }
        return $result;
    }

    /**
     * Sending the GET requests with all the parameters in POST as well as GET
     * 
     * @param array $query - Query array
     * 
     * @return QueryParameters
     * */
    public static function generateQueryParams($query = array())
    {
        $result = Utility::generateQuery($query);
        return http_build_query($result);
    }

    /**
     * Wrap Result
     * 
     * @param object $result      - Response content
     * @param object $queryObject - Query object
     *
     * @return ResultWrapped Object
     * */
    public static function wrapResult($result = '', $queryObject = '')
    {
        $result = $wrapper = json_decode($result, true);            
        if ($result && $queryObject && isset($queryObject->operation)) {
            $flag =  (isset($queryObject->json_translate) 
            && $queryObject->json_translate);
            switch ($queryObject->operation) {
            case 'findOne':
                if (Utility::isKeySet($result, 'entries') 
                    && count($result['entries']) > 0
                ) {
                    $wrapper = ($flag) ? $result['entries'][0] : 
                        new Result(
                            $result['entries'][0]
                        );
                } else {
                    $wrapper = json_encode(
                        array(
                            "error_code" => 119, 
                            "error_message" => "The requested entry doesn't exists"
                        )
                    );
                }
                break;
            case 'fetch':
                if (Utility::isKeySet($result, 'entry')) {
                    $wrapper = (!$flag) ? 
                    new Result(
                        $result['entry']
                    ) 
                    : $result['entry'];
                } elseif (Utility::isKeySet($result, 'asset')) {
                    $wrapper = (!$flag) ? 
                    new Result(
                        $result['asset']
                    ) 
                    : $result['asset'];
                } elseif (Utility::isKeySet($result, 'schema')) {
                    array_push($wrapper, $result['schema']);
                } elseif (Utility::isKeySet($result, 'content_type')) {
                    array_push($wrapper, $result['content_type']);  
                }  
                break;
            case 'find':
                $wrapper = array();
                if (Utility::isKeySet($result, 'entries')) {
                    if (!is_numeric($result['entries'])) {
                        for ($i = 0, 
                            $_i = count($result['entries']); 
                            $i < $_i && !$flag; $i++) {
                            $result['entries'][$i] = new Result(
                                $result['entries'][$i]
                            );
                        }
                    }
                    array_push($wrapper, $result['entries']);
                }
                if (Utility::isKeySet($result, 'assets')) {
                    if (!is_numeric($result['assets'])) {
                        for ($i = 0, 
                            $_i = count($result['assets']); 
                            $i < $_i && !$flag; $i++
                        ) {
                            $result['assets'][$i] = new Result(
                                $result['assets'][$i]
                            );
                        }
                    } 
                    array_push($wrapper, $result['assets']);    
                }
            
                if (Utility::isKeySet($result, 'schema')) {
                    array_push($wrapper, $result['schema']);
                }
                if (Utility::isKeySet($result, 'content_type')) {
                    array_push($wrapper, $result['content_type']);
                }
                if (Utility::isKeySet($result, 'count')) {
                    array_push($wrapper, $result['count']);
                }
                break;
            }
        }
        return $wrapper;
    }
    
    /**
     * Contentstack request to the API server based on the data
     * 
     * @param object $queryObject - Query Object
     * @param object $type        - type of request
     * 
     * @return Result
     * */
    public static function contentstackRequest($stack, $queryObject = '', $type = '', $count = 0)
    {
        $retryDelay = $stack->retryDelay;
        $retryLimit = $stack->retryLimit;
        $errorRetry = $stack->errorRetry;
        if ($queryObject) {
            if (Utility::isLivePreview($queryObject)) {
                $queryObject->_query['live_preview'] = ($queryObject->contentType->stack->live_preview['live_preview'] ?? 'init');
            }
            $http = curl_init(Utility::contentstackUrl($queryObject, $type));  

            // setting the HTTP Headers
            $Headers     = Utility::headers($queryObject);

            $request_headers = array();
            $request_headers[] = 'x-user-agent: contentstack-php/2.1.0';
            $request_headers[] = 'api_key: '.$Headers["api_key"];
            if (Utility::isLivePreview($queryObject)) {
                $request_headers[] = 'authorization: '.$queryObject->contentType->stack->live_preview['management_token'] ;
            }else {
                $request_headers[] = 'access_token: '.$Headers["access_token"];
            }
            if ($Headers["branch"] !== '' && $Headers["branch"] !== "undefined") {
                $request_headers[] = 'branch: '.$Headers["branch"];
            }

            $proxy_details = $stack->proxy;
            $timeout = $stack->timeout;

            curl_setopt($http, CURLOPT_HTTPHEADER, $request_headers);
            
            curl_setopt($http, CURLOPT_HEADER, false);
            // setting the GET request
            curl_setopt($http, CURLOPT_CUSTOMREQUEST, "GET");
            // receive server response ...
            curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
            // set the cURL time out
            curl_setopt($http, CURLOPT_TIMEOUT_MS, $timeout);

            if(array_key_exists("url",$proxy_details) && array_key_exists("port",$proxy_details)){
                if($proxy_details['url'] != '' && $proxy_details['port'] != '') {

                    // Set the proxy IP
                    curl_setopt($http, CURLOPT_PROXY, $proxy_details['url']);
                    // Set the port
                    curl_setopt($http, CURLOPT_PROXYPORT, $proxy_details['port']);
                    
                    if(array_key_exists("username",$proxy_details) && array_key_exists("password",$proxy_details)){
                        if($proxy_details['username'] != '' && $proxy_details['password'] != '') {

                            $proxyauth = $proxy_details['username'].":".$proxy_details['password'];
                            // Set the username and password
                            curl_setopt($http, CURLOPT_PROXYUSERPWD, $proxyauth);
                            
                        }
                    }
                }
            }
            
            $response = curl_exec($http);
            // status code extraction
            $httpcode = curl_getinfo($http, CURLINFO_HTTP_CODE);
            
            // close the curl            
            curl_close($http);
            if(in_array($httpcode,$errorRetry)){
                if($count < $retryLimit){
                    $retryDelay = round($retryDelay/1000); //converting retry_delay from milliseconds into seconds
                    sleep($retryDelay); //sleep method requires time in seconds
                    $count += 1;
                    return Utility::contentstackRequest($stack, $queryObject, $type, $count);
                }
            } else {
                if ($httpcode > 199 && $httpcode < 300) {
                    // wrapper the server result
                    $response = Utility::wrapResult($response, $queryObject);  
                }
                else{
                    throw new CSException($response, $httpcode);
                }
            }
        }
        return $response;
    }


    /**
     * Validate the key is set or not
     * 
     * @param array  $input - input 
     * @param string $key   - key to check
     * 
     * @return boolean
     * */
    public static function isKeySet($input = array(), $key = '')
    {
        return ($key && isset($input[$key])) ? true : false;
    }

    /**
     * Validate the String
     * 
     * @param object $input - object to check for empty
     * 
     * @return boolean
     * */
    public static function isEmpty($input) 
    {
        return (empty($input));
    }

    /**
     * Get Last activities
     * 
     * @param object $queryObject - query object
     * 
     * @return object
     * */
    public static function getLastActivites($queryObject) 
    {
        return request($queryObject, 'get_last_activites');
    }

    /**
     * DEBUGGING MESSAGE
     * 
     * @param object  $input - object to debug
     * @param boolean $exit  - to exit on debug
     * 
     * @return object
     * */
    public static function debug($input, $exit = false)
    {
        echo "<pre>";
            print_r($input);
        echo "</pre>";
        if ($exit) { 
            exit();
        }
    }
}