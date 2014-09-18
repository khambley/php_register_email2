<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="http://students.oreillyschool.com/resource/php_lesson.css" type="text/css" />
</head>

<body>
<?php
$customer_name = $_GET['name'];
$customer_email = $_GET['email'];

#Remember, if you place any output before a header() call, you'll get an error.
if (!($customer_name && $customer_email))) {
	
   $query_string = $_SERVER['QUERY_STRING'];
   #add a flag called "error" to tell register_form.php that something needs fixed
   $url = "http://".$_SERVER['HTTP_HOST']."/php_register_email/register_form.php?".$query_string."&error=1";
   header("Location: ".$url);
   exit();  //stop the rest of the program from happening
   
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
	echo "Hello, ".$customer_name." !<br />";
  echo 'Click the button to download the file.<br/><a href="download.php"><b>Download our Plug-In!</b></a>';
?>
</td></tr></table>
<div class="bottombar">
</div>
</body>
</html>