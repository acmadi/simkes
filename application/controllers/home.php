<?php 
class home extends CI_Controller
{
function Home()
	{
		parent::__construct();
		$this->load->model(array('muser','m_diagnosa','m_item'));
                        $this->load->helper('url');
                        $this->load->library('id_chart/id_chart');

	}
	
	function index()
	{
         
	 if($level = $this->session->userdata('logged_in')==true)
         {      
                        $chart['c1'] = $this->id_chart->chart_embed('test',300,250,site_url('home/obatterbanyak'),base_url());
                        $chart['c2'] = $this->id_chart->chart_embed('test2',500,250,site_url('home/penyakitterbanyak'),base_url());
		
			$this->load->view('home',$chart);
         }
         else
         {
                $data['footer']="pandalu.com";
                $this->load->view('login_form',$data);

         }
	}

        function warning($input,$goTo)
{
	$url = site_url().'/'.$goTo;
	$output="<script>
		alert(\"$input\");
		location = '$url';
		</script>";
	return $output;
        }

	function login()
	{
        $username = $this->input->post('username',TRUE);
		$password = $this->input->post('password', TRUE);
		$this->db->where('user_username',$username);
		$this->db->where('user_password',md5($password));
		$query = $this->db->get('v_user');
		if($query->num_rows() == 1)
		{
			foreach($query->result() as $row)
			{
			 $nama = $row->user_name;
			 $id_user = $row->user_id;
                         $level=$row->user_level;
                         $id_rayon=$row->id_rayon;
                         $id_wilayah=$row->id_wilayah;
                         $id_mitra=$row->id_mitra;
			}
		}
		
		$user = $this->muser->cek_user($username,$password);
		if($user == TRUE)
		{

                       $data = array('nama'=>$nama,
                           'id_user'=>$id_user,
                           'level'=>$level,
                           'id_rayon'=>$id_rayon,
                           'id_wilayah'=>$id_wilayah,
                           'id_mitra'=>$id_mitra,
                           'logged_in'=>TRUE);

			$this->session->set_userdata($data);
                        $data['title']='Perdana CodeIgniter';
                        $data['content']='ruangmember';
                        $data['footer']='pandalu.com';
                        redirect('home');
                        //$this->index();
                        header ("location:localhost/simkes/index.php/home");
                       // header ("location:http://blajar-komputer.blogspot.com/");
						//$this->load->view('home',$data);
		}
		else
		{
			$this->session->set_flashdata('nama',$username);
			$this->session->set_flashdata('login_message','username tidak ada');
			redirect('home');
		}
		
	}
	function logout()
	{
		$this->session->sess_destroy();
                redirect('home');
		//echo warning('Anda berhasil logout...','home');
	}

        function penyakitterbanyak()
        {
             $penyakit = $this->m_diagnosa->get_penyakitterbanyak()->result_array();
             echo "<graph caption='' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Jumlah' xAxisName='Penyakit' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";

             for ($i=0;$i<count($penyakit);$i++)
		{	//$data[] = array('label'=>$penyakit[$i]['nama_diagnosa'], 'value'=>rand(0,200));
                  echo "<set name='".$penyakit[$i]['nama_diagnosa']."' hoverText='".$penyakit[$i]['nama_diagnosa']."' value='".$penyakit[$i]['jumlah']."' color='AFD8F8'/>";

                }
                echo "</graph>";

        }
        function obatterbanyak()
        {
           $obat = $this->m_item->get_obatterbanyak()->result_array();
 echo "<graph caption='' subcaption='' rotateNames='1' xAxisName='Obat' yAxisMinValue='' yAxisName='Jumlah' decimalPrecision='0' numberPrefix='' showNames='1' showValues='0' showAlternateHGridColor='1' AlternateHGridColor='ff5904' divLineColor='ff5904' divLineAlpha='20' alternateHGridAlpha='5'>";
 //echo "<set name='Jan' value='17400' hoverText='January'/>";
 //echo "<set name='Jan' value='17400' hoverText='January'/>";
 //echo "<set name='Feb' value='19800' hoverText='February'/>";
     for ($i=0;$i<count($obat);$i++)
	   {
              echo "<set name='".$obat[$i]['nama_item']."' value='".$obat[$i]['jumlah']."' hoverText='".$obat[$i]['nama_item']."'/>";


           }
 
         echo "</graph>";
           

        }
        function dashboard()
        {
            $data['bulan'] = $this->input->get('bulan');
            $data['tahun'] = $this->input->get('tahun');
            $this->load->view("dashboard",$data);
            //$this->load->view('laporan/executive_op',$data);
        }
	
	
	
}
?>