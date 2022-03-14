<?php
require_once dirname(__FILE__).'/../../config.php';
//inicjacja mechanizmu sesji
session_start();

//pobranie roli
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

//jeĹ›li brak parametru (niezalogowanie) to idĹş na stronÄ™ logowania
if ( empty($role) ){
	include _ROOT_PATH.'/app/security/login.php';
	//zatrzymaj dalsze przetwarzanie skryptĂłw
	exit();
}

