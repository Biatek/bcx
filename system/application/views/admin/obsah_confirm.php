<h3>Mazanie</h3>
<p>Chystáte sa zmazať obsah s názvom <strong><?=$obsah['name']?></strong>. Ste si istí? Táto akcia sa nedá vrátiť späť!</p>
<?=form_open('admin/obsah/delete')?>
<?=form_hidden('id', $obsah['id'])?>
<?=form_submit('submit', 'Zmazať!')?>
<?=form_close()?>
<p><a href="<?=site_url('admin/obsah')?>">Nie, rozmyslel som si to.</a></p>