<?php

require_once dirname(__FILE__).'/../config.php';

require_once _ROOT_PATH.'/lib/smarty/Smarty.class.php';



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
		$messages [] = 'Pierwsza wartosc nie jest liczba calkowita';
	}
	
	if (! is_numeric( $oprocentowanie )) {
		$messages [] = 'Druga wartosc nie jest liczba calkowita ';
	}
        if (! is_numeric( $czas )) {
		$messages [] = 'Druga wartosc nie jest liczba calkowita…';
	}
        
        if (count ( $messages ) != 0) return false;
	else return true;
	
        
 }



function process(&$kwota,&$oprocentowanie,&$czas,&$messages,&$wynik){
	
	
	//konwersja parametrĂłw na int
	$kwota = intval($kwota);
	$oprocentowanie = floatval($oprocentowanie);
	$czas = intval($czas);
        $oprocentowanie = round($oprocentowanie,2);
	
       
       $wynik = ($kwota + $kwota * ($oprocentowanie/100)) / (12 * $czas);
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

$smarty = new Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Kalkulator');
$smarty->assign('page_description','Profesjonalne szablonowanie kalkulatora oparte na bibliotece Smarty');
$smarty->assign('page_header','Kalkulator kredytowy');

//pozostaĹ‚e zmienne niekoniecznie muszÄ… istnieÄ‡, dlatego sprawdzamy aby nie otrzymaÄ‡ ostrzeĹĽenia
$smarty->assign('kwota',$kwota);
$smarty->assign('oprocentowanie',$oprocentowanie);
$smarty->assign('czas',$czas);
$smarty->assign('wynik',$wynik);
$smarty->assign('messages',$messages);


// 5. WywoĹ‚anie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.html');

