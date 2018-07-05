<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {

		public function get_categoria($id_genero){
			
				$this->db->where('id_genero', $id_genero);
				$consulta=$this->db->get('t_categoria');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
			}
			public function get_categoria_general(){
				$consulta=$this->db->get('t_categoria');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
			}
			public function get_categoria_id_categoria($id_categoria){
				$this->db->where('id', $id_categoria);
				$consulta=$this->db->get('t_categoria',1);
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
			}
			public function get_productos_categoria_id($id_categoria){
				$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero,t_categoria.id as id_categoria, t_categoria.descripcion as descripcion_categoria, t_sub_categoria.descripcion as descripcion_sub_categoria');
	  		$this->db->join('t_producto', 't_producto.id_categoria = t_categoria.id', 'left');
				$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
				$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');
			
				$this->db->where('t_categoria.id', $id_categoria);
				$this->db->order_by('t_producto.id', 'asc');
				$consulta=$this->db->get('t_categoria');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }			
  	
			}
		

}

/* End of file categoria_model.php */
/* Location: ./application/models/categoria_model.php */