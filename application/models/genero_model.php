<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genero_model extends CI_Model {

		public function get_genero(){
			$consulta=$this->db->get('t_genero');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}
	

}

/* End of file genero_model.php */
/* Location: ./application/models/genero_model.php */