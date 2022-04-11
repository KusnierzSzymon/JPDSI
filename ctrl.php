<?php
require_once 'init.php';
// Brak zmian - init inicjuje system i przygotowuje dokĹ‚adnie to co w projekcie 6b.
// Jets zatem nowa struktura, przestrzenie nazw i pomocnicze obiekty i funkcje.

// PoniĹĽej wybĂłr akcji pobranej jako parametr z ĹĽÄ…dania (zmienna $action inicjowana automatycznie w init.php)

// ZauwaĹĽmy, iĹĽ w wybranych akcjach zawarto kontrolÄ™ dostÄ™pu
// (check.php, ajk w projekcie nr 2, przekierowuje na stronÄ™ logowania jeĹ›li uĹĽytkownik nie jest zalogowany)
// PozostaĹ‚e akcje sÄ… publiczne, czyli nie wymagajÄ… logowania, dlatego brak w nich check.php (sÄ… to: login oraz action1)

switch ($action) {
	default : // 'calcView'  // akcja NIEPUBLICZNA
		include 'check.php'; // KONTROLA
		$ctrl = new app\controllers\CalcCtrl();
		$ctrl->generateView ();
	break;
	case 'login': // akcja PUBLICZNA - brak check.php
		$ctrl = new app\controllers\LoginCtrl();
		$ctrl->doLogin();
	break;
	case 'calcCompute' : // akcja NIEPUBLICZNA
		include 'check.php';  // KONTROLA
		$ctrl = new app\controllers\CalcCtrl();
		$ctrl->process ();
	break;
	case 'logout' : // akcja NIEPUBLICZNA
		include 'check.php';  // KONTROLA
		$ctrl = new app\controllers\LoginCtrl();
		$ctrl->doLogout();
	break;
	case 'action1' : // akcja PUBLICZNA - brak check.php
		// zrĂłb coĹ› innego publicznego ...
		print('reakcja na akcjÄ™ publicznÄ… ....');
	break;
	case 'action2': // akcja NIEPUBLICZNA
		include 'check.php';  // KONTROLA
		// zrĂłb coĹ› innego wymagajÄ…cego logowania ...
		print('reakcja na akcjÄ™ niepublicznÄ… ....');
	break;
}