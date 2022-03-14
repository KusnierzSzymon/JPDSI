<?php

require_once dirname(__FILE__).'/../config.php';



include _ROOT_PATH.'/app/security/check.php';

function getParams(&$kwota,&$oprocentowanie,&$czas){
	$kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$oprocentowanie = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;
	$czas = isset($_REQUEST['czas']) ? $_REQUEST['czas'] : null;	
}



function validate(&$kwota,&$oprocentowanie,&$czas,&$messages){
if ( ! (isset($kwota) && isset($oprocentowanie) && isset($czas))) {
	//sytuacja wystÄ…pi kiedy np. kontroler zostanie wywoĹ‚any bezpoĹ›rednio - nie z formularza
   return false;
}

// sprawdzenie, czy potrzebne wartoĹ›ci zostaĹ‚y przekazane
if ( $kwota == "") {
	$messages [] = 'Nie podano kwoty kredytu';
}
if ( $czas == "") {
	$messages [] = 'Nie podano liczby miesiecy';
}
if ( $oprocentowanie == "") {
	$messages [] = 'Nie podano oprocentowania';
}

//nie ma sensu walidowaÄ‡ dalej gdy brak parametrĂłw
if (count ( $messages ) != 0) return false;
	
	// sprawdzenie, czy $x i $y sÄ… liczbami caĹ‚kowitymi
	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartoĹ›Ä‡ nie jest liczbÄ… caĹ‚kowitÄ…';
	}
	
	if (! is_numeric( $oprocentowanie )) {
		$messages [] = 'Druga wartoĹ›Ä‡ nie jest liczbÄ… ';
	}
        if (! is_numeric( $czas )) {
		$messages [] = 'Druga wartoĹ›Ä‡ nie jest liczbÄ… caĹ‚kowitÄ…';
	}
        
        if (count ( $messages ) != 0) return false;
	else return true;
	
        
 }



function process(&$kwota,&$oprocentowanie,&$czas,&$messages,&$wynik){
	global $role;
	
	//konwersja parametrĂłw na int
	$kwota = intval($kwota);
	$oprocentowanie = floatval($oprocentowanie);
	$czas = intval($czas);
        $oprocentowanie = round($oprocentowanie,2);
	
       
       $wynik = ($kwota + $kwota * ($oprocentowanie/100)) / $czas;
       $wynik = round($wynik,2);
}

$kwota = null;
$oprocentowanie = null;
$czas = null;
$wynik = null;
$messages = array();

getParams($kwota,$oprocentowanie,$czas);
if ( validate($kwota,$oprocentowanie,$czas,$messages) ) { 
	process($kwota,$oprocentowanie,$czas,$messages,$wynik);
}

include 'calc_view.php';

