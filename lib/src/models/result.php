<?php
namespace Contentstack\Result;

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
     * Get the ***s from the object
     * @param
     *      string|*** - *** whose corresponding value to be retrieved
     * @return Value
     * */
    public function get($***) {
        return ($*** && is_string($***)) ? $this->object[$***] : NULL;
    }
}