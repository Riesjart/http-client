<?php

namespace Riesjart\HttpClient;

use Mattbrown\Laracurl\Laracurl;
use Mattbrown\Laracurl\Request as LaracurlRequest;
use ReflectionClass;

class Request extends LaracurlRequest
{
    /**
     * @inheritdoc
     */
    public function send()
    {
        $response = parent::send();
        
        $response->setRequest($this);
        
        return $response;
    }


    // =======================================================================//
    //          Magic                                                                        
    // =======================================================================//

    /**
     * @param Laracurl $curl
     */
    public function __construct(Laracurl $curl)
    {
        parent::__construct($curl);

        $this->setResponseClass($this->getDefaultResponseClass());
    }
    
    
    // =======================================================================//
    //          Setters                                                                        
    // =======================================================================//

    /**
     * @param string $class
     *
     * @return $this
     */
    public function setResponseClass($class)
    {
        $this->curl->setResponseClass($class);

        return $this;
    }

    
    // =======================================================================//
    //          Getters                                                                        
    // =======================================================================//

    /**
     * @param string $requestClass
     *
     * @return string
     */
    public function getAssociatedResponseClass($requestClass)
    {
        return preg_replace('/Request$/', 'Response', $requestClass);
    }


    /**
     * @return string
     */
    public function getDefaultResponseClass()
    {
        $responseClass = $this->getAssociatedResponseClass(get_class($this));

        if(class_exists($responseClass)) {

            return $responseClass;
        }

        $class = new ReflectionClass($this);

        while ($class = $class->getParentClass()) {

            $responseClass = $this->getAssociatedResponseClass($class->getName());

            if(class_exists($responseClass)) {

                return $responseClass;
            }
        }
    }
}