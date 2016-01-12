<?php defined('SYSPATH') or die('No direct script access.'); ?> 


<div id="edit">
    <form method="post" action="" enctype="multipart/form-data">      
        <?=View::factory()->showErrors($data['errors'])?>  

        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2">
                <span class='label label-warning star'>*</span><?=__('Image')?>
            </label>        
            <div class="col-sm-10 col-md-10 col-lg-10">         
                <?php echo Form::file('image', array("class"=>"form-control", "placeholder"=>__('Choose image'))) ?>
            </div>
        </div>        
        
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2">
                <?=__('Background color')?>
            </label>        
            <div class="col-sm-10 col-md-10 col-lg-10">         
                <?php echo Form::input('background_color', Arr::get($data['values'], "background_color"), array("class"=>"form-control color-picker", "placeholder"=>__('Pick a color for background of the image.'))) ?>            
            </div>
        </div>                
                            
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2">
                <a href="#" data-placement="right" class="tooltip-elem" title="<?=__('This description is visible to the client/s.')?>"><span class="label label-info">?</span></a><?=__('Description')?>
            </label>        
            <div class="col-sm-10 col-md-10 col-lg-10">         
                <?php echo Form::textarea('description', Arr::get($data['values'], "description"), array("class"=>"form-control", "rows"=>"3")) ?>      
            </div>
        </div>                

        <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Save')?></button>
    </form>          
</div>

