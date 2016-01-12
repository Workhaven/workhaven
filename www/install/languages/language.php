<?php
   
function ___($string, $lang = 'en'){ 
    if( isset($_COOKIE['lang']) && $lang == 'en' ) $lang = $_COOKIE['lang'];         

    if( file_exists ("install/languages/".$lang.".php") )
      include($lang.".php");        

    if( isset($trans[$string]) )  
      return $trans[$string];
    else 
      return $string;      
}

