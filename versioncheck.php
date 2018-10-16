<?PHP
// Set your default account
$mysqluser = 'root';
$mysqlpass = '';
// ################################
// ## DONT EDIT BEYOND THIS LINE ##
// ################################
echo '<div id=\'load\' style="display:block;">Query websites.... Please stay patient</div>';
ob_flush();
flush();
if(!isset($_GET['user'])) {
@$link = mysqli_connect('localhost',$mysqluser,$mysqlpass);}else{@$link = mysqli_connect('localhost',strval($_GET['user']),strval($_GET['pass']));}
$phpvers = phpversion();
$apachevers = substr(apache_get_version(),7);
$apachevers = substr($apachevers,0,stripos( $apachevers,'(') - 1);
@$mysqlvers = mysqli_get_server_info($link);
// GET latest Apache
$apachelatest = NULL;
$apachetick = NULL;
$tmp = file_get_contents('https://httpd.apache.org/download.cgi');
$tmp = substr_replace(strval($tmp),'',0,stripos($tmp,'<p>Stable Release - Latest Version:</p>'));
$tmp = substr($tmp,stripos($tmp,'">') +2);
$apachelatest = substr($tmp,0,stripos($tmp,'</a>'));
if($apachelatest == $apachevers) { $apachetick = '&#10004;'; } else { $apachetick = '&#10008;';}
echo '<div id=\'load0\' style="display:block;">Proceeding Apache version...</div>';
ob_flush();
flush();
// GET latest PHP
$phplatest = NULL;
$phptick = NULL;
$tmp = file_get_contents('http://de2.php.net/downloads.php');
$tmp = substr_replace(strval($tmp),'',0,stripos($tmp,'Current Stable</span>') + 22);
$tmp = substr($tmp,0,stripos($tmp,'<a href=') - 1);
$tmp = str_replace(' ','',$tmp);
$phplatest = str_replace('PHP','',$tmp);
if($phplatest == $phpvers) { $phptick = '&#10004;'; } else { $phptick = '&#10008; - <a href="http://de2.php.net/downloads.php" target="_blank">Update Link </a>';}
echo '<div id=\'load1\' style="display:block;">Proceeding PHP version...</div>';
ob_flush();
flush();
// GET latest MySQL
$mysqllatest = NULL;
$mysqltick = NULL;
$tmp = file_get_contents('http://dev.mysql.com/downloads/');
$tmp = substr_replace(strval($tmp),'',0,stripos($tmp,'Available Release:') + 18);
$tmp = substr($tmp,0,stripos($tmp,')</span>'));
$mysqllatest = str_replace(' ','',$tmp);
if($mysqllatest == $mysqlvers) { $mysqltick = '&#10004;'; } else { $mysqltick = '&#10008; - <a href="http://dev.mysql.com/downloads/mysql/"  target="_blank">Update Link </a>';}
echo '<div id=\'load2\' style="display:block;">Proceeding MySQL version...</div>';
$showmysqllog = 'none';
if($mysqlvers == NULL) {
	$mysqlvers = '---';
	$mysqltick = '';
	$showmysqllog = 'block';
}
ob_flush();
flush();
// GETTING INFO about phpMyAdmin
$phpmyadmincurrent = NULL;
$tmp = file_get_contents('http://localhost/phpmyadmin/version_check.php');
$tmp = json_decode($tmp);
$phpmyadmincurrent = $tmp->version;
echo '<div id=\'load3\' style="display:block;">Proceeding phpMyAdmin installation...</div>';
ob_flush();
flush();
// GET latest phpMyAdmin
$phpmyadminlatest = NULL;
$phpmyadmintick = NULL;
$tmp = file_get_contents('http://www.phpmyadmin.net/home_page/downloads.php');
$tmp = substr_replace(strval($tmp),'',0,stripos($tmp,'<h2>phpMyAdmin') + 14);
$tmp = substr($tmp,0,stripos($tmp,'</h2>'));
$phpmyadminlatest = str_replace(' ','',$tmp);

if($phpmyadminlatest == $phpmyadmincurrent) { $phpmyadmintick = ' &#10004;'; } else { $phpmyadmintick = '&#10008; - <a href="http://www.phpmyadmin.net/home_page/downloads.php" target="_blank">Update Link </a>';}
echo '<div id=\'load4\' style="display:block;">Proceeding phpMyAdmin version...</div>';
ob_flush();
flush();
//
sleep(2);
echo '<script type="text/javascript">document.getElementById(\'load\').style.display = \'none\';</script>';
echo '<script type="text/javascript">document.getElementById(\'load0\').style.display = \'none\';</script>';
echo '<script type="text/javascript">document.getElementById(\'load1\').style.display = \'none\';</script>';
echo '<script type="text/javascript">document.getElementById(\'load2\').style.display = \'none\';</script>';
echo '<script type="text/javascript">document.getElementById(\'load3\').style.display = \'none\';</script>';
echo '<script type="text/javascript">document.getElementById(\'load4\').style.display = \'none\';</script>';
ob_end_flush();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>WAMP - Version checker by Markus Wackermann</title>
</head>
<body>
<table width="830" border="0" cellspacing="0" cellpadding="5">
  <tbody>
    <tr>
      <td width="93">&nbsp;</td>
      <td width="134">My version</td>
      <td width="189">Current Stable</td>
      <td width="374">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>PHP:</td>
      <td><?PHP echo $phpvers; ?></td>
      <td><?PHP echo $phplatest; ?></td>
      <td><?PHP echo $phptick; ?></td>
    </tr>
    <tr>
      <td>Apache:</td>
      <td><?PHP echo $apachevers; ?></td>
      <td><?PHP echo $apachelatest; ?></td>
      <td><?PHP echo $apachetick; ?></td>
    </tr>
    <tr>
      <td>MySQL:</td>
      <td><?PHP echo $mysqlvers; ?></td>
      <td><?PHP echo $mysqllatest; ?></td>
      <td><?PHP echo $mysqltick; ?></td>
    </tr>
    <tr>
      <td>phpMyAdmin:</td>
      <td><?PHP echo $phpmyadmincurrent; ?></td>
      <td><?PHP echo $phpmyadminlatest; ?></td>
      <td><?PHP echo $phpmyadmintick; ?></td>
    </tr>
  </tbody>
</table><br /><br />
<div id="credits" style="font-size:9px;">2014-2015 &copy; Markus Wackermann // version.php v0.3</div>
<br />
<div id="nologin" style="display:<?PHP echo $showmysqllog ?>; font-size:12px;">
<form>
<table width="400" border="1" cellspacing="0" cellpadding="5" style="background-color:#B3B2B2">
  <tbody>
    <tr>
      <td colspan="2" style="background-color:#727171">MySQL Query failed, please log in</td>
      </tr>
    <tr>
      <td width="87">User:</td>
      <td width="287"><input type="text" name="user" id="user" style="font-size:12px;"></td>
    </tr>
    <tr>
      <td>Password:</td>
      <td><input type="text" name="pass" id="pass" style="font-size:12px;"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" value="Enter"></td>
    </tr>
  </tbody>
</table>
</form>
</div>
</body>
</html>
