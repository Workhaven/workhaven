<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
      
<form method="post" action="">          
    
    <div class="form-item">
        <label class="col-sm-2 col-md-2 col-lg-2">
            <?=__('Name')?>
        </label>
        <div class="col-sm-10 col-md-10 col-lg-10">                
            <?php echo Form::input('name', $data['project']->name, array("class"=>"form-control", "placeholder"=>__('Name'), "required"=>"required", ""=>"autofocus")) ?>
        </div>
    </div>                                     
    
    <div class="form-item">
        <label class="col-sm-2 col-md-2 col-lg-2">
            <?=__('Client')?>
        </label>
        <div class="col-sm-10 col-md-10 col-lg-10">                
            <?=Form::select('client_id', $data['clients'], $data['project']->client_id, array("class"=>"form-control"))?>   
        </div>
    </div>             
    
    <div class="form-item">
        <label class="col-sm-2 col-md-2 col-lg-2">
            <?=__('Description')?>
        </label>
        <div class="col-sm-10 col-md-10 col-lg-10">                
            <?php echo Form::textarea('description', $data['project']->description, array("class"=>"form-control", "rows"=>"4", "placeholder"=>__('Description'))) ?>      
        </div>
    </div>      
    
        <div class="form-item">
            <label class="col-sm-2 col-md-2 col-lg-2"><?=__('Deadline')?></label>
            <div class="col-sm-10 col-md-10 col-lg-10">
                <div class="deadline input-group date">       
                  <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                  </span>          
                  <?php echo Form::input('deadline', $data['project']->deadline, array("class"=>"form-control", "data-format"=>"dd/MM/yyyy hh:mm:ss", "placeholder"=>__('Deadline'))) ?>
                </div>      
            </div>
        </div>      
    
    <div class="btn-group btn-group-justified">
        <button class="btn btn-lg btn-primary" style="width:50%; float: left" type="submit"><?=__('Save')?></button>              
        <button class="btn btn-lg btn-warning edit" style="width:50%; float: left" type="button"><?=__('Cancel')?></button>
    </div>                    
</form>