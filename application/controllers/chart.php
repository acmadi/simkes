<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Chart extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{

		$this->load->helper('url');
		$this->load->library('id_chart/id_chart');
		$chart['c1'] = $this->id_chart->chart_embed('test',800,250,site_url('chart/example1'),base_url());
		$chart['c2'] = $this->id_chart->chart_embed('test2',800,250,site_url('chart/example2'),base_url());
		$chart['c3'] = $this->id_chart->chart_embed('test3',800,250,site_url('chart/example3'),base_url());
		$chart['c4'] = $this->id_chart->chart_embed('test4',300,300,site_url('chart/example4'),base_url());


		$this->load->view('chart',$chart);
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
}

/* End of file chart.php */
/* Location: ./application/controllers/chart.php */