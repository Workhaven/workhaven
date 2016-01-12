<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<div id="share">
    <form method="post" action="/admin/projects/share/<?=$data["project"]->id?>"> 
        <?=__('Link for sharing')?>
          <div class="input-group">
            <?php echo Form::input('url', $data["share_url"], array("class"=>"form-control", "placeholder"=>__('Name'), "readonly"=>"readonly")) ?>
            <span class="input-group-addon"><?=HTML::anchor($data["share_url"], "<span class='glyphicon glyphicon-new-window'></span>", array('target' => '_blank') )?></span>
          </div>                
        <br />
        
        <h4><?=__("Visibility settings")?></h4>                                        
        <div class="radio">
          <label>
            <span class="glyphicon glyphicon-lock"></span> <?php echo Form::radio('visibility', '1', $data["project"]->visibility_id==1?true:false, array("class"=>"visibility")) ?>          
            <?=__("Private. Visible only for me, administrators or team colleagues.")?>
          </label>
        </div>
        
        <div class="radio">
          <label>
            <span class="glyphicon glyphicon-globe"></span><?php echo Form::radio('visibility', '2', $data["project"]->visibility_id==2?true:false, array("class"=>"visibility")) ?>
             <?=__("Public. Public access with the link. No login.")?>
          </label>
        </div>
        
        <div class="permissions" id="public_permissions_box" <?=$data["project"]->visibility_id==2?"":"style='display:none'"?>>
              <?php echo View::factory('admin/projects/share_permissions')->set('type', 2)->set('permissions', $data['permissions'])->set('selected', $data["selected_permissions"]) ?>                           
        </div>                        

        <div class="radio">
          <label>
            <span class="glyphicon glyphicon-exclamation-sign"></span> <?php echo Form::radio('visibility', '3', $data["project"]->visibility_id==3?true:false, array("class"=>"visibility")) ?>
            <?=__("Secure. The link is secured with password. Project is visible after login with this password.")?>
          </label>
        </div>
        <div class="permissions" id="secure_permissions_box" <?=$data["project"]->visibility_id==3?"":"style='display:none'"?>>
            <span class='label label-warning star'>*</span><span class='label label-default'><?=__('Password')?></span> 
            <?php echo Form::input('password', $data["project"]->share_password, array($data["project"]->visibility_id==3?"required":"", "class"=>"form-control", "id"=>"password", "style"=>"margin-bottom:10px", "placeholder"=>__('Password'))) ?>
            <?php echo View::factory('admin/projects/share_permissions')->set('type', 3)->set('permissions', $data['permissions'])->set('selected', $data["selected_permissions"]) ?> 
        </div> 
        <hr />
        <h4><?=__("Portfolio")?></h4>        
        <div class="checkbox">
          <label>
            <span class="glyphicon glyphicon-eye-open"></span> <?php echo Form::checkbox('portfolio', 1, $data["project"]->portfolio) ?>          
            <?=__("Portfolio. With this option you can publish the project in your portfolio.")?>
          </label>
        </div>
        <hr />
        <h4><?=__("Team work")?></h4>
        <div class="checkbox">
          <label>
              <span class="glyphicon glyphicon-user"></span> <?php echo Form::checkbox('team', 'team', empty($data['selected_users'])?false:true, array("id"=>"team_sharing")) ?>          
            <?=__("Team work. Project is visible for selected colleagues. After login.")?>
          </label>
        </div>
        <div <?=empty($data['selected_users'])?"style='display:none'":""?> id="team">  
            <table style="width: 100%"> 
                <tr>
                    <td>
                        <button type="button" style="margin-bottom: 10px" class="btn btn-default" id="select_all"><?=__("Select all")?></button>
                        <button type="button" style="margin-bottom: 10px; display: none" class="btn btn-default" id="deselect_all"><?=__("Deselect all")?></button>
                    </td>
                    <td style="width: 100%">                        
                        <?=Form::select('user_id[]', $data['users'], $data['selected_users'], array(""=>"multiple", "data-selected-text-format"=>"count > 2", "data-width"=>"100%", "class"=>"selectpicker"))?>
                    </td>
                </tr>
            </table>                        
        </div>  
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Save')?></button>
    </form>      
</div> 