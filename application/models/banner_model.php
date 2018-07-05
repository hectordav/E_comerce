<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner_model extends CI_Model {

	public function guardar_banner($id_producto){
			$data = array('id_producto' =>$id_producto);
			$this->db->insert('t_banner', $data);
		}	
	public function get_banner_id($id_banner){
		$this->db->where('id', $id_banner);
		$consulta=$this->db->get('t_banner');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function contar_productos_banner(){
     $this->db->from('t_banner');
      return $this->db->count_all_results();
    }
  public function get_producto_banner(){
  		$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero,t_categoria.id as id_categoria, t_categoria.descripcion as descripcion_categoria, t_sub_categoria.descripcion as descripcion_sub_categoria');
  		$this->db->join('t_producto', 't_banner.id_producto = t_producto.id', 'left');
			$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
			$this->db->join('t_categoria', 't_producto.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');
			$consulta=$this->db->get('t_banner');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
  }

}

/* End of file banner_model.php */
/* Location: ./application/models/banner_model.php */