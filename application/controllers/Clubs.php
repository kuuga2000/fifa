<?php
class Clubs extends CI_Controller{
	
	
	public function __construct(){
		parent::__construct();
		$this->load->model(array('ClubsModel','CountriesModel'));
	}
	
	
	public function create(){
		$this->club_name  = $this->input->post('name');
		$this->country_id = $this->input->post('country');
		$this->nickname   = $this->input->post('nickname');
		$this->on_stand   = $this->input->post('onstand');
		$this->ClubsModel->save($this);
	}
	
	public function delete($id=NULL){
		$this->db->delete('tb_clubs',array('id'=>$id));
	}
	
	public function index(){
		$data['countries']=$this->CountriesModel->getAll_Countries();
		$this->load->view('clubs/index',$data);
	}
	
	//function for get All clubs	
	public function getAllClubs(){
		header('Content-type: text/json');
		header('Content-type: application/json');
		$clubs=$this->ClubsModel->getAll_Clubs();
		
		foreach($clubs as $club){
			$data_club[]=$club;
		}
		
		echo json_encode($data_club);
	}
}