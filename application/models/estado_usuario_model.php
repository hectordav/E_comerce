<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado_usuario_model extends CI_Model {

		public function get_estado_usuario(){
				$consulta=$this->db->get('t_tipo_estado_usuario');
					  if($consulta->num_rows() > 0){
					      return $consulta->result();
					  }
			}	

}

/* End of file estado_usuario_model.php */
/* Location: ./application/models/estado_usuario_model.php */