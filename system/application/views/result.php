<a class="results-anchor"></a>
<ul class="nav nav-tabs tabs">
	<li class="birthday active"><a href="#"><?=lang('tabs.birthday')?></a></li>
<!--	<li class="animals"><a href="#"><?=lang('tabs.animals')?></a></li>
	<li class="planetes"><a href="#"><?=lang('tabs.planetes')?></a></li>   --!>
  <li class="celebratenow"><a href="#"><?=lang('tabs.celebratenow')?></a></li>
  <li class="calendar"><a href="#">Calendar</a></li>
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
<!-- 
   <form method="post">
   <select name="range">
   <option value="31">1 month</option>
   <option value="183">6 months</option>
   <option value="366">1 year</option>  
   <option value="1098">3 year</option>
   </select>
   <input type="submit" value="enter">
   </form>
-->
	 <?php
    $number = count($persons)."<br />";
//    $range=$_POST['range'];
//    if (!$range)
      $range = $_POST['range']; // rozsah, doba pokial ma pocitat spolocne narodky a na marse
      $combine = $_POST['combine'];
      $planets = $_POST['planets'];
      $animals = $_POST['animals'];
      $round = $_POST['round'];  // round days, hours, minutes, seconds
      $half = $_POST['half'];
      $select_month = $_POST['select_month'];
      

  
  list($month,$year)=explode(" ",$select_month);    
  echo "<br />" ;
  $range = ((mktime(0,0,0,$month+1,1,$year)) - time ())/ (60*60*24);

  $celebrate=array();
	foreach ($persons as $person) {
 
    //Combine birthday       
//kombinacie dvojice  
if ($combine) {
  $x1=0;    
  while ($x1<$number) {
    $x2=$x1+1 ;
      while ($x2<$number){    
      $cmbdays = $this->calc->getDaysZero($persons[$x1]) + $this->calc->getDaysZero($persons[$x2]) ;
      $days = 365.2422 ;
      $jub = ($cmbdays/$days) ;
      $jubilee = ceil($jub) ;
      $deltax = (($jubilee - $jub) * $days);
      $delta = round($deltax/2) ;
      $person1=$persons[$x1];
      $person2=$persons[$x2];
      $repeat = 0 ;
        while (($delta+182.5*$repeat)<=$range) {
          if ($repeat%2==0)
            {
            $delta_repeat = round($delta + 365.2422*($repeat/2));
            }
          else 
            {
            $delta_repeat = round($delta + 183 + 365.2422*($repeat-1)/2);
            }
          $repeat = $repeat + 1 ;
          $date = date("j.n.Y",time()+$delta_repeat*60*60*24);
          $calendar[$date].="<p><b>$person1[name] and $person2[name]</b> $jubilee"."<sup>th</sup> duo combine birthday</p>";
          $celebrate[$delta_repeat][200]="<b> $delta_repeat </b> days from now, $date, $person1[name] and $person2[name] will celebrate $jubilee"."<sup>th</sup> duo combine birthday. <br />";
          $jubilee = $jubilee + 1 ;    
        }
      $x2++;
    }
    $x1++; 
  }  
  
  //kombinacie trojice
  $x1=0;   
  while ($x1<$number) {
    $x2=$x1+1 ;
      while ($x2<$number){
        $x3=$x2+1 ;
        while ($x3<$number){   
      $cmbdays = ($this->calc->getDaysZero($persons[$x1]) + $this->calc->getDaysZero($persons[$x2]) + $this->calc->getDaysZero($persons[$x3]));
      $days = 365.2422 ;
      $jub = ($cmbdays/$days) ;
      $jubilee = ceil($jub) ;
      $deltax = (($jubilee - $jub) * $days);
      $delta = round($deltax/3) ;
      $person1=$persons[$x1];
      $person2=$persons[$x2];
      $person3=$persons[$x3];
      $repeat = 0 ;
        while (($delta+122*$repeat)<=$range) {
          if ($repeat%3==0)
            {
            $delta_repeat = round($delta + 365.2422*($repeat/3));
            }
          elseif ($repeat%3==1) 
            {
            $delta_repeat = round($delta + 122 + 365.2422*($repeat-1)/3);
            }
          else 
            {
            $delta_repeat = round($delta + 243 + 365.2422*($repeat-2)/3);
            }
          $repeat = $repeat + 1 ;
          $date = date("j.n.Y",time()+$delta_repeat*60*60*24);
          $calendar[$date].="<p><b>$person1[name], $person2[name] and $person3[name]</b> $jubilee"."<sup>th</sup> trio combine birthday</p>";
          $celebrate[$delta_repeat][300]="<b> $delta_repeat </b> days from now, $date, $person1[name], $person2[name] and $person3[name] will celebrate $jubilee"."<sup>th</sup> trio combine birthday. <br />";
          $jubilee = $jubilee + 1 ;
          }
        $x3=++$x3 ;
        } 
    $x2=++$x2 ;
    }
  $x1=++$x1 ; 
  } 
  
  //kombinacie stvorice
  $x1=0;
  while ($x1<$number) {
    $x2=$x1+1 ;
      while ($x2<$number){
        $x3=$x2+1 ;
        while ($x3<$number){
          $x4=$x3+1 ;
          while ($x4<$number){
      $cmbdays = $this->calc->getDaysZero($persons[$x1]) + $this->calc->getDaysZero($persons[$x2]) + $this->calc->getDaysZero($persons[$x3]) + $this->calc->getDaysZero($persons[$x4]);
      $days = 365.2422 ;
      $jub = ($cmbdays/$days) ;
      $nextjub = ceil($jub) ;
      $deltax = (($nextjub - $jub) * $days);
      $delta = round($deltax/4) ;
      $person1=$persons[$x1];
      $person2=$persons[$x2];
      $person3=$persons[$x3];
      $person4=$persons[$x4];
      $repeat = 0 ;
        while (($delta+91.3*$repeat)<=$range) {
          if ($repeat%4==0)
            {
            $delta_repeat = round($delta + 365.2422*($repeat/4));
            }
          elseif ($repeat%4==1) 
            {
            $delta_repeat = round($delta + 91 + 365.2422*($repeat-1)/4);
            }
          elseif ($repeat%4==2)
            {
            $delta_repeat = round($delta + 183 + 365.2422*($repeat-2)/4);
            }
          else 
            {
            $delta_repeat = round($delta + 274 + 365.2422*($repeat-3)/4);
            }
            
          $repeat = $repeat + 1 ;
          $date = date("j.n.Y",time()+$delta_repeat*60*60*24);
          $calendar[$date].="<p><b>$person1[name], $person2[name], $person3[name] and $person4[name]</b> $jubilee"."<sup>th</sup> quartet combine birthday</p>";
          $celebrate[$delta_repeat][400]="<b> $delta_repeat </b> days from now, $date, $person1[name], $person2[name], $person3[name] and $person4[name] will celebrate $nextjub"."<sup>th</sup> quartet combine birthday. <br />";
          $jubilee = $jubilee + 1 ;
          }
          $x4=++$x4 ;
          } 
        $x3=++$x3 ;
        } 
    $x2=++$x2 ;
    }
  $x1=++$x1 ; 
  }
     
  //kombinacie patice
  $x1=0;
  while ($x1<$number) {
    $x2=$x1+1 ;
      while ($x2<$number){
        $x3=$x2+1 ;
        while ($x3<$number){
          $x4=$x3+1 ;
          while ($x4<$number){
            $x5=$x4+1 ;
            while ($x5<$number){
      $cmbdays = $this->calc->getDaysZero($persons[$x1]) + $this->calc->getDaysZero($persons[$x2]) + $this->calc->getDaysZero($persons[$x3]) + $this->calc->getDaysZero($persons[$x4]) + $this->calc->getDaysZero($persons[$x5]);
      $days = 365.2422 ;
      $jub = ($cmbdays/$days) ;
      $nextjub = ceil($jub) ;
      $deltax = (($nextjub - $jub) * $days);
      $delta = round($deltax/5) ;
      $person1=$persons[$x1];
      $person2=$persons[$x2];
      $person3=$persons[$x3];
      $person4=$persons[$x4];
      $person5=$persons[$x5];
      $repeat = 0 ;
        while (($delta+73*$repeat)<=$range) {
          if ($repeat%5==0)
            {
            $delta_repeat = round($delta + 365.2422*($repeat/5));
            }
          elseif ($repeat%5==1) 
            {
            $delta_repeat = round($delta + 73 + 365.2422*($repeat-1)/5);
            }
          elseif ($repeat%5==2)
            {
            $delta_repeat = round($delta + 146 + 365.2422*($repeat-2)/5);
            }
          elseif ($repeat%5==3)
            {
            $delta_repeat = round($delta + 219 + 365.2422*($repeat-3)/5);
            }
          else 
            {
            $delta_repeat = round($delta + 292 + 365.2422*($repeat-4)/5);
            }
          $repeat = $repeat + 1 ;
          $date = date("j.n.Y",time()+$delta_repeat*60*60*24);
          $calendar[$date].="<p><b>$person1[name], $person2[name], $person3[name], $person4[name] and $person5[name]</b> $jubilee"."<sup>th</sup> quintet combine birthday</p>";
          $celebrate[$delta_repeat][500]="<b> $delta_repeat </b> days from now, $date, $person1[name], $person2[name], $person3[name], $person4[name] and $person5[name] will celebrate $jubilee"."<sup>th</sup> quintet combine birthday. <br />";
          $jubilee = $jubilee + 1 ;
          }
            $x5=++$x5 ;
            } 
          $x4=++$x4 ;
          } 
        $x3=++$x3 ;
        } 
    $x2=++$x2 ;
    }
  $x1=++$x1 ; 
  }
  
  //kombinacie sestice
  $x1=0;
  while ($x1<$number) {
    $x2=$x1+1 ;
      while ($x2<$number){
        $x3=$x2+1 ;
        while ($x3<$number){
          $x4=$x3+1 ;
          while ($x4<$number){
            $x5=$x4+1 ;
            while ($x5<$number){
              $x6=$x5+1 ;
              while ($x6<$number){
      $cmbdays = $this->calc->getDaysZero($persons[$x1]) + $this->calc->getDaysZero($persons[$x2]) + $this->calc->getDaysZero($persons[$x3]) + $this->calc->getDaysZero($persons[$x4]) + $this->calc->getDaysZero($persons[$x5]) + $this->calc->getDaysZero($persons[$x6]);
      $days = 365.2422 ;
      $jub = ($cmbdays/$days) ;
      $jubilee = ceil($jub) ;
      $deltax = (($jubilee - $jub) * $days);
      $delta = round($deltax/6) ;
      $person1=$persons[$x1];
      $person2=$persons[$x2];
      $person3=$persons[$x3];
      $person4=$persons[$x4];
      $person5=$persons[$x5];
      $person6=$persons[$x6];
      $repeat = 0 ;
        while (($delta+61*$repeat)<=$range) {
          if ($repeat%6==0)
            {
            $delta_repeat = round($delta + 365.2422*($repeat/6));
            }
          elseif ($repeat%6==1) 
            {
            $delta_repeat = round($delta + 60.83 + 365.2422*($repeat-1)/6);
            }
          elseif ($repeat%6==2)
            {
            $delta_repeat = round($delta + 121.66 + 365.2422*($repeat-2)/6);
            }
          elseif ($repeat%6==3)
            {
            $delta_repeat = round($delta + 182.49 + 365.2422*($repeat-3)/6);
            }
          elseif ($repeat%6==4) 
            {
            $delta_repeat = round($delta + 243.32 + 365.2422*($repeat-4)/6);
            }
          else 
            {
            $delta_repeat = round($delta + 304.15 + 365.2422*($repeat-5)/6);
            }
          $repeat = $repeat + 1 ;
          $date = date("j.n.Y",time()+$delta_repeat*60*60*24);
          $calendar[$date].="<p><b>$person1[name], $person2[name], $person3[name], $person4[name], $person5[name] and $person6[name]</b> $jubilee"."<sup>th</sup> sextet combine birthday</p>";
          $celebrate[$delta_repeat][600]="<b> $delta_repeat </b> days from now, $date, $person1[name], $person2[name], $person3[name], $person4[name], $person5[name] and $person6[name] will celebrate $jubilee"."<sup>th</sup> sextet combine birthday. <br />";
          $jubilee = $jubilee + 1 ;
          }
              $x6=++$x6 ;
              } 
            $x5=++$x5 ;
            } 
          $x4=++$x4 ;
          } 
        $x3=++$x3 ;
        } 
    $x2=++$x2 ;
    }
  $x1=++$x1 ; 
  }
  
  // kombinacie sedem
  $x1=0;
  while ($x1<$number) {
    $x2=$x1+1 ;
      while ($x2<$number){
        $x3=$x2+1 ;
        while ($x3<$number){
          $x4=$x3+1 ;
          while ($x4<$number){
            $x5=$x4+1 ;
            while ($x5<$number){
              $x6=$x5+1 ;
              while ($x6<$number){
                $x7=$x6+1 ;
                while ($x7<$number){
      $cmbdays = $this->calc->getDaysZero($persons[$x1]) + $this->calc->getDaysZero($persons[$x2]) + $this->calc->getDaysZero($persons[$x3]) + $this->calc->getDaysZero($persons[$x4]) + $this->calc->getDaysZero($persons[$x5]) + $this->calc->getDaysZero($persons[$x6]) + $this->calc->getDaysZero($persons[$x7]);
      $days = 365.2422 ;
      $jub = ($cmbdays/$days) ;
      $jubilee = ceil($jub) ;
      $deltax = (($jubilee - $jub) * $days);
      $delta = round($deltax/7) ;
      $person1=$persons[$x1];
      $person2=$persons[$x2];
      $person3=$persons[$x3];
      $person4=$persons[$x4];
      $person5=$persons[$x5];
      $person6=$persons[$x6];
      $person7=$persons[$x7];    
      $repeat = 0 ;
        while (($delta+52.1*$repeat)<=$range) {
          if ($repeat%7==0)
            {
            $delta_repeat = round($delta + 365.2422*($repeat/6));
            }
          elseif ($repeat%7==1) 
            {
            $delta_repeat = round($delta + 52.14 + 365.2422*($repeat-1)/7);
            }
          elseif ($repeat%7==2)
            {
            $delta_repeat = round($delta + 104.28 + 365.2422*($repeat-2)/7);
            }
          elseif ($repeat%7==3)
            {
            $delta_repeat = round($delta + 156.42 + 365.2422*($repeat-3)/7);
            }
          elseif ($repeat%7==4) 
            {
            $delta_repeat = round($delta + 208.56 + 365.2422*($repeat-4)/7);
            }
          elseif ($repeat%7==5) 
            {
            $delta_repeat = round($delta + 260.7 + 365.2422*($repeat-5)/7);
            }
          else 
            {
            $delta_repeat = round($delta + 312.84 + 365.2422*($repeat-6)/7);
            }
          $repeat = $repeat + 1 ;
          $date = date("j.n.Y",time()+$delta_repeat*60*60*24);
          $calendar[$date].="<p><b>$person1[name], $person2[name], $person3[name], $person4[name], $person5[name], $person6[name] and $person7[name]</b> $jubilee"."<sup>th</sup> septet combine birthday</p>";
          $celebrate[$delta_repeat][700]="<b> $delta_repeat </b> days from now, $date, $person1[name], $person2[name], $person3[name], $person4[name], $person5[name], $person6[name] and $person7[name] will celebrate $jubilee"."<sup>th</sup> septet combine birthday. <br />";
          $jubilee = $jubilee + 1 ;
          }
                $x7=++$x7 ;
                } 
              $x6=++$x6 ;
              } 
            $x5=++$x5 ;
            } 
          $x4=++$x4 ;
          } 
        $x3=++$x3 ;
        } 
    $x2=++$x2 ;
    }
  $x1=++$x1 ; 
  }         
}    
    // birthday 
    $delta = $this->calc->getCelebrateDelta($person);
    $date = date("j.n.Y",time()+$delta*60*60*24);
    $jubilee = $this->calc->getYears($person) + 1 ;
    $calendar[$date].="<b>$person[name]</b> $jubilee"."<sup>th</sup> birthday";
    if ($jubilee == 0) {
        $jubilee = 1;}  // podmienka pre vypocet ak ma niekto menej ako rok
    if ($delta == 0) {
          $celebrate[$delta][]="HAPPY BIRTHDAY $person[name], today $date, celebrate $jubilee"."<sup>th</sup> birthday.<br />";  }
    elseif ($delta == 1) {
          $celebrate[$delta][]="HAPPY BIRTHDAY $person[name], tomorrow $date, celebrate $jubilee"."<sup>th</sup> birthday.<br />"; }
    else
    $celebrate[$delta][]="<b> $delta </b> days from now, $date, $person[name] will celebrate $jubilee"."<sup>th</sup> birthday.<br />";
    
    //half birthday
if ($half) {    
    $delta = $this->calc->getHalfBirthdayDelta($person);
    $date = date("j.n.Y",time()+$delta*60*60*24);
    $calendar[$date].="<p><b>$person[name]</b> Half Birthday</p>";
    if ($delta == 0) {
          $celebrate[$delta][]="HAPPY BIRTHDAY $person[name], today $date, celebrate half birthday.<br />";  }
    elseif ($delta == 1) {
          $celebrate[$delta][]="HAPPY BIRTHDAY $person[name], tomorrow $date, celebrate half birthday.<br />"; }

    else
    $celebrate[$delta][]="<b> $delta </b> days from now, $date , $person[name] will celebrate half birthday. <br />";  
}   

    // Planet age - pre vsetky planety
if ($planets) {
    $planets=array("Mercury" => 87.96934,"Venus" => 224.70096,"Mars" => 686.971,
                    "Jupiter" => 4335.3545,"Saturn" => 10756.1995,"Uranus" => 30707.4896,"Neptune" => 60190);
 
    foreach ($planets as $planet => $value) {
      $result = $this->calc->getPlanetAge($person, $value);
      $jubilee=$result['next_planet_age'];
      $delta=$result['delta'];
      while ($delta<=$range) {
        $date = date("j.n.Y",time()+$delta*60*60*24);
        $calendar[$date].="<p><b>$person[name]</b> $jubilee"."<sup>th</sup> Mercury age</p>";
        $celebrate[$delta][]="<b> $delta </b> days from now, $date, $person[name] will celebrate $jubilee"."<sup>th</sup> $planet age .<br />";
        $delta = $delta + round($value) ;  
        $jubilee = $jubilee + 1 ;    
      }  
    }  
}
    //Animal age
if ($animals) {
    $animals=array("dog" => 0.143,"turtle" => 2.197,"lion" => 0.419,"horse" => 0.578,"elephant" => 1.127,
                    "aligator" => 0.954,"orangutan" => 0.853,"camel" => 0.723,"rhino" => 0.636,"shark" => 0.462,"cat" => 0.361);

    foreach ($animals as $animal => $value) {   
      $result = $this->calc->getAnimalAgex($person, $value);
      $jubilee=$result['next_animal_age'];    
      $delta=$result['delta'];
      while ($delta<=$range) {
          $date = date("j.n.Y",time()+$delta*60*60*24);
          $calendar[$date].="<p><b>$person[name]</b> $jubilee"."<sup>th</sup> $animal age</p>";
          $celebrate[$delta][]="<b> $delta </b> days from now, $date, $person[name] will celebrate $jubilee"."<sup>th</sup> $animal age .<br />";
          $delta = round($delta + (365/$value));  
          $jubilee = $jubilee + 1 ;    
      }
    }  
}

   
  //celebrate round days 
if ($round) {
    $days = $this->calc->getDaysZero($person);
    if ($days == 0) {
      $delta = 0 ;
      $celebrate[$delta][]="<b> $person[name] </b> you have just been born :-) <br />";
    }
     
        $i = 50 ;
        while ($i<$days+$range) {
          $delta = ($i - $days) ;
          $date = date("j.n.Y",time()+$delta*60*60*24);
          if ($delta>0)
            $celebrate[$delta][]="<b> $delta </b> days from now, $date, $person[name] will celebrate round $i days.<br />";
          if ($i>=1000) $i=$i+500;
          if ($i>=300 && $i<1000) $i=$i+100;
          if ($i<300) $i=$i+50;
        }      
  //celebrate round hours  1 000, 5 000, 10 000, ...
    $days = $this->calc->getDaysZero($person);
    $i = 1000 ;
    while ($i/(24)<($days+$range)) {
          $delta = round($i/(24) - $days) ;
          $date = date("j.n.Y",time()+$delta*60*60*24);
          if ($delta>0)
            $celebrate[$delta][]="<b> $delta </b> days from now, $date, $person[name] will celebrate round $i hours.<br />";
          if ($i>=10000) $i=$i+10000;
          if ($i==5000) $i=$i+5000;
          if ($i==1000) $i=$i+4000;
    } 

  //celebrate round minutes     10 000, 50 000, 100 000, 150 000, 200 000, 500 000 ...
    $days = $this->calc->getDaysZero($person);
    $i = 10000 ;
    while ($i/(24*60)<($days+$range)) {
          $delta = round($i/(24*60) - $days) ;
          $date = date("j.n.Y",time()+$delta*60*60*24);
          if ($delta>0)
            $celebrate[$delta][]="<b> $delta </b> days from now, $date, $person[name] will celebrate round $i minutes.<br />";
          if ($i>=1000000) $i=$i+500000;
          if ($i==100000) $i=$i+900000;
          if ($i==50000) $i=$i+50000;
          if ($i==10000) $i=$i+40000;
    } 

   //celebrate round seconds     v milions 1, 10, 50 ...
    $days = $this->calc->getDaysZero($person);
    $i = 1 ;
    while ($i*1000000/(24*60*60)<($days+$range)) {                                                                           
          $delta = round($i*1000000/(24*60*60) - $days) ;
          $date = date("j.n.Y",time()+$delta*60*60*24);
          if ($i==1 && $delta>0) {
            $celebrate[$delta][]="<b> $delta </b> days from now, $date, $person[name] will celebrate round $i milions seconds.<br />YOU ARE A MILLIONAIRE <br />";
            $calendar[$date].="<p><b>$person[name]</b> $i milions seconds MILLIONAIRE!</p>";
          }
          if ($i>1 && $delta>0) {
            $celebrate[$delta][]="<b> $delta </b> days from now, $date, $person[name] will celebrate round $i milions seconds.<br />";
            $calendar[$date].="<p><b>$person[name]</b> $i milions seconds</p>";
          }
          if ($i>=50) $i=$i+50;
          if ($i==10) $i=$i+40;
          if ($i==1) $i=$i+9;
    } 
}  // ukoncenie podmienky if ($round)          

}   // patri k celebrate


 
  ksort($celebrate);

  foreach ($celebrate as $c) {
    foreach ($c as $text) {
      echo $text;
    }
  }  
  

  
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
	   }
     
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
  
  <div class="tab calendar">
