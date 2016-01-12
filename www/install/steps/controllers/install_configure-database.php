<?php  
  
  class PhpError extends Exception { 
      public function __construct() { 
          list( 
              $this->code, 
              $this->message, 
              $this->file, 
              $this->line) = func_get_args(); 
      } 
  } 
  
  set_error_handler(create_function( 
      '$errno, $errstr, $errfile, $errline', 
      'throw new PhpError($errno, $errstr, $errfile, $errline);' 
  ));               
    
  $errors = array();
  if(!empty($_POST)){                     
    // Check if all about database is set
    $all_set = true;  
    if(!empty($_POST['host']))     $server_host = $_POST['host'];       else $all_set = false;
    if(!empty($_POST['database'])) $database_name = $_POST['database']; else $all_set = false;
    if(!empty($_POST['login']))    $login = $_POST['login'];            else $all_set = false;
    if(!empty($_POST['password'])) $password = $_POST['password'];      else $all_set = false;
    if(!empty($_POST['table_prefix'])) $table_prefix = $_POST['table_prefix']; else $table_prefix = "";   
    
    if($all_set){                            
      $mysqli = null;
      // FIRST test database connection with "raw" mysqli:
      try { 
          $mysqli = new mysqli($server_host, $login, $password, $database_name);
          if ($mysqli->connect_error) {            
            $errors['connect_error'] = 'Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error;
          }                                 
      } catch (Exception $e) {           
          $errors['db_config'] = ___('It seems you have entered incorrect informations.' /* . " " . $e */ ); 
      }                                                                
      
      if(empty($errors)){        
        // run instalation SQL script (creating tables, etc.):
        try { 
          // load SQL queries one by one and run them:
          $queries = explode (";", str_replace ( "{prefix}", $table_prefix, file_get_contents("install/install.sql")));
          $query = "";
          foreach($queries as $key => $query){
            $query = trim($query);
            if(!empty($query)) {
              $mysqli->query($query);
            }       
          }                                
        } catch (Exception $e) { 
            $errors['install_sql'] = ___('Please repeat this step again. Something went wrong.');
            $errors['exception'] = "Exception: " . $e->getMessage()." in query: ".$query."!"; 
        }       
      
        if(empty($errors)){
            $db_config = "<?php defined('SYSPATH') or die('No direct access allowed.');     
            return array
            (
                'default' => array
                (
                    'type'       => 'MySQL',
                    'connection' => array(
                        'hostname'   => '$server_host',
                        'database'   => '$database_name',
                        'username'   => '$login',   
                        'password'   => '$password',     
                        'persistent' => FALSE,
                    ),
                    'table_prefix' => '$table_prefix',
                    'charset'      => 'utf8',
                    'caching'      => FALSE,
                    'profiling'    => TRUE
                )
            );";                               
            // save database configurations into file:
            file_put_contents("../app/application/config/database.php", $db_config );

            if($mysqli != null)
                $mysqli->close();         

            // redirect to next instalation step:      
            header('location: ?step=create-admin-profile');             
        }                
      }
    }                                                                 
  } 
                                         