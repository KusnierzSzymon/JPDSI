<?php
require_once 'core/Config.class.php';
$conf = new core\Config();
require_once 'config.php'; //ustaw konfiguracjÄ™

function &getConf(){ global $conf; return $conf; }

//zaĹ‚aduj definicjÄ™ klasy Messages i stwĂłrz obiekt
require_once 'core/Messages.class.php';
$msgs = new core\Messages();

function &getMessages(){ global $msgs; return $msgs; }

//przygotuj Smarty, twĂłrz tylko raz - wtedy kiedy potrzeba
$smarty = null;	
function &getSmarty(){
	global $smarty;
	if (!isset($smarty)){
		//stwĂłrz Smarty i przypisz konfiguracjÄ™ i messages
		include_once 'lib/smarty/Smarty.class.php';
		$smarty = new Smarty();	
		//przypisz konfiguracjÄ™ i messages
		$smarty->assign('conf',getConf());
		$smarty->assign('msgs',getMessages());
		//zdefiniuj lokalizacjÄ™ widokĂłw (aby nie podawaÄ‡ Ĺ›cieĹĽek przy ich zaĹ‚Ä…czaniu)
		$smarty->setTemplateDir(array(
			'one' => getConf()->root_path.'/app/view',
			'two' => getConf()->root_path.'/app/view/templates'
		));
	}
	return $smarty;
}

require_once 'core/ClassLoader.class.php'; //zaĹ‚aduj i stwĂłrz loader klas
$cloader = new core\ClassLoader();
function &getLoader() {
    global $cloader;
    return $cloader;
}

require_once 'core/functions.php';

$action = getFromRequest('action');
