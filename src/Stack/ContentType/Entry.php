<?php
/**
 * An entry is the actual piece of content that you want to publish. 
 * Entries can be created for one of the available content types.
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

namespace Contentstack\Stack\ContentType;

use Contentstack\Stack\BaseQuery;
use Contentstack\Support\Utility;

/**
 * Entry
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2020 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
class Entry extends BaseQuery
{
    var $operation;
    var $_query;
    var $entryUid;
    var $contentType = array();

    /**
     * Entry Class to initalize your Entry
     * 
     * @param string $entryUid    - Entry to be fetched.
     * @param string $contentType - contentType of Entry to be fetched.
     * */
    public function __construct($entryUid = '', $contentType = '')
    {
        $this->entryUid = $entryUid;
        parent::__construct($contentType, $this);
        if (!Utility::isEmpty($entryUid)) {
            return $this;
        }
    }

    /**
     * Fetch the specified entry
     * 
     * @return Request
     * */
    public function fetch()
    {
        $this->operation = __FUNCTION__;
        return Utility::contentstackRequest($this);
    }
}