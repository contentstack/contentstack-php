<?php
/*
 * Dependency loading
 * */
namespace Contentstack\Stack\Assets;

use Contentstack\Stack\Assets\QueryAssets\QueryAssets;
use Contentstack\Utility;

require_once __DIR__.'/queryassets.php';

/*
 * Class ContentType
 * */
class Assets {
   
    var $stack    = '';


    /*
     * ContentType
     * ContentType Class to initalize your ContentType
     * @param
     *      contentTypeId - valid content type uid
     * */
    public function __construct($stack = '') {  
         $this->stack = $stack;
        // \Contentstack\Utility\debug($this);
    }

    public function QueryAssets() {
        return new QueryAssets($this);
    }

}