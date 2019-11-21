<?php
namespace Contentstack;

use Contentstack\Stack\Stack;

require_once __DIR__ . '/lib/models/stack.php';

/*
 *  Contentstack abstract class to provide access to Stack Object
 * */
abstract class Contentstack {
    /*
     *  Static method for the Stack constructor
     *  @param
     *      string|api_key        : Contentstack Stack API KEY.
     *      string|access_token   : Contentstack Stack ACCESS TOKEN of respected Stack.
     *      string|environment    : Environment whose content to be fetched.
     *  @return Stack
     * */
    public static function Stack($api_key = '', $access_token = '', $environment = '', $region = '') {
        return new Stack($api_key, $access_token, $environment, $region);
    }
}