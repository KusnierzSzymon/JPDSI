<?php
require_once dirname(__FILE__).'/../../config.php';

// 1. zakoĹ„czenie sesji
session_start();
session_destroy();

// 2. przekieruj lub "forward" na stronÄ™ gĹ‚ĂłwnÄ…
//redirect
header("Location: "._APP_URL);
//"forward"
//include _ROOT_PATH.'/index.php';

