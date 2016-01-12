<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?=HTML::anchor('/admin/', '  <span class="glyphicon glyphicon-home"></span>', array("title" => __('Homepage'), "class"=>"navbar-brand"))?>        
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">       
        <li<?=HTML::active("clients")?>><?=HTML::anchor('/admin/clients/', __("Clients").' <span class="badge">'.$clients_count.'</span>')?></li>
        <li<?=HTML::active("projects")?><?=HTML::active("images", "detail")?> style="position: relative; min-width:100px">              
            <?php if( isset($project) ){ ?>
                <?=HTML::anchor('/admin/projects/detail/'.$project->id, '<span class="upper-title">'.__("Projects").'</span>'.Text::limit_chars($project->name, 25))?>                                      
            <?php } else { ?>
                <?=HTML::anchor('/admin/projects/', __("Projects").' <span class="badge">'.$projects_count.'</span>')?>                                          
            <?php } ?> 
        </li> 
        <li<?=HTML::active("projects")?><?=HTML::active("images", "detail")?> style="position: relative">                                  
            <?=HTML::anchor('#', '<b class="caret"></b>', array( "class"=>"dropdown-toggle", "title" => __('Projects'), "data-toggle"=>"dropdown"))?>            
            <ul class="dropdown-menu pull-right" style="min-width: 270px"> 
                <?php if( isset($project) ){ ?>
                  <li><?=HTML::anchor('/admin/projects/', __("All projects").'<span class="badge pull-right">'.$projects_count.'</span>')?></li>
                  <li class="divider"></li>                    
                <?php } ?>                    
                <li class="dropdown-header"><?=__("Latest projects")?></li> 
                <?php if(isset($latest_projects)){ 
                        foreach ($latest_projects as $proj){ ?>
                            <li><?=HTML::anchor('/admin/projects/detail/'.$proj->id, Text::limit_chars($proj->name, 25).'<span class="badge pull-right">'.$proj->images->find_all()->count().'</span>' )?></li>
                <?php   }                      
                    } ?>    
                <li class="divider"></li>
                <li><?=HTML::anchor('#add_project', "<span class='glyphicon glyphicon-plus' style='color: #74D5D6'></span> ".__("Add new project"), array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Add new project"), "data-target"=>"#add_project-modal"))?></li>
            </ul>                        
        </li>                 
      </ul>                          
      <ul class="nav navbar-nav pull-right right-menu-part">  
        <li class="dropdown<?=HTML::active("user","personalsettings", "active")?>" title="<?=__("Personal settings")?>" >
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu">            
            <li class="dropdown-header"><?=$user->email?><br /><br /></li>            
            <li class="divider"></li>
            <li<?=HTML::active("user","personalsettings")?>><?=HTML::anchor('/admin/user/personalsettings', __("Personal settings"))?></li>
            <li><?=HTML::anchor('/admin/user/log/out', __("Log Out"))?></li>
          </ul>
        </li> 
        <?php if(Auth::instance()->logged_in("admin")){ ?>
        <li<?=HTML::active("user",array("all", "add"))?> title="<?=__("Users")?>" style="position: relative"><a href="/admin/user/all"><span class="glyphicon glyphicon-user"></span><span style="position: absolute;top: 21px;left: 23px" class="glyphicon glyphicon-user"></span> <span class="glyphicon glyphicon-user"></span> <span class="badge"><?=$users_count?></span></a></li>
        <?php } ?>
        
        <?php if(Auth::instance()->logged_in("admin")){ ?>
            <li<?=HTML::active("system","settings")?> title="<?=__("System settings")?>"><?=HTML::anchor('/admin/system/settings', '<span class="glyphicon glyphicon-cog"></span>')?></li>                
        <?php } ?>            
                       
       <li class="dropdown" title="<?=__('Add')?>">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span></a>
          <ul class="dropdown-menu">          
            <li><?=HTML::anchor('#add_image', __("Image"), array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Add new image/s"), "data-target"=>"#add_image-modal"))?></li>
            <li><?=HTML::anchor('#add_project', __("Project"), array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Add new project"), "data-target"=>"#add_project-modal"))?></li>
            <li><?=HTML::anchor('#add_client', __("Client"), array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Add new client"), "data-target"=>"#add_client-modal"))?></li>           
            <?php if(Auth::instance()->logged_in("admin")){ ?>                
                <li><?=HTML::anchor('#add_user', __("User"), array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Create new user account"), "data-target"=>"#add_user-modal"))?></li>           
            <?php } ?>
          </ul>
        </li>        
      </ul>                                       
    </div>
  </div>
</div>   