<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Share_Images extends Controller_Share {
                         
    private $image = NULL;
    public  $project = NULL;    

    public function __construct(\Request $request, \Response $response) {  
        $this->image = new Model_Image($request->param('id')); 
        if (!$this->image->loaded()){ 
            $exception = new HTTP_Exception_404(__('This page seems to not exists.'));
            $response->body( $exception->get_response()->body() );
        }        
        parent::__construct($request, $response);
    }
    
    public function action_detail(){
        if(isset($this->image->background_color)){
            $this->main_template->head_style .= ".wrapper {background-color: ".$this->image->background_color."}";
        } 
        /* Hide "author input field" for image notes if user is loged in. */
        if(Auth::instance()->logged_in()){
            $this->main_template->head_style .= ".jquery-notes-container .notes .note .text-box input#author {display: none}";
        }         
        $this->template->data["values"] = $this->image->object();                         
        $this->template->comments_allowed = $this->project->granted_permissions->where("id", "=", 1)->find_all()->count();
        $this->template->notes_allowed = $this->project->granted_permissions->where("id", "=", 2)->find_all()->count();                                     
        
        if($this->template->comments_allowed){            
            $this->template->data["discussion"] = $this->image->discussion;
        }                                       
    }
    
    public function action_addcomment(){        
        if ($this->request->post()) {                                
            $factory_comment = new Model_Comment();
            $reply_comment_id = NULL;
            if(isset($_GET["replyfor"])) $reply_comment_id = $_GET["replyfor"];
            $new_comment = $factory_comment->create_new($this->request->post(), $this->image->discussion_id, $reply_comment_id);
            $this->redirect('/share/'.$this->project->share_hash.'/images/detail/'.$this->image->id.'#comment'.$new_comment->id);            
        }
    }    
} 
