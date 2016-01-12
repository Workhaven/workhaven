<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="well well-sm">
    <p>
        <b><?=__("Permissions settings.")?> </b>
        <?=__("Without any selected permission visitors can only watch your project name, description and its images.")?>
    </p>
    <div class="checkbox">
        <label>
          <?php echo Form::checkbox('blind_permissions', 'all', false, array("id" => "select_all_permissions")) ?>
          <?=__("All.")?>
        </label>
    </div>
    <?php foreach($permissions as $id => $name){ ?>
        <div class="checkbox option">
            <label>
              <?php echo Form::checkbox($type.'_permissions[]', $id, in_array($name, $selected)) ?>
              <?=__($name)?>
            </label>
        </div>
    <?php } ?>
</div>      