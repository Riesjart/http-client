<?php

namespace Riesjart\HttpClient;

use Mattbrown\Laracurl\Response as LaracurlResponse;

class Response extends LaracurlResponse
{
    /**
     * @var Request
     */
    protected $request;


    // =======================================================================//
    //          Setters                                                                        
    // =======================================================================//

    /**
     * @param Request $request
     *
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }
}