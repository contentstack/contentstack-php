<?php
/**
 * Query is use to get Entries from specific ContentType
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

namespace Contentstack\Stack\ContentType\Query;

use Contentstack\Stack\ContentType\BaseQuery\BaseQuery;
use Contentstack\Support\Utility;

require_once __DIR__."/base_query.php";
require_once __DIR__."/../../Support/Utility.php";
/**
 * Class Query
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2020 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
class Query extends BaseQuery
{
    var $operation;
    var $_query;

    /**
     * Query Class to initalize your Query
     * 
     * @param string $data - data for query
     * @param string $type - type of query
     * */
    public function __construct($data = '', $type = '') 
    {
        $this->_query = array();
        $this->type = $type;
        parent::__construct($data, $this);
    }

    /**
     * Get all entries based on the specified subquery
     * 
     * @return Request
     * */
    public function find() 
    {
        $this->operation = __FUNCTION__;
        if ($this->type == 'assets') {
            return Utility::contentstackRequest($this, 'assets');
        } else if ($this->type == 'contentType') {
            return Utility::contentstackRequest($this);
        }        
    }
  

    /**
     * Get single entry based on the specified subquery
     * 
     * @deprecated since verion 1.1.0
     * 
     * @return Request
     * */
    public function findOne() 
    {
        $this->operation = __FUNCTION__;
        $this->_query['limit'] = 1;
        if ($this->type == 'assets') {
            return Utility::contentstackRequest($this, 'assets');
        } elseif ($this->type == 'contentType') {
            return Utility::contentstackRequest($this);
        }
    }
}