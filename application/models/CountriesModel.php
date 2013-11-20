<?php
class CountriesModel extends CI_Model{
	//static variable for table tb_players	
	const TABLE_COUNTRY = "tb_countries";
	
	public function getAll_Countries(){
		$this->db->order_by('id','DESC');
		return $this->db->get(self::TABLE_COUNTRY)->result();
	}
	
	public function save($data){
		return $this->db->insert(self::TABLE_COUNTRY,$data);
	}
		
}
