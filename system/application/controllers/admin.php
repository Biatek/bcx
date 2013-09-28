<?php

class Admin extends Controller {

	function Admin()
	{
		parent::Controller();
		date_default_timezone_set('Europe/Bratislava');
		$this->load->library('form_validation');
		$this->lang->load('calc');
		$this->lang->load('master');
		$this->lang->load('result');
		$this->lang->load('tabs');
		$this->load->model('m_blog');
		$this->load->model('m_osobnosti');
		$this->load->model('m_osobnosti_image');
	}
	
	function index($redirect = 'admin')
	{
		if (!$this->session->userdata('admin')) {
			$data['view'] = 'login';
		}
		else {
			redirect('admin/obsah');
		}
		$data['redirect'] = $redirect;
		$data['content'] = NULL;
		$data['messages'] = $this->messages->get();
		$data['title'] = 'Login';
		$this->load->view('master', $data);
	}
	
	function login() {
		if (!$this->input->post('submit')) {
			redirect('admin');
		}
		else {
			$query = $this->db->get_where('users', array(	'username' => $this->input->post('username'),
															'password' => sha1($this->input->post('password'))));
			$result = $query->row_array();
			if (count($result)) {
				$this->session->set_userdata('admin', TRUE);
			}
			else {
				$this->messages->add('Nesprávne heslo', 'error');
			}
			redirect(trim($this->input->post('redirect'), "/"));
		}		
	}
	
	function logout() {
		$this->session->set_userdata('admin', FALSE);
		$this->messages->add('Odhlásenie prebehlo úspešne.', 'success');
		redirect('admin');
	}
	
	function obsah($op = null, $id = null) {
		$data['title'] = 'Obsah';
		if (!$this->session->userdata('admin')) {
			redirect('admin');
		}
		$data['content'] = null;
		switch ($op) {
			case 'add':
				$data['content']['files'] = null;
				$data['view'] = 'admin/obsah_edit';
				break;
			case 'edit':
				$data['content']['obsah'] = $this->m_obsah->getByPk($id);
				$files['folder'] = 'obsah';
				$files['files'] = $this->m_image->getByObsah($id);
				$data['content']['files'] = $this->load->view('admin/files', $files, TRUE);
				$data['view'] = 'admin/obsah_edit';
				break;
			case 'confirm':
				$data['content']['obsah'] = $this->m_obsah->getByPk($id);
				$data['view'] = 'admin/obsah_confirm';
				break;
			case 'delete':
				$id = $this->input->post('id');
				if ($this->m_obsah->delete($id)) {
					$this->messages->add('Obsah bol úspešne zmazaný.', 'success');
				}
				else {
					$this->messages->add('Pri mazaní obsahu nastala chyba, kontaktujte administrátora.', 'error');
				}
				redirect ('admin/obsah');
				break;
			case 'save':
				if ($this->input->post('cancel')) {
					redirect('admin/obsah');
				}
				$this->form_validation->set_rules('name', 'Názov', 'required');
				$this->form_validation->set_rules('text', 'Text', 'required');
				$this->form_validation->set_rules('image', 'Obrázok', 'callback_dummy');
				$this->form_validation->set_rules('id', 'ID', 'callback_dummy');
				$this->form_validation->set_rules('path', 'Názov', 'alpha_dash');				
				$this->form_validation->set_rules('lang', 'Jazyk', 'callback_dummy');
				$this->form_validation->set_rules('keywords', 'Kľúčové slová', 'callback_dummy');

				if (($this->form_validation->run() == FALSE))
				{
					$data['view'] = 'admin/obsah_edit';
					$files['files'] = $this->input->post('image');
					$files['folder'] = 'obsah';
					$data['files'] = $this->load->view('admin/files', $files, TRUE);
				}
				else {
					$obsah['name'] = $this->input->post('name');
					$obsah['text'] = $this->input->post('text');
					$obsah['images'] = $this->input->post('image');
					$obsah['lang'] = $this->input->post('lang');
					$obsah['path'] = $this->input->post('path');					
					$obsah['published'] = $this->input->post('published');
					$obsah['front'] = $this->input->post('front');
					$obsah['keywords'] = $this->input->post('keywords');
					
					if ($this->input->post('id')) {
						$blog = $this->m_blog->getByPk($this->input->post('id'));
						if (($this->input->post('published')) && (!$blog['published'])) {
							$obsah['created'] = time();
						}
					}
					else {
						if (($this->input->post('published'))) {
							$obsah['created'] = time();
						}
					}
					$obsah['timestamp'] = time();
					if ($this->input->post('id')) {
						if ($this->m_obsah->update($this->input->post('id'), $obsah)) {
							$this->messages->add('Údaje boli úspešne uložené.');
							redirect('admin/obsah');
						}						
					}
					else {
						if ($this->m_obsah->insert($obsah)) {
							$this->messages->add('Údaje boli úspešne uložené.');
							redirect('admin/obsah');
						}						
					}
					$this->messages->add('Pri aktualizácii údajov nastala chyba, kontaktujte administrátora.', 'error');
					redirect('admin/obsah');				
				}
			break;
			default:
				$data['content']['obsah'] = $this->m_obsah->getByParams(array());
				$data['view'] = 'admin/obsah_list';
			break;
		}		
		$data['messages'] = $this->messages->get();
		$this->load->view('master', $data);
	}

