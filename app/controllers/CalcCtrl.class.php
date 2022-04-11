<?php

namespace app\controllers;
use app\forms\CalcForm;
use app\transfer\CalcResult;


class CalcCtrl {
    
    
	private $form;   //dane formularza (do obliczeĹ„ i dla widoku)
	private $wynik;
        
        
        public function __construct(){
		//stworzenie potrzebnych obiektĂłw
		
		$this->form = new CalcForm();
		$this->wynik = new CalcResult();
	}




public function getParams(){
	$this->form->kwota = getFromRequest('kwota');
		$this->form->oprocentowanie = getFromRequest('oprocentowanie');
		$this->form->czas = getFromRequest('czas');
}



function validate(){
if ( ! (isset($this->form->kwota) && isset($this->form->oprocentowanie) && isset($this->form->czas))) {
	//sytuacja wystÄ…pi kiedy np. kontroler zostanie wywoĹ‚any bezpoĹ›rednio - nie z formularza
   return false;
}

// sprawdzenie, czy potrzebne wartoĹ›ci zostaĹ‚y przekazane
if ( $this->form->kwota == "") {
	getMessages()->addError('Nie podano kwoty kredytu');
}
if ( $this->form->czas == "") {
	getMessages()->addError('Nie podano liczby miesiecy');
}
if ( $this->form->oprocentowanie == "") {
	getMessages()->addError('Nie podano oprocentowania');
}

//nie ma sensu walidowaÄ‡ dalej gdy brak parametrĂłw
if (! getMessages()->isError()) {
	
	// sprawdzenie, czy $x i $y sÄ… liczbami caĹ‚kowitymi
	if (! is_numeric( $this->form->kwota )) {
		getMessages()->addError('Pierwsza wartosc nie jest liczba calkowita');
	}
	
	if (! is_numeric( $this->form->oprocentowanie )) {
		getMessages()->addError('Druga wartosc nie jest liczba calkowita ');
	}
        if (! is_numeric( $this->form->czas )) {
		getMessages()->addError('Druga wartosc nie jest liczba calkowita…');
	}
}
        
       return ! getMessages()->isError();
       
       
}
	
        
 



public function action_calcCompute(){
    
    $this->getParams();
    
    if ($this->validate()) {
	
	
	//konwersja parametrĂłw na int
	$this->form->kwota = intval($this->form->kwota);
	$this->form->oprocentowanie = floatval($this->form->oprocentowanie);
	$this->form->czas = intval($this->form->czas);
        $this->form->oprocentowanie = round($this->form->oprocentowanie,2);
        getMessages()->addInfo('Parametry poprawne.');
	
       
       $this->wynik->wynik = ($this->form->kwota + $this->form->kwota * ($this->form->oprocentowanie/100)) / (12 * $this->form->czas);
       $this->wynik->wynik = round($this->wynik->wynik,2);

       getMessages()->addInfo('Wykonano obliczenia.');
       
    }
    
    $this->generateView();
}
public function action_calcShow(){
		getMessages()->addInfo('Witaj w kalkulatorze');
		$this->generateView();
	}

public function generateView(){



getSmarty()->assign('page_title','Kalkulator');
getSmarty()->assign('page_description','Profesjonalne szablonowanie kalkulatora oparte na bibliotece Smarty');
getSmarty()->assign('page_header','Kalkulator kredytowy');

                getSmarty()->assign('user',unserialize($_SESSION['user']));
		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('wynik',$this->wynik);

getSmarty()->display('CalcView.tpl');

}

}

