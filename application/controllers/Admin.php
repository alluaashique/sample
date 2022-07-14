<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	
 
	public function index()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1')
		{	
			$this->load->view('Admin/header');
			$this->load->view('Admin/index');
			$this->load->view('Admin/footer');
		}
		else
		{
			redirect('Welcome/index');

		}
	}
	

	public function signout()
	{
		$data = new stdClass();
				if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1')
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
    
    public function add_product()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1')
		{
            
            $data['prod']=$this->DB_model->view_product()->result();
            $this->load->view('Admin/header');
			$this->load->view('Admin/ad_prod',$data);
			$this->load->view('Admin/footer');
		} 
		else 
        {
            redirect('/', 'refresh');

		}
	}
    
    public function ad_product()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1')
		{
            $pro= $this->input->post("pro");
            $bat= $this->input->post("bat");
            
            $qty= $this->input->post("qty");
            $amt= $this->input->post("amt");

            //$data=array($pro,$bat,$qty,$amt);
            $slog=$this->DB_model->insert_product($pro,$bat,$qty,$amt);	
          	
        
            if($slog)
            {
                //$data['prod']=$this->DB_model->view_product();   
                redirect('Admin/add_product');
                
           
            }
		} 
		else 
        {
            redirect('/', 'refresh');

		}
	}
    public function bill()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1')
		{
            
            $data['prod']=$this->DB_model->view_product()->result();
            $data['user']=$this->DB_model->view_user()->result();
            $this->load->view('Admin/header');
			$this->load->view('Admin/billing',$data);
			$this->load->view('Admin/footer');
		} 
		else 
        {
            redirect('/', 'refresh');

		}
	}
    
    public function findamt()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1')
		{
            
            $id= $this->input->post("id");
            $data=$this->DB_model->view_pro($id)->result();
            
            echo json_encode(array("pid" => (int)$data[0]->p_id,"pname"=>$data[0]->p_name,"pqty"=>(int)$data[0]->p_qty,"pamt"=>(int)$data[0]->p_amt)); 
            //echo $data->p_amt;
            
		} 
		else 
        {
            redirect('/', 'refresh');

		}
	}
    
    public function billing()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true && $_SESSION['role'] === '1')
		{
            $pro= $this->input->post("pro_id[]");
            $cust= $this->input->post("cust");
            $qty= $this->input->post("qty[]");
            
            $tot= $this->input->post("tot[]");
            $amt= $this->input->post("amt[]");
            $sum=0;

            for($i=0;$i<sizeof($pro);$i++)
            {
                $sum+=$tot[$i];

            }
            
            $bill=$this->DB_model->insert_bill($cust,$sum);
            //bill===  b_id	u_id	amount
            //single_bill == bill_id	b_id	p_id	p_qty	amt
            for($i=0;$i<sizeof($pro);$i++)
            {
                $slog=$this->DB_model->insert_single_bill($bill,$pro[$i],$qty[$i],$amt[$i]);	

            }


        
            if($slog)
            {
                //$data['prod']=$this->DB_model->view_product(); 
                echo "alert('data inserted')";  
                redirect('Admin/bill');

                
           
            }
		} 
		else 
        {
            redirect('/', 'refresh');

		}
	}

}