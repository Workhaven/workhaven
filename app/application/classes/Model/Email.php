<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Email {        
    
    private $system_settings = NULL;    
    private $html = TRUE;
    private $from = NULL;
    
    public function __construct() {
        $this->system_settings = ORM::factory('Systemsetting')->where('name', 'IN', array('name', 'email', 'copyright'))->find_all()->as_array('name', 'value'); 
        $this->from = $this->system_settings['email'];
    }

    public static function factory()
    {       
        return new Model_Email();
    }
    
    private function build_html_message($content){        
        $main_template = new View('emails/main_template');                        
        $main_template->set("content", $content->render());
                
        $main_template->set('copyright',    $this->system_settings['copyright']);
        $main_template->set('company_name', $this->system_settings['name']);
        return $main_template->render();
    }
    
    public function you_have_new_account($to, $login_details){                                
        $subject = __('New account');        
        
        $template = new View('emails/you_have_new_account');
        $template->set("email", $login_details['email']);
        $template->set("password", $login_details['password']);
        
        $message = $this->build_html_message($template);
        Email::send($to, $this->from, $subject, $message, $this->html);
    }
    
    public function new_image($to, $image){                
        $subject = __('New image');        
        
        $template = new View('emails/new_image');
        $template->set("image", $image);        
        
        $message = $this->build_html_message($template);
        Email::send($to, $this->from, $subject, $message, $this->html);        
    }
    
    public function new_note($to, $note){
        $subject = __('New note');
        
        $template = new View('emails/new_note');
        $template->set("note", $note);   
        
        $message = $this->build_html_message($template); 
        Email::send($to, $this->from, $subject, $message, $this->html);        
    }    
    
    public function new_comment($to, $comment){
        $subject = __('New comment');
        
        $template = new View('emails/new_comment');
        $template->set("comment", $comment);
        
        $message = $this->build_html_message($template); 
        Email::send($to, $this->from, $subject, $message, $this->html);
    }           
}