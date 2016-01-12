<?php
/**
 * Handles notifications. The initial call of this class is in constructor of 
 * "app/system/classes/Controller" class. This class checks for action "add" 
 * (this means /add/ in url at action place) and notificates related user of
 * this new "adding of something".
 *
 * @author Jiří Kvapil
 */

class Notifications {    
    
    private $request = NULL;
    
    public function __construct(\Request $request = NULL) {
        $this->request = $request;
    }
    
    public static function factory($request = NULL)
    {
        return new Notifications($request);
    }
    
    public function new_user_account($to, $login_details){
        Model_Email::factory()->you_have_new_account($to, $login_details);
    }   
    
    public function new_note($note){
        $project = $note->image->project;
        
        foreach ($project->team->find_all() as $user) {
            /* Skip sending notification to currently loged in user's email, because this user is author of the new note: */
            if (Auth::instance()->logged_in() && $user->email == Auth::instance()->get_user()->email) {
                continue;
            } 
            Model_Email::factory()->new_note($user->email, $note);
        }
    }
    
    public function new_comment($comment){
        $project = $comment->discussion->image->project;

        foreach ($project->team->find_all() as $user) {            
            /* Skip sending notification to currently loged in user's email, because this user is author of the new comment: */
            if (Auth::instance()->logged_in() && $user->email == Auth::instance()->get_user()->email) {
                continue;
            } 
            Model_Email::factory()->new_comment($user->email, $comment);
        }       
    }       
    
    /*
     * To all team members will send notification about new picture.
     */
    public function new_image($image){
        $project = $image->project;
        
        foreach ($project->team->find_all() as $user) {            
            if ($user->email != Auth::instance()->get_user()->email) {
                Model_Email::factory()->new_image($user->email, $image);
            }
        }        
    }
}
