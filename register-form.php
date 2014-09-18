<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome to the ACME Plug-In Company!</title>
<link rel="stylesheet" href="http://students.oreillyschool.com/resource/php_lesson.css" type="text/css" />
</head>

<body>
<?php
$error_code = 0;
if (isset($_GET['error']) == "1") {
	$error_code = 1;
	}
function checkUserInfo($user_info) {
	$user_ip = 0;
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	/*echo $user_agent;*/
	$user_ip = "100"; //$_SERVER['HTTP_X_FORWARDED_FOR']; //"202"; to test preg_match HTTP_X_FORWARDED_FOR doesn't work on my localhost (undefined index)
	$platform = "Platform Unknown";
	$browser = "Browser Unknown";
	$ip = 1;
	
	//First, check the IP address
	if(preg_match('/^[202]/', $user_ip)) {
		$ip = 0;
		echo "Access Denied";
		exit();
		}
	//Second get the platform
	if(preg_match('/Macintosh/', $user_agent)) {
		$platform = 'Macintosh';
	} else if(preg_match('/Windows/', $user_agent)) {
		$platform = 'Windows';
		} else {
			echo $platform . "<br>You need to use a Mac or Windows platform with this plug-in.<br/>Your platform is not compatible with this plug-in.\n";
			}
	
	//Third, get the browser
	if(preg_match('/Firefox/', $user_agent)) {
		$browser = 'Firefox';
	//MSIE check for IE10 and under
	} else if (preg_match('/MSIE/', $user_agent) || preg_match('/Mozilla/', $user_agent) && preg_match('/Trident/', $user_agent)) { // check for Mozilla & Trident token for IE11
		$browser = "Internet Explorer";
	} else if ($platform == 'Macintosh' && $browser != "Firefox") {
		echo "Please download the Firefox browser on your Mac.<br/>Click the link <a href='http://www.mozilla.org/en-US/firefox/new/' target='_blank'>here</a> to download.";
	} else if ($platform == 'Windows' && $browser != "Internet Explorer" || $browser != "Firefox") {
		echo "Please download the Internet Explorer browser on your PC.<br/>Click the link <a href='http://windows.microsoft.com/ie' target='_blank'>here</a> to download.";
	} else {
		echo $browser . "<br>Your browser is not compatible with this plug-in.\n";
	}
	
	//Fourth, check user platform / browser / IP combo
	if ($ip == 1 && $platform == "Macintosh" && $browser == "Firefox" || ($ip == 1 && $platform == "Windows" && $browser == "Internet Explorer" || $browser == "Firefox" )) {
		//echo 'Your platform and browser are compatible.<br/>Click the button to download.<br/><br/><a href="download.php"><b>Download our PDF brochure!</b></a>';
		$user_info = TRUE;
		return $user_info;
		} 
}
?>
<div class="topbar">
ACME, INC.
</div>
<table>
<tr><td class="sidebar" valign="top">

links go here

</td><td class="content">
<h3>Welcome to Acme Plug-In Company!</h3><br/>
<?php
if ($error_code) {
	echo "<div style='color:red'>Please complete the following:</div>";
}
?>

<?php
	$user_info = TRUE;
  checkUserInfo($user_info);
	if ($user_info) {
		echo 'Your platform and browser are compatible.<br />';
		echo 'Please register your name and email to download the plug-in:<br />';
?>
<form method="GET" action="register.php">
<table>
	<tr>
  	<td align="right">Name: </td>
    <td algin="left"><input type="text" size="25" name="name" value="<?php if (isset($_GET['name'])) { echo $_GET['name']; } ?>" />
    <?php if ($error_code && !($_GET['name'])) { echo "<b>Please include your name.</b>"; } ?>
    </td>
  </tr>
  <tr>
  	<td align="right">Email: </td>
    <td align="left"><input type="text" size="25" name="email" value="<?php if (isset($_GET['email'])) { echo $_GET['email']; } ?>" />
    <?php if ($error_code && !($_GET['email'])) { echo "<b>Please include your email address.</b>"; } ?>
    <?php
		if (isset($_GET['email'])) {
			$email = $_GET['email'];
		}
		if ($error_code && !(filter_var($email, FILTER_VALIDATE_EMAIL))) {
			echo "<b>Please enter a valid email address.</b>";
		}
		?>
    </td>
  </tr>
  <tr>
  	<td colspan="2" align="center"><input type="submit" value="SUBMIT" /></td>
  </tr>
</table>
</form>
<?php
	} //end $user_info if statement
?>
</td></tr></table>
<div class="bottombar">
</div>
</body>
</html>