
<div class="navbar navbar-inverse navbar-static-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>        
      <?=HTML::anchor('/share/'.Request::current()->param('hash').'/project/detail/', $project->name." <span class='badge'>".$project->images->find_all()->count()."</span>", array("class"=>"navbar-brand"))?>        
    </div>   
  </div>
</div>   