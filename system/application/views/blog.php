<div class="blog">
	<h2><?=$blog['name']?></h2>
	<div class="blog-created"><?=date(lang('master.dateformat'), $blog['created'])?> <?=$this->session->userdata('admin')?anchor('admin/obsah/edit/'.$blog['id'], '[edit]'):''?></div>
	<div class="blog-text"><?=$blog['text']?></div>
</div>