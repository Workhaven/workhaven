<?php defined('SYSPATH') OR die('No direct script access.');

class HTTP_Exception extends Kohana_HTTP_Exception {
    
    /**
     * Generate a Response for all Exceptions without a more specific override
     * 
     * The user should see a nice error page, however, if we are in development
     * mode we should show the normal Kohana error page.
     * 
     * @return Response
     */
    public function get_response()
    {
        // Lets log the Exception, Just in case it's important!
        Kohana_Exception::log($this);
 
        if (Kohana::$environment >= Kohana::DEVELOPMENT)
        {
            // Show the normal Kohana error page.
            return parent::get_response();
        }
        else
        {                        
            $view = View::factory('errors/default');
            $view->error_code = $this->getCode();
            $view->message = $this->getMessage();
            
            $template = View::factory('blank');
            $system_settings = ORM::factory('Systemsetting')->where('name', 'IN', array('language'))->find_all()->as_array('name', 'value');            
            $template->title = $this->getMessage();
            $template->meta_description = $this->getMessage();
            $template->meta_keywords    = "";
            $template->head_style       = "";   
            $template->html_lang        = $system_settings['language'];
            $template->content = $view->render();                
            
            $response = Response::factory()
                ->status($this->getCode())
                ->body($template->render());
 
            return $response;
        }
    }    
}
