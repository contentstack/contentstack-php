<?php
/*
 * Dependency loading
 * */
namespace Contentstack\Stack\Assets;

use Contentstack\Stack\Assets\QueryAssets\QueryAssets;
use Contentstack\Stack\ContentType\Query\Query;
use Contentstack\Utility;


require_once __DIR__.'/query.php';

/*
 * Class Assets
 * */
class Assets {
   
    var $stack    = '';
    

    /*
     * Assets
     * Assets Class to initalize your Assets
     * @param
     *      
     * */
    public function __construct($stack = '') {  
         $this->stack = $stack;
         $this->type = 'assets';
    }

    public function Query() {
        return new Query($this, $this->type);
    }

}