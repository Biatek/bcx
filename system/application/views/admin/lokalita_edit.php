<h2>Úprava lokality</h2>
	<?php echo validation_errors(); ?>
	<?=form_open_multipart('admin/lokalita/save')?>
	<table class="form edit lokalita">
		<tbody>
			<tr>
				<td class="label">
					<label>Názov</label>
				</td>
				<td>
					<input type="text" name="name" class="name" value="<?=isset($lokalita)?$lokalita['name']:set_value('name')?>" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Telefón</label><br />Zadajte telefónne čísla pre túto lokalitu, <strong>oddelené čiarkou</strong>.
				</td>
				<td>
					<input type="text" name="telefon" class="name" value="<?=isset($lokalita)?$lokalita['telefon']:set_value('telefon')?>" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Adresa</label>
				</td>
				<td><textarea type="text" name="adresa"><?=isset($lokalita)?$lokalita['adresa']:set_value('adresa')?></textarea></td>
			</tr>
			<tr>
				<td>
					<label>GPS</label><br />Zadajte GPS súradnice pre zobrazenie mapy lokality. Sú to dve desatinné čísla oddelené čiarkou.</strong>.
				</td>
				<td>
					<input type="text" name="gps" class="name" value="<?=isset($lokalita)?$lokalita['gps']:set_value('gps')?>" />
				</td>
			</tr>
		</tbody>
	</table>

	<div><?=form_submit('submit', 'Uložiť')?></div>
	<div><?=form_submit('cancel', 'Zrušiť úpravy')?></div>
	<?=form_hidden('id', isset($lokalita)?$lokalita['id']:set_value('id'))?>
	<?=form_close()?>