 <?php
  $msie=false;
  if (strpos($_SERVER['HTTP_USER_AGENT'],"MSIE")) $msie=true;
  if (strpos($_SERVER['HTTP_USER_AGENT'],"Firefox")) $msie=true;
  if ($msie) {
   require_once "header.php";
   echo "<h1 style=\"color:black\">Choose a person!</h1>\n";
   $i=explode("/",$_SERVER['REQUEST_URI']);
   $id_name=$i[4];
  }
  
 if (!$msie) {     // iba zapoznamkovanie, IE nebude zobrazovat kategorie, lebo to nefunguje v IE, pri testovani IE 9,10 to odstaranime
 ?>   
  	<form id="kategorie">
  		<?php foreach ($kategorie as $k) { ?>
  			<span><input name="kategorie[]" class="popup-filter" type="checkbox" rel="<?=$k['id']?>" value="<?=$k['id']?>" <?php print in_array($k['id'], $checked)?'checked':''; ?> /><?=$k['name']?></span>
  		<?php } ?>
  	</form>
<?php
  }
?>
  	
  	<span id="row-id" rel="<?php print $rowid; ?>"></span>

  	<div>
    	<?php $i = 0; ?>
  		  <?php foreach($osobnosti as $o) { ?>
  				<?php $kategorie = array(); ?>
  				<?php foreach ($o['kategorie'] as $kat) { ?>
  					<?php $kategorie[] = $kat['kategoria_id']; ?>
  				<?php  } ?>
  				<?php $i++; ?>
  				<a href="#"
<?php
 if ($msie) {
?>
          onclick="window.opener.document.getElementById('name[<?=$id_name?>]').value='<?=$o['name']?>';
          window.opener.document.getElementById('day[<?=$id_name?>]').value='<?=date('j', $o['dob'])?>';
          window.opener.document.getElementById('month[<?=$id_name?>]').value='<?=date('n', $o['dob'])?>';
          window.opener.document.getElementById('year[<?=$id_name?>]').value='<?=date('Y', $o['dob'])?>';
          window.close()">
<?php
 }
?>
          <span class="name label label-info" kat="<?=implode(',', $kategorie)?>" day="<?=date('j', $o['dob'])?>" month="<?=date('n', $o['dob'])?>" year="<?=date('Y', $o['dob'])?>" name="<?=$o['name']?>">
  					<?=$o['name']?>
  				</span></a>
  			<?php } ?>
    </div>
<?php
 if ($msie)
   require_once "footer.php";
?>
