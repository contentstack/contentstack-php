<?php
/*
 * Dependency loading
 * */
namespace Contentstack\Stack\Asset;

use Contentstack\Utility;

require_once __DIR__.'/base_query.php';


/*
 * Class Asset
 * */
class Asset {
    var $operation;
    var $assetUid = '';
    var $stack    = '';


    /*
     * Asset
     * Asset Class to initalize your Asset
     * @param
     *      Asset_UId - valid Asset uid
     * */
    public function __construct($asset_uid = '', $stack = '') {  

         $this->stack = $stack;
         $this->assetUid = $asset_uid;
          

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