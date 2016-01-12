<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_User extends Controller_Secure {
    
        public function action_all(){ 
           if(Auth::instance()->logged_in("admin")){
                $pagination = Pagination::factory(array(
                    'total_items' => Model::factory('User')->count_all(),                
                ));
                $this->template->data["users"] = Model::factory('User')->order_by('id', 'desc')->offset($pagination->offset)->limit($pagination->items_per_page)->find_all();
                $this->template->data["pagination"] = $pagination;                              
           } 
        }
        
        public function action_delete(){
            $user = new Model_User($this->request->param('id'));        
            if ($user->loaded()){
                $user->delete();            
            }
            $this->redirect('admin/user/all');
        }        
    
        public function action_add(){           
            $post = $this->request->post();                        
            if($post){
                $this->template->data["post"] = $post;                 
                
                if ($post['role'] == ""){
                    array_push($this->template->data["errors"], array("Role" => __("User role must be set.")));
                } else {
                    /* automatically obtain password if user set none */
                    if (empty($post['password'])) {
                        $post['password'] = Auth::randomPassword();
                        $post['password_confirm'] = $post['password'];
                    }                    
                    try {                                                
                        $user = ORM::factory('User')->create_user($post, array('email', 'password'));
                        $user->add('roles', ORM::factory('Role', array('name' => $post['role'])));
                        $this->template->data["post"] = NULL;
                    } catch (ORM_Validation_Exception $e) {
                        $this->template->data["errors"] = $e->errors('models');
                    }
                    if( empty($this->template->data["errors"]) ){                                                
                        Notifications::factory()->new_user_account($post['email'], $post);                        
                        $this->redirect('/admin/user/all');
                    }
                }
            } 
            $this->template->data["roles"] = ORM::factory("Role")->get_roles();
        }
    
	public function action_log()
	{            		
                switch($this->request->param('id')){
                    case 'out':
                        Auth::instance()->logout();
                        $this->redirect(lcfirst($this->request->directory()).'/user/log/in');
                        break;
                    
                    case 'in': 
                        $errors = array();
                        if($this->request->post()){
                            if (Auth::instance()->login($this->request->post('email'), $this->request->post('password')))
                            {                                            
                              $this->redirect(isset($_GET["back_url"])?$_GET["back_url"]:"/admin");
                            }
                            else
                            {
                                $errors = array( "form" => __("Login failed. Check the entered data.") );
                            }
                        } 
                        $view = new View('admin/user/login');                        
                        $view->set("errors", $errors);
                        $this->response->body($view);                        
                        break;                        
                }
	}  
        
        public function verify_user($password){                        
            $user = ORM::factory('User')->where('email', '=', Auth::instance()->get_user()->email)
                                        ->and_where('password', '=', Auth::instance()->hash($password))                                    
                                        ->find();             
            if (!$user->loaded())
            {
                return NULL;
            }
            return $user;
        }
        
	public function action_personalsettings()
	{                           
            if($this->request->post()){                                             
                if(!$user = $this->verify_user($this->request->post('password'))){
                    $this->template->data["errors"][] = __('Unable to verify your identity. Changes will not be made.');
                } else {                
                    switch($this->request->param('id')){
                        case 'savesettings':
                            $values = $this->request->post();
                            unset($values['password']); 
                            try {
                                $user->update_user($values);
                                Auth::instance()->login($this->request->post('email'), $this->request->post('password'));
                            } catch (ORM_Validation_Exception $e) {                            
                                $this->template->data["errors"] = $e->errors('models');
                            }                      
                            break;

                        case 'changepassword':                                                                                                       
                            try {
                                $user->update_user(
                                    array(  'password' => $this->request->post('new_password'),
                                            'password_confirm' => $this->request->post('password_confirm'))
                                );                                                       
                            } catch (ORM_Validation_Exception $e) {                            
                                $this->template->data["errors"] = $e->errors('models');
                            } 
                            break;                        
                    }
                }
                if(!$this->template->data["errors"])
                    $this->redirect('/admin/user/personalsettings');
            }            
            $this->template->data["user"] = Auth::instance()->get_user();
            $this->template->data["languages"] = ORM::factory('Language')->get_languages();
	}        
} 
