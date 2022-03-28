<?php
//Skrypt uruchamiajÄ…cy akcjÄ™ wykonania obliczeĹ„ kalkulatora
// - naleĹĽy zwrĂłciÄ‡ uwagÄ™ jak znaczÄ…co jego rola ulegĹ‚a zmianie
//   po wstawieniu funkcjonalnoĹ›ci do klasy kontrolera

require_once dirname(__FILE__).'/../config.php';

//zaĹ‚aduj kontroler
require_once $conf->root_path.'/app/CalcCtrl.class.php';

//utwĂłrz obiekt i uĹĽyj
$ctrl = new CalcCtrl();
$ctrl->process();

