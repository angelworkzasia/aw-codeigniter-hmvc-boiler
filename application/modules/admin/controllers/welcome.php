<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	private $view_type = 'default';

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function  __construct()
	 {
		   parent:: __construct();
		   	$this->load->library('ion_auth');
			$this->load->helper('url');
		    if ($this->agent->is_mobile())
			{
				$this->view_type = 'mobile';
			}
			else
			{
				$this->view_type = 'default';
			}
	 }

	 
	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}
	
		$data['platform']=$this->agent->mobile();
		//$data['logout_link']=

		$this->load->view($this->view_type.'/welcome_message',$data );

	}
	public function logout()
	{
			$this->ion_auth->logout();
			redirect('auth/login');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */