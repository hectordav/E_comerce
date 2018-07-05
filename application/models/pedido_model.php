<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido_model extends CI_Model {

	public function guardar_pedido($id_estado_pedido,$id_tipo_pago,$id_usuario, $id_pre_pedido, $total, $fecha, $fecha_pago){
		$data = array(	'id_usuario'=>$id_usuario,
			'id_estado_pedido'=>$id_estado_pedido,
			'id_tipo_pago'=>$id_tipo_pago,
			'num_factura'=>$id_pre_pedido,
			'total'=>$total,
			'fecha'=>$fecha,
			'fecha_pago'=>$fecha_pago);
		$this->db->insert('t_pedido', $data);
	}
	public function get_max_pedido(){
		$this->db->select_max('id');
		$consulta=$this->db->get('t_pedido');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function guardar_det_pedido($id_pedido_2,$id_inventario_producto,$id_talla_producto,$id_color_producto,$descripcion,$cantidad,$total){
		$data = array('id_pedido'=>$id_pedido_2,
		'id_inventario_producto'=>$id_inventario_producto,
		'id_talla_producto'=>$id_talla_producto,
		'id_color_producto'=>$id_color_producto,
		'descripcion'=>$descripcion,
		'cantidad'=>$cantidad,
		'total'=>$total);
		$this->db->insert('t_det_pedido', $data);

	}
	public function get_pedido_id($id_pedido){
		$this->db->select('t_pedido.id as id_pedido, t_pedido.num_factura as num_fact, t_pedido.total as total_fact, t_pedido.fecha as fecha_pedido, t_pedido.observaciones as observaciones_pedido, t_estado_pedido.descripcion as estado_pedido, t_tipo_pago.descripcion as tipo_pago, t_cliente.nombre as nombre_cliente, t_cliente.dni as dni_cliente, t_cliente.direccion_envio as direccion_envio, t_cliente.telf as telf_cliente,t_cliente.email as email_cliente ');
		$this->db->join('t_usuario', 't_pedido.id_usuario = t_usuario.id', 'left');
		$this->db->join('t_cliente', 't_usuario.id_cliente = t_cliente.id', 'left');
		$this->db->join('t_estado_pedido', 't_pedido.id_estado_pedido = t_estado_pedido.id', 'left');
		$this->db->join('t_tipo_pago', 't_pedido.id_tipo_pago = t_tipo_pago.id', 'left');
			$this->db->where('t_pedido.id', $id_pedido);
			$consulta=$this->db->get('t_pedido',1);
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
	}
	public function get_det_pedido_id_pedido($id_pedido){
		$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero,t_categoria.id as id_categoria, t_categoria.descripcion as descripcion_categoria, t_sub_categoria.descripcion as descripcion_sub_categoria, t_det_pedido.id as id_det_pedido, t_det_pedido.cantidad as cantidad_det_pedido, t_det_pedido.total as total_det_pedido,t_talla.descripcion as descripcion_talla, t_color.descripcion as descripcion_color');
			$this->db->join('t_inventario_producto', 't_det_pedido.id_inventario_producto = t_inventario_producto.id', 'left');
			$this->db->join('t_producto', 't_inventario_producto.id_producto = t_producto.id', 'left');
			$this->db->join('t_talla_producto', 't_det_pedido.id_talla_producto = t_talla_producto.id', 'left');
			$this->db->join('t_color_producto', 't_det_pedido.id_color_producto = t_color_producto.id', 'left');
			$this->db->join('t_talla', 't_talla_producto.id_talla = t_talla.id', 'left');
			$this->db->join('t_color', 't_color_producto.id_color = t_color.id', 'left');
			$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
			$this->db->join('t_categoria', 't_producto.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');
			$this->db->where('t_det_pedido.id_pedido', $id_pedido);
			$consulta=$this->db->get('t_det_pedido');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
	}
	public function actualizar_estado($id_pedido,$id_estado_pedido,$observaciones){
		$data = array('id_estado_pedido' =>$id_estado_pedido,
		'observaciones'=>$observaciones);
		$this->db->where('id', $id_pedido);
		$this->db->update('t_pedido', $data);
	}


}

/* End of file pedido_model.php */
/* Location: ./application/models/pedido_model.php */