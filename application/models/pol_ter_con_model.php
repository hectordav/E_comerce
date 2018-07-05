<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pol_ter_con_model extends CI_Model {

	public function guardar_pol_ter_con($descripcion){
			$data = array('descripcion' =>$descripcion);
			$this->db->insert('t_pol_ter_con', $data);
		}
	public function get_pol_ter_con(){
		$consulta=$this->db->get('t_pol_ter_con');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}	

}

/* End of file pol_ter_con_model.php */
/* Location: ./application/models/pol_ter_con_model.php */