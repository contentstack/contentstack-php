<?php

/**
 * Result
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

/**
 * Class Result
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2021 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
class Result
{
    private $_object;

    /**
     * Result constructor
     * Result wrapper over the plain result for the future
     * 
     * @param object $result - Response object
     * */
    public function __construct($result = '') 
    {
        $this->_object = $result;

       
    }

    /**
     * To convert result object to json
     * 
     * @return json format of the result
     * */
    public function toJSON() 
    {
        return $this->_object;
    }

    /**
     * Get the keys from the object
     * 
     * @param string $key - key whose corresponding value to be retrieved
     * 
     * @return Value
     * */
    public function get($key) 
    {

        return ($key && is_string($key)) ? $this->_object[$key] : null;
    
    }
}