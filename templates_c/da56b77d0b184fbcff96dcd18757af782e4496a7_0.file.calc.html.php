<?php
/* Smarty version 4.1.0, created on 2022-03-21 21:29:27
  from 'C:\xampp\htdocs\Kalkulator_01\app\calc.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.1.0',
  'unifunc' => 'content_6238e02783a319_81397993',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da56b77d0b184fbcff96dcd18757af782e4496a7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\Kalkulator_01\\app\\calc.html',
      1 => 1647894564,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6238e02783a319_81397993 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5199141906238e027815a56_66883320', 'footer');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12752970666238e027817018_98044558', 'content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "../templates/main.html");
}
/* {block 'footer'} */
class Block_5199141906238e027815a56_66883320 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'footer' => 
  array (
    0 => 'Block_5199141906238e027815a56_66883320',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
przykladowa tresc stopki wpisana do szablonu glownego z szablonu kalkulatora<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_12752970666238e027817018_98044558 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_12752970666238e027817018_98044558',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<h3>Kalkulator kredytowy</h2>


<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
/app/calc.php" method="post">
	<fieldset>
	<label for="id_kwota">Kwota pozyczki: </label>
	<input id="id_kwota" type="text" name="kwota" value="<?php echo $_smarty_tpl->tpl_vars['kwota']->value;?>
" /><br />
	<label for="id_czas">Czas(w latach): </label>
        <input id="id_czas" type="text" name="czas" value="<?php echo $_smarty_tpl->tpl_vars['czas']->value;?>
" /><br />
	<label for="id_oprocentowanie">Oprocentowanie: </label>
	<input id="id_oprocentowanie" type="text" name="oprocentowanie" value="<?php echo $_smarty_tpl->tpl_vars['oprocentowanie']->value;?>
" /><br />
	</fieldset>
        <input type="submit" value="Oblicz" class="pure-button pure-button-primary" />

</form>	
<div class="messages">

<?php if ((isset($_smarty_tpl->tpl_vars['messages']->value))) {?>
	<?php if (count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?>
		<ol class="err">
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
		<li><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</li>
		<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</ol>
	<?php }
}?>



<?php if ((isset($_smarty_tpl->tpl_vars['wynik']->value))) {?>
<h4>Rata miesieczna wynosi:</h4>
	<p class="res">
	<?php echo $_smarty_tpl->tpl_vars['wynik']->value;?>

	</p>
<?php }?>

</div>

 <?php
}
}
/* {/block 'content'} */
}
