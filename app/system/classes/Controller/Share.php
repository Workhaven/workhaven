<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Controller_Share extends Kohana_Controller_Template {     
    
    public function __construct(\Request $request, \Response $response){     

        $this->project = Model::factory('Project')->where("share_hash", "=", $request->param('hash'))->find();
        if (!$this->project->loaded() OR $this->project->visibility->name == "privat"){            
            throw new HTTP_Exception_404(__('This page seems to not exists.'));
        }
        if ($this->project->visibility->name == "secure"){
            if( !$this->visitor_authorized($request->param('hash')) AND $request->action() != 'authenticate')
            {              
                $this->redirect('/share/'.$request->param('hash').'/project/authenticate/');                              
            }
        }
        parent::__construct($request, $response);      
    } 

    /* 
     * Check if visitor is authorized for current viewed project. 
     * Test if visitor have the project in session.
     * @return  bool
     */
    public function visitor_authorized($project_share_hash){
        $session = Session::instance();
        $available_projects = $session->get('available_projects');
        /* Session with available projects: 
         *      is empty OR
         *      does not exists OR
         *      current project is not in it
         */
        if( empty($available_projects) OR 
            !isset($available_projects) OR    
            !in_array($project_share_hash, $available_projects))
        {
            return false;
        }         
        return true;
    }
    
    /* 
     * After succesful authorization current project can be
     * added to user's session 'available_projects'.
     */
    public function authorize_project($project_share_hash){
        $session = Session::instance();
        $available_projects = $session->get('available_projects');
        // Add new project hash
        $available_projects[] = $project_share_hash;
        // Resave it
        $session->set('available_projects', $available_projects);           
    }    
}
