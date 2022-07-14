<?php
class DB_model extends CI_Model 
{
	public function __construct()
    {
        parent::__construct();
    }
    
	function insert($tbl,$data)
	{
		$d=$this->db->insert($tbl,$data);
		return $d;
	}
	public function resolve_user_login($username, $password)
    {       
        $this->db->select('pwd');
        $this->db->from('login');
        $this->db->where('uname', $username);
        $hash = $this->db->get()->row('pwd');
		return password_verify($password, $hash);
        //return $this->verify_password_hash($password, $hash);
    }
	public function get_user_id_from_username($username)
    {
        $this->db->select('uname');
        $this->db->from('login');
        $this->db->where('uname', $username);
        return $this->db->get()->row('uname');
    }
    private function verify_password_hash($password, $hash)
    {
        
        return password_verify($password, $hash);
        
    }
	public function encrypt_password($pass)
	{
		return password_hash($pass,PASSWORD_BCRYPT);
	}
	public function get_user($user_id)
    {
        $this->db->from('login');
		$this->db->join('user',' login.lid=user.lid','inner');
        $this->db->where('uname', $user_id);
        return $this->db->get()->row();       
    }
	public function insert_product($pro,$bat,$qty,$amt)
	{
		$data=array('p_name'=>$pro,'p_batch'=>$bat,'p_qty'=>$qty,'p_amt'=>$amt);
		$d=$this->db->insert('product',$data);
		return $d;
	}
	public function view_product()
	{
		$this->db->select('*');
		$this->db->from('product');
        $result=$this->db->get();
		return $result;
	}
	public function view_pro($con)
	{
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('p_id',$con);
        $result=$this->db->get();
		return $result;
	}
	
	public function view_user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('login','user.lid=login.lid','inner');
        $result=$this->db->get();
		return $result;
	}
	function insert_bill($cust,$sum)
	{
		$data=array("u_id"=>$cust,"amount"=>$sum);
		$d=$this->db->insert('bill',$data);
		return $d;
	}
	
	function insert_single_bill($bill,$pro,$qty,$amt)
	{
		$data=array("b_id"=>$bill	,"p_id"=>$pro	,"p_qty"=>$qty	,"amt"=>$amt);
		$d=$this->db->insert('single_bill',$data);
		if($d)
		{
  			$data = $this->db->query('UPDATE `product` SET `p_qty` = `p_qty`- '.$qty.' WHERE `p_id` = '.$pro);
			
	
		}
		return $d;
	}
	
	/////////////////////////////////////////////////////
	
	
}





?>