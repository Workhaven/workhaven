<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Notes extends Kohana_Controller_Template {
  
    public function before() {
        if ($this->request->is_ajax()) {
            $this->profiler = NULL;
            $this->auto_render = FALSE;
            header('content-type: application/json');
        }
        parent::before();
    }     
    
    private function parse_post_data($post){
        $note_data = array();        
        $note_data['left'] = $post['left'];
        $note_data['top'] = $post['top'];
        $note_data['width'] = $post['width'];
        $note_data['height'] = $post['height'];
        $note_data['text'] = $post['note'];
        $note_data['image_id'] = $post['image_id'];
        if(Auth::instance()->logged_in()){
            $note_data['user_id'] = Auth::instance()->get_user()->id;
        } else {
            $note_data['author_visitor'] = $post['author'];
        }
        $note_data['link'] = $post['link']; 
        return $note_data;      
    }
    
    private function parse_db_data($notes_from_db) {
        $parsed_notes = array();       
        foreach ($notes_from_db as $note) {
            $parsed_notes[] = array(
                'ID' => $note->id,
                'LEFT' => $note->left,
                'TOP' => $note->top,
                'WIDTH' => $note->width,
                'HEIGHT' => $note->height,
                'DATE' => Date::process($note->created, FALSE),
                'NOTE' => nl2br($note->text),
                'AUTHOR' => $note->user->email.$note->author_visitor,
                'LINK' => $note->link
            );
        }
        return $parsed_notes;
    }    
    
    private function get_notes($image_id){        
        $image = new Model_Image($image_id);         
        $notes = array();
        if ($image->loaded()){           
            $notes = $this->parse_db_data( $image->notes->find_all() );
        }            
        return $notes;        
    }    
    
    private function save_note($post){        
        $note = new Model_Note();        
        $note_data = array_filter($this->parse_post_data($post));                                            
        $note->values($note_data, array_keys($note_data));
        try {
            $note->save();              
            Notifications::factory()->new_note($note->reload());
        } catch (Exception $exc) {
            return false;
        }           
        return true;
    }       
    
    private function delete_note($id) {
        $note = new Model_Note($id);             
        if($note->loaded() && Auth::instance()->logged_in()){               
            $note->delete();                    
            return true;
        }             
        return false;
    }  
    
    private function edit_note($id, $post) {
        $note = new Model_Note($id);             
        if($note->loaded() && Auth::instance()->logged_in()){ 
            $note->text = $post['note'];
            $note->save();                    
            return true;
        }             
        return false;
    }       
    
    public function action_index(){
        if ($this->request->post()) {
            $post = $this->request->post();            
            if (isset($post['add']) && !empty($post['add'])){
                echo json_encode($this->save_note($post));                
            }              
            
            if (isset($post['get']) && !empty($post['get'])) {
                echo json_encode($this->get_notes($post['image_id']));
            }

            if (isset($post['delete']) && !empty($post['delete'])) {
                echo json_encode($this->delete_note($post['id']));
            }

            if (isset($post['edit']) && !empty($post['edit'])) {
                echo json_encode($this->edit_note($post['id'], $post));
            }
        }          
    }
    
} 
