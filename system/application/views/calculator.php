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
  				<div id="buttons">
  				  <button class="btn btn-primary more" type="button" value="<?=lang('calc.more.title')?>"><?=lang('calc.more')?></span></button>
  					<button class="btn btn-danger btn-large calculate" name="submit" type="submit"><span title="<?=lang('calc.calculate.title')?>"><?=lang('calc.calculate')?></span></button>
  				</div>
  				<div class="reset"><button class="btn btn-primary" type="cancel" name="reset"><?=lang('calc.reset')?></button></div>
  		</form>
  	</div>
  </div>
  <?php if (!count($dates)) { ?>
    <h1><?=$front['title']?></h1>
    <div clacc="front-text"><?=$front['text']?></div>
  <?php } ?>
</div>