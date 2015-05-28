<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CodeIgniter Rest Controller
 *
 * A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @author        	Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link			https://github.com/chriskacerguis/codeigniter-restserver
 * @version         3.0.0-pre
 */
abstract class My_Controller extends CI_Controller
{
    /**
     * This defines the rest format.
     *
     * Must be overridden it in a controller so that it is set.
     *
     * @var string|null
     */
    protected $rest_format          = null;

    protected $data = array();

    protected function uploadImg($filename, $config, &$error){
    	$this->load->library ( 'upload', $config );
    	if(isset($config['file_name'])){
    		$config['file_name'] = iconv("UTF-8","gb2312",$config['file_name']);
    	}
    	$this->upload->initialize($config);
    	//echo $filename , ' | ' , $config['file_name'] ;
    	if ( ! $this->upload->do_upload($filename))
    	{
    		$error = $this->upload->display_errors();
    		return  false;
    	}
    	else
    	{
    		$this->data['upload_data'] = $this->upload->data();
    		$filepath = $this->data['upload_data']['file_name'];
    		$filepath = iconv("gb2312","UTF-8",$filepath);
    		return $filepath;
    
    		//$this->load->view('upload_success', $this->data);
    	}
    }

    /**
     * Constructor function
     * @todo Document more please.
     */
    public function __construct($config = 'rest')
    {
        parent::__construct();
        $this->load->helper('api');
        $this->lang->load('general', 'chinese');
        $this->load->library('session');
        $this->load->helper('url');
        $router = $this->router->class;
        $action = $this->router->method;

        
        $this->data['router'] = $router;
        $this->data['action'] = $action;
        
        $current_url = $router . '/' . $action;
        //$this->session->unset_userdata('user');
        $current_user = $this->session->userdata('dash_user');
        $exception_arr = array(
        		'user/login',
        		'user/register',
        		'welcome/index'
        		
        );
        if(!in_array($current_url , $exception_arr)){
        	$this->session->set_userdata('dash_current_url', uri_string());
        }
        //var_dump($current_user,$current_url);die;
        if(!$current_user 
        		&& !in_array($current_url , $exception_arr)){
        	redirect('../user/login', 'refresh');
        }
        else
        {
        	$this->data['user'] = $current_user;
        }
        
    }



}
