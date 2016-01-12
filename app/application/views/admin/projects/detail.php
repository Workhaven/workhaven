<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<div class="detail">
    <div class="container">
        <h2 style="display: inline">
            <?=HTML::anchor('#', "<span class='glyphicon glyphicon-pencil'></span>", array("class" => "edit", "title" => __('Edit project')))?>
            <?=" ".__('Project informations')?> <span class="badge"><?=count($data['images'])?></span>
        </h2>
        <?=HTML::anchor('#share', __("Share"), array("style" => "padding: 0 30px 0 30px", "class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Sharing settings"), "data-target"=>"#share-modal"))?>
        <?=HTML::anchor('/admin/projects/delete/'.$data["project"]->id, __("Delete"), array("class"=>"confirm-modal-dialog", "data-message"=>__('Do you really want to delete this?') ) )?>
        <?=View::factory()->showErrors($data['errors'])?>
        <div id="info-container">
            <div id="info">
                <table>
                    <tr><td width="150"><label><?=__('Created')?>:</label></td><td><?=Date::process($data['project']->created, FALSE)?></td></tr>
                    <?php if(Auth::instance()->logged_in("admin")){ ?>
                    <tr><td><label><?=__('Created by user')?>:</label></td><td><?=$data['project']->owner->email?></td></tr>
                    <?php } ?>
                    <tr><td><label><?=__('Client')?>:</label></td><td><?php if($data["project"]->client->id) echo HTML::anchor('/admin/clients/detail/'.$data["project"]->client->id, $data["project"]->client->name." ".$data["project"]->client->surname." <span class='badge'> ".$data["project"]->client->projects->find_all()->count()."</span>")?></td></tr>
                    <tr><td colspan="2"><?=nl2br($data["project"]->description)?></td></tr>
                    <tr><td><label><?=__('Deadline')?>:</label></td><td><?= $data['project']->deadline?></td></tr>
                </table>
            </div>
            <?=HTML::anchor('#', "<span class='glyphicon glyphicon-circle-arrow-up pull-right'></span>", array("class" => "show-hide-info", "title" => __('Hide informations')))?>
            <?=HTML::anchor('#', "<span class='glyphicon glyphicon-circle-arrow-down pull-right'></span>", array("class" => "show-hide-info", "title" => __('Show informations'),  "style" => "display: none"))?>
        </div>
        <div style="display:none"  id="edit">
            <?php include Kohana::find_file('views', 'admin/projects/edit') ?>
            <?php include Kohana::find_file('views', 'admin/projects/share') ?>
        </div>
    </div>
</div>

<div class="container">      
    <div class="galery">
      <?php foreach($data['images'] as $key => $image){ ?>       
        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 images">              
            <?=HTML::anchor('/admin/images/detail/'.$image->id, '<img src="/imagefly/h170/images/projects/'.$data["project"]->id.'/'.$image->filename.'" class="thumbnail" alt="'.$image->description.'" />')?>              
            <div class="actions">
                <?=HTML::anchor('/admin/images/delete/'.$image->id, "<button type='button' class='close' aria-hidden='true'>&times;</button>", array("class"=>"confirm-modal-dialog", "data-message"=>__('Do you really want to delete this?') ) )?>
                <?=HTML::anchor('/admin/images/detail/'.$image->id, "<span class='glyphicon glyphicon-share-alt'></span>")?>
                <?=HTML::anchor('/admin/images/publishinportfolio/'.$image->id, $image->portfolio==0?"<span class='glyphicon glyphicon-eye-open'></span>":"<span class='glyphicon glyphicon-eye-close'></span>")?>
            </div>               
        </div>              
        <div class="clearfix visible-xs"></div>
      <?php } ?>
    </div>          
  </div>