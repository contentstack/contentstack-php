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
       // \Contentstack\Utility\debug($this);
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


    public function geturl() {

        return $this->object['url'];
    
    }

    public function getAssetUid() {

        return $this->object['uid'];
    
    }


    public function getCreatedAt() {

        return $this->object['created_at'];
    
    }


    public function getCreatedBy() {

        return $this->object['created_by'];
    
    }


    public function getUpdatedAt() {

        return $this->object['updated_at'];
    
    }


    public function getUpdatedBy() {

        return $this->object['updated_by'];
    
    }


    public function getFilename() {

        return $this->object['filename'];
    
    }


    public function getFileSize() {

        return $this->object['file_size'];
    
    }

    public function getVersion() {

        return $this->object['_version'];
    
    }

    public function getTitle() {

        return $this->object['title'];
    
    }


    public function getLocale() {

        $data =  $this->object['publish_details'];

        for($i=0; count($data) > $i; $i++){

             return $data[$i]['locale'];
        }
    
    }


    public function set($key, $value){

        $this->object[$key] = $value; 

        return $this; 

    }

}