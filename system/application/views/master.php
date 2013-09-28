<!DOCTYPE html>
<html lang="en">
	<head>     
		<title><?=lang('master.title')?><?=$title?' | '.$title:''?></title>     
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
		<meta name="description" content="<?=isset($description)?$description:lang('master.description')?>">
		<meta name="keywords" content="<?=isset($keywords)?$keywords:lang('master.keywords')?>">
	
		<link href="<?=base_url()?>images/favicon32.ico" type="image/x-icon" rel="icon">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/bootstrap-responsive.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css">
		<link rel="stylesheet" type="text/css" media="screen and (max-width: 960px)" href="<?=base_url()?>css/small.css" />
		<!-- iphone 4 -->
		<link rel="stylesheet" type="text/css" media="only screen and (-webkit-min-device-pixel-ratio : 1.5),only screen and (min-device-pixel-ratio : 1.5)" href="<?=base_url()?>css/small.css" />
		<!-- jQuery !-->
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery.scrollTo.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery.easing.1.3.js"></script>
		<script type="text/javascript" src="<?=base_url()?>ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/bc.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/ajaxupload.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/upload.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/bootstrap.min.js"></script>
		
		<meta property="og:title" content="<?=$title?$title:'Birthday Calculators'?>" />
    <meta property="og:type" content="website" />
    
    <meta property="og:image" content="http://birthdaycalculators.com/images/logo.jpg" />
    <meta property="og:site_name" content="Birthday Calculators" />
    <meta property="fb:admins" content="1382366178" />

		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-21673533-1']);
			_gaq.push(['_trackPageview']);
			(function() {
			  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		<script type="text/javascript">(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	</head>

	<body>
		<div id="wrapper">
		  <div id="header">
		    <div id="header-inner"><a href="<?php print site_url();?>" title="<?=lang('master.home.title')?>"></a></div> <!-- header inner -->
				<div id="top">
				  <div id="top-inner">
				    <div id="small-menu">
				      Menu
				      <div id="small-menu-popup">
  				      <ul>
                  <?php foreach($this->m_stranka->getMenu() as $stranka) { ?>
      							<?php $path = $stranka['path']?$stranka['path']:$stranka['id']; ?>
      							<li><?=anchor('page/'.$path, $stranka['name'])?></li>   
      						<?php } ?>
                  <li><?=anchor('blog', lang('menu.blog'))?></li>
      						<?php if ($this->uri->rsegment(1)) { ?>
      							<li><?=anchor('', lang('master.calculator'))?></li>
      						<?php } ?>
      					</ul>
      				</div>
				    </div>
				    <div id="flags">
  				    <a href="<?=$this->lang->switch_uri('sk')?>">Slovak</a> | <a href="<?=$this->lang->switch_uri('en')?>">English</a>
  				  </div> <!-- flags -->
  				  <div id="top-inner-left">
  				    <a class="home" href="<?=site_url()?>" title="<?=lang('master.home.title')?>">Home</a>&nbsp;
  				    <a class="facebook" href="http://www.facebook.com/pages/birthdaycalculatorscom/192915784082110" title="<?=lang('master.facebook.title')?>" target="_blank">Facebook</a> <div class="fb-like" data-href="http://www.facebook.com/pages/birthdaycalculatorscom/192915784082110" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false" data-font="arial"></div>
  				  </div>
          </div>				    
				</div>
		  </div> <!-- header -->
		  <div id="menu">
		    <div id="menu-inner">
		      <ul>
            <?php foreach($this->m_stranka->getMenu() as $stranka) { ?>
							<?php $path = $stranka['path']?$stranka['path']:$stranka['id']; ?>
							<li><?=anchor('page/'.$path, $stranka['name'])?></li>   
						<?php } ?>
            <li><?=anchor('blog', lang('menu.blog'))?></li>
						<?php if ($this->uri->rsegment(1)) { ?>
							<li><?=anchor('', lang('master.calculator'))?></li>
						<?php } ?>
					</ul>
				</div>
		  </div>
			<div id="content"<?=$this->uri->segment(1)?' class="'.$this->uri->segment(1).'"':''?>>
  			<div id="content-inner">
				  <?php if (!isset($hide_menu)) { ?>		
				  <?php } ?>
				  <?php if (($this->uri->segment(1) == 'admin') && ($this->session->userdata('admin'))) { ?>
				    <div class="navbar">
  				    <div class="navbar-inner">
    				    <ul class="nav">
    					    <li<?php print ($this->uri->segment(2) == 'front')?' class="active"':''; ?>><?=anchor('admin/front', 'Úvodná stránka')?></li>
      						<li<?php print ($this->uri->segment(2) == 'obsah')?' class="active"':''; ?>><?=anchor('admin/obsah', 'Obsah')?></li>
      						<li<?php print ($this->uri->segment(2) == 'stranka')?' class="active"':''; ?>><?=anchor('admin/stranka', 'Stránky')?></li>
      						<li<?php print ($this->uri->segment(2) == 'blocks')?' class="active"':''; ?>><?=anchor('admin/blocks', 'Bloky')?></li>
      						<li<?php print ($this->uri->segment(2) == 'osobnosti')?' class="active"':''; ?>><?=anchor('admin/osobnosti', 'Osobnosti')?></li>
      						<li<?php print ($this->uri->segment(2) == 'kategorie')?' class="active"':''; ?>><?=anchor('admin/kategorie', 'Kategórie')?></li>
      						<li<?php print ($this->uri->segment(2) == 'settings')?' class="active"':''; ?>><?=anchor('admin/settings', 'Nastavenia')?></li>
      						<li><?=anchor('admin/logout', 'Odhlásiť')?></li>
      				  </ul>
      				</div>
      		  </div>
					  <?php
						  if (isset($messages)) {
							  if (is_array($messages)):
								  print '<div id="messages">';
							      foreach ($messages as $type => $msgs):
							        foreach ($msgs as $message):
							          echo ('<div class="' .  $type .'">' . $message . '</div>');
							        endforeach;
							      endforeach;
								  print '</div>';
							  endif;
						  }
					  ?>        
				  <?php } ?>
				  <?php if (isset($right)) { ?>
				    <div id="right">
  				    <?php print $right;?>
				    </div>
				  <?php } ?>           
				  <?php print $this->load->view($view, $content); ?>    

  			  <?php if ($view == 'calculator') { ?>  
  				  <?php if ($calculate) { ?>
  					  <div id="result" class="<?=$calculate ? 'visible' : 'invisible'?>">
  						  <?=$this->load->view('result', $result)?>
  					  </div>
  				  <?php } ?>
  			  <?php } ?> 
  		    <div style="clear:both;"></div>
  		  </div>
  		</div>
		</div> <!-- #content -->     			
		<div id="footer">
		  <div id="footer-inner">
		    <?php $lang = ($this->uri->segment(1) == 'sk')?'sk':'en'; ?>
		    <div class="box single first">
		      <?php $block = $this->m_blocks->getByParams(array('location' => 1, 'lang' => $lang)); ?>
		      <?php if ($block) { ?>
		        <?php $rand = rand(0, count($block)-1); ?>
  		      <h3 class="block"><?php print $block[$rand]['name']; ?></h3>
  		      <div class="content"><?php print $block[$rand]['text']; ?></div>
  		    <?php } ?>
		    </div>
		    <div class="box double">
  		    <?php $block = $this->m_blocks->getByParams(array('location' => 2, 'lang' => $lang)); ?>
		      <?php if ($block) { ?>
		        <?php $rand = rand(0, count($block)-1); ?>
  		      <h3 class="block"><?php print $block[$rand]['name']; ?></h3>
  		      <div class="content"><?php print $block[$rand]['text']; ?></div>
  		    <?php } ?>
		    </div>
		    <div class="box double last">
  		    <?php $block = $this->m_blocks->getByParams(array('location' => 3, 'lang' => $lang)); ?>
		      <?php if ($block) { ?>
		        <?php $rand = rand(0, count($block)-1); ?>
  		      <h3 class="block"><?php print $block[$rand]['name']; ?></h3>
  		      <div class="content"><?php print $block[$rand]['text']; ?></div>
  		    <?php } ?>
		    </div>
		  </div> <!-- #footer-inner -->
		</div> <!-- #footer -->
		<span style="display:none;" id="siteurl"><?=site_url()?>/</span>
		<span style="display:none;" id="baseurl"><?=base_url()?></span>
		
		<div id="star-popup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel"><?php print lang('calc.choose.person'); ?></h3>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>
	</body>
</html>
		