<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyĹ‚a siÄ™ do klienta.
// WysĹ‚aniem odpowiedzi zajmie siÄ™ odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrĂłw

$kwota = $_REQUEST ['kwota'];
$oprocentowanie = $_REQUEST ['oprocentowanie'];
$czas = $_REQUEST ['czas'];

// 2. walidacja parametrĂłw z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostaĹ‚y przekazane
if ( ! (isset($kwota) && isset($oprocentowanie) && isset($czas))) {
	//sytuacja wystÄ…pi kiedy np. kontroler zostanie wywoĹ‚any bezpoĹ›rednio - nie z formularza
	$messages [] = 'BĹ‚Ä™dne wywoĹ‚anie aplikacji. Brak jednego z parametrĂłw.';
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
if (empty( $messages )) {
	
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
	

}

// 3. wykonaj zadanie jeĹ›li wszystko w porzÄ…dku

if (empty ( $messages )) { // gdy brak bĹ‚Ä™dĂłw
	
	//konwersja parametrĂłw na int
	$kwota = intval($kwota);
	$oprocentowanie = floatval($oprocentowanie);
	$czas = intval($czas);
        $oprocentowanie = round($oprocentowanie,2);
	//wykonanie operacji
       $wynik = ($kwota + $kwota * ($oprocentowanie/100)) / $czas;
       $wynik = round($wynik,2);
}

// 4. WywoĹ‚anie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   bÄ™dÄ… dostÄ™pne w doĹ‚Ä…czonym skrypcie

include 'calc_view.php';

