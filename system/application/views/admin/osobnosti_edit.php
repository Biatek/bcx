<h2>Osobnosť - vytvorenie/úprava</h2>
	<?php echo validation_errors(); ?>
	<?=form_open_multipart('admin/osobnosti/save')?>
	<label>Meno</label>
	<input type="text" name="name" class="name" value="<?=isset($osobnost)?$osobnost['name']:set_value('name')?>" />
	<label>Popis, životopis</label>
	<textarea type="text" name="description" id="ckeditor"><?=isset($osobnost)?$osobnost['description']:set_value('description')?></textarea>
	<label>URL</label>
	<div class="description">(použite len malé písmená bez diakritiky, čísla a pomlčky)</div>
	<input type="text" name="path" class="name" value="<?=isset($osobnost)?$osobnost['path']:set_value('path')?>" />
	<label>Jazyk</label>
	<?=form_dropdown('lang', $this->language->get_languages(), isset($osobnost)?$osobnost['lang']:set_value('lang'))?>
	<label>Kategória</label>
	<select name="kategorie[]" multiple="multiple" type="text">
	<?php foreach ($kategorie as $kat) { ?>
		<option value="<?=$kat['id']?>"<?=in_array($kat['id'], $kategorie_selected)?' selected="selected"':''?>><?=$kat['name']?></option>
	<?php } ?>
	</select>
	<label>Dátum narodenia</label>
	Deň: <input type="text" name="day" class="date" value="<?=isset($osobnost)?$osobnost['day']:set_value('day')?>" />
	Mesiac: <input type="text" name="month" class="date" value="<?=isset($osobnost)?$osobnost['month']:set_value('month')?>" />
	Rok: <input type="text" name="year" class="date" value="<?=isset($osobnost)?$osobnost['year']:set_value('year')?>" />
	<label id="upload" name="osobnosti">Pridať obrázok</label>
	<span id="progress"></span>
	<p class="description">Tu sa dá uploadnúť obrázok osobnosti.</p>
	<ul id="files" rel="1"><?=$files?></ul>				
	<div class="submit">
  	<button type="submit" class="btn btn-primary">Uložiť</button>
  </div>
	<?=form_hidden('id', isset($osobnost)?$osobnost['id']:set_value('id'))?>
	<?=form_close()?>