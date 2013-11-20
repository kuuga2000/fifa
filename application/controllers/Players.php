<?php
class Players extends CI_Controller{
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model('PlayerModel');
	}
	
	
	public function create(){
		
		$this->player_name = $this->input->post('name');
		$this->birth_place = $this->input->post('birthplace');
		$this->birth_date = $this->input->post('birthdate');
		$this->country_id = $this->input->post('country');
		$this->PlayerModel->save($this);
		
	}
	
	public function delete($id=NULL){
		$this->db->delete('tb_players',array('id'=>$id));
	}
	
	public function index(){
		
					
		$this->load->view('players/index');
	}
	
	//function for get All players	
	public function getAllPlayers(){
		header('Content-type: text/json');
		header('Content-type: application/json');
		$players=$this->PlayerModel->getAll_Players();
		
		foreach($players as $player){
			$data_player[]=$player;
		}
		
		echo json_encode($data_player);
		
	}
}
