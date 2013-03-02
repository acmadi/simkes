<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
Class Usermodel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function get_list_user()
	{
		return $this->db->get('user');
	}
	function simpan($data)
	{
		if($data['user_id'] != '')
		{
			$this->db->where('user_id',$data['user_id']);
			$this->db->update('user',$data);
		}
		else
		{
			$this->db->from('user');
			$this->db->where('user_username',$data['user_username']);
			$num = $this->db->count_all_results();
			if($num > 0)
			{
				return false;
			}
			else
			{
				$this->db->insert('user',$data);
				$this->db->query('UPDATE '.$this->db->dbprefix.'user set user_password=PASSWORD("'.$data['user_password'].'") WHERE user_username="'.$data['user_username'].'"');
			}
		}
	}
	function hapus_user($id)
	{
		$this->db->where('user_id',$id);
		$this->db->delete('user');
	}
}
