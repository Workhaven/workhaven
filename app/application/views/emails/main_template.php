<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div style="padding: 10px; max-width: 600px">
    <h1 style="color: #68c4c5"><?=$company_name?></h1>
    <div>
        <?=$content?>
    </div>    
    <br />
    <hr />
    <div>
        <?=HTML::anchor(URL::site(NULL, TRUE), str_replace("/","", str_replace("http://","",URL::site(NULL, TRUE))), array("style" => "color: #68c4c5") )?>
        <br />
        <?=$copyright?>
    </div>
    <br />
    <br />
</div>



