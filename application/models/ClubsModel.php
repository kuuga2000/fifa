<?php
class ClubsModel extends CI_Model{
	//static variable for table tb_players	
	const TABLE_CLUB = "tb_clubs";
	public function getAll_Clubs(){
		$this->db->order_by('id','DESC');
		return $this->db->from(self::TABLE_CLUB)
		         		->join('tb_countries countries','countries.id ='.self::TABLE_CLUB.'.country_id','LEFT')
				 		->select('countries.country_name, tb_clubs.*')
				 		->get()->result();
		
		//$this->db->order_by('id','DESC');
		//return $this->db->get(self::TABLE_CLUB)->result();
	}
	public function save($data){
		return $this->db->insert(self::TABLE_CLUB,$data);
	}
}