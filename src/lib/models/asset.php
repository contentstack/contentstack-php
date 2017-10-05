<?php
/*
 * Dependency loading
 * */
namespace Contentstack\Stack\Asset;


use Contentstack\Stack\ContentType\BaseQuery\BaseQuery;
use Contentstack\Utility;

require_once __DIR__."/base_query.php";
require_once __DIR__."/../utility.php";


/*
 * Class Asset
 * */
class Asset extends BaseQuery  {
    var $operation;
    var $assetUid = '';
    var  $stack = '';
    var  $type = '';

    /*
     * Asset
     * Asset Class to initalize your Asset
     * @param
     *      Asset_UId - valid Asset uid
     * */
    public function __construct($asset_uid = '', $stack = '') {  
         $this->stack    = $stack;
         $this->assetUid = $asset_uid;
         $this->type     = 'asset'; 
         parent::__construct($this);
         if(!\Contentstack\Utility\isEmpty($asset_uid)) 
            return $this;
          

    }

     /*
     * fetch
     * Fetch the specified assets
     * */
    public function fetch() {
        $this->operation = __FUNCTION__;
       return \Contentstack\Utility\request($this, 'asset');
    }

}