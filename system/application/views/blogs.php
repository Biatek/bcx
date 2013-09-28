
	<!--
Tento text je originál kód. Ten nad tým som prerobil, aby sa text na titulke
zobrazoval iba na titulke a nikde inde. Na Vrátenie s	
	
<div class="blogs">
	<?php foreach($blogs as $blog) { ?>
		<div class="blog">
			<h2><a href="<?=site_url('blog/'.$blog['path'])?>"><?=$blog['name']?></a></h2>
			<div class="blog-created"><?=date(lang('master.dateformat'), $blog['created'])?></div>
			<p><?=word_limiter($blog['text'], 50)?></p>
			<p class="readmore"><?=anchor('blog/'.$blog['path'], lang('blog.read_more'))?></p>
		</div>        
	<?php } ?>
</div>
-->
<div class="blogs">
	<?php foreach($blogs as $blog) { ?>
		<div class="blog">
			<h2><a href="<?=site_url('blog/'.$blog['path'])?>"><?=$blog['name']?></a></h2>
			<div class="blog-created"><?=date(lang('master.dateformat'), $blog['created'])?></div>
			<p><?=word_limiter($blog['text'], 50)?></p>
			<p class="readmore"><?=anchor('blog/'.$blog['path'], lang('blog.read_more'))?></p>
		</div>        
	<?php } ?>
</div>