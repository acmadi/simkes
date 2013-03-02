<?php
class Muser extends CI_Model
{
	function Muser()
	{
	 parent::__construct();
	}

        function count_user($like)
	{
		$like != '' ? $this->db->like($like) : '';

                return $this->db->count_all('v_master_user');
        }

        function get_user($like, $sidx, $sord, $limit, $start)
	{
		$like != '' ? $this->db->like($like) : '';
		$this->db->order_by($sidx, $sord);
		return $this->db->get('v_master_user', $limit, $start);
	}
	
	function cek_user($username,$password)
	{
		$this->db->where('user_username',$username);
		$this->db->where('user_password',md5($password));
		$query=$this->db->get('user');
		if($query->num_rows() > 0)
		{
			return true;
		}
		
		else
		{
			return false;
		}
	}

        function insert_user($data)
        {
                return $this->db->insert('user',$data);
        }
        function insert_user_mitra($data)
        {
                return $this->db->insert('user_mitra',$data);
        }
        function insert_user_wilayah($data)
        {
                return $this->db->insert('user_wilayah',$data);
        }
        function insert_user_rayon($data)
        {
                return $this->db->insert('user_rayon',$data);
        }
        function get_id_user()
        {
        $this->db->select_max('user_id');
        $query = $this->db->get('user');
        return $query->result_array();
        }
        function delete_user($user_id)
        {
        $this->db->where('user_id', $user_id);
	$this->db->delete('user');
        }

}
?>