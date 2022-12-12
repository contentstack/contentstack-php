<?php 
namespace Contentstack;

 /**
 *  Contentstack interface to provide plugin support
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Sunil Lakshman <sunil.lakshman@contentstack.com>
 * @copyright 2012-2023 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 */

interface ContentstackPlugin {

    /**
     * interface method for the Stack plugins
     * 
     * @param Stack             $stack      : Contentstack Stack Connection.
     * @param string            $http : host name/ipaddress from where the content to be fetched
     * @param array             $request  : Stack query Request.

     * @return void
    * */

    public function onRequest($stack, $http, &$request);
    /**
     * interface method for the Stack plugins
     * 
     * @param Stack            $stack      : Contentstack Stack API KEY.
     * @param string           $http : host name/ipaddress from where the content to be fetched
     * @param array            $request  : Stack query Request.
     * @param array            $response  : Stack Query Response.

     * @return response
    * */

    public function onResponse($stack, $http, $request, $response); 
}
?>