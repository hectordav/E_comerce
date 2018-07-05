<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

		public function guardar_cliente($dni,$nombre,$direccion_1,$direccion_2,$telf,$email){
			$data= array('dni'=>$dni,
			'nombre'=>$nombre,
			'direccion'=>$direccion_1,
			'direccion_envio'=>$direccion_2,
			'telf'=>$telf,
			'email'=>$email);
			$this->db->insert('t_cliente', $data);
		}
		public function get_cliente_dni($dni){
			$this->db->where('dni', $dni);
			$consulta=$this->db->get('t_cliente');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}
		

}

/* End of file categoria_model.php */
/* Location: ./application/models/categoria_model.php */