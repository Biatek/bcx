<h3><?php print lang('blog.box.title');?></h3>
<ul>
<?php foreach ($content as $blog) { ?>
  <li><?php print anchor('blog/'.$blog['path'], $blog['name']); ?><br /><?php print date(lang('master.dateformat'), $blog['created'])?></li>
<?php } ?>
</ul>