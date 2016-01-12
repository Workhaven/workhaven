<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<style>
    body {background: #89DD2C;padding-top: 40px;padding-bottom: 40px;}        
    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
    }
    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }
    .form-signin .checkbox {
      font-weight: normal;
    }
    .form-signin .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
      -webkit-box-sizing: border-box;
         -moz-box-sizing: border-box;
              box-sizing: border-box;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="text"] {
      margin-bottom: -1px;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }    
</style>
<div class="container">    
  <form class="form-signin" method="post" action="">
    <h2><?=__("Please sign in")?></h2>
    <?=View::factory()->showErrors($errors)?>
    <input type="text" name="email" class="form-control" placeholder="<?=__('E-mail address')?>" required autofocus>
    <input type="password" name="password" class="form-control" placeholder="<?=__('Password')?>" required>
    <label class="checkbox">
      <input type="checkbox" value="remember-me"><?=__('Remember me')?>
    </label>      
    <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Sign in')?></button>
    <br />
    <?=HTML::anchor('/lostpassword/', __('Lost password?'), array("style" => "color: black;text-decoration: underline;"))?>
  </form>
</div>