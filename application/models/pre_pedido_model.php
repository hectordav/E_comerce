<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pre_pedido_model extends CI_Model {

	public function guardar_pre_pedido($id_usuario,$fecha){
		$data = array('id_usuario' =>$id_usuario,
		'fecha'=>$fecha );
		$this->db->insert('t_pre_pedido', $data);
	}

		public function buscar_pre_pedido($id_usuario){
			$this->db->where('id_usuario', $id_usuario);
			$consulta=$this->db->get('t_pre_pedido',1);
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
			
		}
		public function buscar_pre_pedido_id_prepedido($id_pedido){
			$this->db->where('id',$id_pedido);
			$consulta=$this->db->get('t_pre_pedido');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
		public function guardar_det_pre_pedido($id_pre_pedido,$id_inventario,$talla,$color,$nombre_producto,$cantidad_2,$precio_neto,$iva,$total_carrito){
			$data = array('id_pre_pedido'=>$id_pre_pedido,
				'id_inventario_producto'=>$id_inventario,
				'id_talla_producto'=>$talla,
				'id_color_producto'=>$color,
				'descripcion'=>$nombre_producto,
				'cantidad'=>$cantidad_2,
				'precio_neto'=>$precio_neto,
				'iva'=>$iva,
				'total'=>$total_carrito);
			$this->db->insert('t_det_pre_pedido', $data);
		}
		public function guarda_token($id_pre_pedido,$sessionToken){
			$data = array('id_pre_pedido' =>$id_pre_pedido,
			'token' =>$sessionToken);
			$this->db->insert('t_token_pedido', $data);
		}

		public function actualizar_prepedido($id_pre_pedido,$nuevo_total)		{
			$data = array('total' =>$nuevo_total);
			$this->db->where('id', $id_pre_pedido);
			$this->db->update('t_pre_pedido', $data);
		}
		public function get_pre_pedido_id($id_pre_pedido){
			$this->db->where('id', $id_pre_pedido);
			$consulta=$this->db->get('t_pre_pedido',1);
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
		public function buscar_det_pedido_id($id_pre_pedido){
			$this->db->where('id_pre_pedido',$id_pre_pedido );
			$consulta=$this->db->get('t_det_pre_pedido');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
		public function get_det_pre_pedido_id($id_pre_pedido){
			$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero,t_categoria.id as id_categoria, t_categoria.descripcion as descripcion_categoria, t_sub_categoria.descripcion as descripcion_sub_categoria, t_det_pre_pedido.id as id_det_pedido, t_det_pre_pedido.cantidad as cantidad_det_pedido, t_det_pre_pedido.iva as iva_det_pedido, t_det_pre_pedido.total as total_det_pedido, t_talla.descripcion as descripcion_talla, t_color.descripcion as descripcion_color');
			$this->db->join('t_inventario_producto', 't_det_pre_pedido.id_inventario_producto = t_inventario_producto.id', 'left');
			$this->db->join('t_producto', 't_inventario_producto.id_producto = t_producto.id', 'left');
			$this->db->join('t_talla_producto', 't_det_pre_pedido.id_talla_producto = t_talla_producto.id', 'left');
			$this->db->join('t_color_producto', 't_det_pre_pedido.id_color_producto = t_color_producto.id', 'left');
			$this->db->join('t_talla', 't_talla_producto.id_talla = t_talla.id', 'left');
			$this->db->join('t_color', 't_color_producto.id_color = t_color.id', 'left');
			$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
			$this->db->join('t_categoria', 't_producto.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');
			$this->db->where('t_det_pre_pedido.id_pre_pedido', $id_pre_pedido);
			$consulta=$this->db->get('t_det_pre_pedido');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
		public function get_det_pre_pedido($id_det_pre_pedido){
			$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero,t_categoria.id as id_categoria, t_categoria.descripcion as descripcion_categoria, t_sub_categoria.descripcion as descripcion_sub_categoria, t_det_pre_pedido.id as id_det_pedido, t_det_pre_pedido.cantidad as cantidad_det_pedido, t_det_pre_pedido.iva as iva_det_pedido, t_det_pre_pedido.total as total_det_pedido ');
			$this->db->join('t_inventario_producto', 't_det_pre_pedido.id_inventario_producto = t_inventario_producto.id', 'left');
			$this->db->join('t_producto', 't_inventario_producto.id_producto = t_producto.id', 'left');
			$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
			$this->db->join('t_categoria', 't_producto.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');
			$this->db->where('t_det_pre_pedido.id', $id_det_pre_pedido);
			$consulta=$this->db->get('t_det_pre_pedido');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
		public function borrar_det_pedido($id_det_pre_pedido){
			$this->db->where('id', $id_det_pre_pedido);
			$this->db->delete('t_det_pre_pedido');
		}
		public function borrar_pre_pedido($id_pre_pedido){
			$this->db->where('id', $id_pre_pedido);
			$this->db->delete('t_pre_pedido');
		}
		public function sumar_articulos_det_pre_pedido($id_pre_pedido){
			$this->db->select('SUM(cantidad) as total');
			$this->db->where('id_pre_pedido', $id_pre_pedido);
			$consulta=$this->db->get('t_det_pre_pedido');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
		

}

/* End of file categoria_model.php */
/* Location: ./application/models/categoria_model.php */