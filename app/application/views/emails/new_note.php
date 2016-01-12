<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h2><?=__('New note')?></h2>
<p>
    <?=__('New note has been added to your picture.')?>
</p>

<p style="padding: 10px; border: 1px solid black">
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/images/detail/'.$note->image->id, nl2br($note->text), array("style" => "color: #68c4c5"))?><br />
    <b><?=$note->user->email.$note->author_visitor?>, <?=Date::process($note->created, FALSE)?></b>
</p>  
<br />
<p>
    <b><?=__('Image')?>:</b><br />    
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/images/detail/'.$note->image->id, '<img src="'.URL::site(NULL, TRUE).'imagefly/w200/images/projects/'.$note->image->project->id.'/'.$note->image->filename.'" width="200" alt="'.$note->image->description.'" />')?><br /> 
</p>
<br />
<p>
    <b><?=__('Project')?>:</b><br />
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/projects/detail/'.$note->image->project->id, $note->image->project->name,  array("style" => "color: #68c4c5"))?>
</p>
