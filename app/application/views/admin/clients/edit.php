<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
     
<form method="post" action="">     
    <div class="form-item">
        <label class="col-sm-2 col-md-2 col-lg-2">
            <span class="label label-warning star">*</span><?=__('Name')?>
        </label>        
        <div class="col-sm-10 col-md-10 col-lg-10">         
            <?php echo Form::input('name', $client->name, array("class"=>"form-control", "placeholder"=>__('Name'), "required"=>"required", ""=>"autofocus")) ?>
        </div>
    </div>
    <div class="form-item">
        <label class="col-sm-2 col-md-2 col-lg-2">
            <?=__('Surname')?>
        </label>        
        <div class="col-sm-10 col-md-10 col-lg-10"> 
            <?php echo Form::input('surname', $client->surname, array("class"=>"form-control", "placeholder"=>__('Surname'))) ?>
        </div>
    </div>         
    <div class="form-item">
        <label class="col-sm-2 col-md-2 col-lg-2">
            <?=__('E-mail')?>
        </label>        
        <div class="col-sm-10 col-md-10 col-lg-10">         
            <?php echo Form::input('email', $client->email, array("class"=>"form-control", "placeholder"=>__('E-mail'))) ?>
        </div>            
    </div>     
    <div class="form-item">
        <label class="col-sm-2 col-md-2 col-lg-2">
            <?=__('Description')?>
        </label>        
        <div class="col-sm-10 col-md-10 col-lg-10">         
            <?php echo Form::textarea('description', $client->description, array("class"=>"form-control", "rows"=>"3", "placeholder"=>__('Description'))) ?>      
        </div>            
    </div>          
                
    <div class="btn-group btn-group-justified">
        <button class="btn btn-lg btn-primary" style="width:50%; float: left" type="submit"><?=__('Save')?></button>                      
        <button class="btn btn-lg btn-warning edit" style="width:50%; float: left" type="button"><?=__('Cancel')?></button>
    </div>    
</form>
 