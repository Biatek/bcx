<?php

class Person extends Controller {

	function Person()
	{
		parent::Controller();
		date_default_timezone_set('Europe/London');
		$this->lang->load('calc');
		$this->lang->load('master');
		$this->lang->load('result');
		$this->lang->load('tabs');				
	}
	
	function index() {
		$this->load->helper('text');
		$this->load->model('m_person');
		$data['content']['persons'] = $this->m_osobnosti->getAll($this->language->lang());
		$data['view'] = 'persons';
		$data['title'] = 'Persons';
		$this->load->view('master', $data);
	}
	
	function read($id = null) {
		if (!$id) {
			redirect('');
		}
		$this->load->model('m_osobnosti');
		if (is_numeric($id)) {
			$data['content']['person'] = $this->m_osobnosti->getByPk($id);
		}
		else {
			$data['content']['person'] = $this->m_osobnosti->getByPath($id);
		}
		$data['title'] = $data['content']['person']['name'];
		$data['view'] = 'person';		
		$this->load->view('master', $data);
	}
}