<h2>Blok - vytvorenie/úprava</h2>
	<?php echo validation_errors(); ?>
	<?=form_open_multipart('admin/blocks/save')?>
	<label>Názov</label>
	<input type="text" name="name" class="name" value="<?=isset($block)?$block['name']:set_value('name')?>" />
	<label>Text</label>
	<textarea type="text" name="text" id="ckeditor"><?=isset($block)?$block['text']:set_value('text')?></textarea>
	<label>Umiestnenie</label>
	<?=form_dropdown('location', array('0'=>'- žiadne -', '1'=>'Prvý blok','2'=>'Druhý blok','3'=>'Tretí blok'), isset($block)?$block['location']:set_value('location'))?>
	<label>Jazyk</label>
	<?=form_dropdown('lang', $this->language->get_languages(), isset($block)?$block['lang']:set_value('lang'))?>
	<label id="upload" name="blocks">Pridať obrázok</label>
	<span id="progress"></span>
	<p class="description">Obrázky na titulku sú zväčšované na šírku 960px, preto je dobré pridávať fotky minimálne tejto veľkosti.</p>
	<ul id="files" rel="100"><?=$files?></ul>				
	<div class="submit"><?=form_submit('submit', 'Uložiť')?><?=form_submit('cancel', 'Zrušiť úpravy')?></div>
	<?=form_hidden('id', isset($block)?$block['id']:set_value('id'))?>
	<?=form_close()?>