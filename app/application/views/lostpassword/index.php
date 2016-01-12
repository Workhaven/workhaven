<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="container">
<h2><?=__('Lost password?')?></h2>
<?=View::factory()->showErrors($data['errors'])?>
<p><?=__('Fill in your account e-mail and we will send you new password to the e-mail box.')?></p>
<form action="" method="POST">    
    <div class="input-group">        
        <span class="input-group-addon"><?=__('Your account e-mail:')?></span>                
        <?php echo Form::input('email', Arr::get($data['values'], "email"), array("required", "autofocus", "class"=>"form-control", "placeholder"=>__('E-mail'))) ?>                                                         
    </div>
    <br />   
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Send')?></button>
</form>
</div>