	function blocks($op = null, $id = null) {
		$data['title'] = 'Bloky';
		if (!$this->session->userdata('admin')) {
			redirect('admin');
		}
		$data['content'] = null;
		switch ($op) {
			case 'add':
				$data['content']['files'] = null;
				$data['view'] = 'admin/blocks_edit';
				break;
			case 'edit':
				$data['content']['block'] = $this->m_blocks->getByPk($id);
				$files['folder'] = 'blocks';
				$files['files'] = $this->m_blocks_image->getByObsah($id);
				$data['content']['files'] = $this->load->view('admin/files', $files, TRUE);
				$data['view'] = 'admin/blocks_edit';
				break;
			case 'confirm':
				$data['content']['block'] = $this->m_blocks->getByPk($id);
				$data['view'] = 'admin/blocks_confirm';
				break;
			case 'delete':
				$id = $this->input->post('id');
				if ($this->m_blocks->delete($id)) {
					$this->messages->add('Blok bol úspešne zmazaný.', 'success');
				}
				else {
					$this->messages->add('Pri mazaní bloku nastala chyba, kontaktujte administrátora.', 'error');
				}
				redirect ('admin/blocks');
				break;
			case 'save':
				if ($this->input->post('cancel')) {
					redirect('admin/blocks');
				}
				$this->form_validation->set_rules('name', 'Názov', 'required');
				$this->form_validation->set_rules('text', 'Text', 'required');
				$this->form_validation->set_rules('location', 'Umiestnenie', 'callback_dummy');
				$this->form_validation->set_rules('image', 'Obrázok', 'callback_dummy');
				$this->form_validation->set_rules('id', 'ID', 'callback_dummy');
				$this->form_validation->set_rules('lang', 'Jazyk', 'callback_dummy');

				if (($this->form_validation->run() == FALSE))
				{
					$data['view'] = 'admin/blocks_edit';
					$files['files'] = $this->input->post('image');
					$files['folder'] = 'blocks';
					$data['files'] = $this->load->view('admin/files', $files, TRUE);
				}
				else {
					$block['name'] = $this->input->post('name');
					$block['text'] = $this->input->post('text');
					$block['images'] = $this->input->post('image');
					$block['lang'] = $this->input->post('lang');
					$block['location'] = $this->input->post('location');					
					
					$block['timestamp'] = time();
					
					if ($this->input->post('id')) {
						if ($this->m_blocks->update($this->input->post('id'), $block)) {
							$this->messages->add('Údaje boli úspešne uložené.');
							redirect('admin/blocks');
						}						
					}
					else {
						if ($this->m_blocks->insert($block)) {
							$this->messages->add('Údaje boli úspešne uložené.');
							redirect('admin/blocks');
						}						
					}
					$this->messages->add('Pri aktualizácii údajov nastala chyba, kontaktujte administrátora.', 'error');
					redirect('admin/blocks');				
				}
			break;
			default:
				$data['content']['blocks'] = $this->m_blocks->getByParams(array());
				$data['view'] = 'admin/blocks_list';
			break;
		}		
		$data['messages'] = $this->messages->get();
		$this->load->view('master', $data);
	}

