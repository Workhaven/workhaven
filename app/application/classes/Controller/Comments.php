<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Comments extends Controller_Template {             
    
    public function action_delete(){ 
        $comment = new Model_Comment($this->request->param('id'));            
        if (!$comment->loaded()){$this->redirect('admin/404/');}        
        
        $image_id = $comment->discussion->image->id;
        $comment->delete();
        $this->redirect('admin/images/detail/'.$image_id.'#discussion');
    }   
} 
