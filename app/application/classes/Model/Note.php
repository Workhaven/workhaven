<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Note extends ORM {            
    
    protected $_belongs_to = array( 'image' => array('model' => 'Image', 'foreign_key' => 'image_id'),
                                    'user' => array('model' => 'User', 'foreign_key' => 'user_id'));
    
    public function rules()
    {
        return array(       
            'top' => array(
                array('not_empty'),
            ),                     
            'left' => array(
                array('not_empty'),
            ),
            'width' => array(
                array('not_empty'),
            ),
            'height' => array(
                array('not_empty'),
            ),
            'text' => array(
                array('not_empty'),
            ),            
        );
    } 
}