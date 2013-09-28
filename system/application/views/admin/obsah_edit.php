<h2>Obsah - vytvorenie/úprava</h2>
	<?php echo validation_errors(); ?>
	<?=form_open_multipart('admin/obsah/save')?>
	<label>Názov</label>
	<input type="text" name="name" class="name" value="<?=isset($obsah)?$obsah['name']:set_value('name')?>" />
	<label>Text</label>
	<textarea type="text" name="text" id="ckeditor"><?=isset($obsah)?$obsah['text']:set_value('text')?></textarea>
	<label>URL</label>
	<div class="description">(použite len malé písmená bez diakritiky, čísla a pomlčky)</div>
	<input type="text" name="path" class="name" value="<?=isset($obsah)?$obsah['path']:set_value('path')?>" />
	<label>Kľúčové slová</label>
	<div class="description">Zadajte kľúčové slová oddelené čiarkou. Maximálna dĺžka: 255 znakov.</div>
	<input type="text" name="keywords" maxlength="255" class="name" value="<?=isset($obsah)?$obsah['keywords']:set_value('keywords')?>" />
	<label>Jazyk</label>
	<?=form_dropdown('lang', $this->language->get_languages(), isset($obsah)?$obsah['lang']:set_value('lang'))?>
	<label>Publikovať</label>
	<div class="description">Ak zaškrtene tento checkbox, stránku uvidia všetci. Ak nie, uvidí ju len admin. Je to výhodné ak si rozpíšeš stránku a nie je ešte dokončená a chceš si ju len uložiť.</div>
	<input type="checkbox" name="published" value="1"<?=isset($obsah)?($obsah['published']?' checked="checked"':''):''?>" />
	<label>Zobraziť na titulke</label>
	<div class="description">Ak zaškrtene tento checkbox, článok sa objaví na titulnej stránke.</div>
	<input type="checkbox" name="front" value="1"<?=isset($obsah)?($obsah['front']?' checked="checked"':''):''?>" />
	<label id="upload" name="obsah">Pridať obrázok</label>
	<span id="progress"></span>
	<p class="description">Obrázky na titulku sú zväčšované na šírku 960px, preto je dobré pridávať fotky minimálne tejto veľkosti.</p>
	<ul id="files" rel="100"><?=$files?></ul>				
	<div class="submit"><?=form_submit('submit', 'Uložiť')?><?=form_submit('cancel', 'Zrušiť úpravy')?></div>
	<?=form_hidden('id', isset($obsah)?$obsah['id']:set_value('id'))?>
	<?=form_close()?>