<?php
namespace Contentstack;

class Result {
    private $object;

    /*
     * Result constructor
     * Result wrapper over the plain result for the future
     * */
    public function __construct($result = '') {
        $this->object = $result;


    }

    /*
     * toJSON
     * To convert result object to json
     * @param
     * @return json format of the result
     * */
    public function toJSON() {
        return $this->object;
    }

    /*
     * get
     * Get the keys from the object
     * @param
     *      string|key - key whose corresponding value to be retrieved
     * @return Value
     * */
    public function get($key) {

        return ($key && is_string($key)) ? $this->object[$key] : NULL;

    }
}
