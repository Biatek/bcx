<h3>Zoznam jedál</h3>
<?php //print_r($jedlo)?>
<p><a href="<?=site_url('admin/jedlo/add')?>">Vytvoriť nové</a></p>
<?=form_open('admin/jedlo/sort')?>
<table class="sortable">
	<tr>
		<th></th>
		<th>Názov</th>
		<th>Typ</th>
		<th>Lokality</th>
		<th>Operácie</th>
	</tr>
	<?php foreach ($jedlo as $riadok) { ?>
		<tr>
			<td><img src="<?=base_url()?>/css/images/arrow.png" /><input type="hidden" name="order[]" value="<?=$riadok['id']?>" /></td>
			<td><?=$riadok['name']?></td>
			<td><?=$riadok['typ'][0]['name']?></td>
			<td>
				<?php $lokality = array(); ?>
				<?php foreach ($riadok['lokality'] as $lok) {
					$l = $this->m_lokalita->getByPk($lok['lokalita_id']);
					$lokality[] = $l['name'];
				} ?>
				<?=implode(', ', $lokality)?>
			</td>
			<td><a href="<?=site_url('admin/jedlo/edit/'.$riadok['id'])?>">edit</a> | <a href="<?=site_url('admin/jedlo/confirm/'.$riadok['id'])?>">zmazať</a></td>
		</tr>
	<?php } ?>
</table>
<input type="submit" name="submit" value="Uložiť poradie" />
<?=form_close()?>