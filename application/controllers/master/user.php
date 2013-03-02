<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->helper(array('url')); // Load Helper URL CI
		$this->load->model(array('muser','m_mitra','m_wilayah','m_rayon')); // Load Model m_jqgrid
    }
	function index()
	{
		$this->grid(); //Default di arahkan ke function grid
	}
	function grid()
	{       $data['mitra']=$this->m_mitra->get_allmitra()->result_array();
		//$this->load->view('master/rayonadd',$data);
                
                
		$this->load->view('master/user',$data); // Load View jqgrid
	}

        function getwilayah()
	{

        $index = $this->input->post('id');
	    $wilayah = $this->m_wilayah->get_allwilayah($index);
        //$wilayah = $this->m_wilayah->get_wil(2);
        if( ! empty($wilayah) )
        {
			echo "<option value= >Pilih Wilayah</option>";
            foreach( $wilayah as $row )
            {
                echo "<option value=";
                echo $row->id_wilayah;
                echo ">";
                echo $row->nama_wilayah;
                echo "</option>";
            }
        }
	}

        function getrayon()
	{

            $index = $this->input->post('id');
	    $rayon = $this->m_rayon->get_semuarayon($index);
        //$wilayah = $this->m_wilayah->get_wil(2);
        if( ! empty($rayon) )
        {
			echo "<option value= >Pilih Rayon</option>";
            foreach( $rayon as $row )
            {
                echo "<option value=";
                echo $row->id_rayon;
                echo ">";
                echo $row->nama_rayon;
                echo "</option>";
            }
        }
	}



	function json()
	{
		$page  = $this->input->get('page');
		$limit = $this->input->get('rows');
		$sidx  = $this->input->get('sidx');
		$sord  = $this->input->get('sord');

		if(!$sidx) $sidx=1;


		# Untuk Single Searchingnya #
		$where = ""; //if there is no search request sent by jqgrid, $where should be empty
		$searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
		$searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
		if ($_GET['_search'] == 'true')
		{
			$where = array($searchField => $searchString);
		}
		# End #


		$count = $this->muser->count_user($where);

		$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
		if ($page > $total_pages) $page=$total_pages;
		$start = $limit*$page - $limit;
		if($start <0) $start = 0;

		$data1 = $this->muser->get_user($where, $sidx, $sord, $limit, $start)->result();

		$responce->page = $page;
		$responce->total = $total_pages;
		$responce->records = $count;
		$i=0;
                $responce->pilihan[1][1]='pilihan 1';
                $responce->pilihan[1][2]='pilihan 2';
                $responce->pilihan[1][3]='pilihan 3';
		foreach($data1 as $line)
		{
			$responce->rows[$i]['user_id']   = $line->user_id;
			$responce->rows[$i]['cell'] = array($line->user_id,$line->user_name,$line->user_username,$line->user_password,$line->name_level);
			$i++;
		}
		echo json_encode($responce);
	}

        function pilihan()
        {
                $responce->pilihan[1][1]='pilihan 1';
                $responce->pilihan[1][2]='pilihan 2';
                $responce->pilihan[1][3]='pilihan 3';
                echo json_encode($responce);

        }


	function crud()
	{
		$oper=$this->input->post('oper');
		$nama=$this->input->post('usernama');
		$username=$this->input->post('userusername');
		$password=$this->input->post('userpassword');
		$id_mitra=$this->input->post('usermitra');
		$id_wilayah=$this->input->post('userwilayah');
		$id_rayon=$this->input->post('userrayon');
                $level=$this->input->post('userlevel');
                $user_id=$this->input->post('id');
                $user_level=5;

                if($id_mitra!='')
                {
                    if($id_wilayah!='')
                    {
                        if($id_rayon!='')
                        {
                            if($level=='1')
                            {
                                $user_level=7;
                            }
                            else
                            {
                                $user_level=6;
                            }
                        }
                        else
                        {
                            if($level=='1')
                            {
                                $user_level=5;
                            }
                            else
                            {
                                $user_level=4;
                            }
                        }
                    }
                  else
                    {
                        if($level == '1')
                            {
                                $user_level=3;
                            }
                         else
                           {
                              $user_level=2;
                          }
                    }
                }


                $data['error']='';
                $data['nama']=$nama;
                $data['username']=$username;
                $data['password']=$password;
                $data['id_mitra']=$id_mitra;
                $data['id_wilayah']=$id_wilayah;
                $data['id_rayon']=$id_rayon;
                $data['userlevel']=$user_level;
                $data['level']=$level;
                $data['oper']=$oper;
                echo json_encode($data);

                
	    switch ($oper)
		{
	        case 'add':
				$datanya=array('user_username'=>$username,'user_password'=>md5($password),'user_name'=>$nama,'user_level'=>$user_level);
				$this->muser->insert_user($datanya);
                                $iduser=$this->muser->get_id_user();
                                $id=$this->muser->get_id_user();
                                $id_user= $id[0]['user_id'];
                                if($user_level == 2 or $user_level == 3)
                                {
                                $datanya=array('user_id'=>$id_user,'id_mitra'=>$id_mitra);
                                $this->muser->insert_user_mitra($datanya);
                                }
                                else if($user_level == 4 or $user_level == 5)
                                {
                                $datanya=array('user_id'=>$id_user,'id_wilayah'=>$id_wilayah);
                                $this->muser->insert_user_wilayah($datanya);
                                }
                                else if($user_level == 6 or $user_level == 7)
                                {
                                $datanya=array('user_id'=>$id_user,'id_rayon'=>$id_rayon);
                                $this->muser->insert_user_rayon($datanya);
                                }
				break;
	        case 'edit':
	            $datanya=array('nama_user'=>$nama_user);
				$this->muser->update_user($id_user, $datanya);
	            break;
	        case 'del':
	            $this->muser->delete_user($user_id);
	        break;
		}
                 
                 
	}
        
        

        
       
     

}