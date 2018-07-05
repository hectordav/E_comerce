<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado_pedido_model extends CI_Model {

		public function get_estado_pedido(){
			$consulta=$this->db->get('t_estado_pedido');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
	

}

/* End of file estado_pedido.php */
/* Location: ./application/models/estado_pedido.php */