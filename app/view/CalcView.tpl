{extends file="main.tpl"}

{block name=footer}przykladowa tresc stopki wpisana do szablonu glownego z szablonu kalkulatora{/block}

{block name=content}

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">uzytkownik: {$user->login}, rola: {$user->role}</span>
</div>








<form action="{$conf->action_url}calcCompute" method="post" class="pure-form pure-form-aligned bottom-margin">
	<legend>Kalkulator</legend>
        <fieldset>
       <div class="pure-control-group">
	<label for="id_kwota">Kwota pozyczki: </label>
	<input id="id_kwota" type="text" name="kwota" value="{$form->kwota}" /><br />
        </div>
        <div class="pure-control-group">
	<label for="id_czas">Czas(w latach): </label>
        <input id="id_czas" type="text" name="czas" value="{$form->czas}" /><br />
	</div>
        <div class="pure-control-group">
        <label for="id_oprocentowanie">Oprocentowanie: </label>
	<input id="id_oprocentowanie" type="text" name="oprocentowanie" value="{$form->oprocentowanie}" /><br />
	</div>

    <div class="pure-controls">    
   <input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
  </div>
	</fieldset>
</form>	



{include file='messages.tpl'}

{if isset($wynik->wynik)}
<div class="messages inf">
	Wynik: {$wynik->wynik}
</div>
{/if}

{/block}