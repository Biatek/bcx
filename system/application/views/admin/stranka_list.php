<h3>Zoznam stránok</h3>
<p><a href="<?=site_url('admin/stranka/add')?>">Vytvoriť novú</a></p>
<table class="table table-condensed">
	<tr>
		<th>ID</th>
		<th>Názov</th>
		<th>Operácie</th>
	</tr>
	<?php foreach ($stranka as $riadok) { ?>
		<tr>
			<td><?=$riadok['id']?></td>
			<td><?=$riadok['name']?></td>
			<td><a href="<?=site_url('admin/stranka/edit/'.$riadok['id'])?>">edit</a> | <a href="<?=site_url('admin/stranka/confirm/'.$riadok['id'])?>">zmazať</a></td>
		</tr>
	<?php } ?>
</table>