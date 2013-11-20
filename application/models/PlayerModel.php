<?php
class PlayerModel extends CI_Model{
	//static variable for table tb_players	
	const TABLE_PLAYER = "tb_players";
	
	public function getAll_Players(){
		$this->db->order_by('id','DESC');
		return $this->db->get(self::TABLE_PLAYER)->result();
	}
	
	public function save($data){
		return $this->db->insert(self::TABLE_PLAYER,$data);
	}
		
}