	function osobnosti($op = null, $id = null) {
		$data['title'] = 'Osobnosti';
		if (!$this->session->userdata('admin')) {
			redirect('admin');
		}
		$this->load->model('m_kategorie');
		$data['content'] = null;
		switch ($op) {
			case 'add':
				$data['content']['files'] = null;
				$data['content']['months'] = range(1,12);
				$data['content']['days'] = range(1,31);
				$data['content']['years'] = range(1000,date('Y'));				
				$data['view'] = 'admin/osobnosti_edit';
				$data['content']['kategorie'] = $this->m_kategorie->get(array('content' => 'osobnosti'));
				$data['content']['kategorie_selected'] = array();
				break;
			case 'edit':
				$data['content']['osobnost'] = $this->m_osobnosti->getByPk($id);
				$data['content']['osobnost']['day'] = date('d', $data['content']['osobnost']['dob']);
				$data['content']['osobnost']['month'] = date('m', $data['content']['osobnost']['dob']);
				$data['content']['osobnost']['year'] = date('Y', $data['content']['osobnost']['dob']);
				$files['folder'] = 'osobnosti';
				$files['files'] = $this->m_osobnosti_image->getByOsoba($id);
				$data['content']['files'] = $this->load->view('admin/files', $files, TRUE);
				$data['content']['kategorie'] = $this->m_kategorie->get(array('content' => 'osobnosti'));
				
				$data['content']['kategorie_selected'] = array();
				foreach($data['content']['osobnost']['kategorie'] as $kat) {
					$data['content']['kategorie_selected'][] = $kat['kategoria_id'];
				}
				$data['view'] = 'admin/osobnosti_edit';
				break;
			case 'confirm':
				$data['content']['obsah'] = $this->m_obsah->getByPk($id);
				$data['view'] = 'admin/osobnosti_confirm';
				break;
			case 'delete':
				$id = $this->input->post('id');
				if ($this->m_sobnosti->delete($id)) {
					$this->messages->add('Osobnosť bola úspešne zmazaná.', 'success');
				}
				else {
					$this->messages->add('Pri mazaní osobnosti nastala chyba, kontaktujte administrátora.', 'error');
				}
				redirect ('admin/osobnosti');
				break;
			case 'save':
				if ($this->input->post('cancel')) {
					redirect('admin/osobnosti');
				}
				$this->form_validation->set_rules('name', 'Meno', 'required');
				$this->form_validation->set_rules('description', 'Popis', 'callback_dummy');
				$this->form_validation->set_rules('image', 'Obrázok', 'callback_dummy');
				$this->form_validation->set_rules('id', 'ID', 'callback_dummy');
				$this->form_validation->set_rules('path', 'Názov', 'alpha_dash');				
				$this->form_validation->set_rules('lang', 'Jazyk', 'callback_dummy');
				$this->form_validation->set_rules('day', 'Deň narodenia', 'callback_dummy');
				$this->form_validation->set_rules('month', 'Mesiac narodenia', 'callback_dummy');
				$this->form_validation->set_rules('year', 'Rok narodenia', 'callback_dummy');
				$this->form_validation->set_rules('kategorie', 'Kategórie', 'required');

				if (($this->form_validation->run() == FALSE))
				{
					$data['view'] = 'admin/osobnosti_edit';
					$files['files'] = $this->input->post('image');
					$files['folder'] = 'osobnosti';
					$data['files'] = $this->load->view('admin/files', $files, TRUE);
					$data['content']['kategorie'] = $this->m_kategorie->get(array('content' => 'osobnosti'));
					$data['content']['kategorie_selected'] = $this->input->post('kategorie');
				}
				else {
					$osobnost['name'] = $this->input->post('name');
					$osobnost['description'] = $this->input->post('description');
					$osobnost['images'] = $this->input->post('image');
					$osobnost['lang'] = $this->input->post('lang');
					$osobnost['path'] = $this->input->post('path');					
					$osobnost['dob'] = mktime(0, 0, 0, $this->input->post('month'), $this->input->post('day'), $this->input->post('year'));
					$osobnost['kategorie'] = $this->input->post('kategorie');										
					
					$osobnost['timestamp'] = time();
					if ($this->input->post('id')) {
						if ($this->m_osobnosti->update($this->input->post('id'), $osobnost)) {
							$this->messages->add('Údaje boli úspešne uložené.');
							redirect('admin/osobnosti');
						}						
					}
					else {
						if ($this->m_osobnosti->insert($osobnost)) {
							$this->messages->add('Údaje boli úspešne uložené.');
							redirect('admin/osobnosti');
						}						
					}
					$this->messages->add('Pri aktualizácii údajov nastala chyba, kontaktujte administrátora.', 'error');
					redirect('admin/osobnosti');				
				}
			break;
			default:
				$data['content']['osobnosti'] = $this->m_osobnosti->getByParams(array());
				$data['view'] = 'admin/osobnosti_list';
			break;
		}		
		$data['messages'] = $this->messages->get();
		$this->load->view('master', $data);
	}


