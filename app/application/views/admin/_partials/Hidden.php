<?php defined('SYSPATH') or die('No direct script access.'); ?>

<div style="display: none">           
    <?php echo View::factory('admin/images/add')->set("data", $add_image_data); ?>
    <?php echo View::factory('admin/projects/add')->set("data", $add_project_data); ?>
    <?php echo View::factory('admin/clients/add')->set("data", $add_client_data); ?>
    <?php echo View::factory('admin/user/add')->set("data", $add_user_data); ?>    
</div>