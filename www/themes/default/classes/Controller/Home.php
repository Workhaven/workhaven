<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Home extends Controller_Template {
    
    public function action_index()
    {   
        $system_settings = ORM::factory('Systemsetting')->where('name', 'IN', array('language', 'title', 'keywords', 'description', 'copyright', 'name', 'logo_ext'))->find_all()->as_array('name', 'value');
        $language_parts = explode('-', $system_settings['language']);       
                
        $this->template = View::factory('index');
        
        $this->main_template->html_lang        = $language_parts[0];
        $this->main_template->title            = $system_settings['title'];
        $this->main_template->meta_keywords    = $system_settings['keywords'];
        $this->main_template->meta_description = $system_settings['description'];
        $this->main_template->meta_copyright   = $system_settings['copyright'];                
        
        $this->template->description    = $system_settings['description'];
        $this->template->logo_ext       = $system_settings['logo_ext'];
        $this->template->site_name      = $system_settings['name'];
        
        $this->template->projects = Model::factory('Project')->order_by('id', 'desc')->where("portfolio", "=", 1)->find_all();                        
    }  
} 
