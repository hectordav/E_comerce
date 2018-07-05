<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_producto_model extends CI_Model {

	public function guardar_inventario($id_producto,$cantidad,$precio_neto,$iva,$total){
		$data = array(
			'id_producto'=>$id_producto,
			'cantidad'=>$cantidad,
			'precio_neto'=>$precio_neto,
			'iva'=>$iva,
			'total'=>$total);
		$this->db->insert('t_inventario_producto', $data);
	}
	public function get_inventario_producto_id($id_inventario){
		$this->db->select('t_producto.nombre as nombre, t_inventario_producto.id as id, t_inventario_producto.cantidad as cantidad,  t_inventario_producto.precio_neto as precio_neto, t_inventario_producto.iva as iva,  t_inventario_producto.total as total');
		$this->db->join('t_producto', 't_inventario_producto.id_producto = t_producto.id', 'left');
		$this->db->where('t_inventario_producto.id', $id_inventario);
		$consulta=$this->db->get('t_inventario_producto',1);
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_inventario_producto_id_producto($id_producto){
		$this->db->select('t_producto.nombre as nombre, t_inventario_producto.id as id, t_inventario_producto.cantidad as cantidad,  t_inventario_producto.precio_neto as precio_neto, t_inventario_producto.iva as iva,  t_inventario_producto.total as total');
		$this->db->join('t_producto', 't_inventario_producto.id_producto = t_producto.id', 'left');
		$this->db->where('t_inventario_producto.id_producto', $id_producto);
		$consulta=$this->db->get('t_inventario_producto',1);
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function actualizar_precio_inventario($id_producto,$precio_neto,$iva,$total){
		$data = array(
			'precio_neto'=>$precio_neto,
			'iva'=>$iva,
			'total'=>$total);
		$this->db->where('id', $id_producto);
		$this->db->update('t_inventario_producto', $data);
	}
	public function actualizar_cantidad_inventario($id_inventario,$cantidad){
		$data = array('cantidad' =>$cantidad);
		$this->db->where('id', $id_inventario);
		$this->db->update('t_inventario_producto', $data);
		
	}
	
}

/* End of file inventario_product_model.php */
/* Location: ./application/models/inventario_product_model.php */