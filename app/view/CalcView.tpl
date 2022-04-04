{extends file="main.tpl"}

{block name=footer}przykladowa tresc stopki wpisana do szablonu glownego z szablonu kalkulatora{/block}

{block name=content}

<h3>Kalkulator kredytowy</h2>


<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
	<fieldset>
	<label for="id_kwota">Kwota pozyczki: </label>
	<input id="id_kwota" type="text" name="kwota" value="{$form->kwota}" /><br />
	<label for="id_czas">Czas(w latach): </label>
        <input id="id_czas" type="text" name="czas" value="{$form->czas}" /><br />
	<label for="id_oprocentowanie">Oprocentowanie: </label>
	<input id="id_oprocentowanie" type="text" name="oprocentowanie" value="{$form->oprocentowanie}" /><br />
	</fieldset>
        <input type="submit" value="Oblicz" class="pure-button pure-button-primary" />

</form>	
<div class="messages">

{if $msgs->isError()}
	<h4>WystÄ…piĹ‚y bĹ‚Ä™dy: </h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err}
	{strip}
		<li>{$err}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}


{if $msgs->isInfo()}
	<h4>Informacje: </h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf}
	{strip}
		<li>{$inf}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}



{if isset($wynik->wynik)}
<h4>Rata miesieczna wynosi:</h4>
	<p class="res">
	{$wynik->wynik}
	</p>
{/if}

</div>

 {/block}