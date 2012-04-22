<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
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
		  // $this->clear_cache();
		$this->load->library('session');	
		   $this->load->library('template');
		   $this->load->helper('html');
		   	$this->load->library('form_validation');
		   // $this->load->module('users') ;

			$this->load->helper('url');
			
		    if ($this->agent->is_mobile())
			{
				$this->view_type = 'mobile';
				$this->template->set_template('mobile');
			
				$this->template->add_js('js/mobile/jquery.mobile-1.1.0.js');
				$this->template->add_css('css/jquery.mobile-1.1.0.css');
			}
			else
			{
				$this->view_type = 'default';

				
			}
			//$this->output->enable_profiler(TRUE);
		/*	$rss['template'] = 'rss.php';
			$rss['regions'] = array('name', 'items');
			$this->template->add_template('rss', $rss, TRUE);*/

// Template will now use the master template and regions from the supplied $rss template group configuration
	 }

	 
	public function index()
	{
	
		if (!$this->ion_auth->logged_in())
		{
			//redirect(modules::run('login/auth/getLoginURI'));
			$data['loginmessage']="Welcome guest";
			$data['log_link']='auth/login';
			$data['log_label']="Login";
			

			
		}
		else
		{
			$data['loginmessage']="Welcome user , you are logged in";
			$data['log_link']='auth/logout ';
			$data['log_label']="Logout";
		$user = $this->ion_auth->user()->row();
		echo $user->email;
		}
	
		$data['content']=$this->agent->mobile();
		
		$this->template->write_view('rightsidebar', $this->view_type.'/loginbox', $data);
		
		
		
        $this->template->write('rightsidebar', modules::run('users/show/index')) ;  
		//$this->load->view($this->view_type.'/template',$data );
		$this->template->write_view('rightsidebar', $this->view_type.'/normal_message', $data);
		$this->template->write_view('content', $this->view_type.'/normal_message', $data);
		$this->template->write_view('footer', $this->view_type.'/normal_message', $data);
		$this->template->render();

	}
		//log the user out
/*	function logout()
	{
		//$this->data['title'] = "Logout";
// echo "logout ";
		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them back to the page they came from
		redirect('login/auth/login', 'refresh');
	}*/


      function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */