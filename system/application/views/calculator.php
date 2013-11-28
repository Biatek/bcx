<div id="calculator">
  <div id="form">
    <h3 class="form-header">
      <?=$front['headline']?>
    </h3>
    <h3 class="form-header-small">
      <?=lang('calc.headline-small')?>
    </h3>
  	<div id="date-choser">
  		<?=form_open('', array('id'=>'calculator'))?>
  			<table class="calculator">
  				<?php $count = count($dates) > 1 ? count($dates) : 1 ?>
  				<?php for ($i=0;$i<$count;$i++) { ?>
  					<?php
  							$data['selected']['name'] = isset($dates[$i]) ? $dates[$i]['name'] : null;
  							$data['selected']['day'] = isset($dates[$i]) ? $dates[$i]['day'] : date('j');
  							$data['selected']['month'] = isset($dates[$i]) ? $dates[$i]['month'] : date('n');
  							$data['selected']['year'] = isset($dates[$i]) ? $dates[$i]['year'] : date('Y');
  
  							$data['date'] = $months.' '.$days.' '.$years;
  							$data['months'] = $months;
  							$data['days'] = $days;
  							$data['years'] = $years;
  							$data['i'] = $i;
  							$this->load->view('dates_row', $data);
  					?>
  				<?php } ?>
        </table>
          <?php
            $cookie_time=time()+60*60*24*10;
            $boxes=array("combine","planets","animals","round","half");
            foreach ($boxes as $b) {
              if ($_POST[$b]!=$_COOKIE[$b]) {
                setcookie($b,$_POST[$b],$cookie_time);
                $box[$b]=$_POST[$b];
              } else {
                $box[$b]=$_COOKIE[$b];
              }
              if ($box[$b]) $box[$b]=" checked"; 
            }             
          ?>
          <div id="settings">
              <!-- Range:
               <select name="range">
               <option value="31">1 month</option>
               <option value="183">6 months</option>
               <option value="366">1 year</option>  
               <option value="1098">3 year</option> 
               </select>  <br />    -->
               Month of calendar:
               <select name="select_month" style="width:200px">
               <?php      //vyber mesiaca
                 $select_month=$_POST['select_month'];
                 if ($select_month)
                   setcookie("select_month",$select_month,$cookie_time);
                 else
                   $select_month=$_COOKIE['select_month'];
                 $m = date("n");
                 $y = date("Y");
                 for ($i = 1; $i <= 12; $i++) {
                   $t=mktime(0,0,0,$m,1,$y);
                   $month_name=date("F",$t);
                   if ($select_month=="$m $y") $s=" selected"; else $s="";
                   echo "<option value=\"$m $y\"$s>$month_name $y</option>\n";
                   $m++;
                   if ($m>12){
                    $m=1;
                    $y++;                   
                   } 
                 }
               ?> 
               </select><br />
               <input type="checkbox" name="combine"<?=$box['combine']?> /> Combine birthday<br />
               <input type="checkbox" name="planets"<?=$box['planets']?> /> Planet age<br />
               <input type="checkbox" name="animals"<?=$box['animals']?> /> Animal age<br />
               <input type="checkbox" name="round" <?=$box['round']?> /> Round days, hours, minutes, seconds<br />
               <input type="checkbox" name="half" <?=$box['half']?> /> Half birthday<br />
          </div>
  				<div id="buttons">
  				  <button class="btn btn-primary more" type="button" value="<?=lang('calc.more.title')?>"><?=lang('calc.more')?></span></button>
  					<button class="btn btn-danger btn-large calculate" name="submit" type="submit"><span title="<?=lang('calc.calculate.title')?>"><?=lang('calc.calculate')?></span></button>
  				</div>
  				<div class="reset">
            <button class="btn btn-primary" type="cancel" name="reset"><?=lang('calc.reset')?></button>
  				  <button class="btn btn-primary" type="button" id="btn_settings" onclick="document.getElementById('settings').style.display='block'">Settings</button>
            
          </div>
  		</form>
  	</div>
  </div>
  <?php if (!count($dates)) { ?>
    <h1><?=$front['title']?></h1>
    <div clacc="front-text"><?=$front['text']?></div>
  <?php } ?>
</div>