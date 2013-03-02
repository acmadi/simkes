<?php ob_start();

 class Chapter extends CI_Controller {
 function __construct()
 {
   parent::__construct();
   $this->load->model(array('Querypage', 'm_apotek'));
   $this->load->helper(array('form', 'url', 'inflector'));
   $this->load->library(array('form_validation','upload'));
 }
 public function index()
 {
       if ($this->input->post('submit'))
		{   
		$this->do_upload();
		//$this->impor();
       // $this->load->view('chapter', $data);
		}
	else
		{
   //$this->load->view('chapter', $data);
   $this->load->view('chapter');
		}
 }
function do_upload()
{
    $config['upload_path'] = './temp_upload/';
    $config['allowed_types'] = 'xls';
                
    //$this->load->library('upload', $config);
    $this->upload->initialize($config);
    
    //$this->upload->do_upload("files");
     if ( ! $this->upload->do_upload("fileupload"))
     {
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg_excel', 'Insert failed. Please check your file, only .xls file allowed.');
     }
     else
     {
         //echo "Berhasil";
            $data = array('error' => false);
            $upload_data = $this->upload->data();
			print_r($upload_data);
			echo "Semangat";
            /*$this->load->library('excel_reader');
            $this->excel_reader->setOutputEncoding('CP1251');

            $file =  $upload_data['full_path'];
			print_r($file);
            $this->excel_reader->read($file);
			echo "Ayo tetap berjuang";
            error_reporting(E_ALL ^ E_NOTICE);

            // Sheet 1
            $data = $this->excel_reader->sheets[0] ;
			print_r($data);
			echo "/n";
            $dataexcel = Array();
            for ($i = 2; $i <= $data['numRows']; $i++)
            {
               if($data['cells'][$i][1] == '') break;
               $dataexcel[$i-1]['nama_provider'] = $data['cells'][$i][1];
               $dataexcel[$i-1]['almt_provider'] = $data['cells'][$i][2];
               $dataexcel[$i-1]['langg_provider'] = $data['cells'][$i][3];
               $dataexcel[$i-1]['email_provider'] = $data['cells'][$i][4];
               $dataexcel[$i-1]['fax_provider'] = $data['cells'][$i][5];
               $dataexcel[$i-1]['tlp_provider'] = $data['cells'][$i][6];
               $dataexcel[$i-1]['idjenis_provider'] = "1";
            }
     //cek data
    //$check= $this->Querypage->search_chapter($dataexcel);
        echo ('Bismillah');
        $check=null;
        echo count($check);
        print_r($dataexcel);
        
        echo count($dataexcel);
    if (count($check) > 0)
    {
        echo "Update";
      //$this->Querypage->update_chapter($dataexcel);
      // set pesan
      //$this->session->set_flashdata('msg_excel', 'update data success');
    }
	else
    {
        
      //$this->Querypage->insert_chapter($dataexcel);
      //$this->m_apotek->insert_apotek($dataexcel[1]);
       echo "Insert";
       

      // set pesan
      //$this->session->set_flashdata('msg_excel', 'inserting data success');
    }
	*/
    }

  //redirect('chapter');
  }
	function impor()
	{
	$error = "";
	$msg = "";
	$pesan="";
	$fileElementName = 'userfile';
	
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}
	elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}
	else 
	{
			$msg .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);
			$pesan .= "Ayo Semangat";
			//for security reason, we force to remove all uploaded file
			@unlink($_FILES[$fileElementName]);	
			
			$config['upload_path'] = './temp_upload/';
			$config['allowed_types'] = 'xls';
                
			$this->load->library('upload', $config);
			$tes=$this->upload->do_upload();
			
			
			if ( ! $this->upload->do_upload())
			{
            $data = array('error' => $this->upload->display_errors());
            $this->session->set_flashdata('msg_excel', 'Insert failed. Please check your file, only .xls file allowed.');
			}
			
			else
			{
            $data = array('error' => false);
            $upload_data = $this->upload->data();
			//print_r($upload_data);
			//echo "Semangat";
            $this->load->library('excel_reader');
            $this->excel_reader->setOutputEncoding('CP1251');

            $file =  $upload_data['full_path'];
			//print_r($file);
            $this->excel_reader->read($file);
			//echo "Ayo tetap berjuang";
            error_reporting(E_ALL ^ E_NOTICE);

            // Sheet 1
            $data = $this->excel_reader->sheets[0] ;
			//print_r($data);
			//echo "/n";
            $dataexcel = Array();
            for ($i = 1; $i <= $data['numRows']; $i++)
            {
               if($data['cells'][$i][1] == '') break;
               $dataexcel[$i-1]['chapternumber'] = $data['cells'][$i][1];
               $dataexcel[$i-1]['title'] = $data['cells'][$i][2];
               $dataexcel[$i-1]['text1'] = $data['cells'][$i][3];
               $dataexcel[$i-1]['text2'] = $data['cells'][$i][4];
            }
			//cek data
			$check= $this->Querypage->search_chapter($dataexcel);
			//print_r($dataexcel);
			if (count($check) > 0)
			{
			$this->Querypage->update_chapter($dataexcel);
			// set pesan
			$this->session->set_flashdata('msg_excel', 'update data success');
			}
			else
			{
			$this->Querypage->insert_chapter($dataexcel);
			// set pesan
			$this->session->set_flashdata('msg_excel', 'inserting data success');
			}
			}
				
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "',\n";
	echo				"pesan: '" . $pesan . "'\n";
	echo "}"; 
	}

        function do_impor()
	{
	$error = "";
	$msg = "";
	$pesan="";
	$fileElementName = 'userfile';

	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'No file was uploaded.';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}
	elseif(empty($_FILES[$fileElementName]['tmp_name']) || $_FILES[$fileElementName]['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}
	else
	{
			$msg .= " File Name: " . $_FILES[$fileElementName]['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES[$fileElementName]['tmp_name']);
			$pesan .= "Ayo Semangat";
			//for security reason, we force to remove all uploaded file
			@unlink($_FILES[$fileElementName]);

			$config['upload_path'] = './temp_upload/';
			$config['allowed_types'] = 'xls';

			$this->load->library('upload', $config);
			$tes=$this->upload->do_upload();


			if ( ! $this->upload->do_upload())
			{
                           $data = array('error' => $this->upload->display_errors());
                           $this->session->set_flashdata('msg_excel', 'Insert failed. Please check your file, only .xls file allowed.');
			}

			else
			{
                            $data = array('error' => false);
                            $upload_data = $this->upload->data();
                            //print_r($upload_data);
                            //echo "Semangat";
                            $this->load->library('excel_reader');
                            $this->excel_reader->setOutputEncoding('CP1251');

                            $file =  $upload_data['full_path'];
                            //print_r($file);
                            $this->excel_reader->read($file);
                            //echo "Ayo tetap berjuang";
                            error_reporting(E_ALL ^ E_NOTICE);

                            // Sheet 1
                            $data = $this->excel_reader->sheets[0] ;
                            //print_r($data);
                            //echo "/n";
                            $dataexcel = Array();
                            for ($i = 1; $i <= $data['numRows']; $i++)
                            {
                            if($data['cells'][$i][1] == '') break;
                            $dataexcel[$i-1]['nama_provider'] = $data['cells'][$i][1];
                            $dataexcel[$i-1]['almt_provider'] = $data['cells'][$i][2];
                            $dataexcel[$i-1]['langg_provider'] = $data['cells'][$i][3];
                            $dataexcel[$i-1]['email_provider'] = $data['cells'][$i][4];
                            $dataexcel[$i-1]['fax_provider'] = $data['cells'][$i][5];
                            $dataexcel[$i-1]['tlp_provider'] = $data['cells'][$i][6];
                            $dataexcel[$i-1]['idjenis_provider'] = "1";
                            }
                            //cek data
                            //$check= $this->Querypage->search_chapter($dataexcel);
                            //print_r($dataexcel);
                            $check=null;
                            if (count($check) > 0)
                            {
                            //echo "Update";
                            //$this->Querypage->update_chapter($dataexcel);
                            // set pesan
                            //$this->session->set_flashdata('msg_excel', 'update data success');
                            }
                            else
                            {

                            //$this->Querypage->insert_chapter($dataexcel);
                            $this->m_apotek->insert_apotek($dataexcel[1]);
                            //echo "Insert";


                            // set pesan
                            //$this->session->set_flashdata('msg_excel', 'inserting data success');
                            }
			}

	}
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo				"msg: '" . $msg . "',\n";
	echo				"pesan: '" . $pesan . "'\n";
	echo "}";
	}
}
?>