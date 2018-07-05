<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_categoria_model extends CI_Model {

		public function guardar_subcategoria($id_genero,$id_categoria,$sub_categoria){
			$data = array('id_categoria' =>$id_categoria ,
			'id_genero'=>$id_genero,
			'descripcion'=>$sub_categoria);
			$this->db->insert('t_sub_categoria', $data);
		}
		public function get_sub_categoria($id_sub_categoria){
			$this->db->where('id', $id_sub_categoria);
			$consulta=$this->db->get('t_sub_categoria',1);
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}
		public function get_sub_categoria_id_categoria($id_categoria){
			$this->db->select('id,descripcion');
			$this->db->where('id_categoria', $id_categoria);
			$consulta=$this->db->get('t_sub_categoria');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}
		public function actualizar_sub_categoria($id_sub_categoria,$id_genero,$id_categoria,$sub_categoria){
			$data = array('id_categoria' =>$id_categoria,
			'id_genero'=>$id_genero,
			'descripcion'=>$sub_categoria);
			$this->db->where('id', $id_sub_categoria);
			$this->db->update('t_sub_categoria', $data);
		}
		public function get_sub_categoria_id_genero($id_genero){
			$this->db->select('t_sub_categoria.descripcion as descripcion_sub_cat');
			$this->db->join('t_categoria', 't_sub_categoria.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_genero', 't_categoria.id_genero = t_genero.id', 'left');
			$this->db->where('t_genero.id', $id_genero);
			$consulta=$this->db->get('t_sub_categoria');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
	

}

/* End of file sub_categoria_model.php */
/* Location: ./application/models/sub_categoria_model.php */