<?php
namespace Contentstack;

/*
 * Exception
 * Exception Class is used to wrap the REST API error
 **/
class Exception extends \Exception {
    var $error_message;
    var $error_code;
    var $http_code;

    function __construct($error, $http_code = 412) {
        $error = json_decode($error, true);
        $this->error_message = (isset($error['error_message'])) ? $error['error_message'] : "It seems Built.io Contentstack is behaving badly. Please contact support@contentstack.io.";
        $this->error_code    = (isset($error['error_code'])) ? $error['error_code'] : null;
        $this->errors        = (isset($error['errors'])) ? $error['errors'] : array();
        $this->http_code     = $http_code;
        parent::__construct($this->error_message, $this->error_code, null);
    }

    /*
     * getStatusCode
     * To get http status_code of the current exception
     * @return HttpCode|string
     * */
    function getStatusCode() {
        return $this->http_code;
    }

    /*
     * getErrors
     * Returns error details of current exception
     * @return error|array
     * */
    function getErrors() {
        return $this->errors;
    }
}
