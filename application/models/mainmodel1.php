<?php
class mainmodel1 extends CI_model
{
	//work

	//data insertion 
		public function regi($a)
		{

		$this->db->insert("reg",$a);

		}

		//password encryption
		public function encpswd($pass)
			{
				return password_hash($pass, PASSWORD_BCRYPT);
			}

			//view user details 
		public function viewt()
			{
				$this->db->select('*');
				$qry=$this->db->get("reg");
				return $qry;

			}

			//approval
	public function approve($id)
	{
		$this->db->set('status','1');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("reg");
		return $qry;
	}

	//reject
	public function reject($id)
	{
		$this->db->set('status','2');
		$qry=$this->db->where("id",$id);
		$qry=$this->db->update("reg");
		return $qry;
	}



//login

	public function logi($uname,$pass)
	{
		$this->db->select('password');
		$this->db->from('reg');
		$this->db->where("uname","$uname");
		$qry=$this->db->get()->row("password");
		return $this->verifypas($pass,$qry);
	}
	public function verifypas($pass,$qry)
	{
		return password_verify($pass,$qry);
	}
	public function getuserid($uname)
	{
		$this->db->select('id');
		$this->db->from("reg");
		$this->db->where("uname","$uname");
		return $this->db->get()->row('id');
	}
	public function getuser($id)
	{
		$this->db->select('*');
		$this->db->from("reg");
		$this->db->where("id",$id);
		return $this->db->get()->row();
	}


}
?>