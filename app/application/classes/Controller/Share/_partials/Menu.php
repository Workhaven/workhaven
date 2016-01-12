<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller__Partials_Menu extends Controller {
       
    public $request;
    public $project;
    public $current_image = NULL;
    
    public function __construct() {             
        $this->request = Request::current();        
        $this->project = Model::factory('Project')->where("share_hash", "=", $this->request->param('hash'))->find();
        parent::__construct(Request::current(), Response::factory());
    }   
    
    public function getData(){        
        $data = array(            
            "project" =>  $this->project,                        
            //"image" => $this->current_image,
        );
        return $data;
    }
 
}