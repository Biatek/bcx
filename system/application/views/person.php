<div class="person">
	<h2><?php print $person['name'] ?> (<?php print date(lang('master.dateformat'), $person['dob']) ?>)</h2>
	<div class="text">
		<?php if ($person['files']) { ?>
			<div class="image"><img src="<?php print base_url() . 'content/osobnosti/medium/'.$person['files'][0]['name']?>" /></div>
		<?php } ?>
		<?php print $person['description'] ?>
	</div>
</div>