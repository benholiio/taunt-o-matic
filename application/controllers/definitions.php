<?php 
	header('Content-type: application/json');
	class Definitions extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			$this->load->spark('curl/1.2.1');
			$this->load->library('curl');								
			$this->load->model('taunts');
		}
		function index()
		{			
			$game = "";
			$limit = 1;
			$length = "";
			$taunts = $this->taunts->getTaunts($game,$limit,$length);
			$i = 0;
			
			foreach($taunts as $taunt)
			{
				$arr = array(
					"taunt" => $taunt->taunt,
					"definitions" => array()
				);
				$words = explode(" ", $taunt->taunt);
				
				foreach ($words as $word)
				{
					$lookup =  urlencode(strtolower(preg_replace("/[^0-9a-zA-Z\-\_\']/",'', $word)));//strtolower(preg_replace('/[^0-9a-zA-Z\-\_]/',"", $word));
					$arr['definitions'][$i]['word'] = $word;
					$arr['definitions'][$i]['dictionary'] = json_decode($this->curl->simple_get('http://dictionary.stuffby.ws/word/'.$lookup));
					$i++;										
				}
				
			}
			echo json_encode($arr);
		}
	}

?>