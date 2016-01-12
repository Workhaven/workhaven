<?php defined('SYSPATH') or die('No direct script access.');
 
class Model_Comment extends ORM {
    
    protected $_belongs_to = array('discussion' => array('model' => 'Discussion', 'foreign_key' => 'discussion_id'),
                                   'user' => array('model' => 'User', 'foreign_key' => 'user_id'),
                                   'parent' => array('model' => 'Comment', 'foreign_key' => 'reply_comment_id'));
    protected $_has_many = array('replies' => array('model' => 'Comment', 'foreign_key' => 'reply_comment_id'));
    
    
    public function create_new($post, $discussion_id, $reply_comment_id = NULL){ 
        $comment = NULL;
        if( isset($post['text']) && isset($discussion_id) ){                 
            $user = Auth::instance()->get_user();
            $comment = Model::factory('Comment');
            
            $values = array();                                   
            $values["text"] = $post['text'];
            $values["discussion_id"] = $discussion_id;
            if($user){
                $values["user_id"] = $user->id;
            } else if($post['author_visitor'] != ""){
                $values["author_visitor"] = $post['author_visitor'];
            }
            $values["reply_comment_id"] = $reply_comment_id;            
            $comment->values($values, array_keys($values));                                   
            try {                                                                      
                $comment->save();             
                Notifications::factory()->new_comment($comment->reload());
            } catch (ORM_Validation_Exception $e) {
                $errors = $e->errors('models');
            }                
        }
        return $comment;
    }    
    
    public function rules()
    {
        return array(
            'discussion_id' => array(                
                array('not_empty'),                                
            ),                        
        );
    }      
}