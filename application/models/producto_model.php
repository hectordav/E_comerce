<?php

class Producto_model extends CI_Model {

		public function guardar_producto($id_genero,$id_categoria,$id_sub_categoria,$codigo,$nombre,$descripcion,$archivo_1,$archivo_2,$archivo_3,$archivo_4){
		$data = array('id_genero'=>$id_genero,
			'id_categoria'=>$id_categoria,
			'id_sub_categoria'=>$id_sub_categoria,
			'codigo'=>$codigo,
			'nombre'=>$nombre,
			'descripcion_1'=>$descripcion,
			'adjunto_1'=>$archivo_1,
			'adjunto_2'=>$archivo_2,
			'adjunto_3'=>$archivo_3,
			'adjunto_4'=>$archivo_4);
		$this->db->insert('t_producto', $data);
		}
		public function get_max_producto(){
      $this->db->select_max('id');
      $contra_peritaje=$this->db->get('t_producto');
      if($contra_peritaje->num_rows()> 0){
          return $contra_peritaje->result();
        }
    }
    public function guardar_talla($id_producto,$id_talla){
    	$data = array('id_producto' =>$id_producto,
    	'id_talla'=>$id_talla );
    	$this->db->insert('t_talla_producto', $data);
    }
    public function guardar_color($id_producto,$id_color){
    	$data = array('id_producto' =>$id_producto,
    	'id_color'=>$id_color );
    	$this->db->insert('t_color_producto', $data);
    }

		public function actualizar_producto($id_producto,$id_genero,$id_categoria,$id_sub_categoria,$id_talla,$id_color,$codigo,$nombre,$descripcion,$archivo_1,$archivo_2,$archivo_3,$archivo_4){
		$data = array('id_genero'=>$id_genero,
			'id_categoria'=>$id_categoria,
			'id_sub_categoria'=>$id_sub_categoria,
			'id_talla'=>$id_talla,
			'id_color'=>$id_color,
			'codigo'=>$codigo,
			'nombre'=>$nombre,
			'descripcion_1'=>$descripcion,
			'adjunto_1'=>$archivo_1,
			'adjunto_2'=>$archivo_2,
			'adjunto_3'=>$archivo_3,
			'adjunto_4'=>$archivo_4);
		$this->db->where('id', $id_producto);
		$this->db->update('t_producto', $data);
		}
		public function actualizar_producto_sin_adjunto($id_producto,$id_genero,$id_categoria,$id_sub_categoria,$codigo,$nombre,$descripcion){
		$data = array('id_genero'=>$id_genero,
			'id_categoria'=>$id_categoria,
			'id_sub_categoria'=>$id_sub_categoria,
			'codigo'=>$codigo,
			'nombre'=>$nombre,
			'descripcion_1'=>$descripcion);
		$this->db->where('id', $id_producto);
		$this->db->update('t_producto', $data);
		}
	
		public function get_producto_id($id_producto){
			$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero, t_categoria.descripcion as descripcion_categoria, t_inventario_producto.total as total');
			$this->db->join('t_inventario_producto', 't_inventario_producto.id_producto = t_producto.id', 'right');
			$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
			$this->db->join('t_categoria', 't_producto.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');
			$this->db->where('t_producto.id', $id_producto);
			$consulta=$this->db->get('t_producto',1);
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}
		public function get_talla_id_producto($id_producto){
			$this->db->select('t_talla_producto.id as id_talla_producto, t_talla.descripcion as descripcion_talla');
			$this->db->join('t_talla', 't_talla_producto.id_talla = t_talla.id', 'left');
			$this->db->where('t_talla_producto.id_producto', $id_producto);
			$consulta=$this->db->get('t_talla_producto');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }

		}
		public function get_color_id_producto($id_producto){
			$this->db->select('t_color_producto.id as id_color_producto, t_color.descripcion as descripcion_color');
			$this->db->join('t_color', 't_color_producto.id_color = t_color.id', 'left');
			$this->db->where('t_color_producto.id_producto', $id_producto);
			$consulta=$this->db->get('t_color_producto');
				  if($consulta->num_rows() > 0){
				      return $consulta->result();
				  }
		}
		
		public function get_producto_id_sub_categoria($id_sub_categoria){
			$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero, t_categoria.descripcion as descripcion_categoria');
			$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
			$this->db->join('t_categoria', 't_producto.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');
			$this->db->where('t_producto.id_sub_categoria', $id_sub_categoria);
			$consulta=$this->db->get('t_producto');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}
		public function get_producto(){
			$this->db->select('t_producto.id as id_producto, t_producto.codigo as codigo, t_producto.nombre as nombre, t_producto.descripcion_1 as descripcion, t_producto.adjunto_1 as adjunto_1, t_producto.adjunto_2 as adjunto_2, t_producto.adjunto_3 as adjunto_3,t_producto.adjunto_4 as adjunto_4,t_genero.descripcion as descripcion_genero, t_categoria.descripcion as descripcion_categoria');
			$this->db->join('t_genero', 't_producto.id_genero = t_genero.id', 'left');
			$this->db->join('t_categoria', 't_producto.id_categoria = t_categoria.id', 'left');
			$this->db->join('t_sub_categoria', 't_producto.id_sub_categoria = t_sub_categoria.id', 'left');

			$consulta=$this->db->get('t_producto');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		}
	}

/* End of file producto_model.php */
/* Location: ./application/models/producto_model.php */
