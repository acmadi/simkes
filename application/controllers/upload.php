<?php

class Upload extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
		$this->load->view('uplod', array('error' => ' ' ));
	}

	function do_upload()
	{


		$config['upload_path'] = './uploads/';
		//$config['upload_path'] = UPLOADS;
		//$config['allowed_types'] = 'gif|jpg|png';
                $config['allowed_types'] = 'xls';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';
		$config['overwrite']=true;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload("gambar"))
		{
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('upload_form', $error);
		}
		else
		{
			$data = $this->upload->data();

			//print_r($data);
			$pesan['error']='';
			$pesan['msg']=$data['file_name'];
			echo json_encode($pesan);
			//foreach ($data as $item => $value):
			//echo $item+":";  echo $value;
			//echo "<br />";
			//endforeach;

			//$this->load->view('upload_success', $data);
		}
	}
        function tesajax()
        {
            $data['msg']="Hai";
            $data['error']='';
            $data['pesan']="Bismillah";
            echo json_encode($data);
        }
}
?>