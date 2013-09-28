<h3>Zoznam kategórií</h3>
<p><a href="<?=site_url('admin/kategorie/add')?>">Vytvoriť novú</a></p>
<table class="table table-condensed">
	<tr>
		<th>ID</th>
		<th>Jazyk</th>
		<th>Názov</th>
		<th>Operácie</th>
	</tr>
	<?php foreach ($kategorie as $riadok) { ?>
		<tr>
			<td><?=$riadok['id']?></td>
			<td><?=$riadok['lang']?></td>
			<td><?=$riadok['name']?></td>
			<td><a href="<?=site_url('admin/kategorie/edit/'.$riadok['id'])?>">edit</a> | <a href="<?=site_url('admin/kategorie/confirm/'.$riadok['id'])?>">zmazať</a></td>
		</tr>
	<?php } ?>
</table>