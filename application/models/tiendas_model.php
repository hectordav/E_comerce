<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiendas_model extends CI_Model {

	public function guardar_tienda($descripcion){
		$data = array('descripcion' =>$descripcion);
		$this->db->insert('t_tiendas', $data);
	}
	public function get_tiendas(){
		$consulta=$this->db->get('t_tiendas');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}	

}

/* End of file contacto_model.php */
/* Location: ./application/models/contacto_model.php */