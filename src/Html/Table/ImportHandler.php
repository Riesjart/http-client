<?php

namespace Riesjart\HttpClient\Html\Table;

use Illuminate\Database\Eloquent\Collection;

abstract class ImportHandler
{
    /**
     * @var array
     */
    protected $columns = [];


    /**
     * @param Response $response
     * 
     * @return Collection
     */
    public function handle(Response $response)
    {
        if(! $this->columns) {

            $this->setColumns();
        }
        
        return $this->processData($response, new Collection());   
    }


    /**
     * @param Response $response
     * @param Collection $models
     * 
     * @return mixed
     */
    public abstract function processData(Response $response, Collection $models);

    
    // =======================================================================//
    //          Setters                                                                        
    // =======================================================================//

    public abstract function setColumns();
}