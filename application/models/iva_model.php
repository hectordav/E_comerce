<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iva_model extends CI_Model {

	public function get_iva(){
			$consulta=$this->db->get('t_iva',1);
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}	

}

/* End of file iva_model.php */
/* Location: ./application/models/iva_model.php */