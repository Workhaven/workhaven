<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_User extends Model_Auth_User {
        
    public function roles_to_string(){
        $string = "";
        foreach($this->roles->find_all()->as_array('id', 'name') as $id => $name ){
            $string .= $name." ";
        }
        return $string;
    }
}