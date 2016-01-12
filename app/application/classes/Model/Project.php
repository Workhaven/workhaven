<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Project extends ORM {
        
    protected $_has_many = array(
        'images' => array('model' => 'Image', 'foreign_key' => 'project_id'),
        'team' => array('model' => 'User', 'through' => 'projects_teams', 'far_key' => 'user_id'),        
        'granted_permissions' => array('model' => 'Projectpermissions', 'through' => 'projects_granted_permissions', 'far_key' => 'permission_id'),        
    );    
    protected $_belongs_to = array('client' => array('model' => 'Client', 'foreign_key' => 'client_id'),
                                   'owner' => array('model' => 'User', 'foreign_key' => 'user_id'),
                                   'visibility' => array('model' => 'Projectvisibility', 'foreign_key' => 'visibility_id'));
    
    public function rules()
    {
        return array(
            'name' => array(
                array('not_empty'),                
                array('max_length', array(':value', 255)),
            ),            
        );
    }
        
    /*
     * Function count_projects() returns count of projects related to 
     * current loged in user
     * @return integer $count 
     */
    public static function count_projects(){                    
        if (Auth::instance()->logged_in("admin")) {
            return Model::factory('Project')->count_all();
        } else {                
            return Auth::instance()->get_user()->projects->count_all();
        }                    
    }    
}