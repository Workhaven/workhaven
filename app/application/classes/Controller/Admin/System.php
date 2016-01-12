<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_System extends Controller_Secure {

	public function action_settings()
	{   
            $system_settings = ORM::factory('Systemsetting')->find_all();            
            if($this->request->post()){                      
                $values = $this->request->post();
                switch($this->request->param('id')){
                    case 'save':                                                         
                        foreach ($system_settings as $setting)
                        {                                                           
                            // save new logo:
                            if($setting->name == 'logo_ext'){
                                $image = $_FILES['logo'];
                                
                                if($this->request->post('delete_logo')){
                                   unlink(DOCROOT . 'images/logo' . '.' . $setting->value);
                                   $setting->value = NULL;
                                }
                                
                                if(Model_Image::validate_uploaded_image($image)){                                    
                                    if(Model_Image::save_uploaded_image($image, DOCROOT . 'images/logo' . '.' . pathinfo($image['name'], PATHINFO_EXTENSION))){
                                        // delete old logo image if the old one has different file extension than the new one
                                        if($setting->value && $setting->value != pathinfo($image['name'], PATHINFO_EXTENSION)){
                                            unlink(DOCROOT . 'images/logo' . '.' . $setting->value);
                                        }
                                        $setting->value = pathinfo($image['name'], PATHINFO_EXTENSION);
                                    }
                                }
                            } else {
                                $setting->value = $this->request->post($setting->name);                            
                            }
                            
                            try {                                                                        
                                $setting->save();                                
                            } catch (ORM_Validation_Exception $e) {
                                $this->template->data["errors"] = $e->errors('models');
                            }                                                                                                                  
                        }                                                
                        break;   
                }                
                if(!$this->template->data["errors"])
                    $this->redirect('admin/system/settings/save');                
            } else {                
                $values = array();         
                foreach ($system_settings as $setting)
                {
                    $values[$setting->name] = $setting->value;                    
                }   
            }   
            $this->template->values = $values;
            $this->template->templates = $this->get_templates();
            $this->template->languages = ORM::factory('Language')->get_languages();
	}             
        
  public function get_templates(){
      $templates = array();
      if ($handle = opendir( DOCROOT.'themes' )) {          
          // List all templates in templates directory directory and strip out . and ..
          while (false !== ($theme_name = readdir($handle))) {                    
              if ($theme_name != "." && $theme_name != "..") {                        
                  $template_info = include DOCROOT.'themes/'.$theme_name.'/info.php';                        
                  $templates[$theme_name] = $template_info['name'].$template_info['description'];
              }
          }
          closedir($handle);
      }
      return $templates;
  }
} 
