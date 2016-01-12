<?php defined('SYSPATH') OR die('No direct script access.');

abstract class Controller_Secure extends Kohana_Controller_Template {     
    
  public function before(){     
   
    if (!(Auth::instance()->logged_in("admin") OR Auth::instance()->logged_in("internal")) AND 
          $this->request->controller() !== 'user' AND 
          $this->request->action() !== 'log'  AND 
          $this->request->param('id') !== 'in'
       )
    {
      $back_url = "?back_url=".URL::site($this->request->uri()). (!empty($_GET) ? "?".http_build_query($_GET, '&') : "" );      
      $this->redirect('admin/user/log/in'.$back_url);
    }
    parent::before();      
  } 
}
