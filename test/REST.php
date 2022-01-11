<?php
namespace Contentstack\Test;

require_once __DIR__ . '/constants.php';

use Contentstack\Config;

class REST
{
    private $results = array();

    public function __construct() {
        $myfile = fopen(RESULT_PATH, "r") or die("Unable to open file!");
        $this->results = json_decode(fread($myfile, filesize(RESULT_PATH)), true);
        fclose($myfile);
    }

    /*
     * Remove system ***s from the values
     * */
    public function sanatize($value = array())
    {
        unset($value['SYS_ACL']);
        unset($value['DEFAULT_ACL']);
        unset($value['roles']);
        return $value;
    }

    /*
     * Set method is used to add the variable to the private variable of current instance
     * @param
     *      string|$***  - *** which will hold the value
     *      array|$value - value of the ***
     * @return null
     * */
    public function set($*** = '', $value = '')
    {
        // unset values
        if (is_array($value) && isset($value[0]) && is_array($value[0])) {
            foreach ($value as $k => $val) {
                $val = $this->sanatize($val);
                $value[$k] = $val;
            }
        } else {
            $value = $this->sanatize($value);
        }
        // unset values

        // before set get the data
        $tmpValue = ($this->get($***)) ? $this->get($***) : array();
        $this->results[$***] = array_merge($value, $tmpValue);
    }

    /*
     * Get method is used to fetch the matched ***'s value of current instance
     * @param
     *      string|$***  - *** which will hold the value
     * @return string|array|$value
     * */
    public function get($*** = '')
    {
        return ($*** && isset($this->results[$***])) ? $this->results[$***] : array();
    }

    public function getAPIKEY() {
        $stack = $this->get('stack');
        return $stack['api_***'];
    }

    public function getAccessToken() {
        $stack = $this->get('stack');
        if (gettype($stack['delivery_token']) === 'string') {
            return $stack['delivery_token'];
        }
        return $stack['discrete_variables']['access_token'];
    }

    public function getEnvironmentName() {
        $stack = $this->get('stack');
        if (gettype($stack['environment']) === 'string') {
            return $stack['environment'];
        }
        $environment = $this->get('environment');
        return $environment['name'];
    }

    public function getHost() {
        $host = $this->get('host');
        if (gettype($host) === 'string') {
            return $host;
        }
        return NULL;
    }
}

function debug($input = array(), $exit = false)
{
    echo "<pre>";
    print_r($input);
    echo "</pre>";
    if ($exit) exit();
}