	function stranka($op = null, $id = null) {
		$data['title'] = 'Stránky';
		$data['content'] = null;
		if (!$this->session->userdata('admin')) {
			redirect('admin');
		}
		switch ($op) {
			case 'add':
				$data['content']['files'] = null;
				$data['view'] = 'admin/stranka_edit';
				break;
			case 'edit':
				$data['content']['stranka'] = $this->m_stranka->getByPk($id);
				$files['folder'] = 'stranka';
				$files['files'] = $this->m_stranka_image->getByStranka($id);
				$data['content']['files'] = $this->load->view('admin/files', $files, TRUE);
				$data['view'] = 'admin/stranka_edit';
				break;
			case 'confirm':
				$data['content']['stranka'] = $this->m_stranka->getByPk($id);
				$data['view'] = 'admin/stranka_confirm';
				break;
			case 'delete':
				$id = $this->input->post('id');
				if ($this->m_stranka->delete($id)) {
					$this->messages->add('Stránka bola úspešne zmazaná.', 'success');
				}
				else {
					$this->messages->add('Pri mazaní obsahu nastala chyba, kontaktujte administrátora.', 'error');
				}
				redirect ('admin/stranka');
				break;
			case 'save':
				if ($this->input->post('cancel')) {
					redirect('admin/stranka');
				}
				$this->form_validation->set_rules('name', 'Názov', 'required');
				$this->form_validation->set_rules('path', 'Názov', 'alpha_dash');
				$this->form_validation->set_rules('text', 'Text', 'required');
				$this->form_validation->set_rules('image', 'Obrázok', 'callback_dummy');
				$this->form_validation->set_rules('published', 'Publivaná', 'callback_dummy');
				$this->form_validation->set_rules('id', 'ID', 'callback_dummy');
				$this->form_validation->set_rules('keywords', 'Kľúčové slová', 'callback_dummy');

				if (($this->form_validation->run() == FALSE))
				{
					$data['view'] = 'admin/stranka_edit';
					$files['files'] = $this->input->post('image');
					$files['folder'] = 'stranka';
					$data['files'] = $this->load->view('admin/files', $files, TRUE);
				}
				else {
					$stranka['name'] = $this->input->post('name');
					$stranka['path'] = $this->input->post('path');
					$stranka['text'] = $this->input->post('text');
					$stranka['images'] = $this->input->post('image');
					$stranka['lang'] = $this->input->post('lang');
					$stranka['published'] = $this->input->post('published');
					$stranka['keywords'] = $this->input->post('keywords');
					$stranka['timestamp'] = time();
					if ($this->input->post('id')) {
						if ($this->m_stranka->update($this->input->post('id'), $stranka)) {
							$this->messages->add('Údaje boli úspešne uložené.');
							redirect('admin/stranka');
						}						
					}
					else {
						if ($this->m_stranka->insert($stranka)) {
							$this->messages->add('Údaje boli úspešne uložené.');
							redirect('admin/stranka');
						}						
					}
					$this->messages->add('Pri aktualizácii stránky nastala chyba, kontaktujte administrátora.', 'error');
					redirect('admin/stranka');					
				}
			break;
			default:
				$data['content']['stranka'] = $this->m_stranka->getByParams(array());
				$data['view'] = 'admin/stranka_list';
			break;
		}		
		$this->load->view('master', $data);
	}

	function front($op = null, $lang = null) {
  	$this->load->model('m_front');
		$data['title'] = 'Úvodná stránka';
		$data['content'] = null;
		if (!$this->session->userdata('admin')) {
			redirect('admin');
		}
		switch ($op) {
			case 'edit':
				$data['content']['front'] = $this->m_front->getByLang($lang);
				$data['view'] = 'admin/front_edit';
				break;
			case 'save':
				if ($this->input->post('cancel')) {
					redirect('admin/front');
				}
				$this->form_validation->set_rules('title', 'Názov', 'required');
				$this->form_validation->set_rules('headline', 'Headline', 'required');
				$this->form_validation->set_rules('text', 'Text', 'required');
				$this->form_validation->set_rules('lang', 'Lang', 'required');
				
				if (($this->form_validation->run() == FALSE))
				{
					$data['view'] = 'admin/front_edit';
				}
				else {
					$front['title'] = $this->input->post('title');
					$front['headline'] = $this->input->post('headline');
					$front['text'] = $this->input->post('text');
					$front['lang'] = $this->input->post('lang');
					$front['timestamp'] = time();

					if ($this->m_front->update($this->input->post('lang'), $front)) {
						$this->messages->add('Údaje boli úspešne uložené.');
						redirect('admin/front');
					}						


					$this->messages->add('Pri aktualizácii stránky nastala chyba, kontaktujte administrátora.', 'error');
					redirect('admin/stranka');					
				}
			break;
			default:
				$data['content']['front'] = $this->m_front->getAll();
				$data['view'] = 'admin/front_list';
			break;
		}		
		$this->load->view('master', $data);
	}


