<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quienes_somos_model extends CI_Model {
	
	public function guardar_quienes_somos($descripcion){
		$data = array('descripcion' =>$descripcion);
		$this->db->insert('t_quienes_somos', $data);
	}
	public function get_quienes_somos(){
		$consulta=$this->db->get('t_quienes_somos');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	

}

/* End of file quienes_somos_model.php */
/* Location: ./application/models/quienes_somos_model.php */