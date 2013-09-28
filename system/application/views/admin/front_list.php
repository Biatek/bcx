<table class="table table-condensed">
  <tr>
    <th>Jazyk</th>
    <th>Názov</th>
    <th>Operácie</th>
  </tr>
<?php foreach ($front as $row) { ?>
  <tr>
    <td><?php print $row['lang']; ?></td>
    <td><?php print $row['title']; ?></td>
    <td><?php print anchor('admin/front/edit/'.$row['lang'], 'Upraviť'); ?></td>
  </tr>
<?php } ?>
</table>
    
    