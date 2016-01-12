<?php defined('SYSPATH') or die('No direct script access.'); ?>
<?php
    function print_discussion($comments, $image_id, $nested = false){
        foreach($comments as $key => $comment){ ?>
            <?php if(!$nested){?>
            <li class="media">                
            <?php } else {?>
            <div class="media">
            <?php } ?>
                <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                    <!-- Place for an image.  -->
                </div>
                <div class="media-body col-xs-12 col-sm-10 col-md-11 col-lg-11" id="comment<?=$comment->id?>">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4 class="media-heading"><?=$comment->user->email.$comment->author_visitor." • <span class='datetime'>".  Date::process($comment->created) . "</span>"?></h4>
                            <p><?=nl2br($comment->text)?></p>                            
                            <?=HTML::anchor('#', __("Reply"), array("class" => "reply") )?>
                        </div>
                    </div>
                    <div class="media reply">                        
                        <form method="post" action="<?= URL::site('/share/'.Request::current()->param('hash').'/images/addcomment/'.$image_id.'?replyfor='.$comment->id)?>">                        
                            <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                                <!-- Place for an image.  -->
                            </div>
                            <div class="media-body col-xs-12 col-sm-10 col-md-11 col-lg-11">                    
                                <?php echo Form::input('author_visitor', '', array("required", "class"=>"form-control", "placeholder"=>__('Your e-mail address'))) ?>            
                                <?php echo Form::textarea('text', "", array("required", "class"=>"form-control", "rows"=>"2", "placeholder"=>__('Your comment'))) ?>      
                              <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Post')?></button>
                            </div>                        
                        </form>
                    </div>                    
                    <?php print_discussion($comment->replies->order_by("created", 'desc')->find_all(), $image_id, true); ?>
                </div>            
            <?php if(!$nested){?>
            </li>            
            <?php } else {?>
            </div>
            <?php } ?>            
      <?php      
        }
    }    
?>

<div class="container">
    <div id="leftMenu">
        <ul class="nav">
            <li><a href="javascript:void(0);" class="reload-notes" title="<?=__('Number of notes')?>"><span id="notes-count" class="badge"></span></a></li>            
            <li><a href="javascript:void(0);" class="add-note cancel-note" title="<?=__('Add new note')?>"><span class="glyphicon glyphicon-pushpin"></span></a></li>                    
            <li><a href="javascript:void(0);" class="hide-notes" title="<?=__('Show/hide notes')?>"><span class="glyphicon glyphicon-off"></span></a></li>
            <li><a href="javascript:void(0);" class="reload-notes" title="<?=__('Reload notes')?>"><span class="glyphicon glyphicon-refresh"></span></a></li>
            <li class="divider"></li>
            <li><?=HTML::anchor('#edit', "<span class='glyphicon glyphicon-pencil'></span>", array("class"=>"inline-modal", "data-toggle"=>"modal", "title" => __("Edit image settings"), "data-target"=>"#edit_image"))?></li>                                              
            <li><?=HTML::anchor('/admin/images/publishinportfolio/'.Arr::get($data["values"], "id")."?back_url=images", Arr::get($data["values"], "portfolio")==0?"<span class='glyphicon glyphicon-eye-open'></span>":"<span class='glyphicon glyphicon-eye-close'></span>", array("title" => (Arr::get($data["values"], "portfolio")==0?__('Send to portfolio'):__('Exclude from portfolio')) ))?></li>
            <li class="divider"></li>
            <li><?=HTML::anchor('/admin/images/delete/'.Arr::get($data["values"], "id"), "<span class='glyphicon glyphicon-trash'></span>", array("class"=>"confirm-modal-dialog", "title" => __("Delete image"), "data-message"=>__('Do you really want to delete this?') ) )?></li>              
        </ul>
    </div>             
    
    <div class="center-block image-detail">
        <img src="/images/projects/<?=Arr::get($data["values"], "project_id")?>/<?=Arr::get($data["values"], "filename")?>" alt="<?=Arr::get($data["values"], "description")?>" id='<?=Arr::get($data["values"], "id")?>' <?=$notes_allowed?'class="note"':''?> />
    </div>
    <?php if($data["values"]["description"]){ ?>
    <div class="well well-lg"><?=nl2br(Arr::get($data["values"], "description"))?></div>
    <?php } ?>   
    <br />
    <br />    
</div>

<?php if($comments_allowed) { ?>
    <div id="discussion">
        <div class="container">
            <div class="header">
                <span class="badge"><?=__("Number of comments:")?> <?=$data['discussion']->comments->find_all()->count()?></span>                            
                <?=HTML::anchor('/share/'.Request::current()->param('hash').'/images/detail/'.Arr::get($data["values"], "id").'?refresh='.time().'#discussion', '<span class="glyphicon glyphicon-refresh pull-right"></span>')?>
            </div>
            <ul class="media-list">
                <li class="media">                    
                    <form method="post" action="<?= URL::site('/share/'.Request::current()->param('hash').'/images/addcomment/'.Arr::get($data["values"], "id"))?>">                    
                        <div class="col-xs-12 col-sm-2 col-md-1 col-lg-1">
                                <!-- Place for an image.  -->
                        </div>
                        <div class="media-body col-xs-12 col-sm-10 col-md-11 col-lg-11">
                          <?php echo Form::input('author_visitor', '', array("required", "class"=>"form-control", "placeholder"=>__('Your e-mail address'))) ?>            
                          <?php echo Form::textarea('text', "", array("required", "class"=>"form-control", "rows"=>"2", "placeholder"=>__('Your comment'))) ?>
                          <button class="btn btn-lg btn-primary btn-block" type="submit"><?=__('Post')?></button>
                        </div>
                    </form>
                </li>
                <?php
                    print_discussion($data['discussion']->comments->where("reply_comment_id", "=", NULL)->order_by("created", 'desc')->find_all(), Arr::get($data["values"], "id"), false);
                ?>
            </ul>
        </div>
    </div>
<?php } ?>