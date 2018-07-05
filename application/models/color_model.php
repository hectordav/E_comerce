<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Color_model extends CI_Model {

		public function get_color(){
				$consulta=$this->db->get('t_color');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
			}	

}

/* End of file categoria_model.php */
/* Location: ./application/models/categoria_model.php */