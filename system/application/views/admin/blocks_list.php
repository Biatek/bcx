<h3>Zoznam blokov</h3>
<?php //print_r($obsah)?>
<p><a href="<?=site_url('admin/blocks/add')?>">Vytvoriť nový</a></p>
<table class="table table-condensed">
	<tr>
		<th>ID</th>
		<th>Jazyk</th>
		<th>Názov</th>
		<th>Operácie</th>
	</tr>
	<?php foreach ($blocks as $riadok) { ?>
		<tr>
			<td><?=$riadok['id']?></td>
			<td><?=$riadok['lang']?></td>
			<td><?=$riadok['name']?></td>
			<td><a href="<?=site_url('admin/blocks/edit/'.$riadok['id'])?>">edit</a> | <a href="<?=site_url('admin/blocks/confirm/'.$riadok['id'])?>">zmazať</a></td>
		</tr>
	<?php } ?>
</table>