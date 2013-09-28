<?php

class Osobnost extends Controller {

	function Osobnost()
	{
		parent::Controller();
		date_default_timezone_set('Europe/London');
		$this->lang->load('calc');
		$this->lang->load('master');
		$this->lang->load('result');
		$this->lang->load('tabs');				
	}
	
	function index() {
		redirect('');
	}
	
	function popup($row) {
	  $form_kat = isset($_POST['kategorie'])?$_POST['kategorie']:array();
	  $tmp_kat = NULL;
	  
		$this->load->model('m_osobnosti');
		$this->load->model('m_kategorie');
		$osobnosti = $this->m_osobnosti->getByParams(array('lang' => $this->lang->lang()));

		if ($form_kat) {
  		foreach ($osobnosti as $key => $osobnost) {
    		$osobnost_kategorie = array();
    		$tmp_kat = array();
    		foreach ($osobnost['kategorie'] as $kat) {
      		$tmp_kat[] = $kat['kategoria_id'];
    		}
    		sort($tmp_kat);
    		sort($form_kat);
    		foreach ($form_kat as $checked) {
      		if (!in_array($checked, $tmp_kat)) {
        		unset ($osobnosti[$key]);
      		}
    		}
  		}
		}
		$kategorie = $this->m_kategorie->get(array('lang' => $this->lang->lang()));
		echo $this->load->view('popup', array('osobnosti' => $osobnosti, 'kategorie' => $kategorie, 'rowid' => $row, 'checked' => $form_kat), TRUE);
	}
}