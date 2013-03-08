<?php
	class Taunts extends CI_Model
    {
    	function __construct()
    	{
    		parent::__construct();
    		$this->load->spark('curl/1.2.1');
    		$this->load->library('curl');
    	}
        function insert()
        {
            $data = array(
            'taunt' => $this->input->post('taunt'),
            
            );
            
            $this->db->insert('taunt', $data);
            return $taunt = $this->db->insert_id();
        }
        
                
        function get()
        {
            $this->db->select('taunt');
            $events = $this->db->get('taunts');
            return $events->result();
        }
        
        function getTaunts($game,$limit,$length)
        {
        	if($length)
        	{
        		$where = "LENGTH(taunt) <= ".$length;
        		$this->db->where($where);
        	}
        	if($limit)
        	{
        		$this->db->limit($limit);
        		$this->db->order_by("id", "random");
        	}
        	if($game != "None")
        	{
        		$this->db->select('taunt');
        		$this->db->like('game', $game);
        		$query = $this->db->get('taunt');
        		return $query->result();
        	}
        	else {
        		$this->db->select('taunt');
        		$query = $this->db->get('taunt');
        		return $query->result();
        	}
        	
        }
               
        function games()
        {
        	$this->db->select('id,title');
            $data = $this->db->get('game');
            return $data->result();
        }
        
        function searchGame($game)
        {
        	$this->db->like('title', $game);
        	$query = $this->db->get('game');
        	return $query->row()->title;
        }
        
        function newTaunt($taunt,$game)
        {
        	$data = array(
        			'taunt' => $taunt,
        			'game' => $game.','
        			);
        	$this->db->insert('taunt', $data);
        }
        
        function newGameTitle($gameTitle)
        {
        	$data = array(
        			'title' => $gameTitle
        			);
        	$this->db->insert('game', $data);
        }
        
       function definitions($taunts)
	   {		   			 
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
		   		return $arr;
		   	
		   	}
	   }
	   
	   function addAppend($append)
	   {
			$data = array(
		  			'text' => $append);
		  	$this->db->insert('append', $data);
	   }
	   
	   function getAppend()
	   {
			$this->db->limit(1);
		  	$this->db->order_by("id", "random");
		  	$query = $this->db->get('append');
		  	return $query->result();
		  	
	   }
	   
	   function voteUpAppend($append)
	   {
	   		$this->db->query("UPDATE append SET rank = rank + 1 WHERE id=".$append);
	   }
	   
	   function voteDownAppend($append)
	   {
	   	$this->db->query("UPDATE append SET rank = rank - 1 WHERE id=".$append);
	   }
                
    }
?>