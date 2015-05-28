<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
require APPPATH . '/libraries/My_Controller.php';
class news extends My_Controller {
	
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
		$router = $this->data['router'];
		$request_url = $router . '/list/format/json';
		
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
		$this->load->view ( 'pages/' . $router . '/list', $this->data );
		$this->load->view ( 'templates/footer', $this->data );
	}
	public function create() {
		$router = $this->data['router'];
		$this->data ['title'] = $this->lang->line ( 'create' ) . $this->lang->line ( $router);
		
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
		
		$validation_rules = array (
				array (
						'field' => 'name',
						'label' => 'name',
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
					'name' => $this->input->post ( 'name' ),
					'content' => $this->input->post ( 'content' ),
					
			);
			
			
			$request_url = $router . '/detail/format/json';
			
			$resp = my_api_request ( $request_url, $method = 'post', $request );
			//var_dump($resp);die;
			$this->data ['resp'] = json_decode ( $resp, true );
			
			
			
		}
		$this->load->view ( "pages/" . $this->data ['router'] . "/" . $this->data ['action'], $this->data );
		$this->load->view ( 'templates/footer' );
	}
	public function update($id_name, $id_val) {
		$router = $this->data['router'];
		$this->data ['title'] = $this->lang->line ( 'edit' ) . $this->lang->line ( $router );
		
		$this->load->helper ( 'form' );
		$this->load->library ( 'form_validation' );
	
		$request_url = $router . '/detail/id/' . $id_val . '/format/json';
		
		$detail = my_api_request ( $request_url, $method = 'get', $param = array () );
		//$detail = array('name'=>'abc');
		// $this->data = array();
		// $this->data = my_api_request
		$this->data ['detail'] = json_decode ( $detail, true );
		
		$validation_rules = array (
				array (
						'field' => 'name',
						'label' => 'name',
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
					'name' => $this->input->post ( 'name' ),
					'content' => $this->input->post ( 'content' ),
					'id' => $id_val
					
			);
			
			
				
			$request_url = $router . '/detail/format/json';
			
			$resp = my_api_request ( $request_url, $method = 'put', $request );
				
			$this->data ['resp'] = json_decode ( $resp, true );
			
			
				
		}
		
		$this->load->view ( "pages/" . $router . "/" . $this->data ['action'], $this->data );
		$this->load->view ( 'templates/footer' );
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */