<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

		public function get_usuario(){
				$consulta=$this->db->get('t_usuario');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
			}
		public function actualizar_usuario_password($id_usuario,$clave){
			$data = array('clave'=>$clave);
			$this->db->where('id', $id_usuario);
			$this->db->update('t_usuario', $data);
		}
		public function get_usuario_id($id_usuario){
				$this->db->select('t_usuario.id as id_usuario,t_usuario.nombre as nombre, t_usuario.login as login, t_usuario.clave as clave,t_nivel.descripcion as nivel, t_tipo_estado_usuario.descripcion as estado_usuario');
				$this->db->join('t_nivel', 't_usuario.id_nivel = t_nivel.id', 'left');
				$this->db->join('t_tipo_estado_usuario', 't_usuario.id_tipo_estado_usuario = t_tipo_estado_usuario.id', 'left');
				$this->db->where('t_usuario.id', $id_usuario);
				$consulta=$this->db->get('t_usuario');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
			}	
		public function guardar_usuario($id_nivel,$id_tipo_estado_usuario,$nombre,$login,$clave){
			$data = array('id_nivel' =>$id_nivel,
				'id_tipo_estado_usuario' =>$id_tipo_estado_usuario,
				'nombre' =>$nombre,
				'login' =>$login,
				'clave' =>$clave);
			$this->db->insert('t_usuario', $data);
		}
		public function actualizar_usuario($id_usuario,$id_nivel,$id_tipo_estado_usuario,$nombre,$login,$clave){
			$data = array('id_nivel' =>$id_nivel,
				'id_tipo_estado_usuario' =>$id_tipo_estado_usuario,
				'nombre' =>$nombre,
				'login' =>$login,
				'clave' =>$clave);
			$this->db->where('id', $id_usuario);
			$this->db->update('t_usuario', $data);
		}
		public function actualizar_estado_usuario($id_usuario,$id_tipo_estado_usuario){
			$data = array('id_tipo_estado_usuario' =>$id_tipo_estado_usuario);
			$this->db->where('id', $id_usuario);
			$this->db->update('t_usuario', $data);
		}
		public function get_usuario_log_pass($login,$password){
			$this->db->where('login', $login);
			$this->db->where('clave', $password);
			$consulta=$this->db->get('t_usuario',1);
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
		public function get_usuario_login($login){
			$this->db->where('login', $login);
			$consulta=$this->db->get('t_usuario',1);
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}

}

/* End of file usuario_model.php */
/* Location: ./application/models/usuario_model.php */