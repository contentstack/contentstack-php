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
 * @copyright 2012-2020 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
namespace Contentstack\Support;

require_once __DIR__ . "/../lib/models/result.php";
require_once __DIR__ . "/../lib/models/csexception.php";

use Contentstack\Error\CSException;
use Contentstack\Result;

/**
 * Utility/Helper where all the helper and utility functions will be available.
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2020 Contentstack. All Rights Reserved
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
        return $stack->getProtocol()
            .'://'.$stack->getHost()
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
            $URL = Utility::getDomain($queryObject).ENVIRONMENTS.''
            .$queryObject->contentType->stack->getEnvironment();
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
        $QueryParams = Utility::generateQuery($query);
        $Headers     = Utility::headers($query);
        $result      = array_merge($QueryParams, $Headers);
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
    public static function contentstackRequest($queryObject = '', $type = '')
    {
        $server_output = '';
        
        if ($queryObject) {
            $http = curl_init(Utility::contentstackUrl($queryObject, $type));  

            // setting the GET request
            curl_setopt($http, CURLOPT_HEADER, false);
            // setting the GET request
            curl_setopt($http, CURLOPT_CUSTOMREQUEST, "GET");
            // receive server response ...
            curl_setopt($http, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($http);
                     
            // status code extraction
            $httpcode = curl_getinfo($http, CURLINFO_HTTP_CODE);

            // close the curl            
            curl_close($http);
            if ($httpcode > 199 && $httpcode < 300) {
                // wrapper the server result
                $response = Utility::wrapResult($response, $queryObject);            
            } else {
                throw new CSException($response, $httpcode);
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