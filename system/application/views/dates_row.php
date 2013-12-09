<tr rel="<?=$i?>">
	<td class="label" rel="<?=$i?>">
	<div class="name">
  	<?=lang('calc.name'); ?><br />
  	<input name="name[<?=$i?>]" id="name[<?=$i?>]" type="text" value="<?=isset($selected['name']) ? $selected['name'] : ''?>"/>
	</div>
	<div class="datefields"><div class="datefield"><div class="title"><?=lang('calc.month'); ?></div>
	<?=form_dropdown('month['.$i.']', $months, isset($selected['month']) ? $selected['month'] : NULL)?></div>
	<div class="datefield"><div class="title"><?=lang('calc.day'); ?></div>
	<?=form_dropdown('day['.$i.']', $days, isset($selected['day']) ? $selected['day'] : NULL)?></div>
	<div class="datefield"><div class="title"><?=lang('calc.year'); ?></div>
	<?=form_dropdown('year['.$i.']', $years, isset($selected['year']) ? $selected['year'] : NULL)?></div></div>
<?php
 if ((strpos($_SERVER['HTTP_USER_AGENT'],"MSIE")) || (strpos($_SERVER['HTTP_USER_AGENT'],"Firefox"))) {
?>
   <a href="#" onclick="javascript:window.open('<?php print site_url().'/osobnost/popup/'.$i; ?>','_blank','height=600,width=600, status=yes,toolbar=no,menubar=no,location=no')">
   <img src="<?=base_url()?>/css/images/star.png" alt="<?=lang('calc.star.alt')?>" title="<?=lang('calc.star.alt')?>" /></a> 
<?php 
} else {
?>
  <div class="star" rel="<?=$i?>"><a href="<?php print site_url().'/osobnost/popup/'.$i; ?>" data-target="#star-popup"><img src="<?=base_url()?>/css/images/star.png" alt="<?=lang('calc.star.alt')?>" title="<?=lang('calc.star.alt')?>" /></a></div>
<?php
}
?>  
  </td>
</tr>