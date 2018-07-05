<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class productos_recomendados_model extends CI_Model {

	public function guardar_productos_recomendados($id_producto){
			$data = array('id_producto' =>$id_producto);
			$this->db->insert('t_productos_recomendados', $data);
		}	
	public function get_productos_recomendados_id($id_productos_recomendados){
		$this->db->where('id', $id_productos_recomendados);
		$consulta=$this->db->get('t_productos_recomendados');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function contar_productos_recomendados(){
      $this->db->from('t_productos_recomendados');
      return $this->db->count_all_results();
    }
    public function get_productos_recomendados(){
  		$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero, t_categoria.descripcion as descripcion_categoria, t_sub_categoria.descripcion as descripcion_sub_categoria');
  		$this->db->join('t_producto', 't_productos_recomendados.id_producto = t_producto.id', 'left');
			$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
			$this->db->join('t_categoria', 't_producto.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');
			$this->db->order_by('t_productos_recomendados.id', 'asc');
			$consulta=$this->db->get('t_productos_recomendados');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
  }

}

/* End of file productos_recomendados_model.php */
/* Location: ./application/models/productos_recomendados_model.php */