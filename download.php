<?php
// when the user clicks on the link "download the plug-in", the program sends the user here, download.php

	$filepath = $_SERVER['DOCUMENT_ROOT']."/php_register_email2/acme_brochure.pdf";
	if (file_exists($filepath)) {
	   header("Content-Type: application/force-download");
	   header("Content-Disposition:filename=\"brochure.pdf\"");
	   $fd = fopen($filepath,'rb');
	   fpassthru($fd);
	   fclose($fd);
	}
	
?>