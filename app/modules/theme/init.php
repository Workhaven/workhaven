<?php defined('SYSPATH') or die('No direct script access.');

// Create an instance of the Theme library
$theme = Theme::factory(ORM::factory('Systemsetting')->where('name', '=', 'template')->find()->value); 

// Load any themes
$theme->load();
