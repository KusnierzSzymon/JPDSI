<?php
/* Smarty version 4.1.0, created on 2022-04-11 22:36:44
  from 'C:\xampp\htdocs\Kalkulator_01\app\view\templates\main.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_6254915cb18101_70214365',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e0310bb9751cfa61797128e22c6a95dd295b9e5a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Kalkulator_01\\app\\view\\templates\\main.tpl',
      1 => 1649708867,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6254915cb18101_70214365 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title><?php echo (($tmp = $_smarty_tpl->tpl_vars['page_title']->value ?? null)===null||$tmp==='' ? "brak tytuĹ‚u" ?? null : $tmp);?>
</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css" integrity="sha384-UQiGfs9ICog+LwheBSRCt1o5cbyKIHbwjWscjemyBMT9YCUMZffs6UqUTd0hObXD" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->app_url;?>
/css/style.css" />
</head>
<body>
	<div style="margin: 1em;">
		<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7354266726254915cb17351_14517382', 'content');
?>

	</div>
</body>
</html><?php }
/* {block 'content'} */
class Block_7354266726254915cb17351_14517382 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_7354266726254915cb17351_14517382',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 Domyslna tresc zawartosci .... <?php
}
}
/* {/block 'content'} */
}
