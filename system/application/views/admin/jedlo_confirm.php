<h3>Mazanie</h3>
<p>Chystáte sa zmazať obsah s názvom <strong><?=$jedlo['name']?></strong>. Ste si istí? Táto akcia sa nedá vrátiť späť!</p>
<?=form_open('admin/jedlo/delete')?>
<?=form_hidden('id', $jedlo['id'])?>
<?=form_submit('submit', 'Zmazať!')?>
<?=form_close()?>
<p><a href="<?=site_url('admin/jedlo')?>">Nie, rozmyslel som si to.</a></p>