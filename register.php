<?php
//checks if user has registered, if not, gets name and email and sets cookies.
$customer_name = $_COOKIE['name'];
$expired = time() + (86400 * 7); //cookie expires 7 days from set date
if (!($customer_name)) {
	$customer_name = $_GET['name'];
	setcookie("name", $customer_name, $expired);
}
$customer_email = $_COOKIE['email'];
if (!($customer_email)) {
	$customer_email = $_GET['email'];
	setcookie("email", $customer_email, $expired);
}

#Remember, if you place any output before a header() call, you'll get an error.
if (!($customer_name && $customer_email) || !(filter_var($customer_email, FILTER_VALIDATE_EMAIL))) {
	
	   $query_string = $_SERVER['QUERY_STRING'];
	   #add a flag called "error" to tell register_form.php that something needs to be fixed
	   $url = "http://".$_SERVER['HTTP_HOST']."/php_register_email2/register-form.php?".$query_string."&error=1";
	   header("Location: ".$url);
	   exit();  //stop the rest of the program from happening
   
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Acme Plug-in Company</title>
<link rel="stylesheet" href="http://students.oreillyschool.com/resource/php_lesson.css" type="text/css" />
</head>

<body>

<div class="topbar">
ACME, INC.
</div>
<table>
<tr><td class="sidebar" valign="top">

links go here

</td><td class="content">
<h3>Welcome to Acme Plug-In Company!</h3><br/>
<?php

if ($customer_name == $_COOKIE['name'] && $customer_email == $_COOKIE['email']) {
	echo "Hello, ".$customer_name."!<br />";
	echo "We're sorry, you've reached the download limit.<br />";
} else {
	echo "Hello, ".$customer_name." !<br />";
	echo 'Please click the button to download the file.<br/><a href="download.php"><b>Download our Plug-In!</b></a>';
	}

?>
</td></tr></table>
<div class="bottombar">
</div>
</body>
</html>