<div class="stranka">
	<h2><?=$stranka['name']?></h2>
	<div class="blog-created"><?=$this->session->userdata('admin')?anchor('admin/stranka/edit/'.$stranka['id'], '[edit]'):''?></div>
	<div class="stranka-text"><?=$stranka['text']?></div>
</div>