	function upload($folder) {
		if (!$this->session->userdata('admin')) {
			echo "not authorised. attempt has been logged.";
		}
		
		switch ($folder) {
			case 'obsah':
				$medium_width = 533;
				$medium_height = 300;
				$thumb_width = 355;
				$thumb_height = 200;
			break;
			case 'stranka':
				$medium_width = 533;
				$medium_height = 300;
				$thumb_width = 355;
				$thumb_height = 200;
			break;
			case 'osobnosti':
				$medium_width = 533;
				$medium_height = 300;
				$thumb_width = 355;
				$thumb_height = 200;
			break;
			case 'featured':
				$medium_width = 960;
				$medium_height = 320;
				$thumb_width = 384;
				$thumb_height = 128;				
			case 'blocks':
				$medium_width = 384;
				$medium_height = 128;
				$thumb_width = 120;
				$thumb_height = 80;	
		}
		
		$config['upload_path'] = './content/'.$folder.'/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size']	= '20000';
		$config['max_width']  = '4096';
		$config['max_height']  = '2048';
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('uploadfile')) {
			echo "";
		} else {
			$obrazok = $this->upload->data();
			echo $obrazok['file_name'];
			
			// uprava obrazku na velkost medium
			// proporcna uprava mensej strany na pozadovanu velkost
			$config = array();
			
			$ratio = $medium_width/$medium_height;
			$current_ratio = $obrazok['image_width']/$obrazok['image_height'];
			
			if ($current_ratio > $ratio) {
				$config['height'] = $medium_height;
				$config['width'] = ($medium_height/$obrazok['image_height'])*$obrazok['image_width'];
			}
			else {
				$config['width'] = $medium_width;
				$config['height'] = ($medium_width/$obrazok['image_width'])*$obrazok['image_height'];
			}
			$config['maintain_ratio'] = TRUE;
			$config['source_image'] = './content/'.$folder.'/'.$obrazok['file_name'];
			$config['new_image'] = './content/'.$folder.'/medium/'.$obrazok['file_name'];
			
			$this->load->library('image_lib', $config); 
			$this->image_lib->resize();
			
			// urezanie obrazku na finalny rozmer
			$new_width = $config['width'];
			$new_height = $config['height'];
			$config = array();
			$config['source_image'] = './content/'.$folder.'/medium/'.$obrazok['file_name'];
			$config['width'] = $medium_width;
			$config['height'] = $medium_height;
			if ($new_width > $medium_width) {
				$config['x_axis'] = round(($new_width - $medium_width)/2);
				$config['y_axis'] = 0;
			}
			else {
				$config['y_axis'] = round(($new_height - $medium_height)/2);
				$config['x_axis'] = 0;				
			}
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$this->load->library('image_lib', $config); 
			$this->image_lib->crop();

			// uuprava obrazku na velkost thumb
			$config = array();
			
			$ratio = $thumb_width/$thumb_height;
			$current_ratio = $obrazok['image_width']/$obrazok['image_height'];
			
			if ($current_ratio > $ratio) {
				$config['height'] = $thumb_height;
				$config['width'] = ($thumb_height/$obrazok['image_height'])*$obrazok['image_width'];
			}
			else {
				$config['width'] = $thumb_width;
				$config['height'] = ($thumb_width/$obrazok['image_width'])*$obrazok['image_height'];
			}
			$config['maintain_ratio'] = TRUE;
			$config['source_image'] = './content/'.$folder.'/'.$obrazok['file_name'];
			$config['new_image'] = './content/'.$folder.'/thumbs/'.$obrazok['file_name'];
			
			$this->image_lib->initialize($config);
			$this->load->library('image_lib', $config); 
			$this->image_lib->resize();
			
			// urezanie obrazku na finalny rozmer
			$new_width = $config['width'];
			$new_height = $config['height'];
			$config = array();
			$config['source_image'] = './content/'.$folder.'/thumbs/'.$obrazok['file_name'];
			$config['width'] = $thumb_width;
			$config['height'] = $thumb_height;
			if ($new_width > $thumb_width) {
				$config['x_axis'] = round(($new_width - $thumb_width)/2);
				$config['y_axis'] = 0;
			}
			else {
				$config['y_axis'] = round(($new_height - $thumb_height)/2);
				$config['x_axis'] = 0;				
			}
			$config['maintain_ratio'] = FALSE;
			
			$this->image_lib->initialize($config);
			$this->load->library('image_lib', $config); 
			$this->image_lib->crop();
			// echo memory_get_usage();
		}
	}
	
	function kategorie($op = 'list', $id = null) {
		$data['content'] = null;
		$this->load->model('m_kategorie');
		switch ($op) {
			case 'list':
				$data['content']['kategorie'] = $this->m_kategorie->get(array('content' => 'osobnosti'));
				$data['view'] = 'admin/kategorie_list';
			break;
			case 'add':
				$data['view'] = 'admin/kategorie_edit';
				$kategorie = $this->m_kategorie->get(array('content' => 'osobnosti'));
				foreach ($kategorie as $id => $name) {
					$data['content']['kategorie'][$id] = $name;
				}
			break;
			case 'edit':
				if (!$id) {
					redirect('admin/kategorie');
				}
				$data['view'] = 'admin/kategorie_edit';
				$kategoria = $this->m_kategorie->get(array('id' => $id));
				$data['content']['kategoria'] = $kategoria[0];
				//print_r($kategoria);
			break;
			case 'save':
				if ($this->input->post('cancel')) {
					redirect('admin/kategorie');
				}
				$this->form_validation->set_rules('name', 'Názov', 'required');
				if (($this->form_validation->run() == FALSE))
				{
					$data['view'] = 'admin/kategorie_edit';
				}
				else {
					$kategoria['timestamp'] = time();
					$kategoria['name'] = $this->input->post('name');
					$kategoria['lang'] = $this->input->post('lang');
					$kategoria['parent'] = 0;
					$kategoria['content'] = 'osobnosti';
					$kategoria['id'] = $this->input->post('id');
					if ($this->m_kategorie->save($kategoria)) {
						$this->messages->add('Kategória bola úspešne uložená.', 'success');
					}
					else {
						$this->messages->add('Pri ukladaní kategórie nastal problém, kontaktujte administrátora!', 'error');
					}
					redirect('admin/kategorie');
				}
			break;
			case 'confirm':
				if (!$id) {
					redirect('admin/kategorie');
				}
				$kategoria = $this->m_kategorie->get(array('id' => $id));
				$data['content']['kategoria'] = $kategoria[0];
				$data['view'] = 'admin/kategorie_confirm';
			break;
			case 'delete':
				if (!$this->input->post('id')) {
					redirect('admin/kategorie');
				}
				$id = $this->input->post('id');
				if ($this->m_kategorie->delete($id)) {
					$this->messages->add('Kategória bola úspešne zmazaná.', 'success');
				}
				else {
					$this->messages->add('Pri mazaní kategórie nastal problém, kontaktujte administrátora.', 'error');
				}
				redirect ('admin/kategorie');
			break;
		}
		$data['messages'] = $this->messages->get();
		$this->load->view('master', $data);
	}
	
	function settings() {
		$data['title'] = 'Nastavenie';
		if (!$this->session->userdata('admin')) {
			echo "not authorised. attempt has been logged.";
		}
		if ($this->input->post('password1') && $this->input->post('password2')) {
			if ($this->input->post('password1') != $this->input->post('password2')) {
				$this->messages->add('Heslá musia byť rovnaké!', 'error');
			}
			else {
				$this->db->where('username', 'admin');
				$this->db->update('users', array('password' => sha1($this->input->post('password1'))));
				$this->messages->add('Heslo bolo úspešne zmenené.', 'success');
			}
		}
		$data['view'] = 'admin/settings';
		$data['content']['settings'] = $this->m_settings->get();
		$data['messages'] = $this->messages->get();
		$this->load->view('master', $data);
	}
	
	function file($folder = null, $file = null) {
		$files = array();
		$files[0] = $file;
		echo $this->load->view('admin/files', array(
			'folder' => $folder,
			'files' => $files,
			)
		);
	}
	
	function dummy() {
		// tato mimoriadne komplikovana funkcia je tu na validaciu poli ktore nemusia byt validovane ale chcem ich aby
		// som ich mohol repopulateovat
		return TRUE; 
	}
	
}