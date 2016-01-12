<div class="container">
    <table class="table table-striped">    
        <tr>
            <th><?=__('E-mail')?></th>
            <th><?=__('Role')?></th>
            <th><?=__('Logins count')?></th>
            <th><?=__('Last login')?></th>
            <th><?=HTML::anchor('#add_client', "<span class='glyphicon glyphicon-plus' style='color: #74D5D6'></span> ".__("Add new client"), array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Add new client"), "data-target"=>"#add_client-modal"))?></th>
        </tr>
        <?php 
        foreach($data['users'] as $key => $user){ 
            /* do not print users without role ( these are anonymous users with top secret mission ;-) )  */
            if(!$user->roles->find_all()->count()) {
                continue;
            }
            ?>
            <tr>
                <td><?=$user->email?></td> 
                <td><?=$user->roles_to_string()?></td>
                <td><?=$user->logins?></td>            
                <td><?=$user->logins>0?date(__('DateTimeFormat'),$user->last_login):""?></td>
                <td><?=HTML::anchor('/admin/user/delete/'.$user->id, '<span class="glyphicon glyphicon-remove"></span>', array( "class"=>"confirm-modal-dialog", "data-message"=>__('Do you really want to delete this?') ) )?></td>
            </tr>  
        <?php } ?>                 
    </table>

    <?php
        echo $data['pagination'];
    ?>
</div>