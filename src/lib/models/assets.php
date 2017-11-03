<?php
/*
 * Dependency loading
 * */
namespace Contentstack\Stack\Assets;


use Contentstack\Stack\ContentType\Query\Query;
// use Contentstack\Stack\ContentType\BaseQuery\BaseQuery;
use Contentstack\Utility;


require_once __DIR__.'/query.php';
// require_once __DIR__."/base_query.php";


/*
 * Class Assets
 * */
class Assets {

    var $operation;
    var $assetUid = '';
    var $stack = '';
    var $type = '';
   
   
    /*
     * 
     * Assets constructor
     * @param
     *      
     * */
    public function __construct($asset_uid = '', $stack = '') { 

         $this->stack = $stack;
         if($asset_uid == ''){
            $this->type = 'assets';
        }else{
            $this->type = 'asset';
            $this->assetUid = $asset_uid;  
         }
    }

    /*
     * Query
     * Query object to create the "Query" on the specified ContentType
     * @returns Query
     * */
    public function Query() {
        return new Query($this, $this->type);
    }


     /*
     * fetch
     * Fetch the specified assets
     * */
    public function fetch() {
        $this->operation = __FUNCTION__;
       return \Contentstack\Utility\contentstackRequest($this, 'asset');
    }
}