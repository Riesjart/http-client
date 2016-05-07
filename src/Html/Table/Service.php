<?php

namespace Riesjart\HttpClient\Html\Table;

use Illuminate\Database\Eloquent\Collection;

abstract class Service
{
    /**
     * @var ImportHandler
     */
    protected $importHandler;

    /**
     * @var Response
     */
    protected $response;


    /**
     * @return Collection
     */
    public function handleImport()
    {
        if(! $this->importHandler) {

            $this->setImportHandler();
        }

        return $this->importHandler->handle($this->response);
    }

    
    // =======================================================================//
    //          Setters                                                                        
    // =======================================================================//

    /**
     * @return $this
     */
    public function setImportHandler()
    {
        $this->importHandler = app()->make($this->getImportHandlerClass());
        
        return $this;
    }
    
    
    // =======================================================================//
    //          Getters                                                                        
    // =======================================================================//

    /**
     * @return string
     */
    public function getImportHandlerClass()
    {
        return preg_replace('/' . class_basename($this) . '$/', 'ImportHandler', get_class($this));
    }
}