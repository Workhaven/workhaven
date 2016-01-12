<?php
defined('SYSPATH') OR die('No direct script access.');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PartialView
 *
 * @author Jiří Kvapil
 */

class PartialView extends Kohana_View {   
    
    public static function factory($view_path = NULL, array $data = NULL, $secure = FALSE)   
    {          
            /* if partial view should be secure (only for logged in users) */
            if($secure){
                if (!Auth::instance()->logged_in())
                {
                  return "";
                }                      
            }              
            
            if(!$data){
                $partial_obj = NULL;
                
                $parsed_path = explode("/", $view_path);    
                $file = end( $parsed_path );
                
                $controller_path = array();
                foreach ($parsed_path as $path_item){
                    $controller_path[] = ucfirst($path_item);
                }
                $controller_path = implode("/", $controller_path);
                                                                
                $class_path = '../app/application/classes/Controller/'.$controller_path.EXT;               
                                                           
                if(file_exists($class_path))
                    require_once $class_path;
                else 
                    throw new View_Exception("Controller file for the partial view does not exists. Create file '".$file.EXT."' and class inside Controller/_partials/");               
                
                $class = "Controller__Partials_".$file;
                
                if(class_exists($class)){
                    $partial_obj = new $class();
                    $data = $partial_obj->getData();
                } else {
                    throw new View_Exception('Controller class for partial view does not exists.');
                }
            }            
            return new View( $view_path, $data);
    }    
}
