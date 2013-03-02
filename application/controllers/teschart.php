<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teschart extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model(array('muser','m_diagnosa','m_item'));
	}

	function index()
	{

		/*$this->load->helper('url');
		$this->load->library('id_chart/id_chart');
		$chart['c1'] = $this->id_chart->chart_embed('test',800,250,site_url('chart/example1'),base_url());
		$chart['c2'] = $this->id_chart->chart_embed('test2',800,250,site_url('chart/example2'),base_url());
		$chart['c3'] = $this->id_chart->chart_embed('test3',800,250,site_url('chart/example3'),base_url());
		$chart['c4'] = $this->id_chart->chart_embed('test4',300,300,site_url('chart/example4'),base_url());

                 *
                 */

		$this->load->view('teschart');
	}

	function example1()
	{

		$this->load->helper('url');
		$this->load->library('id_chart/id_chart');
		for ($i=1;$i<30;$i++)
			$data[] = array('label'=>'data '.$i, 'value'=>90);
		echo $this->id_chart->set_chart('line')
							->set_data($data)
							->set_vertical()
							->render();
	}

	function example2()
	{

		$this->load->helper('url');
		$this->load->library('id_chart/id_chart');
		for ($i=1;$i<30;$i++)
			$data[] = array('label'=>'data '.$i, 'value'=>rand(1,300));

		echo $this->id_chart->set_chart('bar')
							->set_data($data)
							->set_vertical()
							->render();
	}
	function example3()
	{

		$this->load->helper('url');
		$this->load->library('id_chart/id_chart');
		for ($i=1;$i<30;$i++)
			$data[] = array('label'=>'data '.$i, 'value'=>rand(1,300));

		echo $this->id_chart->set_chart('area')
							->set_data($data)
							->set_vertical()
							->render();
	}

	function example4()
	{

		$this->load->helper('url');
		$this->load->library('id_chart/id_chart');
		for ($i=1;$i<6;$i++)
			$data[] = array('label'=>'data '.$i, 'value'=>rand(20,300));

		echo $this->id_chart->set_chart('pie')
							->set_data($data)
							//->set_radius(20)
							->render();
	}

        function tesxml()
        {
          return "Hai";
        }
        function penyakitterbanyak()
        {
             $penyakit = $this->m_diagnosa->get_penyakitterbanyak()->result_array();
             echo "<graph caption='Obat Terbanyak' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Quantity' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";

             for ($i=0;$i<count($penyakit);$i++)
		{	//$data[] = array('label'=>$penyakit[$i]['nama_diagnosa'], 'value'=>rand(0,200));
                  echo "<set name='".$penyakit[$i]['nama_diagnosa']."' hoverText='".$penyakit[$i]['nama_diagnosa']."' value='".$penyakit[$i]['jumlah']."' color='AFD8F8'/>";

                }
                echo "</graph>";

        }
        function obatterbanyak()
        {
           $obat = $this->m_item->get_obatterbanyak()->result_array();
           echo "<graph caption='Obat' canvasBorderColor='333333' animation='1' numdivlines='4' showNames='1' showValues='0' chartLeftMargin='5' chartRightMargin='5'  chartTopMargin='5' showLegend='0' showAnchors='0' rotateNames='1' formatNumberScale='1' decimalPrecision='2' formatNumber='0' yAxisName='Quantity' divLineColor='CCCCCC'  showAlternateHGridColor='1'>";

           for ($i=0;$i<count($obat);$i++)
	   {
           echo "<set name='".$obat[$i]['nama_item']."' hoverText='".$obat[$i]['nama_item']."' value='".$obat[$i]['jumlah']."' color='AFD8F8'/>";
           }
           echo "</graph>";
           }
        
        }

/* End of file chart.php */
/* Location: ./application/controllers/chart.php */