<h3>Mazanie</h3>
<p>Chystáte sa zmazať stránku s názvom <strong><?=$stranka['name']?></strong>. Ste si istí? Táto akcia sa nedá vrátiť späť!</p>
<?=form_open('admin/stranka/delete')?>
<?=form_hidden('id', $stranka['id'])?>
<?=form_submit('submit', 'Zmazať!')?>
<?=form_close()?>
<p><a href="<?=site_url('admin/stranka')?>">Nie, rozmyslel som si to.</a></p>