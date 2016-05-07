<?php

namespace Riesjart\HttpClient\Html;

use Riesjart\HttpClient\Request as HttpClientRequest;

class Request extends HttpClientRequest
{
    /**
     * @var string
     */
    protected $method = 'get';

    /**
     * @var string
     */
    protected $url = '';

    
    // =======================================================================//
    //          Setters
    // =======================================================================//

    /**
     * @inheritdoc
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
    

    // =======================================================================//
    //          Getters                                                                        
    // =======================================================================//
    
    /**
     * @inheritdoc
     */
    public function getMethod()
    {
        return $this->method;
    }

    
    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return $this->url;
    }
}