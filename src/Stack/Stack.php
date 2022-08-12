<?php
/**
 * Stack Class to initialize the provided parameter Stack
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
use Contentstack\Stack\ContentType;
use Contentstack\Stack\Assets;

require_once __DIR__."/../Config/index.php";
/**
 * Stack Class to initialize the provided parameter Stack
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2021 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
class Stack
{
    /* header - array where all the headers for the request will be stored */
    var $header = array();
    /* host - Host to be used to fetch the content */
    private $host = HOST;
    /* port - Port of the HOST */
    private $port = PORT;
    /* protocol - Protocol to be used to fetch the content */
    private $protocol = PROTOCOL;
    /* environment - Environment on which content published to be retrieved */
    private $environment;

    /**
     * Constructor of the Stack
     * 
     * @param string $api_key        - API Key of Stack
     * @param string $delivery_token - Delivery Token of Stack
     * @param string $environment    - Environment Name of Stack
     * @param string $region         - API Key of Stack
     * */
    public function __construct(
        $api_key = '', 
        $delivery_token = '', 
        $environment = '', 
        $config = array('region'=> '', 'branch'=> '', 'live_preview' => array())
    ) {
        $previewHost = 'api.contentstack.io';
        if ($config && $config !== "undefined" && array_key_exists('region', $config) && $config['region'] !== "undefined" && $config['region'] =="eu" ) {
            $this->host = $config['region'].'-cdn.contentstack.com';
            $previewHost =  $config['region'].'-api.contentstack.com';
        }
        $this->header = Utility::validateInput(
            'stack', array('api_key' => $api_key, 
            'access_token' => $delivery_token, 
            'environment' => $environment, 
            'region' => $config['region'] ?? '',
            'branch' => $config['branch'] ?? '')
        );
        $this->environment = $this->header['environment'];
        unset($this->header['environment']);
        $livePreview = array('enable' => false, 'host' => $previewHost);
        $this->live_preview = $config['live_preview'] ? array_merge($livePreview, $config['live_preview']) : $livePreview;
        $this->proxy = array_key_exists("proxy",$config) ? $config['proxy'] : array('proxy'=>array());
        $this->timeout = array_key_exists("timeout",$config) ? $config['timeout'] : '3000';
        $this->retryDelay = array_key_exists("retryDelay",$config) ? $config['retryDelay'] : '3000';
        $this->retryLimit = array_key_exists("retryLimit",$config) ? $config['retryLimit'] : '5';
        $this->errorRetry = array_key_exists("errorRetry",$config) ? $config['errorRetry'] : array('errorRetry'=>array(408, 429));
        return $this;
    }

    /**
     * To initialize the ContentType object from 
     * where the content will be fetched/retrieved.
     * 
     * @param string $contentTypeId - valid content type 
     *                              uid relevant to configured stack
     * 
     * @return ContentType
     * */
    public function ContentType($contentTypeId = '') 
    { 
        return new ContentType($contentTypeId, $this);
    }


    /**
     * Assets Class to initalize your Assets
     * 
     * @param string $assetUid - valid asset uid relevent to configured stack
     *
     * @return Assets
     * */
    public function Assets($assetUid = '') 
    {
        return new Assets($assetUid, $this);
    }


    /**
     * ImageTrasform function is define for image manipulation with different
     * 
     * @param $url        : Image url on which we want to manipulate. 
     * @param $parameters : It is an second parameter 
     *                    in which we want to place different 
     *                    manipulation key and value in array form
     *      
     * @return string
     * */    
    public function ImageTrasform($url, $parameters)
    {     
        if (is_string($url) === true && strlen($url) > 0 
            && is_array($parameters) === true 
            && count($parameters) > 0
        ) {
            $params = array();
            foreach ($parameters as $key => $value) {
                array_push($params, $key . '=' .$value);
            }         
            $params = implode("&", $params);

            $url = (strpos($url, '?') === false) 
            ? $url .'?'.$params: 
            $url .'&'.$params;

            return $url;
        } else {
            Utility::debug(
                "Please provide valid url 
                and array of transformation parameters."
            );
        }                                   
    }

    public function LivePreviewQuery($parameters) {
        $this->live_preview['live_preview'] = $parameters['live_preview'] ?? 'init';
        $this->live_preview['content_type_uid'] = $parameters['content_type_uid'] ?? null;
    }

    /**
     * To get the last_activity information of the 
     * configured environment from all the content types
     * 
     * @return Result
     * */
    public function getLastActivities()
    {
        $this->_query = array("only_last_activity" => "true");
        return Utility::getLastActivites($this);
    }

    /**
     * To set the host on stack object
     * 
     * @param string $host - host name/ipaddress from where the content to be fetched
     * 
     * @return Stack
     * */
    public function setHost($host = '')
    {
        Utility::validateInput('host', $host);
        $this->host = $host;
        return $this;
    }
    /**
     * This function returns host.
     * 
     * @return string
     * */
    public function getHost()
    {
        return $this->host;
    }
    /**
     * This function sets protocol.
     * 
     * @param string $protocol - protocol type
     * 
     * @return Stack
     * */
    public function setProtocol($protocol = '')
    {
        Utility::validateInput('protocol', $protocol);
        $this->protocol = $protocol;
        return $this;
    }
    /**
     * This function return protocol type.
     * 
     * @return string
     * */
    public function getProtocol()
    {
        return $this->protocol;
    }
    /**
     * This function sets Port.
     * 
     * @param string $port - Port Number
     * 
     * @return Stack
     * */
    public function setPort($port = '')
    {
        Utility::validateInput('port', $port);
        $this->port = $port;
        return $this;
    }

    /**
     * This function return Port.
     * 
     * @return string
     * */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * This function sets API Key.
     * 
     * @param string $api_key - API Key
     * 
     * @return Stack
     * */
    public function setAPIKEY($api_key = '')
    {
        Utility::validateInput('api_key', $api_key);
        $this->header['api_key'] = $api_key;
        return $this;
    }
    /**
     * This function sets Delivery Token.
     * 
     * @param string $delivery_token - Delivery Token
     * 
     * @return Stack
     * */
    public function setDeliveryToken($delivery_token = '')
    {
        Utility::validateInput('access_token', $delivery_token);
        $this->header['access_token'] = $delivery_token;
        return $this;
    }

    /**
     * This function sets environment name.
     * 
     * @param string $environment - Name of Environment
     * 
     * @return Stack
     * */
    public function setEnvironment($environment = '')
    {
        Utility::validateInput('environment', $environment);
        $this->environment = $environment;
        return $this;
    }
    
    /**
     * This function returns API Key.
     * 
     * @return string
     * */
    public function getAPIKEY()
    {
        return $this->header['api_key'];
    }
    /**
     * This function returns Delivery Token.
     * 
     * @return string
     * */
    public function DeliveryToken()
    {
        return $this->header['access_token'];
    }
    /**
     * This function returns environment name.
     * 
     * @return string
     * */
    public function getEnvironment() 
    {
        return $this->environment;
    }

    /**
     * This function sets Branch.
     * 
     * @param string $branch - Name of branch
     * 
     * @return Stack
     * */
    public function setBranch($branch = '')
    {
        Utility::validateInput('branch', $branch);
        $this->header['branch'] = $branch;
        return $this;
    }

    /**
     * This function returns Branch.
     * 
     * @return string
     * */
    public function Branch()
    {
        return $this->header['branch'];
    }

    /**
     * This call returns comprehensive information of all 
     * the content types available in a particular stack in your account.
     * 
     * @param object $params - query params for getting content-type.
     * 
     * @return Stack
     * */
    public function getContentTypes($params) 
    {
        if ($params && $params !== "undefined") {
            $myArray = json_decode($params, true);
            $this->_query = $myArray;
        }
        
        return Utility::contentstackRequest($this, $this, "getcontentTypes");
    }

    /**
     * Syncs your Contentstack data with your app and ensures that the data is always up-to-date by providing delta updates
     * 
     * @param object $params -  params is an object that supports ‘locale’, ‘start_date’, ‘content_type_uid’, and ‘type’ queries.
     * 
     * @return Stack
     * */
    public function sync($params) 
    {
        if ($params && $params !== "undefined") {
            $this->_query = $params;
        }
        return Utility::contentstackRequest($this, $this, "sync");
    }
}