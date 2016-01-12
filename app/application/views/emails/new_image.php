<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h2><?=__('New image')?></h2>
<p>
    <?=__('New image has been added to your project')?> <?=HTML::anchor(URL::site(NULL, TRUE).'admin/projects/detail/'.$image->project->id, $image->project->name,  array("style" => "color: #68c4c5"))?>
</p>

<p>
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/images/detail/'.$image->id, '<img src="'.URL::site(NULL, TRUE).'imagefly/w760/images/projects/'.$image->project->id.'/'.$image->filename.'" width="200" alt="'.$image->description.'" />')?><br /> 
    <br /> 
    <b><?=__('Image link')?>: </b><br />    
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/images/detail/'.$image->id, URL::site(NULL, TRUE).'admin/images/detail/'.$image->id,  array("style" => "color: #68c4c5"))?> 
</p>

<p>
    <b><?=__('Project link')?>: </b><br />
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/projects/detail/'.$image->project->id, URL::site(NULL, TRUE).'admin/projects/detail/'.$image->project->id, array("style" => "color: #68c4c5"))?> 
</p>


