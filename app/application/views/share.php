<!DOCTYPE html>
<html lang="<?=$html_lang?>">
<head>
    <meta charset="utf-8" />
    <title><?php echo $title ?></title>
    <meta name="description" content="<?php echo $meta_description ?>" />
    <meta name="keywords" content="<?php echo $meta_keywords ?>" />  
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/css/workhaven.css" />
    <link rel="stylesheet" type="text/css" href="/css/img-notes.css" />
    <!--[if lte IE 8]>
    <link rel="stylesheet" type="text/css" href="/css/img-notes-lteIE8.css" />
    <![endif]-->    
    <style>
        <?php echo $head_style ?>
    </style>
</head>
<body>
    <div class="wrapper">    
        <div class="navbar-wrapper">        
            <?php echo PartialView::factory("share/_partials/Menu", NULL, false); ?>
        </div>                     
        <?php echo $content ?>        
        <?php echo PartialView::factory("share/_partials/Footer", NULL, false); ?>
    </div>    
    <script src="/js/jquery-1.10.2.min.js"></script>   
    <script src="/js/jquery-ui.min.js"></script> 
    <script src="/js/jquery-notes_1.0.8_min.js"></script>    
    <script src="/js/bootstrap.min.js"></script>    
    <script src="/js/workhaven-share-init.js"></script>  
</body>
</html>