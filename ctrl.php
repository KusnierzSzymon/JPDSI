<?php
require_once 'init.php';
// Brak zmian - init inicjuje system i przygotowuje dokĹ‚adnie to co w projekcie 6b.
// Jets zatem nowa struktura, przestrzenie nazw i pomocnicze obiekty i funkcje.

// PoniĹĽej wybĂłr akcji pobranej jako parametr z ĹĽÄ…dania (zmienna $action inicjowana automatycznie w init.php)

// ZauwaĹĽmy, iĹĽ w wybranych akcjach zawarto kontrolÄ™ dostÄ™pu
// (check.php, ajk w projekcie nr 2, przekierowuje na stronÄ™ logowania jeĹ›li uĹĽytkownik nie jest zalogowany)
// PozostaĹ‚e akcje sÄ… publiczne, czyli nie wymagajÄ… logowania, dlatego brak w nich check.php (sÄ… to: login oraz action1)

getConf()->login_action = 'login'; //okreĹ›lenie akcji logowania - robimy to w tym miejscu, poniewaĹĽ tu sÄ… zdefiniowane wszystkie akcje

switch ($action) {
	default :
		control('app\\controllers', 'CalcCtrl',		'generateView', ['user','admin']);
	case 'login': 
		control('app\\controllers', 'LoginCtrl',	'doLogin');
	case 'calcCompute' : 
		//zamiast pierwszego parametru moĹĽna podaÄ‡ null lub '' wtedy zostanie przyjÄ™ta domyĹ›lna przestrzeĹ„ nazw dla kontrolerĂłw
		control(null, 'CalcCtrl',	'process',		['user','admin']);
	case 'logout' : 
		control(null, 'LoginCtrl',	'doLogout',		['user','admin']);
}