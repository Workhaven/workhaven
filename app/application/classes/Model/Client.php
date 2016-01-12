<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Client extends ORM {        
    
    protected $_has_many = array('projects' => array('model' => 'Project', 'foreign_key' => 'client_id'));
    
    public function rules()
    {
        return array(
            'name' => array(                
                array('not_empty'),                
                array('max_length', array(':value', 64)),
            ),            
            'surname' => array(
                array('max_length', array(':value', 64)),
            ),
            'email' => array(
                array('max_length', array(':value', 255)),
                array('email'),                
            ),                              
        );
    } 
    
    public function get_clients(){
        $c_db = array();
        $clients = array();
        $clients[NULL] = __('Select client');        
        if (Auth::instance()->logged_in("admin")) {
            $c_db = Model::factory('Client')->order_by('id', 'desc')->find_all();
        } else {
            $c_db = Model::factory('Client')->order_by('id', 'desc')->where('user_id', '=', Auth::instance()->get_user()->id)->find_all();
        }        
        foreach ($c_db as $client) {
            $clients[$client->id] = ucfirst($client->name)." ".ucfirst($client->surname).". ".Text::limit_chars($client->description,50);
        }   
        return $clients;
    }   
    
    public static function count_clients(){
        if (Auth::instance()->logged_in("admin")) {
            return Model::factory('Client')->count_all();
        } else {
            return Model::factory('Client')->where('user_id', '=', Auth::instance()->get_user()->id)->count_all();
        }
    }
     
}