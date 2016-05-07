<?php

namespace Riesjart\HttpClient\Image;

use Riesjart\HttpClient\Response as HttpClientResponse;
use Image;
use Intervention\Image\Image as InterventionImage;

class Response extends HttpClientResponse
{
    /**
     * @var InterventionImage
     */
    protected $image;

    
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

            $this->setImage();
        }
    }


    // =======================================================================//
    //          Setters                                                                        
    // =======================================================================//

    /**
     * @return $this
     */
    protected function setImage()
    {
        $this->image = Image::make($this->body);

        return $this;
    }
    
    
    // =======================================================================//
    //          Getters                                                                        
    // =======================================================================//

    /**
     * @return InterventionImage
     */
    public function getImage()
    {
        return $this->image;
    }
}