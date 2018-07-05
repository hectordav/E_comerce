<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slide_model extends CI_Model {

	public function contar_slide(){
		 $this->db->from('t_slide');
     return $this->db->count_all_results();
	}
	public function guardar_slide($adjunto){
		$data = array('adjunto' =>$adjunto);
		$this->db->insert('t_slide', $data);
	}
	public function get_slide(){
		$consulta=$this->db->get('t_slide');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	

}

/* End of file slide_model.php */
/* Location: ./application/models/slide_model.php */