<?php
/**
 *  Contentstack abstract class to provide access to Stack Object
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
 */
namespace Contentstack;

use Contentstack\Stack\Stack;
use Contentstack\Utils\Utils;
use Contentstack\Utils\Model\Option;


/**
 *  Contentstack abstract class to provide access to Stack Object
 * 
 * @category  PHP
 * @package   Contentstack
 * @author    Uttam K Ukkoji <uttamukkoji@gmail.com>
 * @author    Rohit Mishra <rhtmishra4545@gmail.com>
 * @copyright 2012-2021 Contentstack. All Rights Reserved
 * @license   https://github.com/contentstack/contentstack-php/blob/master/LICENSE.txt MIT Licence
 * @link      https://pear.php.net/package/contentstack
 */
abstract class Contentstack
{
    /**
     * Static method for the Stack constructor
     * 
     * @param string             $api_key      : Contentstack Stack API KEY.
     * @param string             $access_token : Contentstack Stack ACCESS TOKEN.
     * @param string             $environment  : Environment Name.
     * @param array              $config       : Stack Configuration to provide region.
     * @param ContentstackRegion $region       : Region name of Contentstack. (default region 'us')
     * 
     * @return Stack
     * */

    public static function Stack($api_key = '',
        $access_token = '',
        $environment = '',
        $config = array('region'=> 'us', 'branch'=> '', 'live_preview' => array('enable' => false, 'host' => 'api.contentstack.io'))
    ) {
        return new Stack($api_key, $access_token, $environment, $config);
    }

    public static function renderContent(string $content, Option $option): string 
    {
        return Utils::renderContent($content, $option);
    }

    public static function renderContents(array $contents, Option $option): array
    {
        return Utils::renderContents($contents, $option);
    }

    public static function jsonToHtml(object $content, Option $option): string 
    {
        return Utils::jsonToHtml($content, $option);
    }

    public static function jsonArrayToHtml(array $contents, Option $option): array
    {
        return Utils::jsonArrayToHtml($contents, $option);
    }
}