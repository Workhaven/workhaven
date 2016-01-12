<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<div class="detail">
    <div class="container">         
        <h2 style="display: inline">
            <?=HTML::anchor('#', "<span class='glyphicon glyphicon-pencil'></span>", array("class" => "edit", "title" => __('Edit client')))?>
            <?=" ".$client->name." ".$client->surname?> <span class="badge"><?=$client->projects->find_all()->count()?></span>
        </h2>                    
        <?=HTML::anchor('/admin/clients/delete/'.$client->id, __("Delete"), array("style" => "padding: 0 30px 0 30px", "class"=>"confirm-modal-dialog", "data-message"=>__('Do you really want to delete this?') ) )?>        
        <?=View::factory()->showErrors($data['errors'])?>  
        <div id="info-container">
            <div id="info">
                <table>
                    <tr><td width="100"><label><?=__('E-mail')?>:</label></td><td><?=$client->email?></td></tr>                
                    <tr><td width="100"><label><?=__('Created')?>:</label></td><td><?=Date::process($client->created, FALSE)?></td></tr>
                    <tr><td colspan="2"><?=nl2br($client->description)?></td></tr>               
                </table>
            </div>        
            <?=HTML::anchor('#', "<span class='glyphicon glyphicon-circle-arrow-up pull-right'></span>", array("class" => "show-hide-info", "title" => __('Hide informations')))?> 
            <?=HTML::anchor('#', "<span class='glyphicon glyphicon-circle-arrow-down pull-right'></span>", array("class" => "show-hide-info", "title" => __('Show informations'),  "style" => "display: none"))?>          
        </div>      
        <div style="display:none" id="edit">
            <?php include Kohana::find_file('views', 'admin/clients/edit') ?>
        </div> 
    </div>
</div>   
<div class="container">
    <h3><?=__("Client's projects")?>:</h3>
    <div id="projects" style="clear: both; padding-top: 20px">
        <?php foreach($client->projects->order_by("id", "desc")->find_all() as $project){ ?>
                <div class="project col-xs-6 col-sm-4 col-md-3 col-lg-3">
                    <?php include Kohana::find_file('views', 'admin/projects/project_card') ?>
                </div>                    
                <div class="clearfix visible-xs"></div>
        <?php }?>
    </div> 
</div>
