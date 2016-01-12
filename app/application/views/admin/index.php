<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<div class="container">
    <div class="latest col-sm-6 col-md-4 col-lg-3">
        <h2><span class="glyphicon glyphicon-pushpin"></span> <?=__('Latest notes')?></h2>
        <?php foreach($latest_notes as $note){ ?>
        <div class="panel panel-default">                
                <div class="panel-body">
                    <b><?=Date::process($note->created)?></b>
                    <p><?=HTML::anchor('/admin/images/detail/'.$note->image->id, Text::limit_chars($note->text, 100))?></p>                            
                    <?=$note->user->email.$note->author_visitor?>
                </div>
                <div class="panel-footer"><?=HTML::anchor('/admin/projects/detail/'.$note->image->project->id, Text::limit_chars($note->image->project->name,30))?></div>
            </div>         
        <?php } ?>
    </div>
    <div class="latest col-sm-6 col-md-4 col-lg-3">
        <h2><span class="glyphicon glyphicon-comment"></span> <?=__('Latest comments')?></h2>
        <?php foreach($latest_comments as $comment){ ?>
            <div class="panel panel-default">                
                <div class="panel-body">     
                    <b><?=Date::process($comment->created)?></b>
                    <p><?=HTML::anchor('/admin/images/detail/'.$comment->discussion->image->id.'#comment'.$comment->id, Text::limit_chars($comment->text, 100))?></p>                            
                    <?=$comment->user->email.$comment->author_visitor?>
                </div>
                <div class="panel-footer"><?=HTML::anchor('/admin/images/detail/'.$comment->discussion->image->project->id, Text::limit_chars($comment->discussion->image->project->name,30))?></div>
            </div>        
        <?php } ?>        
    </div>
    <div class="clearfix visible-sm"></div>
    <div class="latest col-sm-6 col-md-4 col-lg-3">
        <h2><span class="glyphicon glyphicon-picture"></span> <?=__('Latest images')?></h2>
        <?php foreach($latest_images as $image){ ?>                     
            <div class="panel panel-default">                
                <div class="panel-body">     
                    <?=HTML::anchor('/admin/images/detail/'.$image->id, '<img src="/imagefly/w760/images/projects/'.$image->project->id.'/'.$image->filename.'" alt="'.$image->description.'" />')?>                              
                </div>
                <div class="panel-footer"><?=HTML::anchor('/admin/projects/detail/'.$image->project->id, Text::limit_chars($image->project->name,30))?></div>
            </div>                                        
        <?php } ?>         
    </div>    
    <div class="latest col-sm-6 col-md-4 col-lg-3">                
        <h2><?=__('Latest projects')?></h2>
        <?php foreach($latest_projects as $project){ 
            include Kohana::find_file('views', 'admin/projects/project_card');
        } ?>         
    </div>
</div>