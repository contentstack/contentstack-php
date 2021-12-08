<?php
/**
 * CSException
 * CSException Class is used to wrap the REST API error
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

namespace Contentstack\Error;

/**
 * CSException
 * CSException Class is used to wrap the REST API error
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2021 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
class CSException extends \Exception
{
    var $error_message;
    var $error_code;
    var $http_code;
    /**
     * CSException Class to initalize your ContentType
     * 
     * @param string $error     - Error message
     * @param Stack  $http_code - Erro code
     * */
    function __construct($error, $http_code = 412) 
    {
        $error = json_decode($error, true);
        $this->error_message = (
            isset(
                $error['error_message']
            )
            ) ? 
            $error['error_message'] : 
            "It seems Contentstack is behaving badly. 
            Please contact support@contentstack.io.";

        $this->error_code    = (
            isset($error['error_code'])
            ) ? 
            $error['error_code'] : null;
        $this->errors        = (
            isset($error['errors'])
            ) ? $error['errors'] : 
            array();
        $this->http_code     = $http_code;
        parent::__construct($this->error_message, $this->error_code, null);
    }

    /**
     * To get http status_code of the current exception
     * 
     * @return HttpCode|string
     * */
    function getStatusCode() 
    {
        return $this->http_code;
    }

    /**
     * Returns error details of current exception
     * 
     * @return error|array
     * */
    function getErrors() 
    {
        return $this->errors;
    }
}