<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Share_Project extends Controller_Share {

    public $project;   
    
    public function __construct(\Request $request, \Response $response) {
        if( $request->action() == 'authenticate' ){
            $this->force_this_main_template = 'blank';
        }
        parent::__construct($request, $response);
    }        

    public function action_authenticate(){        
        if( $this->request->post() ){
            if( $this->request->post("password") == $this->project->share_password){
                $this->authorize_project($this->request->param('hash'));                
                $this->redirect('/share/'.$this->request->param('hash').'/project/detail');
            }
        }        
    }

    public function action_detail(){
        $this->template->data["values"] = $this->project->object();
        $this->template->data["hash"] = $this->request->param('hash');
        $this->template->data["images"] = $this->project->images->order_by('id', 'desc')->find_all();
    }   
} 
