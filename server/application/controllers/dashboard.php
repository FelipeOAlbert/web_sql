<?php defined('BASEPATH') OR exit('No direct script access allowed');

class dashboard extends CI_Controller {
	
	private $data;

	function __construct()
	{
		parent::__construct();
		$this->load->model("admin_model", "admin");
	}
	
	function index()
	{
		die('Teste');
	}
	
	public function sync()
	{
		header('Access-Control-Allow-Origin: *');
		
		if($_POST){
			
			// sincroniza os dados
			$retorno = $this->admin->save();
			
			if($retorno){
				echo json_encode(array('retorno' => 'sucess'));
				die();
			}
			
			echo json_encode(array('retorno' => false));
			die();
		}
		
		die('sem post');
	}
}