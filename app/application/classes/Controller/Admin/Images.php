<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Images extends Controller_Secure {
      
    private $image = NULL;
    
    public function __construct(\Request $request, \Response $response) {          
        if($request->param('id')){
            $this->image = new Model_Image($request->param('id')); 
            if (!$this->image->loaded()){
                throw new HTTP_Exception_404(__('This page seems to not exist.'));
            }
        }
        parent::__construct($request, $response);
    }        
    
    protected function _save_image($image, $project_id, $file_id, $filename = NULL)
    {            
        if(!$filename){
            $filename = $file_id."_".$project_id."_".strtolower(Text::random('alnum', 32)). '.' . pathinfo($image['name'], PATHINFO_EXTENSION);         
        }
        $target_path = DOCROOT . 'images/projects/' . $project_id . '/' . $filename;          
                
        if( Model_Image::save_uploaded_image($image, $target_path) )
            return $filename; 
        else 
            return FALSE;     
    }          
    
    public function action_add(){
        $error = FALSE;
        if ($this->request->post()) {
            $this->template->data["values"] = $this->request->post(); 
                                               
            if ($_FILES['files']['name'][0] != "") {                
                for ($i = 0; $i < count($_FILES['files']['name']); $i++) {                        
                    $image = Model::factory('Image');     
                    $discussion = new Model_Discussion();
                    $discussion->save();
                    $post = $this->request->post();                    
                    $post["filename"] = "temp";
                    $post["discussion_id"] =  $discussion->id;
                    $image->values($post, array_keys($post));
                    try {                                                                        
                        $image->save();                                                                
                        $filename = $this->_save_image(array("name" => $_FILES['files']['name'][$i],"type" => $_FILES['files']['type'][$i],"tmp_name" => $_FILES['files']['tmp_name'][$i],"error" => $_FILES['files']['error'][$i], "size" => $_FILES['files']['size'][$i]), $this->request->post("project_id"), $image->id);                        
                        // set new name into DB:
                        if($filename){
                            $image->filename = $filename;
                            $image->save();
                        }
                        $discussion->image_id = $image->id;
                        $discussion->save();       
                        
                        Notifications::factory()->new_image($image);
                    } catch (ORM_Validation_Exception $e) {
                        $this->template->data["errors"] = $e->errors('models');                        
                        $error = TRUE;
                        $discussion->delete();
                    }
                }
            } else {         
                $error = TRUE;
                array_push ( $this->template->data["errors"], "You must choose file/s.");
            }
            if(!$error){                
                $this->redirect('admin/projects/detail/'.$this->request->post("project_id"));                        
            }
        } else {                            
           if ( isset($_GET["project_id"])) {
                $this->template->data["values"] = array("project_id" => $_GET["project_id"]);
           }
        }
        $this->template->data["projects"] = ORM::factory("Project")->order_by('id', 'desc')->find_all()->as_array("id", "name");        
    }
    
    public function action_delete(){
        $project_id = $this->image->project_id;
        $this->image->delete_image_file();        
        if($this->image->discussion->loaded()){
            $this->image->discussion->delete();
        }
        $this->image->delete();
        $this->redirect('admin/projects/detail/'.$project_id);            
    }
    
    public function action_detail(){            
        if ($this->request->post()) {
           $image_revision = "";
           $this->image->description = $this->request->post("description");
           $this->image->background_color = $this->request->post("background_color");            
           if($_FILES['image']['name']){
               $this->_save_image($_FILES['image'], $this->image->project_id, NULL, $this->image->filename); 
               $image_revision = '?image_revision='.time()."#";
           }            
           $this->image->save();
           $this->redirect('admin/images/detail/'.$this->image->id.$image_revision);
        }

        if(isset($this->image->background_color)){
            $this->main_template->head_style .= ".wrapper {background-color: ".$this->image->background_color."}";
        }
        /* Hide "author input field" for image notes if user is loged in. */        
        $this->main_template->head_style .= ".jquery-notes-container .notes .note .text-box input#author {display: none}";                
        if(isset($_GET["image_revision"])) {            
            $this->template->data["image_revision"] = "?".$_GET["image_revision"];
        }
        $this->template->data["values"] = $this->image->object();                  
        $this->template->data["notes"] = $this->image->notes->find_all();                  
        $this->template->data["discussion"] = $this->image->discussion;  
    }  
    
    public function action_addcomment(){
        if ($this->request->post()) {
            $factory_comment = new Model_Comment();
            $reply_comment_id = NULL;
            if(isset($_GET["replyfor"])) $reply_comment_id = $_GET["replyfor"];
            $new_comment = $factory_comment->create_new($this->request->post(), $this->image->discussion_id, $reply_comment_id);
            $this->redirect('/admin/images/detail/'.$this->image->id.'#comment'.$new_comment->id);
        }
    }    
    
    public function action_publishinportfolio(){
        $this->image->portfolio = 1 - $this->image->portfolio;
        $this->image->save();
        $this->redirect($this->request->referrer());
    }            
} 
