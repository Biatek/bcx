<?php

class Page extends Controller {

	function Page()
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
	
	function read($id = null) {
		if (!$id) {
			redirect('');
		}
		$this->load->model('m_stranka');
		if (is_numeric($id)) {
			$data['content']['stranka'] = $this->m_stranka->getByPk($id);
		}
		else {
			$data['content']['stranka'] = $this->m_stranka->getByPath($id);
		}
		if (!$data['content']['stranka']) {
			$this->lang->load('error');
			$this->output->set_status_header('404');
			$data['title'] = 'Page not found';
			$data['view'] = 'error404';
			$data['content'] = NULL;
			$data['hide_menu'] = TRUE;
		}
		else {
			$data['view'] = 'stranka';	
			$data['title'] = $data['content']['stranka']['name'];	
			$data['keywords'] = $data['content']['stranka']['keywords'];
			$data['description'] = word_limiter(strip_tags($data['content']['stranka']['text'], 40));
		}
		$this->load->view('master', $data);
	}
}