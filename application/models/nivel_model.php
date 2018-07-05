<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nivel_model extends CI_Model {

	public function get_nivel(){
		$consulta=$this->db->get('t_nivel');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}	

}

/* End of file nivel_model.php */
/* Location: ./application/models/nivel_model.php */