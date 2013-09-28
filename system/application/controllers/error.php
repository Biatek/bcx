<?php
class Error extends Controller {
 
	function error_404()
	{
		$this->lang->load('error');
		$this->output->set_status_header('404');
		$data['title'] = 'Page not found';
		$data['view'] = 'error404';
		$data['content'] = NULL;
		$data['hide_menu'] = TRUE;
		$this->load->view('master', $data);
	}
}