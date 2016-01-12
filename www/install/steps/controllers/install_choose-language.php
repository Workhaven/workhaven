<?php  
if(!empty($_POST)){      
    if($_POST['language'] != ""){
        setcookie('lang', $_POST['language'], time() + (86400 * 7));
    }
    header('location: ?step=environment-tests');
}   