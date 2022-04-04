<?php

require_once 'CalcForm.class.php';
require_once 'CalcResult.class.php';


class CalcCtrl {
    
    private $msgs;   //wiadomoĹ›ci dla widoku
	private $form;   //dane formularza (do obliczeĹ„ i dla widoku)
	private $wynik;
        
        
        public function __construct(){
		//stworzenie potrzebnych obiektĂłw
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->wynik = new CalcResult();
	}




public function getParams(){
	$this->form->x = getFromRequest('kwota');
		$this->form->y = getFromRequest('oprocentowanie');
		$this->form->op = getFromRequest('czas');
}



function validate(){
if ( ! (isset($this->form->kwota) && isset($this->form->oprocentowanie) && isset($this->form->czas))) {
	//sytuacja wystÄ…pi kiedy np. kontroler zostanie wywoĹ‚any bezpoĹ›rednio - nie z formularza
   return false;
}

// sprawdzenie, czy potrzebne wartoĹ›ci zostaĹ‚y przekazane
if ( $this->form->kwota == "") {
	$this->msgs->addError('Nie podano kwoty kredytu');
}
if ( $this->form->czas == "") {
	$this->msgs->addError('Nie podano liczby miesiecy');
}
if ( $this->form->oprocentowanie == "") {
	$this->msgs->addError('Nie podano oprocentowania');
}

//nie ma sensu walidowaÄ‡ dalej gdy brak parametrĂłw
if (! $this->msgs->isError()) {
	
	// sprawdzenie, czy $x i $y sÄ… liczbami caĹ‚kowitymi
	if (! is_numeric( $this->form->kwota )) {
		$this->msgs->addError('Pierwsza wartosc nie jest liczba calkowita');
	}
	
	if (! is_numeric( $this->form->oprocentowanie )) {
		$this->msgs->addError('Druga wartosc nie jest liczba calkowita ');
	}
        if (! is_numeric( $this->form->czas )) {
		$this->msgs->addError('Druga wartosc nie jest liczba calkowita…');
	}
}
        
       return ! $this->msgs->isError();
       
       
}
	
        
 



function process(){
    
    $this->getparams();
    
    if ($this->validate()) {
	
	
	//konwersja parametrĂłw na int
	$this->form->kwota = intval($this->form->kwota);
	$this->form->oprocentowanie = floatval($this->form->oprocentowanie);
	$this->form->czas = intval($this->form->czas);
        $this->form->oprocentowanie = round($this->form->oprocentowanie,2);
	
       
       $this->wynik->wynik = ($this->form->kwota + $this->form->kwota * ($this->form->oprocentowanie/100)) / (12 * $this->form->czas);
       $this->wynik->wynik = round($this->wynik->wynik,2);

       $this->msgs->addInfo('Wykonano obliczenia.');
       
    }
    
    $this->generateView();
}

public function generateView(){



getSmarty()->assign('page_title','Kalkulator');
getSmarty()->assign('page_description','Profesjonalne szablonowanie kalkulatora oparte na bibliotece Smarty');
getSmarty()->assign('page_header','Kalkulator kredytowy');


		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('wynik',$this->wynik);

getSmarty()->display('CalcView.html');

}

}

