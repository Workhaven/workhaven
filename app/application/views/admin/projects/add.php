<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<div class="container" id="add_project">     
    <form method="post" action="/admin/projects/add/">      
        <?=View::factory()->showErrors(Arr::get($data, "errors", array()))?>

        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><span class='label label-warning star'>*</span><?=__('Name')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
              <?php echo Form::input('name', Arr::get($data['values'], "name"), array("class"=>"form-control", "placeholder"=>__('Name'), "required" => "required", ""=>"autofocus")) ?>
            </div>
        </div>

        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Client')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?=Form::select('client_id', $data['clients'], Arr::get($data['values'], "client_id"), array("class"=>"form-control"))?>   
            </div>
        </div>

        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Description')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <?php echo Form::textarea('description', Arr::get($data['values'], "description"), array("class"=>"form-control", "rows"=>"3", "placeholder"=>__('Description'))) ?>      
            </div>
        </div>            
            
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Deadline')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <div class="deadline input-group date">       
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>          
                  <?php echo Form::input('deadline', Arr::get($data['values'], "deadline"), array("class"=>"form-control", "data-format"=>"dd/MM/yyyy hh:mm:ss", "placeholder"=>__('Deadline'))) ?>
                </div>      
            </div>
        </div>
        <br class="clearfix" />
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Create')?></button>
    </form>
</div>