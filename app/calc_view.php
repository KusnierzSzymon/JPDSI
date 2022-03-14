<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator pozyczki</title>
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>
<div style="width:90%; margin: 2em auto;">
	
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>
 
<div style="width:90%; margin: 2em auto;">

<form action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
    <legend>Kalkulator</legend>
	<label for="id_kwota">Kwota pozyczki: </label>
	<input id="id_kwota" type="text" name="kwota" value="<?php out($kwota) ?>" /><br />
	<label for="id_czas">Czas(w miesiacach): </label>
        <input id="id_czas" type="text" name="czas" value="<?php out($czas) ?>" /><br />
	<label for="id_oprocentowanie">Oprocentowanie: </label>
	<input id="id_oprocentowanie" type="text" name="oprocentowanie" value="<?php out($oprocentowanie) ?>" /><br />
	<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />

</form>	

<?php
//wyĹ›wieltenie listy bĹ‚Ä™dĂłw, jeĹ›li istniejÄ…
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($wynik)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Rata miesieczna wynosi '.$wynik; ?>
</div>
<?php } ?>

</body>
</html>

