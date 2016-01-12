<style>body {background: #5A147A;} table{color: white} table tr:nth-child(odd){background:none} input.button, #menu a {color: #5A147A}</style>
<h1><?=___('Create admin profile')?></h1> 
<?php    
    echo showErrors($errors);    
?>
<p><?=___('Create your profile to manage your system.')?></p>
<form method="post" action="">  
  <table>
    <tr>
      <th><?=___('E-mail address')?></th>
      <td><input type="text" name="email" value="<? if(!empty($_POST['email'])) echo $_POST['email'];?>" required autofocus /></td>
    </tr>
    <tr>
      <th><?=___('Password')?></th>
      <td><input type="password" name="password" value="<? if(!empty($_POST['password'])) echo $_POST['password'];?>" required  /></td>
    </tr>
    <tr>
      <th><?=___('Confirm password')?></th>
      <td><input type="password" name="confirm_password" value="<? if(!empty($_POST['confirm_password'])) echo $_POST['confirm_password'];?>" required  /></td>
    </tr>        
    <tr>
      <td colspan="2">
        <div id="menu">
          <a href="?step=configure-database"><?=___('Back')?></a>
          <input type="submit" value="<?=___('Continue')?>" class="button" />
        </div>
      </td>
    </tr>
  </table>  
</form>
  