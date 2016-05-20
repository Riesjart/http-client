<?php

namespace Riesjart\HttpClient\Json;

use Riesjart\HttpClient\Response as HttpClientResponse;
use stdClass;

class Response extends HttpClientResponse
{
    /**
     * @var stdClass
     */
    protected $object;

    /**
     * @var array
     */
    protected $array = [];
    

    // =======================================================================//
    //          Magic                                                                        
    // =======================================================================//
    
    /**
     * @inheritdoc
     */
    public function __construct($body, $headers, $info = [])
    {
        parent::__construct($body, $headers, $info);

        $contentType = array_get($this->headers, 'Content-Type');

        if(starts_with($contentType, 'application/json')) {

            $this->decodeJson();
        }
    }


    // =======================================================================//
    //          Setters
    // =======================================================================//

    /**
     * @return $this
     */
    public function decodeJson()
    {
        $this->object = json_decode($this->body);
        $this->array = json_decode($this->body, true);

        return $this;
    }


    // =======================================================================//
    //          Getters                                                                        
    // =======================================================================//

    /**
     * @param $property
     * 
     * @return mixed
     */
    public function get($property)
    {
        return array_get($this->array, $property);
    }


    /**
     * @param bool $assoc
     *
     * @return array|string
     */
    public function getData($assoc = false)
    {
        return $assoc ? $this->array : $this->object;
    }
}