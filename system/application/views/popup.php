    
  	<form id="kategorie">
  		<?php foreach ($kategorie as $k) { ?>
  			<span><input name="kategorie[]" class="popup-filter" type="checkbox" rel="<?=$k['id']?>" value="<?=$k['id']?>" <?php print in_array($k['id'], $checked)?'checked':''; ?> /><?=$k['name']?></span>
  		<?php } ?>
  	</form>
  	
  	<span id="row-id" rel="<?php print $rowid; ?>"></span>

  	<div>
    	<?php $i = 0; ?>
  		  <?php foreach($osobnosti as $o) { ?>
  				<?php $kategorie = array(); ?>
  				<?php foreach ($o['kategorie'] as $kat) { ?>
  					<?php $kategorie[] = $kat['kategoria_id']; ?>
  				<?php  } ?>
  				<?php $i++; ?>
  				<a href="#"><span class="name label label-info" kat="<?=implode(',', $kategorie)?>" day="<?=date('j', $o['dob'])?>" month="<?=date('n', $o['dob'])?>" year="<?=date('Y', $o['dob'])?>" name="<?=$o['name']?>">
  					<?=$o['name']?>
  				</span></a>
  			<?php } ?>
    </div>