<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Lostpassword extends Controller_Template {             
    
    public function __construct(\Request $request, \Response $response) {
        $this->force_this_main_template = 'blank';
        parent::__construct($request, $response);
    }
    
    public function action_index(){         
        if($this->request->post()){            
            $validation = Validation::factory($this->request->post());
            $validation ->rule('email', 'not_empty')
                        ->rule('email', 'email');
            if ($validation->check())
            {
                $user = ORM::factory('User')->where('email', '=', $this->request->post('email'))->find();                                            
                if ($user->loaded())
                {
                    try {
                        $new_password = Auth::randomPassword();
                        $user->update_user( array('password' => $new_password, 'password_confirm' => $new_password));
                        mail("george.kvapil@seznam.cz", "new password", "Email:" . $user->email . " New password: " . $new_password);
                    } catch (ORM_Validation_Exception $e) {}
                }
                $this->redirect('lostpassword/ok');
            }
            $this->template->data["values"] = $this->request->post();
            $this->template->data["errors"] = $validation->errors('User');
        }                              
    } 
    
    public function action_ok(){         
        
    }     
} 
