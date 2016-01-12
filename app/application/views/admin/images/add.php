<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<div class="container" id="add_image">     
    <form method="post" action="/admin/images/add/" enctype="multipart/form-data">        
        <?=View::factory()->showErrors(Arr::get($data, "errors", array()))?>  

        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2">
                <span class='label label-warning star'>*</span><?=__('Image/s')?>
            </label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?php echo Form::file('files[]', array("class"=>"form-control", "multiple"=>"multiple", "required"=>"required")) ?>
            </div>
        </div>                                      
                
        <?php if(!Arr::get($data['values'], "project_id", NULL)){ ?>
            <div class="form-item">
                <label class="col-sm-2 col-md-2 col-lg-2">
                    <span class='label label-warning star'>*</span><?=__('Project')?>
                </label>
                <div class="col-sm-10 col-md-10 col-lg-10">
                    <?=Form::select('project_id', $data['projects'], Arr::get($data['values'], "project_id"), array("required"=>"required", "class"=>"form-control"))?>   
                </div>
            </div>
        <?php } else { ?>
            <?=Form::hidden('project_id', Arr::get($data['values'], "project_id")) ?>
        <?php } ?>          

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
                <?=__('Description')?>
            </label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?php echo Form::textarea('description', Arr::get($data['values'], "description"), array("class"=>"form-control", "rows"=>"3", "placeholder"=>__('Description'))) ?>      
            </div>
        </div>          

        <div class="progress progress-striped active" style="display: none">
          <div class="progress-bar"  role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">            
          </div>
        </div>     
        <br class="clearfix" />
        <button class="btn btn-lg btn-primary btn-block show-progressbar" type="submit"><?=__('Add')?></button>
    </form>
</div>