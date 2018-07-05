<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class politicas_devolucion_model extends CI_Model {

	public function guardar_politicas_devolucion($descripcion){
			$data = array('descripcion' =>$descripcion);
			$this->db->insert('t_politicas_devolucion', $data);
		}
	public function get_politicas_devolucion(){
		$consulta=$this->db->get('t_pol_ter_con');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}	

}

/* End of file pol_ter_con_model.php */
/* Location: ./application/models/pol_ter_con_model.php */