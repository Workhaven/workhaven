<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller__Partials_Hidden extends Controller {
       
    public $request;  
    
    public function __construct() {             
        $this->request = Request::current();                
        parent::__construct($this->request, Response::factory());
    }        
    
    public function getData(){                    
        $data = array(
            "add_image_data"    => $this->add_image_data(),
            "add_project_data"  => $this->add_project_data(),
            "add_client_data"   => $this->add_client_data(),
            "add_user_data"     => $this->add_user_data(),
        );
        return $data;
    }
    
    private function add_user_data(){
        return array("roles" => ORM::factory("Role")->get_roles());
    }


    private function add_client_data(){       
        return array("values" => array());
    }

    private function add_image_data(){
        if( $this->request->controller() == "Projects" && $this->request->action() == "detail" ){
            return array("values" => array("project_id" => $this->request->param("id")));    
        }        
        return array("values" => array("project_id" => NULL), "projects" => ORM::factory("Project")->order_by('id', 'desc')->find_all()->as_array("id", "name"));
    }
 
    private function add_project_data(){
        if( $this->request->controller() == "Clients" && $this->request->action() == "detail" ){
            return array("values" => array("client_id" => $this->request->param("id")), "clients" => ORM::factory("Client")->get_clients());    
        }           
        return array("values" => array(), "clients" => ORM::factory("Client")->get_clients());
    }
}