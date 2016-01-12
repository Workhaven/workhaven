<?php defined('SYSPATH') or die('No direct script access.'); ?>
<style>body {background: #52A19D;} table{color: white} table tr:nth-child(odd){background:none} input.button, #menu a {color: #52A19D}</style>
<h1><?=___('Configure database')?></h1>
<?php      
    echo showErrors($errors);    
?>
<p><?=___('Configure your database by filling out the following fields.')?></p> 
<form method="post" action="">
  <table>
    <tr>
      <th><?=___('Database server host')?></th>
      <td><input type="text" name="host" value="<?php if(!empty($_POST['host'])) echo $_POST['host'];?>" required autofocus /></td>
    </tr>
    <tr>
      <th><?=___('Database name')?></th>
      <td><input type="text" name="database" value="<?php if(!empty($_POST['database'])) echo $_POST['database'];?>" required /></td>
    </tr>
    <tr>
      <th><?=___('Database login')?></th>
      <td><input type="text" name="login" value="<?php if(!empty($_POST['login'])) echo $_POST['login'];?>" required /></td>
    </tr>
    <tr>
      <th><?=___('Database password')?></th>
      <td><input type="password" name="password" value="<?php if(!empty($_POST['password'])) echo $_POST['password'];?>" required /></td>
    </tr>
    <tr>
      <th><?=___('Tables prefix')?></th>
      <td><input type="text" name="table_prefix" value="<?=!empty($_POST['table_prefix']) ? $_POST['table_prefix'] : "wh_" ?>"  /></td>
    </tr>    
    <tr>
      <td colspan="2">
        <div id="menu">
          <a href="?step=environment-tests"><?=___('Back')?></a>
          <input type="submit" value="<?=___('Continue')?>" class="button" />          
        </div>
      </td>
    </tr>
  </table>  
</form>
  