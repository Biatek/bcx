<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2010, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Calculator Class
 *
 * This class enables the creation of calendars
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/calendar.html
 */
class Calc {
	
	/*
	 *	premenna $dates sa v kode pouzije ako $this->dates a obsahuje pole datumov v tomto tvare
	 *	napriklad
	 *	$dates = array(
				[0] = array(
					'name'	=>	petiar,
					'day'		=>	7,
					'month'	=>	5,
					'year'	=>	1977
					),
				[1] = array(
					'name'	=>	jozko,
					'day'		=>	6,
					'month'	=>	12,
					'year'	=>	1998
				)
			)
			
			Navratova hodnota z funkcii bude vzdy pole, pretoze mien moze byt viacej, takze prve meno bude vzdy
			$result[0]['name']...
	*/
	
	public $dates = array();
	public $count = 0;
	public $result = array();
	
	const GRANULARITY_DAY = 0;
	const GRANULARITY_SECOND = 1;
	
	public function Calc($dates = array()) {
		
		$this->CI =& get_instance();
		$this->dates = $dates;
		log_message('debug', "Calculator Class Initialized");
	}
	
	// tato funkcia vrati pocet zadanych ludi
	
	public function getResult() {
		$results = array();
		foreach ($this->dates as $date) {
			$results = $date;			
			foreach (get_class_methods('Calc') as $function) {
				if (substr($function, 0, 10) == '_calculate') {
					$key = strtolower(substr($function, 10));
					$classname = 'Calc';
					$results[$key] = call_user_func(array($classname, $function), $date);
				}
			}
			$this->result[] = $results;
		}
		return $this->result;
	}
	
	function getCount($dates) {
		return count($dates);
	}
	
	function getSeconds($date) {
		return $this->_getNow() - $this->_getTimestamp($date);
	}
	
	function getMinutes($date) {
		return floor(($this->_getNow() - $this->_getTimestamp($date))/60);
	}
	
	function getHours($date) {
		return floor(($this->_getNow() - $this->_getTimestamp($date))/3600);
	}
	
	function getDays($date) {
		return floor(($this->_getNow() - $this->_getTimestamp($date))/(60*60*24)-0.5);
	}

	function getWeeks($date) {
		return floor(($this->_getNow() - $this->_getTimestamp($date))/(60*60*24*7));
	}
	
	function getMonths($date) {
		return floor(($this->_getNow() - $this->_getTimestamp($date))/(60*60*24*30.4141));
	}
	
	function getYears($date) {
		if (($date['month'] == date('n')) && ($date['day'] == date('j'))) {
			$result = date('Y') - $date['year'];
		}
		else {
			$result = floor(($this->_getNow() - $this->_getTimestamp($date))/(60*60*24*365.2422));
		}
		return $result;
	}
	
	function getTotalDays($dates) {
		$total = 0;
		foreach ($dates as $date) {
			$total = $total + $this->getDays($date);
		}
		return $total;
	}
	
	function getTotalYears($dates) {
		$total = 0;
		foreach ($dates as $date) {
			$total = $total + $this->getYears($date);
		}
		return $total;
	}
	
	function getTotalYearsCombinedBirthday($dates) {
		return round(($this->getTotalDays($dates))/365.2422);
	}
	
	function getCombinedBirthday($dates) {
		return $this->_getNow(self::GRANULARITY_DAY) + ((365.2422-fmod($this->getTotalDays($dates), 365.2422))/$this->getCount($dates))*24*60*60;
	}
	
	function getNextBirthday($time) {
	  $turning = $this->getYears($time) + 1;
  	return $this->_getTimestamp($time) + $turning*365.2422*24*60*60;
	}
	
	function getBirthdayDelta($time) {
		return round(($time - $this->_getNow(self::GRANULARITY_DAY))/(24*60*60), 2);
	}
	
	function getBirthdayDaysGoing($dates) {
		return ceil(fmod($this->getTotalDays($dates), 365.2422));
	}
	
	function getDayNumber($date) {
		return date('w', $this->_getTimestamp($date));
	}
	
