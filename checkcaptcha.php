<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if ($_POST['contact-captcha'] == $_SESSION['cap_code'])
	{
		echo '{ "success": "all good!" }';
		die();
	}
}
header("HTTP/1.0 404 Not Found");
echo '{ "error": "Opište prosím správný kód z obrázku." }';