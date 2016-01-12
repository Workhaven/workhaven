<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<div class="container" id="add_client">     
    <form method="post" action="/admin/clients/add">      
        <?=View::factory()->showErrors(Arr::get($data, "errors", array()))?>

        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2">
                <span class='label label-warning star'>*</span><?=__('Name')?>
            </label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?php echo Form::input('name', Arr::get($data['values'], "name"), array("class"=>"form-control", "placeholder"=>__('Name'), "required", "autofocus")) ?>
            </div>
        </div>        
            
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2">
                <?=__('Surname')?>
            </label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?php echo Form::input('surname', Arr::get($data['values'], "surname"), array("class"=>"form-control", "placeholder"=>__('Surname'))) ?>    
            </div>
        </div>                

        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2">
                <?=__('E-mail')?>
            </label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?php echo Form::input('email', Arr::get($data['values'], "email"), array("class"=>"form-control", "placeholder"=>__('E-mail'))) ?>        
            </div>
        </div>        

        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2">
                <?=__('Description')?>
            </label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?php echo Form::textarea('description', Arr::get($data['values'], "description"), array("class"=>"form-control", "rows"=>"3", "placeholder"=>__('Description'))) ?>      
            </div>
        </div>        

        <br class="clearfix" />
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Create')?></button>
    </form>
</div>