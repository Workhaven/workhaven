<?php
$errors = array();

if($_POST){
    require "../app/application/".'bootstrap.php';
    
    $remember_me = FALSE;
    if(isset($_POST['remember-me'])) $remember_me = TRUE;

    if (Auth::instance()->login($_POST['email'], $_POST['password'], $remember_me))
    {        
      // rename instalation folder       
      header('location: ./');
    }
    else
    {
        // Login failed, send back to form with error message
        $errors["form"] = ___("Login failed. Check the entered data.");
    }
}