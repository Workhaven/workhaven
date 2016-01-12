<?php defined('SYSPATH') or die('No direct script access.'); ?>
 
  <div class="container">         
      <?php if(Arr::get($data['values'], "description")){ ?>
        <div class="well well-lg"><?=nl2br(Arr::get($data['values'], "description"))?></div>
      <?php } ?>      
      <div class="galery">
        <?php foreach($data['images'] as $key => $image){ ?>       
          <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3 images">              
              <?=HTML::anchor('/share/'.$data["hash"].'/images/detail/'.$image->id, '<img src="/imagefly/w760/images/projects/'.Arr::get($data["values"], "id").'/'.$image->filename.'" class="thumbnail" alt="<?=$image->description?>" />')?>
          </div>      
          <div class="clearfix visible-xs"></div>
        <?php } ?>
      </div>          
  </div>