<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h2><?=__('New comment')?></h2>
<p>
    <?=__('New comment has been added to your image.')?>
</p>

<p style="padding: 10px; border: 1px solid black">
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/images/detail/'.$comment->discussion->image->id.'#comment'.$comment->id, nl2br($comment->text), array("style" => "color: #68c4c5"))?><br />
    <b><?=$comment->user->email.$comment->author_visitor?>, <?=Date::process($comment->created, FALSE)?></b>
</p>  
<br />
<p>    
    <b><?=__('Image')?>:</b><br />
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/images/detail/'.$comment->discussion->image->id, '<img src="'.URL::site(NULL, TRUE).'imagefly/w200/images/projects/'.$comment->discussion->image->project->id.'/'.$comment->discussion->image->filename.'" width="200" alt="'.$comment->discussion->image->description.'" />')?> 
</p>
<br />
<p>
    <b><?=__('Project')?>:</b><br />
    <?=HTML::anchor(URL::site(NULL, TRUE).'admin/projects/detail/'.$comment->discussion->image->project->id, $comment->discussion->image->project->name,  array("style" => "color: #68c4c5"))?>
</p>
