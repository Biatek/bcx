<h2>Kategórie - vytvorenie/úprava</h2>
	<?php echo validation_errors(); ?>
	<?=form_open_multipart('admin/kategorie/save')?>
	<label>Názov</label>
	<input type="text" name="name" class="name" value="<?=isset($kategoria)?$kategoria['name']:set_value('name')?>" />
	<label>Jazyk</label>
	<?=form_dropdown('lang', $this->language->get_languages(), isset($kategoria)?$kategoria['lang']:set_value('lang'))?>
	<div class="submit"><?=form_submit('submit', 'Uložiť')?><?=form_submit('cancel', 'Zrušiť úpravy')?></div>
	<?=form_hidden('id', isset($kategoria)?$kategoria['id']:set_value('id'))?>
	<?=form_close()?>