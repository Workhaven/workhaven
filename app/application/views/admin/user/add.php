<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<div class="container" id="add_user">     
    <form method="post" action="/admin/user/add">
        <?=View::factory()->showErrors(Arr::get($data, "errors", array()))?>  
      
        <div class="form-item">
            <label class="col-sm-3 col-md-3 col-lg-3"><span class='label label-warning star'>*</span><?=__('E-mail address')?></label>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <input type="text" name="email" class="form-control" value="<?=isset($data['post'])?$data['post']['email']:""?>" placeholder="<?=__('E-mail address')?>" required autofocus>
            </div>
        </div>    
        
        <div class="form-item">
            <label class="col-sm-3 col-md-3 col-lg-3"><span class='label label-warning star'>*</span><?=__('User role')?></label>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <?=Form::select('role', $data['roles'], isset($data['post'])?$data['post']['role']:"", array("class"=>"form-control"))?>       
            </div>
        </div>        
    
        <br />
        
        <div class="form-item">
            <label class="col-sm-3 col-md-3 col-lg-3">
                <a href="#" data-placement="right" class="tooltip-elem" title="<?=__('If you do not set password, application will set it automatically.')?>">
                   <span class="label label-info">?</span>
                </a>
                <?=__('Password')?>
            </label>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <input type="password" name="password" class="form-control" value="<?=isset($data['post'])?$data['post']['password']:""?>" placeholder="<?=__('Password')?>">                                 
            </div>
        </div>        

        <div class="form-item">
            <label class="col-sm-3 col-md-3 col-lg-3">
                <?=__('Confirm password')?>
            </label>
            <div class="col-sm-9 col-md-9 col-lg-9">
                <input type="password" name="password_confirm" class="form-control" value="<?=isset($data['post'])?$data['post']['password_confirm']:""?>" placeholder="<?=__('Password')?>">       
            </div>
        </div>           
        <br class="clearfix" />
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Create')?></button>
    </form>
</div>