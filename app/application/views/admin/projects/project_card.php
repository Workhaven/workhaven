<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
<a href="/admin/projects/detail/<?=$project->id?>" style="display: block">        
    <div class="panel panel-default">                
        <div class="panel-body">     
            <?php 
                $images = $project->images->order_by("id", "desc")->limit(3)->find_all();
                if($images->count()==0){ ?>
                    <h5><?=__('No images')?></h5>
                <?php
                } else {
                    foreach($images as $image){ ?>
                         <img src="/imagefly/w300-h100-c/<?=$image->path()?>" alt="" />
                    <?php }
                } 
            ?>              
        </div>        
        <div class="panel-footer">
            <?=$project->name?> <span class="badge"><?=$project->images->find_all()->count()?></span>    
        </div>        
    </div>    
</a>