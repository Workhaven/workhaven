<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Image extends ORM {
          
    protected $_has_many = array('notes' => array('model' => 'Note', 'foreign_key' => 'image_id'));
    protected $_belongs_to = array('project' => array('model' => 'Project', 'foreign_key' => 'project_id'));  
    protected $_has_one = array('discussion' => array('model' => 'Discussion', 'foreign_key' => 'image_id'));           

    public function rules()
    {
        return array(       
            'project_id' => array(
                array('not_empty'),
            ),                     
            'filename' => array(
                array('not_empty'),
            ),
        );
    }   
    
    public function delete_image_file(){
        if (file_exists(DOCROOT.$this->path())) {
             unlink(DOCROOT.$this->path());
        }
    }       
    
    public function path() {
        return "images/projects/".$this->project_id."/".$this->filename;
    }
    
    public static function validate_uploaded_image($image){
        if (! Upload::valid($image) OR
            ! Upload::not_empty($image) OR
            ! Upload::type($image, array('jpg', 'jpeg', 'png', 'gif')))
        {
            return FALSE;
        } 
        return TRUE;
    }

    public static function save_uploaded_image($image, $target_path){
        
        if(Model_Image::validate_uploaded_image($image)){         
            if ($file = Upload::save($image, NULL, DOCROOT."images/"))
            {                                    
                Image::factory($file)/*->resize(200, 200, Image::AUTO)*/->save($target_path); 
                // Delete the temporary file
                unlink($file); 
                return TRUE;
            }
        }
        
        return FALSE;        
    }
}