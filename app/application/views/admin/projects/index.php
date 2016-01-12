<div class="container">
    <table class="table table-striped">    
        <tr>
            <th><?=__('Name')?></th>
            <th><?=__('Client')?></th>
            <th><?=__('Images')?></th>
            <?php if(Auth::instance()->logged_in("admin")){ ?>
            <th><?=__('Owner')?></th>
            <?php } else { ?>
            <th><?=__('Description')?></th>
            <?php } ?>        
            <th><?=__('Deadline')?></th>
            <th colspan="2"><?=HTML::anchor('#add_project', "<span class='glyphicon glyphicon-plus' style='color: #74D5D6'></span> ".__("Add new project"), array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Add new project"), "data-target"=>"#add_project-modal"))?></th>
        </tr>
        <?php foreach($data['projects'] as $key => $project){ ?>
            <tr><td><?=HTML::anchor('/admin/projects/detail/'.$project->id, $project->name)?></td>
                <td><?=HTML::anchor('/admin/projects/detail/'.$project->id, $project->client->name." ".$project->client->surname)?></td> 
                <td><?=HTML::anchor('/admin/projects/detail/'.$project->id, $project->images->find_all()->count())?></td>
                <?php if(Auth::instance()->logged_in("admin")){ ?>
                <td><?=HTML::anchor('/admin/projects/detail/'.$project->id, $project->owner->email)?></td>
                <?php } else { ?>                
                <td><?=HTML::anchor('/admin/projects/detail/'.$project->id, Text::limit_chars($project->description, 60))?></td>
                <?php } ?>
                <td><?=HTML::anchor('/admin/projects/detail/'.$project->id, $project->deadline)?></td>                     
                <td><?=HTML::anchor('/admin/projects/detail/'.$project->id, '<span class="glyphicon glyphicon-zoom-in"></span>')?></td>
                <td><?=HTML::anchor('/admin/projects/delete/'.$project->id, '<span class="glyphicon glyphicon-remove"></span>', array( "class"=>"confirm-modal-dialog", "data-message"=>__('Do you really want to delete this?') ) )?></td>
            </tr>  
        <?php } ?>                 
    </table>

    <?php
        echo $data['pagination'];
    ?>
</div>