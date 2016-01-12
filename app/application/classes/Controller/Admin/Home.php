<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Home extends Controller_Secure {

	public function action_index()
	{                                                      
            $view = View::factory('admin/index');

            if (Auth::instance()->logged_in("admin")) {
                $view->set("latest_notes", Model::factory('Note')->order_by('id', 'desc')->limit(10)->find_all());
                $view->set("latest_comments", Model::factory('Comment')->order_by('id', 'desc')->limit(10)->find_all());
                $view->set("latest_images", Model::factory('Image')->order_by('id', 'desc')->limit(10)->find_all());                
                $view->set("latest_projects", Model::factory('Project')->order_by('id', 'desc')->limit(10)->find_all());
            } else {
                $latest_notes = array();
                foreach(DB::select('notes.id')  ->from('notes')
                                                ->join('images')->on('images.id', '=', 'notes.image_id')
                                                ->join('projects')->on('images.project_id', '=', 'projects.id')
                                                ->join('projects_teams')->on('projects.id', '=', 'projects_teams.project_id')
                                                ->where('projects_teams.user_id', '=', Auth::instance()->get_user()->id)
                                                ->order_by('id', 'desc')
                                                ->limit(10)
                                                ->execute() as $note)
                {
                    $latest_notes[] = new Model_Note($note);
                }                  
                $view->set("latest_notes", $latest_notes);                
                
                $latest_comments = array();
                foreach(DB::select('comments.id')   ->from('comments')
                                                    ->join('discussions')->on('discussions.id', '=', 'comments.discussion_id')
                                                    ->join('images')->on('images.discussion_id', '=', 'discussions.id')
                                                    ->join('projects')->on('images.project_id', '=', 'projects.id')
                                                    ->join('projects_teams')->on('projects.id', '=', 'projects_teams.project_id')
                                                    ->where('projects_teams.user_id', '=', Auth::instance()->get_user()->id)
                                                    ->order_by('id', 'desc')
                                                    ->limit(10)
                                                    ->execute() as $comment)
                {
                    $latest_comments[] = new Model_Comment($comment['id']);
                }                
                $view->set("latest_comments", $latest_comments);
                                
                $latest_images = array();
                foreach(DB::select('images.id') ->from('images')
                                                ->join('projects')->on('images.project_id', '=', 'projects.id')
                                                ->join('projects_teams')->on('projects.id', '=', 'projects_teams.project_id')
                                                ->where('projects_teams.user_id', '=', Auth::instance()->get_user()->id)
                                                ->order_by('id', 'desc')
                                                ->limit(10)
                                                ->execute() as $image)
                {
                    $latest_images[] = new Model_Image($image['id']);
                }                
                $view->set("latest_images",  $latest_images);                
                
                $view->set("latest_projects", Auth::instance()->get_user()->projects->order_by('id', 'desc')->limit(10)->find_all());                
            }            
            
            $this->response->body($view);
	}  
} 
