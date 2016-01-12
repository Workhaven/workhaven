<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="container">
    <form class="form" method="post" enctype="multipart/form-data" action="<?=URL::site('admin/system/settings/save')?>">
        <h2><?=__("System settings")?></h2>
        <?=View::factory()->showErrors($data['errors'])?>     
        
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Your site name')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">                
                <?=Form::input('name', Arr::get($values, "name"), array("class" => "form-control", "placeholder"=> __('Your site name'), "" =>"autofocus"))?>      
            </div>
        </div>         
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Your site email')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?=Form::input('email', Arr::get($values, "email"), array("class" => "form-control", "placeholder"=> __('Your site email')))?>  
            </div>
        </div>             
        
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Your site language')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?=Form::select('language', $languages, Arr::get($values, "language"), array("class"=>"form-control", "placeholder"=> __('Your site language')))?>        
            </div>
        </div> 
        
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Your logo')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?php if(Arr::get($values, "logo_ext")){ ?>
                    <img src="/imagefly/h130/images/logo.<?=Arr::get($values, "logo_ext")?>" height="130" alt="" /><br />
                    <label><?php echo Form::checkbox('delete_logo')?> <?=__('Delete image')?></label>
                <?php } ?>
                <?php echo Form::file('logo', array("class"=>"form-control"))?>        
            </div>
        </div>        
        
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Your site title')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">        
                <?=Form::input('title', isset($values['title'])?$values['title']:NULL, array("class" => "form-control", "placeholder"=> __('Your site title')))?>
            </div>
        </div>             
        
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Your site description')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?=Form::textarea('description', isset($values['description'])?$values['description']:NULL, array("rows"=>"4", "class" => "form-control", "placeholder"=> __('Your site description'))) ?>                      
            </div>
        </div>             
               
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Your site keywords')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?=Form::input('keywords', isset($values['keywords'])?$values['keywords']:NULL, array("class" => "form-control", "placeholder"=> __('Your site keywords')))?>
            </div>
        </div>             
        
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Your site copyright')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?=Form::input('copyright', isset($values['copyright'])?$values['copyright']:NULL, array("class" => "form-control", "placeholder"=> __('Your site copyright')))?>            
            </div>
        </div> 
        
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Template')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?=Form::select('template', $templates, Arr::get($values, "template"), array("class" => "form-control", "placeholder"=> __('Template')))?>
            </div>
        </div>             
        
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Save')?></button>
    </form>
    <br />
</div>    