<h3>Zoznam prevádzok</h3>
<table>
	<tr>
		<th>ID</th>
		<th>Názov</th>
		<th>Operácie</th>
	</tr>
	<?php foreach ($lokalita as $riadok) { ?>
		<tr>
			<td><?=$riadok['id']?></td>
			<td><?=$riadok['name']?></td>
			<td><a href="<?=site_url('admin/lokalita/edit/'.$riadok['id'])?>">edit</a></td>
		</tr>
	<?php } ?>
</table>