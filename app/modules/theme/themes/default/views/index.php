<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php if($logo_ext) { ?>
    <img src="/imagefly/h130/images/logo.<?=$logo_ext?>" height="130" align="left" alt="" />
<?php } ?>
<h1><?=$site_name?></h1>
<p>
    <?=$description?>
</p>
<div class="galery">
  <?php foreach($projects as $project){ ?>                       
      <?php foreach($project->images->order_by('id', 'desc')->where('portfolio', '=', 1)->find_all() as $image){ ?>                       
    <a href="/images/projects/<?=$image->project_id?>/<?=$image->filename?>" title="<?=$image->description?>" data-gallery>
        <img src="/imagefly/w760/images/projects/<?=$image->project_id?>/<?=$image->filename?>" height="150" class="thumbnail" alt="<?=$image->description?>" />        
    </a>
      <?php } ?>
  <?php } ?>
</div>