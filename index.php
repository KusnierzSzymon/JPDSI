<?php
require_once dirname(__FILE__).'/config.php';

//przekierowanie przeglÄ…darki klienta (redirect)
//header("Location: "._APP_URL."/app/calc_view.php");

//przekazanie ĹĽÄ…dania do nastÄ™pnego dokumentu ("forward")
include $conf->root_path.'/app/ctrl.php';
