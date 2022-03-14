<?php
require_once dirname(__FILE__).'/../../config.php';

//pobranie parametrĂłw
function getParamsLogin(&$form){
	$form['login'] = isset ($_REQUEST ['login']) ? $_REQUEST ['login'] : null;
	$form['pass'] = isset ($_REQUEST ['pass']) ? $_REQUEST ['pass'] : null;
}

//walidacja parametrĂłw z przygotowaniem zmiennych dla widoku
function validateLogin(&$form,&$messages){
	// sprawdzenie, czy parametry zostaĹ‚y przekazane
	if ( ! (isset($form['login']) && isset($form['pass']))) {
		//sytuacja wystÄ…pi kiedy np. kontroler zostanie wywoĹ‚any bezpoĹ›rednio - nie z formularza
		return false;
	}

	// sprawdzenie, czy potrzebne wartoĹ›ci zostaĹ‚y przekazane
	if ( $form['login'] == "") {
		$messages [] = 'Nie podano loginu';
	}
	if ( $form['pass'] == "") {
		$messages [] = 'Nie podano hasla';
	}

	//nie ma sensu walidowaÄ‡ dalej, gdy brak parametrĂłw
	if (count ( $messages ) > 0) return false;

	// sprawdzenie, czy dane logowania sÄ… poprawne
	// - takie informacje najczÄ™Ĺ›ciej przechowuje siÄ™ w bazie danych
	//   jednak na potrzeby przykĹ‚adu sprawdzamy bezpoĹ›rednio
	if ($form['login'] == "admin" && $form['pass'] == "admin") {
		session_start();
		$_SESSION['role'] = 'admin';
		return true;
	}
	if ($form['login'] == "user" && $form['pass'] == "user") {
		session_start();
		$_SESSION['role'] = 'user';
		return true;
	}
	
	$messages [] = 'Niepoprawny login lub hasĹ‚o';
	return false; 
}

//inicjacja potrzebnych zmiennych
$form = array();
$messages = array();

// pobierz parametry i podejmij akcjÄ™
getParamsLogin($form);

if (!validateLogin($form,$messages)) {
	//jeĹ›li bĹ‚Ä…d logowania to wyĹ›wietl formularz z tekstami z $messages
	include _ROOT_PATH.'/app/security/login_view.php';
} else { 
	//ok przekieruj lub "forward" na stronÄ™ gĹ‚ĂłwnÄ…
	
	//redirect - przeglÄ…darka dostanie ten adres do "przejĹ›cia" na niego (wysĹ‚ania kolejnego ĹĽÄ…dania)
	header("Location: "._APP_URL);
	
	//"forward"
	//include _ROOT_PATH.'/index.php';
}

