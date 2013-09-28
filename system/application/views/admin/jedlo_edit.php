<h2>Jedlo - vytvorenie/úprava</h2>
	<?php echo validation_errors(); ?>
	<?php //print_r($jedlo)?>
	<?=form_open_multipart('admin/jedlo/save')?>
	<table class="form edit jedlo">
		<tbody>
			<tr>
				<td class="label">
					<label>Názov</label>
				</td>
				<td>
					<input type="text" name="name" class="name" value="<?=isset($jedlo)?$jedlo['name']:set_value('name')?>" />
				</td>
			</tr>
			<tr>
				<td>
					<label>Text</label>
				</td>
				<td>
					<textarea type="text" name="text"><?=isset($jedlo)?$jedlo['text']:set_value('text')?></textarea>
				</td>
			</tr>
			<tr>
				<td>Veľkosť jedla</td>
				<td>
					<?php foreach ($this->m_jedlo->getVelkosti() as $vel) { ?>
						<h4><?=$vel['name']?></h4>
						Gramáž: <input type="text" name="gramaz[<?=$vel['id']?>]" value="<?=isset($jedlo)?$jedlo['velkosti'][$vel['id']]['gramaz']:set_value('gramaz['.$vel['id'].']')?>" />g
						Priemer: <input type="text" name="priemer[<?=$vel['id']?>]" value="<?=isset($jedlo)?$jedlo['velkosti'][$vel['id']]['priemer']:set_value('priemer['.$vel['id'].']')?>" />cm
						Cena: <input type="text" name="cena[<?=$vel['id']?>]" value="<?=isset($jedlo)?$jedlo['velkosti'][$vel['id']]['cena']:set_value('cena['.$vel['id'].']')?>" />€
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td>Typ jedla</td>
				<td><?=form_dropdown('typ', $this->m_jedlo->getTypyForSelect(), isset($jedlo)?$jedlo['typ'][0]['id']:null)?></td>
			</tr>
			<tr>
				<td>Platí pre lokalitu</td>
				<td>
					<?php foreach ($lokality as $lokalita) { ?>
						<?=form_checkbox('lokalita['.$lokalita['id'].']', 1, isset($jedlo)?(int)in_array($lokalita['id'], $jedlo['lokality']):set_value('lokalita['.$lokalita['id'].']'))?><?=$lokalita['name']?><br />
					<?php } ?>
				</td>
			</tr>
		</tbody>
	</table>

	<div><?=form_submit('submit', 'Uložiť')?></div>
	<div><?=form_submit('cancel', 'Zrušiť úpravy')?></div>
	<?=form_hidden('id', isset($jedlo)?$jedlo['id']:set_value('id'))?>
	<?=form_close()?>