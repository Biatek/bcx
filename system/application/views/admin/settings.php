<h2>Nastavenia</h2>
<?=form_open('admin/settings')?>
<label>Zmena hesla. Musíte ho zadať do obodvoch polí, pre kontrolu správnosti.</label><br />
<input name="password1" type="password" /><input name="password2" type="password" /><br />
<input name="timestamp" type="hidden" value="<?=time()?>" />
<input type="submit" name="submit" value="Uložiť" />
<?=form_close()?>