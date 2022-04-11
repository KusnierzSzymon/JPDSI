<?php

namespace app\controllers;

use app\transfer\User;
use app\forms\LoginForm;

class LoginCtrl{
	private $form;
	
	public function __construct(){
		//stworzenie potrzebnych obiektĂłw
		$this->form = new LoginForm();
	}
	
	public function getParams(){
		// 1. pobranie parametrĂłw
		$this->form->login = getFromRequest('login');
		$this->form->pass = getFromRequest('pass');
	}
	
	public function validate() {
		// sprawdzenie, czy parametry zostaĹ‚y przekazane
		if (! (isset ( $this->form->login ) && isset ( $this->form->pass ))) {
			// sytuacja wystÄ…pi kiedy np. kontroler zostanie wywoĹ‚any bezpoĹ›rednio - nie z formularza
			getMessages()->addError('BĹ‚Ä™dne wywoĹ‚anie aplikacji !');
		}
			
			// nie ma sensu walidowaÄ‡ dalej, gdy brak parametrĂłw
		if (! getMessages()->isError ()) {
			
			// sprawdzenie, czy potrzebne wartoĹ›ci zostaĹ‚y przekazane
			if ($this->form->login == "") {
				getMessages()->addError ( 'Nie podano loginu' );
			}
			if ($this->form->pass == "") {
				getMessages()->addError ( 'Nie podano hasĹ‚a' );
			}
		}

		//nie ma sensu walidowaÄ‡ dalej, gdy brak wartoĹ›ci
		if ( !getMessages()->isError() ) {
		
			// sprawdzenie, czy dane logowania poprawne
			// (takie informacje najczÄ™Ĺ›ciej przechowuje siÄ™ w bazie danych)
			if ($this->form->login == "admin" && $this->form->pass == "admin") {
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
				$user = new User($this->form->login, 'admin');
				// zapis wartoĹ›ci do sesji
				//$_SESSION['user_login'] = $user->login;
				//$_SESSION['user_role'] = $user->role;
				// LUB moĹĽna zapisaÄ‡ or razu caĹ‚y obiekt, ale trzeba go zserializowaÄ‡
				$_SESSION['user'] = serialize($user);				
			} else if ($this->form->login == "user" && $this->form->pass == "user") {
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
				$user = new User($this->form->login, 'user');
				// zapis wartoĹ›ci do sesji
				//$_SESSION['user_login'] = $user->login;
				//$_SESSION['user_role'] = $user->role;
				// LUB caĹ‚ego obiekt, po serializacji
				$_SESSION['user'] = serialize($user);				
			} else {
				getMessages()->addError('Niepoprawny login lub hasĹ‚o');
			}
		}
		
		return ! getMessages()->isError();
	}
	
	public function doLogin(){

		$this->getParams();
		
		if ($this->validate()){
			//zalogowany => przekieruj na stronÄ™ gĹ‚ĂłwnÄ…, gdzie uruchomiona zostanie domyĹ›lna akcja
			header("Location: ".getConf()->app_url."/");
		} else {
			//niezalogowany => wyĹ›wietl stronÄ™ logowania
			$this->generateView(); 
		}
		
	}
	
	public function doLogout(){
		// 1. zakoĹ„czenie sesji
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		session_destroy();
		
		// 2. wyĹ›wietl stronÄ™ logowania z informacjÄ…
		getMessages()->addInfo('Poprawnie wylogowano z systemu');

		$this->generateView();		 
	}
	
	public function generateView(){
		
		getSmarty()->assign('page_title','Strona logowania');
		getSmarty()->assign('form',$this->form);
		getSmarty()->display('LoginView.tpl');		
	}
}