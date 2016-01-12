<?php  
  
   
  $errors = array();
  if(!empty($_POST)){       
      
      require "../app/application/".'bootstrap.php';
      // Check if all about database is set
      $all_set = true;  
      if(!empty($_POST['email']))             $email = $_POST['email']; else $all_set = false;
      if(!empty($_POST['password']))          $password = $_POST['password']; else $all_set = false;
      if(!empty($_POST['confirm_password']))  $confirm_password = $_POST['confirm_password']; else $all_set = false;
                                        
      
      if($all_set && $password == $confirm_password){                    
          
          // test database connection:
          try { 
              Database::instance()->connect();                                
          } catch (Exception $e) {               
              $errors[] = $e->getMessage(); 
          }   
                     
          if(empty($errors)){                        
                $lang = 'en';
                if( isset($_COOKIE['lang']) ) $lang = $_COOKIE['lang'];

                $user_data = array("email" => $email, "password" => $password, "password_confirm" => $_POST['confirm_password']);

                try { 
                    $user = ORM::factory('User')->create_user($user_data, array('email', 'password'));
                    $user->language = $lang;
                    $user->save();
                    $user->add('roles', ORM::factory('Role', array('name' => 'admin')));                                    
                } catch (ORM_Validation_Exception $e) {                 
                    $errors[] = $e->errors('models');
                }  

                try { 
                    $email_setting = ORM::factory('Systemsetting')->where('name', '=', 'email')->find();
                    $email_setting->value = $email;  
                    $email_setting->save();
                } catch (ORM_Validation_Exception $e) {                 
                    $errors[] = $e->errors('models');
                }             

                if($lang != 'en'){
                    try { 
                        $email_setting = ORM::factory('Systemsetting')->where('name', '=', 'language')->find();
                        $email_setting->value = $lang;  
                        $email_setting->save();
                    } catch (ORM_Validation_Exception $e) {                          
                        $errors[] = $e->errors('models');
                    }                       
                }       
          } 

          if(empty($errors)){
                header("location: ?step=you-are-done");
          }
      } 
      else 
        {                                                                    
          $errors["bad_info"] = ___('It seems you have entered incorrect informations.');
        }
  } 
                                         