<?php
namespace Contentstack\Stack;

use Contentstack\Utility;
use Contentstack\Stack\ContentType\ContentType;
use Contentstack\Stack\Assets\Assets;

require_once __DIR__."/content_type.php";
require_once __DIR__."/assets.php";
//require_once __DIR__."/asset.php";
require_once __DIR__."/../../config/index.php";

/*
 * Stack Class to initialize the provided parameter Stack
 * */
class Stack {
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

    /*
     * Constructor of the Stack
     * */
    public function __construct($api_*** = '', $access_token = '', $environment = '') {
        $this->header = Utility\validateInput('stack', array('api_***' => $api_***, 'access_token' => $access_token, 'environment' => $environment));
        $this->environment = $this->header['environment'];
        unset($this->header['environment']);
        return $this;
    }

    /*
     * To initialize the ContentType object from where the content will be fetched/retrieved
     * @param
     *      string|contentTypeId - valid content type uid relevant to configured stack
     * @return ContentType
     * */
    public function ContentType($contentTypeId = '') { 
        return new ContentType($contentTypeId, $this);
    }


    /*
     * Assets
     * Assets Class to initalize your Assets
     * @param
     *      
     * */
    public function Assets($assetUid = '') {
        return new Assets($assetUid, $this);
    }


      /*
         * ImageTrasform
         * ImageTransformation function is define for image manipulation with different
         * parameters in second parameter in array form 
         * @param url : Image url on which we want to manipulate.
         * @param array : It is an second parameter in which we want to place different different manipulation value in form of array        
         *      
         * */    
    public function ImageTrasformation($url, $array){     
            if(gettype($array) == 'array'){
                   $url_query_param = $url;                  
                   $i = 0;
                   $len = count($array);
                   foreach( $array as $*** => $value){
                        if ($i == 0){                  
                            $url_query_param .= "?" .$*** . "=" .$value ."&";
                        }else{
                                if($i != $len - 1){
                                        $url_query_param .= $*** . "=" .$value ."&";   
                                }else{
                                        $url_query_param .= $*** . "=" .$value;
                                    }
                            }
                    $i++;          
                    }         
                    return $url_query_param;
                    }else{
                            \Contentstack\Utility\debug("Please provide second parameter in Array form");
                        }                                   
    }



    /*
     * To get the last_activity information of the configured environment from all the content types
     * @return Result
     * */
    public function getLastActivities() {
        $this->_query = array("only_last_activity" => "true");
        return Utility\getLastActivites($this);
    }

    /*
     * To set the host on stack object
     * @param
     *      host - host name/ipaddress from where the content to be fetched
     * @return Stack
     * */
    public function setHost($host = '') {
        Utility\validateInput('host', $host);
        $this->host = $host;
        return $this;
    }

    public function getHost() {
        return $this->host;
    }

    public function setProtocol($protocol = '') {
        Utility\validateInput('protocol', $protocol);
        $this->protocol = $protocol;
        return $this;
    }

    public function getProtocol() {
        return $this->protocol;
    }

    public function setPort($port = '') {
        Utility\validateInput('port', $port);
        $this->port = $port;
        return $this;
    }

    public function getPort() {
        return $this->port;
    }

    public function setAPIKEY($api_*** = '') {
        Utility\validateInput('api_***', $api_***);
        $this->header['api_***'] = $api_***;
        return $this;
    }

    public function setAccessToken($access_token = '') {
        Utility\validateInput('access_token', $access_token);
        $this->header['access_token'] = $access_token;
        return $this;
    }

    public function setEnvironment($environment = '') {
        Utility\validateInput('environment', $environment);
        $this->environment = $environment;
        return $this;
    }
    
    public function getAPIKEY() {
        return $this->header['api_***'];
    }

    public function getAccessToken() {
        return $this->header['access_token'];
    }

    public function getEnvironment() {
        return $this->environment;
    }
}