<h2>Úprava úvodnej stránky</h2>
<?php echo validation_errors(); ?>
<?=form_open_multipart('admin/front/save')?>
	<label>Názov</label>
	<input type="text" name="title" class="name" value="<?=isset($front)?$front['title']:set_value('title')?>" />
	<label>Headline</label>
	<textarea type="text" name="headline"><?=isset($front)?$front['headline']:set_value('headline')?></textarea>
	<label>Text</label>
	<textarea type="text" name="text" id="ckeditor"><?=isset($front)?$front['text']:set_value('text')?></textarea>

	<div class="submit"><?=form_submit('submit', 'Uložiť')?>&nbsp;<?=form_submit('cancel', 'Zrušiť úpravy')?></div>
	<?=form_hidden('lang', isset($front)?$front['lang']:set_value('lang'))?>
<?=form_close()?>