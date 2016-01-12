<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Admin_Clients extends Controller_Secure {
         
        private $client = NULL;
    
        public function __construct(\Request $request, \Response $response) {
            if ($request->param('id')) {
                $this->client = new Model_Client($request->param('id'));
                if (!$this->client->loaded()){ throw new HTTP_Exception_404(__('This page seems to not exists.')); }
            }                                                 
            parent::__construct($request, $response);
        }    
    
        function get_clients($pagination){
            $c = array();
            if (Auth::instance()->logged_in("admin")) {
                $c = Model::factory('Client')->order_by('id', 'desc')->offset($pagination->offset)->limit($pagination->items_per_page)->find_all();
            } else {
                $c = Model::factory('Client')->order_by('id', 'desc')->where('user_id', '=', Auth::instance()->get_user()->id)->offset($pagination->offset)->limit($pagination->items_per_page)->find_all();
            }
            return $c;
        }        
    
	public function action_index()
	{                 
            $pagination = Pagination::factory(array(
                'total_items' => Model_Client::count_clients(),
            ));
            $this->template->data["clients"] = $this->get_clients($pagination);
            $this->template->data["pagination"] = $pagination;
	}      
        
        public function action_add(){            
            if($this->request->post()){                                           
                $this->template->data["values"] = $this->request->post(); 
                $client = Model::factory('Client');
                $post = $this->request->post();
                $post["user_id"] = Auth::instance()->get_user()->id;
                $client->values($post, array_keys($post));
                try {                                                                        
                    $client->save();
                    $this->redirect('admin/clients/');
                } catch (ORM_Validation_Exception $e) {
                    $this->template->data["errors"] = $e->errors('models');
                }                
            } 
        }    
        
        public function action_delete(){                           
            $this->client->delete();            
            $this->redirect('admin/clients/');
        }
               
        public function action_detail(){                                                  
            if($this->request->post()){  
                $this->client->values($this->request->post());                
                try {                                                                        
                    $this->client->save();
                    $this->redirect('admin/clients/detail/'.$this->client->id);
                } catch (ORM_Validation_Exception $e) {
                    $this->template->data["errors"] = $e->errors('models');
                }                         
            } 
            $this->template->client = $this->client;
        }        
} 
