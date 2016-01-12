<?php defined('SYSPATH') or die('No direct script access.');
 
class Controller__Partials_Menu extends Controller {
       
    public $request;
    public $current_image = NULL;
    public $current_client = NULL;
    
    public function __construct() {             
        $this->request = Request::current();        
        if($this->request->controller() == "Clients" && $this->request->action() == "detail"){            
            $this->current_client = new Model_Client($this->request->param('id'));             
            return $this->current_client;
        }          
        parent::__construct(Request::current(), Response::factory());
    }
    
    function current_project(){     
        $project = NULL;
        if($this->request->controller() == "Projects" && $this->request->action() == "detail"){            
            $project = new Model_Project($this->request->param('id'));            
        } 
        if($this->request->controller() == "Images" && $this->request->action() == "detail"){            
            $this->current_image = new Model_Image($this->request->param('id'));             
            return $this->current_image->project;
        }           
        return $project;
    }
    
    public function latest_projects(){
        if (Auth::instance()->logged_in("admin")) {
            return Model::factory('Project')->order_by('id', 'desc')->limit(5)->find_all();            
        } else {            
            return Auth::instance()->get_user()->projects->order_by('id', 'desc')->limit(5)->find_all();
        }
    }
    
    public function getData(){                    
        $data = array(
            "user" => Auth::instance()->get_user(),
            "project" =>  $this->current_project(),
            "projects_count" => Model_Project::count_projects(),
            "clients_count" => Model_Client::count_clients(),
            "users_count" => ORM::factory('User')->count_all(),
            "latest_projects" => $this->latest_projects(),
            "image" => $this->current_image,
            "client" => $this->current_client,
        );
        return $data;
    }
 
}