<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Keys Controller
 *
 * This is a basic Key Management REST controller to make and delete keys.
 *
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Controller
 * @author      Phil Sturgeon
 * @link        http://philsturgeon.co.uk/code/
*/

// This can be removed if you use __autoload() in config.php
require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller
{  
	/* 
	 * lets set some auth levels for public methods
	 * protected $methods = array(
			'index_get' => array('level' => 1),
			'add_post' => array('level' => 5, 'limit' => 10),
	); */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('taunts');
	}

	function index_get()
	{
		//this should be replaced with the an API glossary - OR lets use swagger docs?
		$data['message'] = "And I thought they smelled bad...on the outside.";
		$data['digest'] = base_url()."docs";
		$data['play'] = base_url()."rate";
		$code = 200;
		$this->response($data, $code);
	}
	
   function add_post()
   {
	   	$taunt = $this->get('taunt');
	   	$game = $this->get('game');
	   	$append = $this->get('append');
	   	$gameTitle = $this->get('gameTitle');
	   	
	   	
	   	
	   	 if($taunt && !$game)
	   	 {
	   	 	$game = "NULL";
	   	 	$this->taunts->newTaunt($taunt,$game);
	   	 	$data['message'] = "taunt added";
	   	 	$code = 200;
	   	 }
	   	 elseif($taunt && $game)
	   	 {
	   	 	$this->taunts->newTaunt($taunt,$game);
	   	 	$data['message'] = "taunt-> ".$taunt." - was added to game -> ".$game;
	   	 	$code = 200;
	   	 }
	   	 elseif($gameTitle)
	   	 {
	   	 	$this->taunts->newGameTitle($gameTitle);
	   	 	$data['message'] = $gameTitle." added to game list";
	   	 	$code = 200;
	   	 }
	   	 elseif($append)
	   	 {
	   	 	$this->taunts->addAppend($append);
	   	 	$data['message'] = "'You shoot like *".$append."*' - added to list of appends";
	   	 	$code = 200;
	   	 }
	   	 else
	   	 {
	   	 	$data['dayum'] = "don't be silly";
	   	 	$code = 404;
	   	 }
	   	 
	   	 $this->response($data, $code);
   	 
   }
   
   function get_get()
   {   		
   		$game = $this->get('game');
   		$limit = $this->get('limit');
   		$definitions = $this->get('definition');
   		$length = $this->get('length');
   		$verb = $this->get('verb');
   		
   		if($verb)
   		{
   			$append = $this->taunts->getAppend();
   			foreach ($append as $row)
   			{
   				$suffix = $row->text;
   				$id = $row->id;
   				$rank = $row->rank;
   			}
   			$data['taunt'] = "You ".$verb." like ".$suffix."!";
   			$data['suffix_used'] = $suffix;
   			$data['suffix_id'] = $id;
   			$data['rank'] = $rank;
   			$code = 200;
   		}
   		   		
   		elseif ($game != "None")
   		{
   			$data['game'] = $this->taunts->searchGame($game,$limit);
   			$taunts = $this->taunts->getTaunts($game,$limit,$length);
   			$data['taunts'] = $taunts;
	   		if($definitions == "true" && $limit==1)
	   			{
	   				$data['definitions'] = $this->taunts->definitions($taunts);
	   			}
   			$code = 200;
   		}
   		else
   		{   
   			$taunts = $this->taunts->getTaunts($game,$limit,$length);
   			$data['result'] = $taunts;
   			if($definitions == "true" && $limit==1)
   			{
   				$data['definitions'] = $this->taunts->definitions($taunts);
   			}
   			$code = 200;
   		}
   		
   		$this->response($data, $code);
   }
   
   function vote_post()
   {
   		$voteUp = $this->get('voteUp');
   		$voteDown = $this->get('voteDown');
   		$append = $this->get('append');
   		if($voteUp == "true" && !$voteDown)
   		{
   			$this->taunts->voteUpAppend($append);
   			$data['append'] = $append;
   			$data['vote'] = "up";
   			$code = 200;
   		}
   		elseif($voteDown == "true" && !$voteUp)
   		{
   			$this->taunts->voteDownAppend($append);
   			$data['append'] = $append;
   			$data['vote'] = "down";
   			$code = 200;
   		}
   		else
   		{
   			$data['error'] = "no data";
   			$code = 404;
   		}
   		
   		$this->response($data, $code);
   }
      
}

?>