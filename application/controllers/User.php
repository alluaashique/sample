<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	var $logged="";
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->database();
		$this->load->library(array('session', 'form_validation', 'email', 'pagination'));
		$this->load->model('DB_model');
	}
	
    public function signup()
	{
		$name= $this->input->post("name");
		$uname= $this->input->post("uname");
        
        $pwd= $this->input->post("pwd");
        $ph= $this->input->post("ph");

        $enpass=$this->DB_model->encrypt_password($pwd);

		$data=array("uname"=>$uname,"pwd"=>$enpass,"status"=>1,"role"=>2);
        $slog=$this->DB_model->save('login',$data);	
		$data1=array("name"=>$name,"ph"=>$ph,"lid"=>$slog);	
    
        if($slog)
        {
            $slog=$this->DB_model->save('user',$data1);
                
            redirect('User/index');
                    }
        else
        {
            redirect('Welcome/index');
        }
	}
	public function index()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2')
		{	
			$this->load->view('User/header');
			$this->load->view('User/index');
			$this->load->view('User/footer');
		}
		else
		{
			redirect('Welcome/index');

		}
	}
	
	public function login()
	{
		$t1=$this->input->post("uname");
		$t2=$this->input->post("pwd");
		
			if ($this->DB_model->resolve_user_login($t1, $t2))
				{                    
					 $user_id = $this->DB_model->get_user_id_from_username($t1);
					 $user    = $this->DB_model->get_user($t1);
					 
					if($user->role==2)
						{
							//user
						$this->load->library(array('session'));
						$this->session->set_userdata(array(
							'login_id' => $user->lid,
							'username' => (string) $user->uname,
							'name' => (string) $user->name,
							'logged_in' => (bool) true,
							'role' => $user->role,
							'role_des' => 'user'));
					

						if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2' )
							{
								redirect('User/index', 'refresh');
							} 
							else
								{
									redirect('', 'refresh');
									$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Wrong Username or password!!!</div>');
									
								}
						}
						else if($user->role==1)
						{
							//admin
						$this->load->library(array('session'));
						$this->session->set_userdata(array(
							'login_id' => $user->lid,
							'username' => (string) $user->uname,
							'name' => (string) $user->name,
							'logged_in' => (bool) true,
							'role' => $user->role,
							'role_des' => 'user'));
					

						if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1' )
							{
								redirect('Admin/index', 'refresh');
							} 
							else
								{
									redirect('User/index', 'refresh');
									$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Wrong Username or password!!!</div>');
									
								}
						}				
				}
				else 
				{
					$this->session->set_flashdata('msg','<div class="alert alert-block alert-info text-center" style="color:red;">Wrong Username or password!!!</div>');
					redirect('User/index', 'refresh');
				}
	}
	public function signout()
	{
		$data = new stdClass();
				if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '2')
					{
						foreach ($_SESSION as $key => $value) 
							{
								unset($_SESSION[$key]);
							}
						 redirect('user/index', 'refresh');
					} 
					else 
						{
							redirect('/');
						}
	}

}