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
               Range:
               <select name="range">
               <option value="31">1 month</option>
               <option value="183">6 months</option>
               <option value="366">1 year</option>  
               <option value="1098">3 year</option> 
               </select>  <br />
               Month of calendar:
               <select name="select_month" style="width:200px">
               <option value="11 2013">November 2013</option>
               <option value="12 2013">December 2013</option>
               <option value="1 2014">January 2014</option>  
               <option value="2 2014">February 2014</option> 
               <option value="3 2014">March 2014</option>
               <option value="4 2014">April 2014</option>
               <option value="5 2014">May 2014</option>
               <option value="6 2014">June 2014</option>
               <option value="7 2014">July 2014</option>
               <option value="8 2014">August 2014</option>
               <option value="9 2014">September 2014</option>
               <option value="10 2014">October 2014</option>
               <option value="11 2014">November 2014</option>
               <option value="12 2014">December 2014</option>
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