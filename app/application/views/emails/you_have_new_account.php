<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h2><?=__('You have new account')?></h2>
<p>
    <?=__('New account for this e-mail was created. You can login with:')?>
</p>
<br />
<p>
    <b><?=__('Login')?>:</b> <?=$email?><br />
    <b><?=__('Password')?>:</b> <?=$password?>
<p/>
<br />
<p>
    <?=__('You can login at')?>: <?=HTML::anchor(URL::site(NULL, TRUE).'admin/', URL::site(NULL, TRUE).'admin/', array("style" => "color: #68c4c5"))?>
</p>


