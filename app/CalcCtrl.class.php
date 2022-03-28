<?php

require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';


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
	$this->form->kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$this->form->oprocentowanie = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;
	$this->form->czas = isset($_REQUEST['czas']) ? $_REQUEST['czas'] : null;	
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
global $conf;


$smarty = new Smarty();
$smarty->assign('conf',$conf);


$smarty->assign('page_title','Kalkulator');
$smarty->assign('page_description','Profesjonalne szablonowanie kalkulatora oparte na bibliotece Smarty');
$smarty->assign('page_header','Kalkulator kredytowy');

$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('wynik',$this->wynik);

$smarty->display($conf->root_path.'/app/CalcView.html');

}

}

