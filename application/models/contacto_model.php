<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto_model extends CI_Model {

	public function guardar_contacto($descripcion){
		$data = array('descripcion' =>$descripcion);
		$this->db->insert('t_contacto', $data);
	}
	public function get_contacto(){
		$consulta=$this->db->get('t_contacto');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}	

}

/* End of file contacto_model.php */
/* Location: ./application/models/contacto_model.php */