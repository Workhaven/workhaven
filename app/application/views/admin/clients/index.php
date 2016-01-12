<div class="container">
    <table class="table table-striped">    
        <tr>
            <th><?=__('Name')?></th>
            <th><?=__('Surname')?></th>            
            <th><?=__('E-mail')?></th>
            <th><?=__('Projects')?></th>
            <th><?=__('Description')?></th>
            <th><?=__('Created')?></th>
            <th colspan="2"><?=HTML::anchor('#add_client', "<span class='glyphicon glyphicon-plus' style='color: #74D5D6'></span> ".__("Add new client"), array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Add new client"), "data-target"=>"#add_client-modal"))?></th>
        </tr>
        <?php foreach($data['clients'] as $key => $client){ ?>
            <tr><td><?=HTML::anchor('/admin/clients/detail/'.$client->id, $client->name)?></td>
                <td><?=HTML::anchor('/admin/clients/detail/'.$client->id, $client->surname)?></td>
                <td><?=HTML::anchor('/admin/clients/detail/'.$client->id, $client->email)?></td>
                <td><?=HTML::anchor('/admin/clients/detail/'.$client->id, $client->projects->find_all()->count())?></td>
                <td><?=HTML::anchor('/admin/clients/detail/'.$client->id, Text::limit_chars($client->description, 60))?></td>
                <td><?=HTML::anchor('/admin/clients/detail/'.$client->id, Date::process($client->created, FALSE))?></td>                                     
                <td><?=HTML::anchor('/admin/clients/detail/'.$client->id, '<span class="glyphicon glyphicon-zoom-in"></span>')?></td>
                <td><?=HTML::anchor('/admin/clients/delete/'.$client->id, '<span class="glyphicon glyphicon-remove"></span>', array( "class"=>"confirm-modal-dialog", "data-message"=>__('Do you really want to delete this?') ) )?></td>
            </tr>  
        <?php } ?>                 
    </table>
    <?php
        echo $data['pagination'];
    ?>
</div>

