<?php
/** 
 * Content type lets you define the structure or 
 * blueprint of a page or a section of your web or 
 * mobile property.
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

use Contentstack\Stack\ContentType\Entry;
use Contentstack\Stack\ContentType\Query;
use Contentstack\Support\Utility;
/**
 * Class ContentType
 *  
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2021 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
#[\AllowDynamicProperties]
class ContentType
{
    
    var $uid = '';
    var $stack = '';

    /**
     * ContentType
     * ContentType Class to initalize your ContentType
     * 
     * @param string $uid   - valid content type uid
     * @param Stack  $stack - Stack Instance
     * */
    public function __construct($uid = '', $stack = '') 
    {
        $this->uid = $uid;
        $this->stack = $stack;
        $this->type = 'contentType';
    }

    /**
     * Entry object to create the "Query" on the specified ContentType
     * 
     * @param string $entry_uid - Entry uid to get details
     * 
     * @return Entry
     * */
    public function Entry($entry_uid = '') 
    {
        return new Entry($entry_uid, $this);
    }

    /**
     * Fetch the specific contenttypes
     * 
     * @param object $params - Parameters to fetch content
     * 
     * @return Request
     * */
    public function fetch($params = null) 
    {
        if ($params) {
            $myArray = json_decode($params, true);
            $this->_query = $myArray;
        }        
        return Utility::contentstackRequest($this->stack, $this);
    }
    /**
     * Query object to create the "Query" on the specified ContentType
     * 
     * @return Query
     * */
    public function Query() 
    {
        return new Query($this, $this->type);
    }
}