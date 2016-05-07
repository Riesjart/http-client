<?php

namespace Riesjart\HttpClient\Html;

use Riesjart\HttpClient\Response as HttpClientResponse;
use Yangqi\Htmldom\Htmldom;

class Response extends HttpClientResponse
{
    /**
     * @var Htmldom
     */
    protected $dom;
 
    
    // =======================================================================//
    //          Magic                                                                        
    // =======================================================================//

    /**
     * @inheritdoc
     */
    public function __construct($body, $headers, $info = [])
    {
        parent::__construct($body, $headers, $info);
        
        $this->setDom();
    }


    // =======================================================================//
    //          Setters                                                                        
    // =======================================================================//

    /**
     * @return $this
     */
    protected function setDom()
    {
        $this->dom = new Htmldom($this->body);

        return $this;
    }
    
    
    // =======================================================================//
    //          Getters                                                                        
    // =======================================================================//

    /**
     * @return Htmldom
     */
    public function getDom()
    {
        return $this->dom;
    }
}