<h3>Mazanie</h3>
<p>Chystáte sa zmazať kategóriu s názvom <strong><?=$kategoria['name']?></strong>. Ste si istí? Táto akcia sa nedá vrátiť späť!</p>
<?=form_open('admin/kategorie/delete')?>
<?=form_hidden('id', $kategoria['id'])?>
<?=form_submit('submit', 'Zmazať!')?>
<?=form_close()?>
<p><a href="<?=site_url('admin/kategorie')?>">Nie, rozmyslel som si to.</a></p>