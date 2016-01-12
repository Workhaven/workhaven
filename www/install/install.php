<?php
include("functions.php");
include("languages/language.php");

if(isset($_GET['step'])){
  if( file_exists("install/steps/controllers/install_".$_GET['step'].".php") )
    include("install/steps/controllers/install_".$_GET['step'].".php");
  else
    include("install/steps/controllers/install_choose-language.php");
}
else
    include("install/steps/controllers/install_choose-language.php");

// Sanity check, install should only be checked from index.php
defined('SYSPATH') or exit('Install tests must be loaded from within index.php!');

if (version_compare(PHP_VERSION, '5.3', '<'))
{
	// Clear out the cache to prevent errors. This typically happens on Windows/FastCGI.
	clearstatcache();
}
else
{
	// Clearing the realpath() cache is only possible PHP 5.3+
	clearstatcache(TRUE);
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Instalation</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/install/css/install.css" />
    <style>
      #show_details, #hide_details {
        display: none
      }      
    </style>     
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body style="height: 700px">
  <div id="colors">
    <div style="background: #9BE8CC"></div>
    <div style="background: #A8E9FF"></div>
    <div style="background: #52A19D"></div>
    <div style="background: #5A147A"></div>
    <div style="background: #89DD2C"></div>        
  </div>
  <div class="container">    
    <?php
      if(isset($_GET['step'])){
        if( file_exists("install/steps/views/install_".$_GET['step'].".php") )
          include("install/steps/views/install_".$_GET['step'].".php");        
        else
          include("install/steps/views/install_choose-language.php");        
      } 
      else
          include("install/steps/views/install_choose-language.php");     
    ?>
  </div>
</body>
</html>
