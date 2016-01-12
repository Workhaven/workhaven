<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Projects extends Controller_Secure {
    
        private $post = NULL;
        private $project = NULL;
        
        public function __construct(\Request $request, \Response $response) {
            if ($request->param('id')) {
                $this->project = new Model_Project($request->param('id'));
                if (!$this->project->loaded()){ 
                    throw new HTTP_Exception_404(__('This page seems to not exists.'));                                      
                }
                $this->test_user_authorized();
            }                                                 
            parent::__construct($request, $response);
        }
        
        public function test_user_authorized(){
            /*
             * Test if loged in user have access rights to current project:
             */
            if (Auth::instance()->logged_in() AND
                !Auth::instance()->logged_in("admin") AND
                !$this->project->team->where('id', '=', Auth::instance()->get_user()->id)->find_all()->count())
            {                       
                throw new HTTP_Exception_403(__('You do not have permission to access this.'));
            }            
        }
        
        /*
         * Function get_projects() returns projects related to current loged in user
         * @return array $projects 
         */    
        function get_projects($pagination){
            if (Auth::instance()->logged_in("admin")) {
                return Model::factory('Project')->order_by('id', 'desc')->offset($pagination->offset)->limit($pagination->items_per_page)->find_all();
            } else {
                return Auth::instance()->get_user()->projects->order_by('id', 'desc')->offset($pagination->offset)->limit($pagination->items_per_page)->find_all();
            }
        }        
        
        function delete_project_directory($project_id){
            if (is_dir(DOCROOT."images/projects/".$project_id)) {
                 rmdir(DOCROOT."images/projects/".$project_id);
            }
        }
            
	public function action_index()
	{    
            $pagination = Pagination::factory(array(
                'total_items' => Model_Project::count_projects(),
            ));
            $this->template->data["projects"] = $this->get_projects($pagination);
            $this->template->data["pagination"] = $pagination;
	}
        
        public function action_add(){              
            if($this->request->post()){   
                $this->template->data["values"] = $this->request->post();
                $project = Model::factory('Project');    
                
                $post = array_filter($this->request->post());                                
                $post["user_id"] = Auth::instance()->get_user()->id;                 
                $project->values($post, array_keys($post));
                try {                                                                        
                    $project->save();                
                    mkdir(DOCROOT."images/projects/".$project->id);
                    $project->share_hash = Auth::instance()->hash($project->id.time());                    
                    $project->save();
                    $project->add('team', ORM::factory('User', array('id' => Auth::instance()->get_user()->id))); 
                    $this->redirect('admin/projects/detail/'.$project->id);
                } catch (ORM_Validation_Exception $e) {
                    $this->template->data["errors"] = $e->errors('models');
                }                
            }
            $this->template->data["clients"] = ORM::factory("Client")->get_clients();            
        }  
        
       public function action_delete(){                                                                           
            foreach($this->project->images->find_all() as $image){
                $image->delete_image_file();
                $image->delete();
            }
            $this->delete_project_directory($this->request->param('id'));
            $this->project->delete();
            $this->redirect('admin/projects/');                                                       
        }
           
        public function action_detail(){            
            if($this->request->post()){  
                $post = $this->request->post();
                if (!$post['client_id']) { $post['client_id'] = NULL; }
                $this->project->values($post);
                try {                                                                        
                    $this->project->save();
                    $this->redirect('admin/projects/detail/'.$this->project->id);
                } catch (ORM_Validation_Exception $e) {
                    $this->template->data["errors"] = $e->errors('models');
                }                         
            }                          
            $this->template->data["project"] = $this->project;
            $this->template->data["images"] = $this->project->images->order_by('id', 'desc')->find_all();
            $this->template->data["share_url"] = URL::base(TRUE, TRUE)."share/".$this->project->share_hash."/project/detail/";
            $this->template->data["users"] = Model::factory('User')->where('id', '!=', Auth::instance()->get_user()->id)->order_by('id', 'desc')->find_all()->as_array('id', 'email');            
            $this->template->data["selected_users"] = $this->project->team->where('id', '!=', Auth::instance()->get_user()->id)->order_by('id', 'desc')->find_all()->as_array('id');
            $this->template->data["selected_permissions"] = $this->project->granted_permissions->find_all()->as_array('id', 'name');                       
            $this->template->data["clients"] = ORM::factory("Client")->get_clients();
            $this->template->data["permissions"] = ORM::factory("Projectpermissions")->find_all()->as_array('id', 'name');
        }

        public function action_share(){
            if($this->request->post()){
                $this->post = $this->request->post();
                $this->handle_team_sharing();
                $this->handle_visibility();
                $this->handle_permissions();
            }
            $this->redirect('admin/projects/detail/'.$this->project->id);
        }
              
        /*
         * Method handle_permissions() set or unsets selected permissions
         *      current available permissions:  comments
         *                                      image notes
         */
        private function handle_permissions(){            
            DB::delete('projects_granted_permissions')->where('project_id', '=', $this->project->id)->execute();
            if( isset($this->post['visibility']) AND isset($this->post[$this->post['visibility'].'_permissions']))
            {                
                $selected_permissions = $this->post[$this->post['visibility'].'_permissions'];                
                foreach($selected_permissions as $permission_id){
                    $this->project->add('granted_permissions', ORM::factory('Projectpermissions', array('id' => $permission_id)));
                }                              
            }            
        }           
      
        /*
         * Project visibility options:  private
         *                              public
         *                              secure
         *                              portfolio    
         */
        private function handle_visibility() {
            if( isset($this->post['visibility']) ){
                $this->project->visibility_id = $this->post['visibility'];               
                if( isset($this->post['password']) ){                    
                    $this->project->share_password = $this->post['password'];
                }                
                if( isset($this->post['portfolio']) ){
                    $this->project->portfolio = 1;
                } else {
                    $this->project->portfolio = NULL;
                }               
                $this->project->save();
            }
        }        
        
        /*
         * Method for handling team project sharing option. 
         * In the table "project_visibility" the project and selected users are associated.
         */
        private function handle_team_sharing(){
            /*
             * User checked team checkbox (sharing)
             */
            if( isset($this->post['team']) && isset($this->post['user_id']) ){
                DB::delete('projects_teams')->where('project_id', '=', $this->project->id)->and_where('user_id', '!=', Auth::instance()->get_user()->id)->execute();
                foreach($this->post['user_id'] as $user_id){
                    $this->project->add('team', ORM::factory('User', array('id' => $user_id)));
                }
            /*
             * User unchecked team checkbox (sharing)
             */                
            } else {
                DB::delete('projects_teams')->where('project_id', '=', $this->project->id)->and_where('user_id', '!=', Auth::instance()->get_user()->id)->execute();                        
            }            
        }
} 
