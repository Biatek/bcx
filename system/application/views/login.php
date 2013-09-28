<h2>Prihlásenie</h2>
<?=form_open('admin/login')?>
<div class="login">
	<?=form_fieldset()?>
	<div><label>Meno</label><?=form_input('username')?></div>
	<div><label>Heslo</label><?=form_password('password')?></div>
	<?=form_submit('submit', 'Prihlásiť')?>
	<?=form_hidden('redirect', $redirect)?>
	<?=form_fieldset_close()?>
	<?=form_close()?>
</div>