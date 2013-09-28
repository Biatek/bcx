<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>     
		<title><?=$name?$name.' | ':''?><?=lang('master.title')?></title>     
	
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	
		<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/pdf.css">
	</head>

	<body>
		<?php //$person = array('name' => $name, 'day' => $day, 'month' => $month, 'year' => $year) ?>
		<?php foreach ($persons as $person) { ?>
			<div class="container" style="page-break-before:auto;">
				<div class="header"><img src="./css/images/pdf_header.png" /></div>
				<div class="content">
					<div class="top">
						<div class="name"><?=lang('pdf.name')?>: <strong><?=$person['name']?></strong></div>
						<div class="dob"><?=lang('pdf.dob')?>: <strong><?=date(lang('master.dateformat'), strtotime($person['day'].'.'.$person['month'].'.'.$person['year']))?></strong></div>
					</div>
					<div class="main">
						<h3>Birthday</h3>
						<div class="birthday">
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
								<?=lang('result.half.birthday.will')?> <?=date(lang('master.dateformat'), $half['half'])?>
							<?php } elseif ($half['days'] > 0) { ?>
								<?=lang('result.half.birthday.was')?> <?=date(lang('master.dateformat'), $half['half'])?>
							<?php } elseif ($half['days'] == 0) { ?>
								<?=lang('result.half.birthday.today')?>
							<?php } ?>
						</div>
						<h3>Planets</h3>
						<div class="planets">
							<?=lang('result.planetes.if')?><strong><?=lang('planetes.mercury')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 87.96934)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 87.96934))?>.<br />
							<?=lang('result.planetes.if')?><strong><?=lang('planetes.venus')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 224.70096)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 224.70096))?>.<br />
							<?=lang('result.planetes.if')?><strong><?=lang('planetes.mars')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 686.971)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 686.971))?>.<br />
							<?=lang('result.planetes.if')?><strong><?=lang('planetes.jupiter')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 4335.3545)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 4335.3545))?>.<br />
							<?=lang('result.planetes.if')?><strong><?=lang('planetes.saturn')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 10756.1995)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 10756.1995))?>.<br />
							<?=lang('result.planetes.if')?><strong><?=lang('planetes.uranus')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 30707.4896)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 30707.4896))?>.<br />
							<?=lang('result.planetes.if')?><strong><?=lang('planetes.neptune')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 60190)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 60190))?>.<br />
							<?=lang('result.planetes.if')?><strong><?=lang('planetes.pluto')?></strong><?=lang('result.planetes.then')?><?=$this->calc->getPlanetesAge($person, 90613.3055)?><?=lang('result.planetes.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getPlanetesBirthday($person, 90613.3055))?>.<br />
						</div>
						<h3>Animals</h3>
						<div class="animals">
							<?=lang('result.animals.if')?><strong><?=lang('animal.dog')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.143)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.143))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.turtle')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 2.197)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 2.197))?>.<br />
			        <?=lang('result.animals.if')?><strong><?=lang('animal.lion')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.419)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.419))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.elephant')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 1.127)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 1.127))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.aligator')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.954)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.954))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.orangutan')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.853)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.853))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.ostrich')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.853)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.853))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.camel')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.723)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.723))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.parrot')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.708)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.708))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.rhinoceros')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.636)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.636))?>.<br />
							<?=lang('result.animals.if')?><strong><?=lang('animal.shark')?></strong><?=lang('result.animals.then')?><?=$this->calc->getAnimalAge($person, 0.462)?><?=lang('result.animals.celebrate')?><?=date(lang('master.dateformat'), $this->calc->getAnimalBirthday($person, 0.462))?>.<br />
						</div>
					</div>
				</div>
				<div class="footer"><?=lang('pdf.footer')?><br /><a href="http://www.birthdaycalculators.com">www.birthdaycalculators.com</a></div>
			</div>
		<?php } ?>
	</body>
</html>
			