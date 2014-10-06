<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class admin_model extends CI_Model{

	var $tablename = "data";

	public final function __construct()
	{
		parent::__construct();
	}

	function save()
	{
		$data = array();
		
		foreach($this->input->post('data') as $k => $value){
			$data[$k]['hash'] = $value['id'];
			$data[$k]['nome'] = $value['name'];
			$data[$k]['email'] = $value['email'];
			
			// verifica se ja esta salvo, se estiver, atualiza
			$rows = $this->db->get_where($this->tablename, array('hash' => $data[$k]['hash']))->result_array();
			
			if($rows){
				
				$data[$k]['editado']	= date('Y-m-d H:i:s');
				
				if(!$this->db->where(array('hash' => $data[$k]['hash']))->update($this->tablename, $data[$k])){
					return false;
				}
			}else{
				
				$data[$k]['criado']	= date('Y-m-d H:i:s');
				
				if(!$this->db->insert($this->tablename, $data[$k])){
					return false;
				}
			}
		}
		
		return true;
	}
}