<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
require APPPATH . '/libraries/My_Controller.php';
class price extends My_Controller {
	
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
		$request_url = 'product/list/format/json';
		
		$resp = my_api_request ( $request_url, $method = 'get', $param = array () );
		$resp = json_decode ( $resp, true );
		if (isset ( $resp ['error'] )) {
			$this->data ['error'] = $resp ['error'];
		} else {
			foreach ( $resp as $item ) {
				if (isset ( $item ['img'] ) && $item ['img']) {
					$imgs = explode ( $item ['img'], ',' );
					$item ['img'] = $imgs [0];
				}
			}
			$this->data ['items'] = $resp;
		}
		
		$this->load->view ( 'templates/header', $this->data );
		$this->load->view ( 'pages/price/list', $this->data );
		$this->load->view ( 'templates/footer', $this->data );
	}
	public function create() {
		$this->data ['title'] = $this->lang->line ( 'createprice' );
		
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		
		$validation_rules = array (
				array (
						'field' => 'productname',
						'label' => 'productname',
						'rules' => 'required' 
				),
				/* array(
						'field'   => 'password',
						'label'   => 'Password',
						'rules'   => 'required'
				),
				array(
						'field'   => 'passconf',
						'label'   => 'Password Confirmation',
						'rules'   => 'required'
				), */
				
		);
		
		$this->form_validation->set_rules ( $validation_rules );
		
		$this->load->view ( 'templates/header', $this->data );
		// invalid or first load, load page normally
		if ($this->form_validation->run () === FALSE) {
		}  // process upload
else {
			// product entity
			$request = array (
					'name' => $this->input->post ( 'productname' ),
					'category_id' => $this->input->post ( 'category' ),
					'price' => $this->input->post ( 'price' ),
					'description' => $this->input->post ( 'description' ),
					'entity_id' => $this->input->post ( 'entity' ) 
			);
			// ''=>$this->input->post(''),
			
			
			// init upload lib
			$upload_config ['upload_path'] = $this->config->item ( 'cdn_path' ) . 'product/';
			$upload_config ['allowed_types'] = 'gif|jpg|png|jpeg';
			$upload_config ['remove_spaces'] = TRUE;
			$upload_config ['max_size'] = '1000';
			$upload_config ['max_width'] = '1024';
			$upload_config ['max_height'] = '768';
			
			$this->load->library ( 'upload', $upload_config );
			$errors = array ();
			$images = array ();
			// read imgs
			for($i = 1; $i <= 10; $i ++) {
				
				if (isset ( $_FILES ['thumbnail' . $i] )) {
					$upload_name = 'thumbnail' . $i;
					$img_url = $this->uploadImg ( $upload_name, $errors );
					$images [] = $img_url;
				} else {
					continue; // break;
				}
			}
			
			if (count ( $errors ) > 0) {
				$this->data ['errors'] = $errors;
			} else {
				$request ['img'] = implode ( ',', $images );
				// call create api
				
				$request_url = 'product/detail/format/json';
				
				$resp = my_api_request ( $request_url, $method = 'post', $request );
				$this->data ['resp'] = json_decode ( $resp, true );
			}
		}
		$this->load->view ( "pages/" . $this->data ['router'] . "/" . $this->data ['action'], $this->data );
		$this->load->view ( 'templates/footer' );
	}
	public function update($id_name, $id_val) {
		$this->data ['title'] = $this->lang->line ( 'edit' ) . $this->lang->line ( 'product' );
		
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		
		$request_url = 'product/detail/id/' . $id_val . '/format/json';
		
		$detail = my_api_request ( $request_url, $method = 'get', $param = array () );
		
		// $this->data = array();
		// $this->data = my_api_request
		$this->data ['detail'] = json_decode ( $detail, true );
		
		$validation_rules = array (
				array (
						'field' => 'productname',
						'label' => 'productname',
						'rules' => 'required' 
				),
				/* array(
				 'field'   => 'password',
						'label'   => 'Password',
						'rules'   => 'required'
				),
		array(
				'field'   => 'passconf',
				'label'   => 'Password Confirmation',
				'rules'   => 'required'
		), */
	
		);
		
		$this->form_validation->set_rules ( $validation_rules );
		
		$this->load->view ( 'templates/header', $this->data );
		// invalid or first load, load page normally
		if ($this->form_validation->run () === FALSE) {
		} 		// process upload
		else {
			// product entity
			$request = array (
					'id' => $id_val,
					'name' => $this->input->post ( 'productname' ),
					'category_id' => $this->input->post ( 'category' ),
					'price' => $this->input->post ( 'price' ),
					'description' => $this->input->post ( 'description' ),
					'entity_id' => $this->input->post ( 'entity' ) 
			)
			// ''=>$this->input->post(''),
			;
			
			// init upload lib
			$upload_config ['upload_path'] = $this->config->item ( 'cdn_path' ) . 'product/';
			$upload_config ['allowed_types'] = 'gif|jpg|png|jpeg';
			$upload_config ['remove_spaces'] = TRUE;
			$upload_config ['max_size'] = '1000';
			$upload_config ['max_width'] = '1024';
			$upload_config ['max_height'] = '768';
			
			$this->load->library ( 'upload', $upload_config );
			$errors = array ();
			$images = array ();
			// read imgs
			for($i = 1; $i < 0; $i ++) {
				
				if (isset ( $_FILES ['thumbnail' . $i] )) {
					$upload_name = 'thumbnail' . $i;
					$img_url = $this->uploadImg ( $upload_name, $errors );
					$images [] = $img_url;
				} else {
					continue; // break;
				}
			}
			
			if (count ( $errors ) > 0) {
				$this->data ['errors'] = $errors;
			} else {
				
				$request ['img'] = implode ( ',', $images );
				// call create api
				$request_url = 'product/detail/id/' . $id_val . '/format/json';
				
				$resp = my_api_request ( $request_url, $method = 'put', $request );
				
				$this->data ['resp'] = json_decode ( $resp, true );
			}
			var_dump ( $request );
			die ();
		}
		
		$this->load->view ( "pages/" . $this->data ['router'] . "/" . $this->data ['action'], $this->data );
		$this->load->view ( 'templates/footer' );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */