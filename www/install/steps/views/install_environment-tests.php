 	<h1><?=___('Environment Tests')?></h1>  
  
  	<?php $failed = FALSE ?>  
      
  			<?php if (version_compare(PHP_VERSION, '5.3.3', '>=')): ?>
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>

  			<?php if (is_dir(SYSPATH) AND is_file(SYSPATH.'classes/Kohana'.EXT)): ?>
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>
  		
  			<?php if (is_dir(APPPATH) AND is_file(APPPATH.'bootstrap'.EXT)): ?>  		
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>
  		
  			<?php if (is_dir(DOCROOT) AND is_dir(DOCROOT.'cache') AND is_writable(DOCROOT.'cache')): ?>
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>

  			<?php if (is_dir(DOCROOT) AND is_dir(DOCROOT.'images/projects') AND is_writable(DOCROOT.'images/projects')): ?>
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>      
        
  			<?php if (is_dir(APPPATH) AND is_dir(APPPATH.'cache') AND is_writable(APPPATH.'cache')): ?>
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>
  		
  			<?php if (is_dir(APPPATH) AND is_dir(APPPATH.'logs') AND is_writable(APPPATH.'logs')): ?>  		
  			<?php else: $failed = TRUE ?>  		
  			<?php endif ?>
  		
  			<?php if ( ! @preg_match('/^.$/u', 'ñ')): $failed = TRUE ?>  		
  			<?php elseif ( ! @preg_match('/^\pL$/u', 'ñ')): $failed = TRUE ?>
  			<?php else: ?>
  			<?php endif ?>
 
  			<?php if (function_exists('spl_autoload_register')): ?>
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>
  		
  			<?php if (class_exists('ReflectionClass')): ?>  		
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>
  		
  			<?php if (function_exists('filter_list')): ?>
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>
  		
  			<?php if (extension_loaded('iconv')): ?>  	
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>
  		
  		<?php if (extension_loaded('mbstring')): ?>  		
  			<?php if (ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING): $failed = TRUE ?>
  			<?php else: ?>
  			<?php endif ?>  		
  		<?php endif ?>
  		
  			<?php if ( ! function_exists('ctype_digit')): $failed = TRUE ?>  		
  			<?php else: ?>  		
  			<?php endif ?>
  		
  			<?php if (isset($_SERVER['REQUEST_URI']) OR isset($_SERVER['PHP_SELF']) OR isset($_SERVER['PATH_INFO'])): ?>  	
  			<?php else: $failed = TRUE ?>
  			<?php endif ?>
  		  
  	<?php if ($failed === TRUE): ?>
  		<p id="result" class="fail"><?=___('Your environment did not passed')?></p>
      <div id="menu">
        <a href="#" onclick="details(1); return false" id="show_details"><?=___('Show details')?></a><a href="#" onclick="details(0); return false"  id="hide_details"><?=___('Hide details')?></a>
      </div>
  	<?php else: ?>
  		<p id="result" class="pass"><?=___('Your environment passed')?></p>
      <div id="menu">
        <a href="/"><?=___('Back')?></a>
        <a href="#" onclick="details(1); return false" id="show_details"><?=___('Show details')?></a><a href="#" onclick="details(0); return false"  id="hide_details"><?=___('Hide details')?></a>
        <a href="?step=configure-database"><?=___('Continue')?></a>
      </div>          
  	<?php endif ?>
  
  	<table id="environment_tests" cellspacing="0">
      <tr>
        <td colspan="2">
        	<p>
          <?=___('Descriptions of tests')?>
        	</p>        
        </td>
      </tr>
  		<tr>
  			<th><?=___('PHP Version')?></th>
  			<?php if (version_compare(PHP_VERSION, '5.3.3', '>=')): ?>
  				<td class="pass"><?php echo PHP_VERSION ?></td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">Kohana requires PHP 5.3.3 or newer, this version is <?php echo PHP_VERSION ?>.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('System Directory')?></th>
  			<?php if (is_dir(SYSPATH) AND is_file(SYSPATH.'classes/Kohana'.EXT)): ?>
  				<td class="pass"><?php echo SYSPATH ?></td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">The configured <code>system</code> directory does not exist or does not contain required files.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('Application Directory')?></th>
  			<?php if (is_dir(APPPATH) AND is_file(APPPATH.'bootstrap'.EXT)): ?>
  				<td class="pass"><?php echo APPPATH ?></td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">The configured <code>application</code> directory does not exist or does not contain required files.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('Images Cache Directory')?></th>
  			<?php if (is_dir(DOCROOT) AND is_dir(DOCROOT.'cache') AND is_writable(DOCROOT.'cache')): ?>
  				<td class="pass"><?php echo DOCROOT.'cache/' ?></td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">The <code><?php echo DOCROOT.'cache/' ?></code> directory is not writable.</td>
  			<?php endif ?>
  		</tr>   
  		<tr>
  			<th><?=___('Images Directory')?></th>
  			<?php if (is_dir(DOCROOT) AND is_dir(DOCROOT.'images/projects') AND is_writable(DOCROOT.'images/projects')): ?>
  				<td class="pass"><?php echo DOCROOT.'images/projects/' ?></td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">The <code><?php echo DOCROOT.'images/projects/' ?></code> directory is not writable.</td>
  			<?php endif ?>
  		</tr>                   
  		<tr>
  			<th><?=___('Cache Directory')?></th>
  			<?php if (is_dir(APPPATH) AND is_dir(APPPATH.'cache') AND is_writable(APPPATH.'cache')): ?>
  				<td class="pass"><?php echo APPPATH.'cache/' ?></td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">The <code><?php echo APPPATH.'cache/' ?></code> directory is not writable.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('Logs Directory')?></th>
  			<?php if (is_dir(APPPATH) AND is_dir(APPPATH.'logs') AND is_writable(APPPATH.'logs')): ?>
  				<td class="pass"><?php echo APPPATH.'logs/' ?></td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">The <code><?php echo APPPATH.'logs/' ?></code> directory is not writable.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('PCRE UTF-8')?></th>
  			<?php if ( ! @preg_match('/^.$/u', 'ñ')): $failed = TRUE ?>
  				<td class="fail"><a href="http://php.net/pcre">PCRE</a> has not been compiled with UTF-8 support.</td>
  			<?php elseif ( ! @preg_match('/^\pL$/u', 'ñ')): $failed = TRUE ?>
  				<td class="fail"><a href="http://php.net/pcre">PCRE</a> has not been compiled with Unicode property support.</td>
  			<?php else: ?>
  				<td class="pass">Pass</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('SPL Enabled')?></th>
  			<?php if (function_exists('spl_autoload_register')): ?>
  				<td class="pass">Pass</td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">PHP <a href="http://www.php.net/spl">SPL</a> is either not loaded or not compiled in.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('Reflection Enabled')?></th>
  			<?php if (class_exists('ReflectionClass')): ?>
  				<td class="pass">Pass</td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">PHP <a href="http://www.php.net/reflection">reflection</a> is either not loaded or not compiled in.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('Filters Enabled')?></th>
  			<?php if (function_exists('filter_list')): ?>
  				<td class="pass">Pass</td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">The <a href="http://www.php.net/filter">filter</a> extension is either not loaded or not compiled in.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('Iconv Extension Loaded')?></th>
  			<?php if (extension_loaded('iconv')): ?>
  				<td class="pass">Pass</td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">The <a href="http://php.net/iconv">iconv</a> extension is not loaded.</td>
  			<?php endif ?>
  		</tr>
  		<?php if (extension_loaded('mbstring')): ?>
  		<tr>
  			<th><?=___('Mbstring Not Overloaded')?></th>
  			<?php if (ini_get('mbstring.func_overload') & MB_OVERLOAD_STRING): $failed = TRUE ?>
  				<td class="fail">The <a href="http://php.net/mbstring">mbstring</a> extension is overloading PHP's native string functions.</td>
  			<?php else: ?>
  				<td class="pass">Pass</td>
  			<?php endif ?>
  		</tr>
  		<?php endif ?>
  		<tr>
  			<th><?=___('Character Type (CTYPE) Extension')?></th>
  			<?php if ( ! function_exists('ctype_digit')): $failed = TRUE ?>
  				<td class="fail">The <a href="http://php.net/ctype">ctype</a> extension is not enabled.</td>
  			<?php else: ?>
  				<td class="pass">Pass</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('URI Determination')?></th>
  			<?php if (isset($_SERVER['REQUEST_URI']) OR isset($_SERVER['PHP_SELF']) OR isset($_SERVER['PATH_INFO'])): ?>
  				<td class="pass">Pass</td>
  			<?php else: $failed = TRUE ?>
  				<td class="fail">Neither <code>$_SERVER['REQUEST_URI']</code>, <code>$_SERVER['PHP_SELF']</code>, or <code>$_SERVER['PATH_INFO']</code> is available.</td>
  			<?php endif ?>
  		</tr>
            
     <tr>
      <td colspan="2">
        <h2><?=___('Optional Tests')?></h2>        
        <p>
        	The following extensions are not required to run the Kohana core, but if enabled can provide access to additional classes.
        </p>      
      </td>     
     </tr> 
	   <tr>
  			<th><?=___('PECL HTTP Enabled')?></th>
  			<?php if (extension_loaded('http')): ?>
  				<td class="pass">Pass</td>
  			<?php else: ?>
  				<td class="fail">Kohana can use the <a href="http://php.net/http">http</a> extension for the Request_Client_External class.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('cURL Enabled')?></th>
  			<?php if (extension_loaded('curl')): ?>
  				<td class="pass">Pass</td>
  			<?php else: ?>
  				<td class="fail">Kohana can use the <a href="http://php.net/curl">cURL</a> extension for the Request_Client_External class.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('mcrypt Enabled')?></th>
  			<?php if (extension_loaded('mcrypt')): ?>
  				<td class="pass">Pass</td>
  			<?php else: ?>
  				<td class="fail">Kohana requires <a href="http://php.net/mcrypt">mcrypt</a> for the Encrypt class.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('GD Enabled')?></th>
  			<?php if (function_exists('gd_info')): ?>
  				<td class="pass">Pass</td>
  			<?php else: ?>
  				<td class="fail">Kohana requires <a href="http://php.net/gd">GD</a> v2 for the Image class.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('MySQL Enabled')?></th>
  			<?php if (function_exists('mysql_connect')): ?>
  				<td class="pass">Pass</td>
  			<?php else: ?>
  				<td class="fail">Kohana can use the <a href="http://php.net/mysql">MySQL</a> extension to support MySQL databases.</td>
  			<?php endif ?>
  		</tr>
  		<tr>
  			<th><?=___('PDO Enabled')?></th>
  			<?php if (class_exists('PDO')): ?>
  				<td class="pass">Pass</td>
  			<?php else: ?>
  				<td class="fail">Kohana can use <a href="http://php.net/pdo">PDO</a> to support additional databases.</td>
  			<?php endif ?>
  		</tr>        
  	</table> 
        <br />
        <br />  
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery-1.10.2.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script type="text/javascript">
      	  var $j = jQuery.noConflict();
          $j("#environment_tests").hide();
          $j("#show_details").show();
          
          function details(n){
              if(n){
                $j("#environment_tests").show(1000);
                $j("#hide_details").show();
                $j("#show_details").hide();              
              } else {
                $j("#environment_tests").hide(1000);
                $j("#hide_details").hide();
                $j("#show_details").show();              
              }
          }          
                  
    </script> 