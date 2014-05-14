<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$headers = 'From: ' . htmlentities($_POST['contact-email'], ENT_QUOTES, "UTF-8") . "\r\n";
			
	mail("info@ilovejuice.fr", "Zpráva z formuláře",  htmlentities($_POST['contact-text'], ENT_QUOTES, "UTF-8") + " \n\nLink:" + $_POST['juice-link'], $headers );
}