	function getHalfBirthday($date) {
		$days = round((strtotime(date("Y-m-d")) - strtotime(date('Y').'-'.$date['month'].'-'.$date['day'])) / (60 * 60 * 24));
		$half = 183;
		$result = array();
		if ($days > $half) {
			$result = array(
				'half' => strtotime(date('Y').'-'.$date['month'].'-'.$date['day']) + ($half * 86400),
				'days' => $days - $half,
			);
		}
		elseif (($days > 0) && ($days <= $half)) {
			$result = array(
				'half' => strtotime(date('Y').'-'.$date['month'].'-'.$date['day']) + ($half * 86400),
				'days' => $days - $half,
			);
		}
		elseif (($days < 0) && (abs($days) <= $half)) {
			$result = array(
				'half' => strtotime((date('Y')-1).'-'.$date['month'].'-'.$date['day']) + ($half * 86400),
				'days' => $half - abs($days),
			);
		}
		elseif (($days < 0) && (abs($days) > $half)) {
			$result = array(
				'half' => strtotime(date('Y').'-'.$date['month'].'-'.$date['day']) + ($half * 86400),
				'days' => $half - abs($days),
			);
		}
		elseif ($days == 0) {
			$result = array(
				'half' => time() + ($half * 86400),
				'days' => $half,
			);
		}
		return $result;	
	}
	
  function getPathNumber($date) {
    $path = $date['day']+ $date['month'] + $date['year'] ;
    $path="$path" ;
    $path = $path[0] + $path[1] + $path[2] + $path[3];    
    if ($path >= 10) { 
      $path="$path" ;  //musi to tam byt     
      $path = $path[0] + $path[1] ;
    }
    return $path ;
  }
  
  
	function getAnimalBirthday($date, $ratio = 1) {
		$age = ($this->_getNow() - $this->_getTimestamp($date))/(60*60*24*365.2422);
		$animalAge = $age*$ratio;
		$nextAnimalAge = ceil($animalAge);
		$animalDifference = $nextAnimalAge - $animalAge;
		$realDifference = $animalDifference/$ratio;
		$realDays = round($realDifference * 365.24);
		$realDate = strtotime("+".$realDays." days");
		return $realDate;
	}
	
	function getAnimalAge($date, $ratio = 1) {
		$age = ($this->_getNow() - $this->_getTimestamp($date))/(60*60*24*365.2422);
		$animalAge = ceil($age*$ratio);
		return $animalAge;
	}
	
	function getPlanetesBirthday($date, $ratio = 1) {
		$age = ($this->_getNow() - $this->_getTimestamp($date))/(60*60*24); // age in days
		$planeteAge = $age/$ratio;
		$nextPlaneteAge = ceil($planeteAge);
		//$realDays = round(365.24 - floor($age/floor($planeteAge)));
		$planeteDifference = $nextPlaneteAge - $planeteAge;
		$realDifference = $planeteDifference*$ratio;
		$realDays = round($realDifference);

		$realDate = strtotime("+".$realDays." days");
		return $realDate;
	}
	
	function getPlanetesAge($date, $ratio = 1) {
		$age = ($this->_getNow() - $this->_getTimestamp($date))/(60*60*24); // age in days
		$planeteAge = $age/$ratio;
		$nextPlaneteAge = ceil($planeteAge);
		return $nextPlaneteAge;
	}
	
	function getWhatever() {
		// vypocet
		
		// vysledok bude $result['whatever']
	}
	
	function _getTimestamp($date) {
		return strtotime($date['year'].'-'.sprintf('%02d', $date['month']).'-'.sprintf('%02d', $date['day']));
	}
	
	function _getNow($granularity = self::GRANULARITY_SECOND) {
		$time = null;
		if ($granularity == self::GRANULARITY_SECOND) {
			$time = time();
		}
		else {
			$time = strtotime(date('Y').'-'.date('m').'-'.date('d'));
		}
		return $time;
	}
	
	function cmpCelebrateNowDates($date1, $date2) {
  	return ($date1['days'] > $date2['days'])? 1 : -1;
	}
}