<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="container">
    <form class="form" method="post" action="<?=URL::site('admin/user/personalsettings/savesettings')?>">
      <h2><?=__("Personal settings")?></h2>        
      <?=View::factory()->showErrors($data['errors'])?>  
      
      <span class="label label-default"><?=__('Prefered language')?></span>
      <?=Form::select('language', $data['languages'], $data['user']->language, array("class"=>"form-control", "" => "autofocus"))?>
      <span class='label label-default'><?=__('E-mail address')?></span>
      <input type="text" name="email" class="form-control" placeholder="<?=__('Your e-mail address')?>" value="<?=$data['user']->email?>" />
      <span class='label label-default'><?=__('Account password')?></span>
      <input type="password" name="password" class="form-control" placeholder="<?=__('Account password')?>" required>
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Save')?></button>
    </form>

    <form class="form" method="post" action="<?=URL::site('admin/user/personalsettings/changepassword')?>">
      <h3><?=__("Change password")?></h3>
      <span class='label label-default'><?=__('Old password')?></span>
      <input type="password" name="password" class="form-control" placeholder="<?=__('Old password')?>" required>
      <span class='label label-default'><?=__('New password')?></span>
      <input type="password" name="new_password" class="form-control" placeholder="<?=__('New password')?>" required>      
      <span class='label label-default'><?=__('Confirm new password')?></span>
      <input type="password" name="password_confirm" class="form-control" placeholder="<?=__('Confirm new password')?>" required>
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Change password')?></button>
    </form>
    <br />
</div>    