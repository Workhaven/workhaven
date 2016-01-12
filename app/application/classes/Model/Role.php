<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Role extends ORM {
    
    public function get_roles(){
        $roles = array();
        $roles[""] = __('Select user role');
        $dbroles = ORM::factory('Role')->find_all();  
        foreach ($dbroles as $role) {            
            $roles[$role->name] = ucfirst(__($role->name)).". ".__($role->description);
        }   
        return $roles;
    }
    
}