<?php

namespace Riesjart\HttpClient\Json;

use Riesjart\HttpClient\Response as HttpClientResponse;

class Response extends HttpClientResponse
{
    /**
     * @var string
     */
    protected $json;

    /**
     * @var array
     */
    protected $jsonAssoc = [];
    

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

            $this->setJson();
        }
    }


    // =======================================================================//
    //          Setters
    // =======================================================================//

    /**
     * @return $this
     */
    public function setJson()
    {
        $this->json = json_decode($this->body);
        $this->jsonAssoc = json_decode($this->body, true);

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
        return array_get($this->jsonAssoc, $property);
    }


    /**
     * @param bool $assoc
     *
     * @return array|string
     */
    public function getJson($assoc = false)
    {
        return $assoc ? $this->jsonAssoc : $this->json;
    }
}