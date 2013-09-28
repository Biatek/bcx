<?php

class Blog extends Controller {

	function Blog()
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
		$this->load->model('m_blog');
		$data['content']['blogs'] = $this->m_blog->getAll($this->language->lang());
		$data['view'] = 'blogs';
		$data['title'] = 'Blog';
		$this->load->view('master', $data);
	}
	
	function read($id = null) {
		if (!$id) {
			redirect('blog');
		}
		$this->load->model('m_blog');
		if (is_numeric($id)) {
			$data['content']['blog'] = $this->m_blog->getByPk($id);
		}
		else {
			$data['content']['blog'] = $this->m_blog->getByPath($id);
		}
		$data['title'] = $data['content']['blog']['name'];
		$data['view'] = 'blog';
		$data['keywords'] = $data['content']['blog']['keywords'];
		$data['description'] = word_limiter(strip_tags($data['content']['blog']['text'], 40));		
		$this->load->view('master', $data);
	}
}