<?php

class Calculator extends Controller {

	function Calculator()
	{
		parent::Controller();
		date_default_timezone_set('Europe/London');
		$this->lang->load('calc');
		$this->lang->load('master');
		$this->lang->load('result');
		$this->lang->load('tabs');
		$this->lang->load('blog');
		$this->load->model('m_stranka');
		$this->load->model('m_front');				
	}
	
	function hash($hash) {
	  //print_r(unserialize($this->m_calc->get($hash)));die();
	  $data = $this->m_calc->get($hash);
  	return $this->_calculate($data['data'], TRUE, $hash);
	}

	function _calculate($dates, $calc = TRUE, $hash) {
	
    $data['calculate'] = FALSE;
		$data['title'] = null;
		
		$data['content']['dates'] = $dates;
		
		$data['content']['seconds'] = $this->getInterval(1, 60);      
    $data['content']['minutes'] = $this->getInterval(1, 60);      
    $data['content']['hours'] = $this->getInterval(1, 24);
		$data['content']['days'] = $this->getInterval(1, 31 );
		$data['content']['months'] = $this->_months_list();
		$data['content']['years'] = $this->getInterval(date('Y'), 1900);
		
		$data['content']['selected']['day'] = date('j');
		$data['content']['selected']['month'] = date('n');
		
		$data['view'] = 'calculator';
		
		if ($calc) {
			$results = new Calc($dates);
			$data['persons'] = $dates;
			$data['calculate'] = TRUE;
			$data['title'] = $this->load->view('title', $data, TRUE);
		}
		else {
			$data['content']['articles'] = $this->m_obsah->getByParams(array('front' => 1, 'lang' => $this->lang->lang()));
		}
		
		$data['result'] = null;
		
		// blogs
		$blogs = array();
		$blogs['content'] = $this->m_blog->getAll(10);
		$data['right'] = $this->load->view('box-blog', $blogs, TRUE);
		
		// front page texts
		$data['content']['front'] = $this->m_front->getByLang($this->lang->lang());
		$data['content']['hash'] = $hash;
		$this->load->view('master', $data);
	}
	
	function index()
	{
	  $hash = NULL;
		$dates = null;
		$calc = TRUE;
		if ($_POST) {
		  if (isset($_POST['reset'])) {
  		  $this->reset();
		  }
		  else {
		    $hash = $this->_hash();
		    $dates = $this->getPostDates();
		    $this->session->set_userdata(array('dates' => $dates));

  		  $this->m_calc->save($hash, $dates);
		  }
		}
		elseif ($this->session->userdata('dates')) {
			$dates = $this->session->userdata('dates');
		}
		else {
			$calc = FALSE;
		}
		
		return $this->_calculate($dates, $calc, $hash);		
	}
	
	function certificate() {
		if (!$this->session->userdata('dates')) {
			redirect('');
		}
		$this->load->helper('dompdf');
		$this->lang->load('pdf');
		$dates = $this->session->userdata('dates');
		$data['persons'] = $dates;
		$html = $this->load->view('certificate', $data, TRUE);
		$html = mb_convert_encoding($html, "iso-8859-2", "utf8");
		pdf_create($html, 'bc_certificate');
		//echo $html;
	}
	
	function reset() {
		$this->session->unset_userdata('dates');
		redirect('');
	}
	
	function get_date_row($id) {
		// this function return table row html via ajax back to the jquery
		$data['days'] = $this->getInterval(1, 31);
		$data['months'] = $this->_months_list();
		$data['years'] = $this->getInterval(date('Y'), 1900);
		$data['selected'] = array(
			'day' => date('j'),
			'month' => date('n'),
			'year' => date('Y'),
		);
		
		$data['i'] = $id;
		echo $this->load->view('dates_row', $data);

	}
	
	function getInterval($start, $limit) {
		if ($start < $limit) {
			for ($i=$start;$i<=$limit;$i++) {
				$data[$i] = $i;
			}
		}
		if ($start > $limit) {
			for ($i=$start;$i>=$limit;$i--) {
				$data[$i] = $i;
			}
		}
		return $data;		
	}
	
	function _months_list() {
		for ($i=1;$i<13;$i++) {
			$data[$i] = lang('calc.'.strtolower(date( 'F', mktime(0, 0, 0, $i) )));
		}
		return $data;
	}
	
	function _hash() {
		$letters = '1234567890abcdefghijklomnopqrstuvwxyz';
		$hash = '';
		for ($i=0;$i<10;$i++) {
			$hash .= substr($letters, rand(0,35), 1);
		}
		return $hash;
	}
	
	function getPostDates() {
		$dates = $_POST;
		$date = array();
		if ($dates) {
			foreach ($dates['month'] as $id => $month) {
				if ($dates['name'][$id]) {
					$date[$id]['month'] = $month;
					$date[$id]['year'] = $dates['year'][$id];
					$date[$id]['day'] = $dates['day'][$id];

					$date[$id]['name'] = $dates['name'][$id];
				}
			}
		}
		return $date;
	}
	
}