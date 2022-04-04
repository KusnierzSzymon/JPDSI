<?php
// Skrypt kontrolera gĹ‚Ăłwnego uruchamiajÄ…cy okreĹ›lonÄ…
// akcjÄ™ uĹĽytkownika na podstawie przekazanego parametru

//kaĹĽdy punkt wejĹ›cia aplikacji (skrypt uruchamiany bezpoĹ›rednio przez klienta) musi doĹ‚Ä…czaÄ‡ konfiguracjÄ™
// - w tym wypadku jest juĹĽ tylko jeden punkt wejĹ›cia do aplikacji - skrypt ctrl.php
require_once 'init.php';

//1. pobierz nazwÄ™ akcji



//2. wykonanie akcji
switch ($action) {
	default : // 'calcView'
	    // zaĹ‚aduj definicjÄ™ kontrolera
		include_once 'app/controllers/CalcCtrl.class.php';
		// utwĂłrz obiekt i uzyj
		$ctrl = new CalcCtrl ();
		$ctrl->generateView ();
	break;
	case 'calcCompute' :
		// zaĹ‚aduj definicjÄ™ kontrolera
		include_once 'app/controllers/CalcCtrl.class.php';
		// utwĂłrz obiekt i uzyj
		$ctrl = new CalcCtrl ();
		$ctrl->process ();
	break;
	case 'action1' :
		// zrĂłb coĹ› innego ...
	break;
	case 'action2' :
		// zrĂłb coĹ› innego ...
	break;
}
