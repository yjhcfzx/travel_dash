<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
require APPPATH . '/libraries/My_Controller.php';
class airfreight extends My_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 *
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$router = $this->data ['router'];
		$request_url = $router . '/list/format/json';
		
		$resp = my_api_request ( $request_url, $method = 'get', $param = array () );
		
		$resp = json_decode ( $resp, true );
		if (isset ( $resp ['error'] )) {
			$this->data ['error'] = $resp ['error'];
		} else {
			
			$this->data ['items'] = $resp;
		}
		
		$this->load->view ( 'templates/header', $this->data );
		$this->load->view ( 'pages/' . $router . '/list', $this->data );
		$this->load->view ( 'templates/footer', $this->data );
	}
	public function create() {
		$router = $this->data ['router'];
		$this->data ['title'] = $this->lang->line ( 'create' ) . $this->lang->line ( $router );
		
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		
		$validation_rules = array (
				array (
						'field' => 'product_type_name',
						'label' => 'product_type_name',
						'rules' => 'required' 
				) 
		);
		
		$this->form_validation->set_rules ( $validation_rules );
		
		// $this->load->view ( 'templates/header', $this->data );
		// invalid or first load, load page normally
		if ($this->form_validation->run () === FALSE) {
		}  // process upload
		else {
			// product entity
			$request = array (
					'name' => $this->input->post ( 'product_type_name' ) 
			);
			// ''=>$this->input->post(''),
			
			// init upload lib
			$upload_config ['upload_path'] = $this->config->item ( 'cdn_path' ) . 'resource/';
			$upload_config ['allowed_types'] = '*';
			$upload_config ['remove_spaces'] = TRUE;
			$upload_config ['overwrite'] = TRUE;
			// $upload_config ['max_width'] = '1024';
			// $upload_config ['max_height'] = '768';
			
			$errors = array ();
			$locations = array ();
			// read imgs
			$now = date ( "Y_m_d_H-i-s" );
			for($i = 1; $i <= 10; $i ++) {
				
				if (isset ( $_POST ['location' . $i] )) {
					$item = array ();
					$images = array ();
					$item ['name'] = $_POST ['location' . $i];
					for($j = 1; $j <= 10; $j ++) {
						if (isset ( $_FILES ['thumbnail' . $i . '_' . $j] )) {
							$uploaded = $_FILES ['thumbnail' . $i . '_' . $j] ['name'];
							$filename = pathinfo ( $uploaded, PATHINFO_FILENAME );
							$ext = pathinfo ( $uploaded, PATHINFO_EXTENSION );
							$upload_name = $filename . '_' . $now . '.' . $ext;
							$upload_config ['file_name'] = $upload_name;
							$img_url = $this->uploadImg ( 'thumbnail' . $i . '_' . $j, $upload_config, $errors );
							$images [] = $img_url;
						} else {
							continue; // break;
						}
					}
					$item ['files'] = implode ( ',', $images );
					$locations [] = $item;
				}
			}
			
			if (count ( $errors ) > 0) {
				var_dump ( $errors );
				die ();
				$this->data ['errors'] = $errors;
			} else {
				// call create api
				$request ['sites'] = $locations;
				
				$request_url = $router . '/detail/format/json';
				$resp = my_api_request ( $request_url, $method = 'post', $request );
				
				$this->data ['resp'] = json_decode ( $resp, true );
			}
		}
		$this->load->view ( 'templates/header' );
		$this->load->view ( "pages/" . $router . "/" . $this->data ['action'], $this->data );
		$this->load->view ( 'templates/footer' );
	}
	public function update($id_name, $id_val) {
		$router = $this->data ['router'];
		$this->data ['title'] = $this->lang->line ( 'edit' ) . $this->lang->line ( $router );
		
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		
		$request_url = $router . '/detail/id/' . $id_val . '/format/json';
		
		$detail = my_api_request ( $request_url, $method = 'get', $param = array () );
		;
		// $this->data = array();
		// $this->data = my_api_request
		$this->data ['detail'] = json_decode ( $detail, true );
		
		$validation_rules = array (
				array (
						'field' => 'product_type_name',
						'label' => 'name',
						'rules' => 'required' 
				),
				
		);
		
		$this->form_validation->set_rules ( $validation_rules );
		
		$this->load->view ( 'templates/header', $this->data );
		// invalid or first load, load page normally
		if ($this->form_validation->run () === FALSE) {
		}  // process upload
		else {
					// product entity
		$request = array (
					'name' => $this->input->post ( 'product_type_name' ) ,
					'id'=>$id_val
			);
			// ''=>$this->input->post(''),
			
			// init upload lib
			$upload_config ['upload_path'] = $this->config->item ( 'cdn_path' ) . 'resource/';
			$upload_config ['allowed_types'] = '*';
			$upload_config ['remove_spaces'] = TRUE;
			$upload_config ['overwrite'] = TRUE;
			// $upload_config ['max_width'] = '1024';
			// $upload_config ['max_height'] = '768';
			
			$errors = array ();
			$locations = array ();
			// read imgs
			$now = date ( "Y_m_d_H-i-s" );
			for($i = 1; $i <= 10; $i ++) {
				
				if (isset ( $_POST ['location' . $i] )) {
					$item = array ();
					$images = array ();
					$item ['name'] = $_POST ['location' . $i];
					for($j = 1; $j <= 10; $j ++) {
						if (isset ( $_FILES ['thumbnail' . $i . '_' . $j] )) {
							$uploaded = $_FILES ['thumbnail' . $i . '_' . $j] ['name'];
							$filename = pathinfo ( $uploaded, PATHINFO_FILENAME );
							$ext = pathinfo ( $uploaded, PATHINFO_EXTENSION );
							$upload_name = $filename . '_' . $now . '.' . $ext;
							$upload_config ['file_name'] = $upload_name;
							$img_url = $this->uploadImg ( 'thumbnail' . $i . '_' . $j, $upload_config, $errors );
							$images [] = $img_url;
						} 
						elseif (isset ( $_POST ['thumbnail' . $i . '_' . $j] )) {
								$images [] = $_POST ['thumbnail' . $i . '_' . $j];
						}  else {
							continue; // break;
						}
					}
					$item ['files'] = implode ( ',', $images );
					$locations [] = $item;
				}
			}
			
			if (count ( $errors ) > 0) {
				$this->data ['errors'] = $errors;
			} else {
				
				$request ['sites'] = $locations;
				// call create api
				$request_url = $router . '/detail/id/' . $id_val . '/format/json';
				$resp = my_api_request ( $request_url, $method = 'put', $request );
				
				$this->data ['resp'] = json_decode ( $resp, true );
			}
		}
		
		$this->load->view ( "pages/" . $router  . "/" . $this->data ['action'], $this->data );
		$this->load->view ( 'templates/footer' );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */