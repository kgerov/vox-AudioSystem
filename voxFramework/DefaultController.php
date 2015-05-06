<?php

namespace Vox;

class DefaultController {
    
    /**
     *
     * @var \Vox\App 
     */
    public $app;
    /**
     *
     * @var \Vox\View
     */
    public $view;
    /**
     *
     * @var \Vox\Config 
     */
    public $config;
    /**
     *
     * @var \Vox\InputData 
     */
    public $input;

    public function __construct() {
        $this->app = \Vox\App::getInstance();
        $this->view = \Vox\View::getInstance();
        $this->config = $this->app->getConfig();
        $this->input = \Vox\InputData::getInstance();
    }
    
    public function jsonResponse(){
        
    }

}

