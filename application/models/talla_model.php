<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Talla_model extends CI_Model {

		public function get_talla(){
				$consulta=$this->db->get('t_talla');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
			}	

}

/* End of file categoria_model.php */
/* Location: ./application/models/categoria_model.php */