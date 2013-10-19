<a class="results-anchor"></a>
<ul class="nav nav-tabs tabs">
	<li class="birthday active"><a href="#"><?=lang('tabs.birthday')?></a></li>
	<li class="animals"><a href="#"><?=lang('tabs.animals')?></a></li>
	<li class="planetes"><a href="#"><?=lang('tabs.planetes')?></a></li>
  <li class="celebratenow"><a href="#"><?=lang('tabs.celebratenow')?></a></li>
</ul>
<div class="result">
	<div class="tab birthday">
		<?php if ($calculate) { ?>
	
			<p>
		  <?php // only display this result if there is at least one person with specified name ?>
		 	<?php if ($this->calc->getCount($dates) > 1) { ?>
		 	   <?php if ($this->calc->getBirthdayDelta($this->calc->getCombinedBirthday($dates)) == 0) { ?>     <?php // pogratuluje ak su narodeniny dnes ?>
		      <h3><?=lang('result.happy.birthday')?><?=$this->calc->getTotalYearsCombinedBirthday($dates)?><?=lang('result.birthday.today')?></h3> <br />
			    <strong><?=lang('result.total.days')?><?=$this->calc->getTotalDays($dates)?><?=lang('result.total.days.02')?>.</strong><br />
		        <?php } else { ?>
			           <?php if ($this->calc->getBirthdayDelta($this->calc->getCombinedBirthday($dates)) == 1) { ?>          <?php // pogratuluje ak su narodeniny zajtra ?>
		                <h3><?=lang('result.happy.birthday')?><?=$this->calc->getTotalYears($dates)+1?><?=lang('result.birthday.tomorrow')?></h3><br />
		             <?php } ?>
		          <strong><?=lang('result.birthday.on.01')?><?=$this->calc->getTotalYears($dates)+1?><?=lang('result.birthday.on.02')?><?=date(lang('master.dateformat'),$this->calc->getCombinedBirthday($dates))?><br /> 
		          <?=lang('result.which.is')?> <?=$this->calc->getBirthdayDelta($this->calc->getCombinedBirthday($dates))?> <?=lang('result.days')?>.</strong><br />
		          <strong><?=lang('result.total.years.01')?><?=$this->calc->getTotalYears($dates)?><?=lang('result.total.years.02')?> <?=$this->calc->getBirthdayDaysGoing($dates)?>  <?=lang('result.total.years.03')?></strong><br />   
			        <strong><?=lang('result.total.days')?><?=$this->calc->getTotalDays($dates)?><?=lang('result.total.days.02')?>.</strong><br />
			   <?php } ?> 
		   <?php } else { ?>
			  <strong><?=lang('result.one.person')?></strong>   
          
		  <?php } ?>	
		  </p>
		  		<div class="fb-like" data-href="<?php print site_url('calc/'.$hash); ?>" data-send="true" data-width="450" data-show-faces="false" data-font="trebuchet ms" data-action="like"></div>

		  <?php foreach ($persons as $person) { ?>
				<p class="person">
					<strong><?=$person['name']?></strong> <?=lang('result.is')?> <?=$this->calc->getYears($person)?> <?=lang('result.years')?><?=lang('result.old')?><br />
					<?=lang('result.or')?> <?=$this->calc->getMonths($person)?> <?=lang('result.months')?>  <br />  
		      <?=lang('result.or')?> <?=$this->calc->getWeeks($person)?> <?=lang('result.weeks')?>  <br /> 
		      <?=lang('result.or')?> <?=$this->calc->getDays($person)?> <?=lang('result.days')?><?=lang('result.old')?>  <br />
		      <?=lang('result.or')?> <span class="chours"><?=$this->calc->getHours($person)?></span> <?=lang('result.hours')?>  <br />     
		      <?=lang('result.or')?> <span class="cminutes"><?=$this->calc->getMinutes($person)?></span> <?=lang('result.minutes')?>  <br />     
		      <?=lang('result.or')?> <span class="cseconds"><?=$this->calc->getSeconds($person)?></span> <?=lang('result.seconds')?>  <br /> 
		      <?=lang('result.was.born')?> <?=lang('result.day'.$this->calc->getDayNumber($person))?><br />
					<?php $half = $this->calc->getHalfBirthday($person); ?>
					<?php if ($half['days'] < 0) { ?>
						<?=lang('result.half.birthday.will')?> <?=date(lang('master.dateformat'), $half['half'])?> <?=lang('result.half.which.is')?> <?=abs($half['days'])?> <?=lang('result.half.days')?>
					<?php } elseif ($half['days'] > 0) { ?>
						<?=lang('result.half.birthday.was')?> <?=date(lang('master.dateformat'), $half['half'])?> <?=lang('result.half.which.was')?> <?=$half['days']?> <?=lang('result.half.days.ago')?>
					<?php } elseif ($half['days'] == 0) { ?>
						<?=lang('result.half.birthday.today')?>
					<?php } ?> 

        <br />
        <?=lang('result.path.number')?> <?=$this->calc->getPathNumber($person)?>
  
				</p>
			<?php } ?>    
		<?php } ?>    
	
			<p>
			<div class="messages">
				<?php foreach ($persons as $person) { ?>
					<?php if ($person['name'] && array_key_exists('messages', $person)) { ?>
						<!-- persons messages -->
						<?php foreach ($person['messages'] as $message) { ?>
							<p><?php print str_replace('@name', $person['name'], $message); ?></p>
						<?php } ?>
						<!-- end persons messages -->
					<?php } ?>
				<?php } ?>
			</div>
		</p>
		<div class="certificate"><a href="<?=site_url('calculator/certificate')?>"><?=lang('result.download')?></a></div>
	</div>
	<div class="tab animals">
		<?php foreach ($persons as $person) { ?>
			<p class="person">
				<strong><?=$person['name']?></strong>:<br />
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.dog')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.143)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.143))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.turtle')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 2.197)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 2.197))?>.</p>
        <p><?=lang('result.animals.if')?><strong><?=lang('animal.lion')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.419)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.419))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.elephant')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 1.127)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 1.127))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.aligator')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.954)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.954))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.orangutan')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.853)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.853))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.ostrich')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.853)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.853))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.camel')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.723)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.723))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.parrot')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.708)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.708))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.rhinoceros')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.636)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.636))?>.</p>
				<p><?=lang('result.animals.if')?><strong><?=lang('animal.shark')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.462)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.462))?>.</p>
			</p>
		<?php } ?>	
	</div>
	<div class="tab planetes">
