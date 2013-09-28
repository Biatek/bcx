<?php if($files) { ?>
	<?php foreach ($files as $file) { ?>
		<li id="<?=$file?>" class="success">
			<img src="<?=base_url()?>content/<?=$folder?>/thumbs/<?=$file?>" alt="" />
			<input type="hidden" name="image[]" value="<?=$file?>" /><br />
			<h3>URL:</h3>
			<div class="filepath">Malý: <?=base_url()?>content/<?=$folder?>/thumbs/<?=$file?></div>
			<div class="filepath">Stredný: <?=base_url()?>content/<?=$folder?>/medium/<?=$file?></div>
			<div class="filepath">Originál: <?=base_url()?>content/<?=$folder?>/<?=$file?></div>
			<div class="remove file" name="<?=$file?>">Odstrániť</div>
		</li>
	<?php } ?>
<?php } ?>