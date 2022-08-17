<?php
/**
 * Assets refer to all the media files (images, videos, PDFs, 
 * audio files, and so on) uploaded in your Contentstack 
 * repository for future use.
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

require_once __DIR__ . "/../Support/helper.php";

use Contentstack\Stack\ContentType\Query;
use Contentstack\Stack\BaseQuery;
use Contentstack\Support\Utility;

/**
 * Assets refer to all the media files (images, videos, PDFs, 
 * audio files, and so on) uploaded in your Contentstack 
 * repository for future use.
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2021 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 * */
class Assets extends BaseQuery
{

    var $operation;
    var $assetUid = '';
    var $stack = '';
    var $type = '';
   
   
    /**
     * Assets constructor
     * 
     * @param string $asset_uid - valid asset uid relevent to configured stack
     * @param Stack  $stack     - valid stack configured details 
     * */
    public function __construct($asset_uid = '', $stack = '')
    { 
        if ($asset_uid == '') {
            $this->stack  = $stack;
            $this->type = 'assets';
        } else {
            $stack->type = 'asset';
            $this->assetUid = $asset_uid;
            parent::__construct($stack, $this);
        }
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


    /**
     * Fetch the specified assets
     * 
     * @return Request
     * */
    public function fetch()
    {
        $this->operation = __FUNCTION__;
        return Utility::contentstackRequest($this->stack, $this, 'asset');
    }
}

