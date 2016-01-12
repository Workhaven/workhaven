<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Discussion extends ORM {    
    
    protected $_belongs_to = array('image' => array('model' => 'Image', 'foreign_key' => 'image_id'));
    protected $_has_many = array('comments' => array('model' => 'Comment', 'foreign_key' => 'discussion_id'));   
    
    function create_new(){
        $discussion = Model::factory('Discussion');
        $discussion->save();
        return $discussion->id;
    }       
}