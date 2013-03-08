<?
	class Rate extends CI_Controller
	{
		function index()
		{
			$this->load->view('header');
			$this->load->view('rate');
			$this->load->view('footer');
		}
	}
?>