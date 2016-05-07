<?php

namespace Riesjart\HttpClient\Html\Table;

use Riesjart\HttpClient\Html\Response as HtmlResponse;
use Yangqi\Htmldom\Htmldomnode;

abstract class Response extends HtmlResponse
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $rows = [];

    /**
     * @var Htmldomnode
     */
    protected $table;

    
    // =======================================================================//
    //          Magic                                                                        
    // =======================================================================//

    /**
     * @inheritdoc
     */
    public function __construct($body, $headers, $info = [])
    {
        parent::__construct($body, $headers, $info);
        
        if($this->statusCode == 200) {
            
            $this->setTable()
                ->setRows()
                ->setData();
        }
    }
    

    // =======================================================================//
    //          Setters                                                                        
    // =======================================================================//

    /**
     * @return $this
     */
    protected abstract function setData();


    /**
     * @return $this
     */
    protected abstract function setTable();


    /**
     * @return $this
     */
    protected abstract function setRows();
    
    
    // =======================================================================//
    //          Getters                                                                        
    // =======================================================================//

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }


    /**
     * @return array
     */
    public function getRows()
    {
        return $this->rows;
    }
    
    
    /**
     * @return Htmldomnode
     */
    public function getTable()
    {
        return $this->table;
    }
}