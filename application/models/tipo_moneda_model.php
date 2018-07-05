<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_moneda_model extends CI_Model {
	public function get_tipo_moneda(){
		$consulta=$this->db->get('t_tipo_moneda');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	

}

/* End of file tipo_moneda_model.php */
/* Location: ./application/models/tipo_moneda_model.php */