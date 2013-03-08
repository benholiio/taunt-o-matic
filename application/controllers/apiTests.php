<?php 
	class ApiTests extends CI_Controller
	{
		public function __construct()
		{
			parent::__construct();
				
			$this->load->model('taunts');
		}
		function index()
		{		
		
			{
				header('content-type: application/json; charset=utf-8');
				$data = array();
				$data['apiVersion'] = "0.2";
				$data['swaggerVersion'] = "1.1";
				$data['basePath'] = base_url()."apiTests";
				$data['apis'] = array(
						array(
								'path' => '/add'
		
		
						),
						array(
								'path' => '/get'		
						)
				);
		
		
				echo json_encode($data);
			}
			
			
			
			
		}
		
		function add()
		{
			header('content-type: application/json; charset=utf-8');
			$data = array();
			$data['apiVersion'] = "0.2";
			$data['swaggerVersion'] = "1.1";
			$data['basePath'] = base_url();
			$games = $this->taunts->games();
			foreach($games as $row)
			{
				$list[] = $row->title;
			}
			$data['apis'] = array(
					array(
							'path' => '/add/taunt/{taunt}/game/{game}',
							'description' => 'Add a taunt',
							'operations' => array(array(
									'httpMethod' => 'POST',
									'summary' => 'add a taunt',
									'responseClass' => 'addTaunt',
									'nickname' => 'addTaunt',
									'notes' => 'add a new taunt',
									'parameters' => array(
											array(
													'name' => 'taunt',
													'description' => 'taunt content',
													'paramType' => 'path',
													'required' => true,
													'allowMultiple' => false,
													'dataType' => 'string'
											),
											array(
													'name' => 'game',
													'description' => 'tag this taunt with a game',
													'paramType' => 'path',
													'required' => true,
													'allowMultiple' => false,
													'dataType' => 'string',
													'allowableValues' => array(
															'valueType' => 'LIST',
															'values' => $list
															)
											)),
									'errorResponses' => array(
											array(
													'reason' => 'word',
													'code' => '200'
											),
											array(
													'reason' => 'dayum',
													'code' => '404'
											)
									)
							))
					),
					array(
							'path' => '/add/gameTitle/{gameTitle}',
							'description' => 'Add a game Title',
							'operations' => array(array(
									'httpMethod' => 'POST',
									'summary' => 'add a game title',
									'responseClass' => 'addGame',
									'nickname' => 'addGAme',
									'notes' => 'add a new game title',
									'parameters' => array(
											
											array(
													'name' => 'gameTitle',
													'description' => 'all about the name in the game you got',
													'paramType' => 'path',
													'required' => true,
													'allowMultiple' => false,
													'dataType' => 'string'
											)),
									'errorResponses' => array(
											array(
													'reason' => 'word',
													'code' => '200'
											),
											array(
													'reason' => 'dayum',
													'code' => '404'
											)
									)
							))
					),
					array(
							'path' => '/add/append/{append}',
							'description' => 'Add a taunt suffix',
							'operations' => array(array(
									'httpMethod' => 'POST',
									'summary' => 'Add a taunt suffix',
									'responseClass' => 'addSuffix',
									'nickname' => 'addSuffix',
									'notes' => 'Add a taunt suffix',
									'parameters' => array(
												
											array(
													'name' => 'append',
													'description' => 'ends a taunt. e.g. an example prefix is "you shoot like" - you could put something like - a girl, or my grandmother, stevie wonder',
													'paramType' => 'path',
													'required' => true,
													'allowMultiple' => false,
													'dataType' => 'string'
											)),
									'errorResponses' => array(
											array(
													'reason' => 'append',
													'code' => '200'
											),
											array(
													'reason' => 'dayum',
													'code' => '404'
											)
									)
							))
					)
					
			);
			
			echo json_encode($data);
		}
		
		function get()
		{
			header('content-type: application/json; charset=utf-8');
			$data = array();
			$data['apiVersion'] = "0.2";
			$data['swaggerVersion'] = "1.1";
			$data['basePath'] = base_url();
			$games = $this->taunts->games();
			foreach($games as $row)
			{
				$list[] = $row->title;
			}
			$data['apis'] = array(
					array(
							'path' => '/get/game/{game}/limit/{limit}/definition/{definition}/length/{length}',
							'description' => 'get taunts',
							'operations' => array(array(
									'httpMethod' => 'GET',
									'summary' => 'get taunts',
									'responseClass' => 'getTaunt',
									'nickname' => 'getTaunt',
									'notes' => 'retrieve taunts',
									'parameters' => array(
											array(
													'name' => 'game',
													'description' => 'game title (search)',
													'paramType' => 'path',
													'required' => true,
													'allowMultiple' => false,
													'dataType' => 'string',
													'allowableValues' => array(
															'valueType' => 'LIST',
															'values' => $list
													)
											),
											array(
													'name' => 'limit',
													'description' => 'limit results',
													'paramType' => 'path',
													'required' => false,
													'allowMultiple' => false,
													'dataType' => 'integer'
											),
											array(
													'name' => 'definition',
													'description' => 'include definition (only available on single taunt)',
													'paramType' => 'path',
													'required' => false,
													'allowMultiple' => false,
													'dataType' => 'boolean'
											),
											array(
													'name' => 'length',
													'description' => 'maximum taunt length',
													'paramType' => 'path',
													'required' => false,
													'allowMultiple' => false,
													'dataType' => 'integer'
											)),
									'errorResponses' => array(
											array(
													'reason' => 'word',
													'code' => '200'
											),
											array(
													'reason' => 'dayum',
													'code' => '404'
											)
									)
							))
					)
						
			);
				
			echo json_encode($data);
		}
	}
?>