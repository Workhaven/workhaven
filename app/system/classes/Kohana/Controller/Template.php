<?php defined('SYSPATH') OR die('No direct script access.');

/**
 * Abstract controller class for automatic templating.
 *
 * @package    Kohana
 * @category   Controller
 * @author     Kohana Team
 * @copyright  (c) 2008-2012 Kohana Team
 * @license    http://kohanaframework.org/license
 */
abstract class Kohana_Controller_Template extends Controller {

    /**
     * @var  View  page template
     */
    public $main_template = 'main';
    public $force_this_main_template = NULL;
    public $template = 'main';

    /**
     * @var  boolean  auto render template
     **/
    public $auto_render = TRUE;    
    
    public function __construct(\Request $request, \Response $response) {                  
        if($this->force_this_main_template) {            
            $this->main_template = $this->force_this_main_template;            
        }else if ($request->directory()) {
            $this->main_template = lcfirst($request->directory());
        }                
        parent::__construct($request, $response);
    }

    public function before()
    {               
        if ( Kohana::find_file('views', $this->main_template) )
        {
            $this->main_template = View::factory($this->main_template);      
            $system_settings = ORM::factory('Systemsetting')->where('name', 'IN', array('language', 'title', 'keywords', 'description', 'copyright'))->find_all()->as_array('name', 'value');
            $language_parts = explode('-', $system_settings['language']);            
            
            $this->main_template->head_style       = ''; 
            $this->main_template->html_lang        = $language_parts[0];  /* Print language as ISO: from "en-us" only "en", described at: http://www.w3schools.com/Tags/ref_language_codes.asp */    
            $this->main_template->title            = $system_settings['title'];
            $this->main_template->meta_keywords    = $system_settings['keywords'];
            $this->main_template->meta_description = $system_settings['description'];
            $this->main_template->meta_copyright   = $system_settings['copyright'];            
            $this->main_template->content          = '';                            
        }
        $dir = strtolower($this->request->directory())."/".str_replace('_', '/', strtolower($this->request->controller()));        
        $file = $this->request->action();   
        if (Kohana::find_file('views/'.$dir, $file))
        {   
            $this->template = View::factory($dir.'/'.$file);   
            $this->template->data = array();
            $this->template->data["errors"] = array();
            $this->template->data["values"] = array();
        }
        parent::before();
    }
    
    public function after()
    {                                  
      	/**
      	 * Auto rendering view. View was automatically get from controller name (by function before() from above).      	                  
      	 */     
        if($this->auto_render){
            if ($this->response->body() !== '') {
                $this->main_template->content = $this->response->body();
                $this->auto_render = FALSE;
            } else {                                
                $this->main_template->content = $this->template->render();                
            }
            $this->template = $this->main_template;              
            $this->response->body($this->template);    
        }
        parent::after();
    }

}