<?php foreach ($persons as $person) { ?>
	<p class="person">
		<strong><?=$person['name']?></strong>:<br />
		<p><?=lang('result.planetes.if')?><strong><?=lang('planetes.mercury')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 87.96934)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 87.96934))?>.</p>
		<p><?=lang('result.planetes.if')?><strong><?=lang('planetes.venus')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 224.70096)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 224.70096))?>.</p>
		<p><?=lang('result.planetes.if')?><strong><?=lang('planetes.mars')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 686.971)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 686.971))?>.</p>
		<p><?=lang('result.planetes.if')?><strong><?=lang('planetes.jupiter')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 4335.3545)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 4335.3545))?>.</p>
		<p><?=lang('result.planetes.if')?><strong><?=lang('planetes.saturn')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 10756.1995)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 10756.1995))?>.</p>
		<p><?=lang('result.planetes.if')?><strong><?=lang('planetes.uranus')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 30707.4896)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 30707.4896))?>.</p>
		<p><?=lang('result.planetes.if')?><strong><?=lang('planetes.neptune')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 60190)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 60190))?>.</p>
		<p><?=lang('result.planetes.if')?><strong><?=lang('planetes.pluto')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 90613.3055)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 90613.3055))?>.</p>
	</p>
<?php } ?>	
	</div>
	<div class="tab celebratenow">
	 <?php
   
  //print_r ($persons) ;
  $celebrate=array();
	foreach ($persons as $key => $person) {
    // birthday 
    $delta = $this->calc->getCelebrateDelta($person);
    $date = date("j.n.Y",time()+$delta*60*60*24);
    $jubilee = $this->calc->getYears($person) + 1 ;
    if ($jubilee == 0) {
        $jubilee = 1;}  // podmienka pre vypocet ak ma niekto menej ako rok
    if ($delta == 0) {
          $celebrate[$delta]="HAPPY BIRTHDAY $person[name], today $date, celebrate $jubilee th birthday.<br />";  }
    elseif ($delta == 1) {
          $celebrate[$delta]="HAPPY BIRTHDAY $person[name], tomorrow $date, celebrate $jubilee th birthday.<br />"; }
    else
    $celebrate[$delta]="$delta days form now, $date, $person[name] will celebrate $jubilee th birthday.<br />";


    
    //half birthday
    $delta = $this->calc->getHalfBirthdayDelta($person);
   
    $date = date("j.n.Y",time()+$delta*60*60*24);
    if ($delta == 0) {
          $celebrate[$delta]="HAPPY BIRTHDAY $person[name], today $date, celebrate half birthday.<br />";  }
    elseif ($delta == 1) {
          $celebrate[$delta]="HAPPY BIRTHDAY $person[name], tomorrow $date, celebrate half birthday.<br />"; }

    else
    $celebrate[$delta]="$delta days form now, $date , $person[name] will celebrate half birthday. <br />";   
  }