<?php 

// list($month,$year)=explode(" ",$select_month);
 if (!$month) {
   $month=11;
   $year=2013;
 }
$day = 1;  
  
//zaciatok KALENDAR
  echo "<b> CALENDAR  for " . date("F Y", mktime(0, 0, 0, $month, $day, $year))."</b><br />"; 
  
  $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);    // zistenie poctu dni v mesiaci
  $first_day = date("N", mktime(0, 0, 0, $month, 1, $year));
  $rows =  ceil(($first_day - 1 + $days_in_month)/7) ;  
  
  //hlavicka kalendara
  $table_width = 100 ;
  $table_height = 40 ;
/*  
$prevY = $nextY = $year;
$prevM = $nextM = $month;

// nastaveni odkazu pro predchadzajuci a nasledujuci mesic / rok - este nedorobea  
if ($month - 1 < 1) { $prevM = 12; $prevY--;} else {$prevM = $month - 1;}; 
if ($month + 1 > 12){ $nextM = 1; $nextY++;} else {$nextM = $month + 1;};  

$prev = "<a href='?month=".($prevM)."&year=".($prevY)."'><<</a>";
$next = "<a href='?month=".($nextM)."&year=".($nextY)."'>>></a>";
 */ 
  echo "<table border=1 cellpadding=5 cellspacing=1>";
  echo "<tr><th colspan=7> ".date("F Y", mktime(0, 0, 0, $month, $day, $year))."</th></tr>";
  echo "<tr>
          <th width=".$table_width.">Monday</th>
          <th width=".$table_width.">Tuesday</th>
          <th width=".$table_width.">Wednesday</th>
          <th width=".$table_width.">Thursday</th>
          <th width=".$table_width.">Friday</th>
          <th width=".$table_width.">Saturday</th>
          <th width=".$table_width.">Sunday</th>
        </tr>";
  
  //telo kalendara
  echo "<tr>" ;
  // cyklus vypise prazdne bunky
  $blank_cell = 1;
  while ($blank_cell < $first_day)
    {
    echo "<td></td>";
    $blank_cell++;                         
    }
  
  //cykly dorobia tabulku a vpisu cisla dni  
  $day_num = 1 ;
  for($a=0;$a<$rows;$a++)     //opakovanie riadkov </tr><tr> - ukoci riadok a zacne novy
  { 
    while ($blank_cell + $day_num < 9+7*$a) // 9 je 7+2, 7 pocet dni v tyzni, 2-aby to pasovalo (blank_cell aj day_num zacina od 1)  (alebo <= 8)
    {
          if ($day_num <= $days_in_month)  //podmienka zistuje ci je uz koniec mesiaca, ak ano da uz len prazdne bunky
          {       
              $date=date("j.n.Y",mktime(0,0,0,$month,$day_num,$year));
              echo "<td height=$table_height valign=top> $day_num<br />$calendar[$date]</td>";   //vpise cislo dna a robi tabulku - vlastne to najdolezitejsie
           }
          else  echo "<td></td>";
      $day_num++;
    }
    echo "</tr><tr>"; 
   //if ($first_day_x = 7)
   //   $day_num--;
  } 
  echo "</tr>" ;
  echo "</table>" ;
  
//koniec KALENDAR

?>
  
  

</div> 
	<div class="start-over"><span id="start-over"><?=lang('result.start.over')?></span></div>
</div>