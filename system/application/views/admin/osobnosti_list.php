<h3>Zoznam osobností</h3>
<p><a href="<?=site_url('admin/osobnosti/add')?>">Pridať novú</a></p>
<table class="table table-condensed">
	<tr>
		<th>ID</th>
		<th>Meno</th>
		<th>Dátum narodenia</th>
		<th>Operácie</th>
	</tr>
	<?php foreach ($osobnosti as $riadok) { ?>
		<tr>
			<td><?=$riadok['id']?></td>
			<td><?=$riadok['name']?></td>
			<td><?=date('d. m. Y', $riadok['dob'])?></td>
			<td><a href="<?=site_url('admin/osobnosti/edit/'.$riadok['id'])?>">edit</a> | <a href="<?=site_url('admin/osobnosti/confirm/'.$riadok['id'])?>">zmazať</a></td>
		</tr>
	<?php } ?>
</table>