/*POZNAMKY
- ak je delta rovnaka, zobrazi len jednu oslavu k tomu dnu
*/  
  ksort($celebrate);

  foreach ($celebrate as $text) {
    echo $text;
  }  
 
   
/*
Today, 23 Jan 2011, Dominic celebrate half birthday    F T e R C ?
Tomorow, 24 Jan 2011, Madona celebrate 87 years on the Venus   F T e R C ?
4 days from now, 28 jan 2011, Roger Federer celebrate 26 ostich years   F T e R C ?
15 days from now, 7 feb 2011, Roger Federer, Madona, Michael Jordan celebrate 120 combine birthday F T e R C ?
$delta.$date.$name."celebrate"."meniaci sa texts"
*/
   
   
	   $now = array();
	   foreach ($persons as $person) {
	     $half = $this->calc->getHalfBirthday($person); 
	     if ($half['days'] < 0) {
  	     $half['days'] = abs($half['days']);
	     }
	     else {
  	     $half['days'] = 365 - $half['days'];
  	     $half['half'] = $half['half'] + 365.2422*24*60*60;
	     }
  	   $now[] = array(
  	     'dates' => array(
    	     'half' => array('date' => $half['half'], 'days' => ceil($half['days'])),
    	     'next_bd' => array('days' => ceil(($this->calc->getNextBirthday($person) - time())/60/60/24), 'date' => $this->calc->getNextBirthday($person)),
    	     'comb_bd' => array('days' => ceil(($this->calc->getCount($dates) > 1)?$this->calc->getBirthdayDelta($this->calc->getCombinedBirthday($dates)):NULL), 'date' => ($this->calc->getCount($dates) > 1)?$this->calc->getCombinedBirthday($dates):NULL),
    	   ),
    	   'name' => $person['name'],
  	   );
      //var_dump ($now) ;

        //print ($half['days']) ;   
	   }
      //print ($half['days']) ; 
	   // sorting and output
	   foreach ($now as &$person) {
     //var_dump ($person) ;
           print $result['days'] ;
	     print '<ul><strong>'.$person['name'].'</strong>';
  	   uasort($person['dates'], array('calc', 'cmpCelebrateNowDates'));
  	   foreach ($person['dates'] as $key => $date) {
  	     print $this->load->view('now/'.$key, array('name' => $person['name'], 'date' => $date));
  	   }
  	   print '</ul>';
	   }    
	 ?>
  </div>
	<div class="start-over"><span id="start-over"><?=lang('result.start.over')?></span></div>
</div>