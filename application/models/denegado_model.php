<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denegado_model extends CI_Model {

	public function get_denegado_codigo($error_code){
		$this->db->where('codigo', $error_code);
		$consulta=$this->db->get('t_denegado');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	

}

/* End of file denegado_model.php */
/* Location: ./application/models/denegado_model.php */