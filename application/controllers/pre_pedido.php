<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pre_pedido extends CI_Controller {
	public function __construct()
	{
	
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('inventario_producto_model');
			$this->load->model('pre_pedido_model');
			$this->load->model('producto_model');
			$this->load->model('genero_model');
			$this->load->model('categoria_model');
			$this->load->model('sub_categoria_model');
			$this->load->model('banner_model');
			$this->load->model('modas_model');
			$this->load->model('coleccion_destacada_model');
			$this->load->model('productos_recomendados_model');
			$this->load->model('tipo_moneda_model');
			$this->load->model('slide_model');
			$this->load->model('pol_ter_con_model');
	}
	public function index(){
			redirect('pre_pedido/grilla');
	}
	public function agregar_producto_carrito(){
		$id_producto1['id_producto']=$this->input->post('txt_id_producto','true');
		$cantidad['cantidad']=$this->input->post('id_cantidad','true');
		$talla['talla']=$this->input->post('id_talla_producto','true');
		$color['color']=$this->input->post('id_color_producto','true');
	
			if ($this->session->userdata('logueado')) {
			
			if (!$id_producto1['id_producto'] || !$cantidad['cantidad']|| !$talla['talla'] || !$color['color']) {
			
				$id_producto_2=$this->session->userdata('id_producto');
				$cantidad=$this->session->userdata('cantidad');
				$talla=$this->session->userdata('talla');
				$color=$this->session->userdata('color');
			}else{
				$id_producto_2=$id_producto1['id_producto'];
				$cantidad=$cantidad['cantidad'];
				$talla=$talla['talla'];
				$color=$color['color'];
			}
			
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$consulta=$this->inventario_producto_model->get_inventario_producto_id_producto($id_producto_2);
			foreach ($consulta as $key) {
				$id_inventario=$key->id;
				$nombre_producto=$key->nombre;
				$precio_neto=$key->precio_neto;
				$iva=$key->iva;
				$total=$key->total;
			}
			$id_usuario=$data_usuario['id_usuario'];
			$consulta_pre_pedido=$this->pre_pedido_model->buscar_pre_pedido($id_usuario);
			/*si existe el pre_pedido*/
			if ($consulta_pre_pedido) {
				foreach ($consulta_pre_pedido as $key) {
					$id_pre_pedido=$key->id;
					$total_prepedido=$key->total;
				}
				$cantidad_2=$cantidad;
				$total_carrito=$total*$cantidad_2;
				$nuevo_total=$total_prepedido+$total_carrito;
				$this->pre_pedido_model->guardar_det_pre_pedido($id_pre_pedido,$id_inventario,$talla,$color,$nombre_producto,$cantidad_2,$precio_neto,$iva,$total_carrito);
				$this->pre_pedido_model->actualizar_prepedido($id_pre_pedido,$nuevo_total);		
			}else{
			/*si no existe lo crea*/
				$fecha=date('Y-m-d');
				$this->pre_pedido_model->guardar_pre_pedido($id_usuario,$fecha);
				$consulta_pre_pedido=$this->pre_pedido_model->buscar_pre_pedido($id_usuario);
			if ($consulta_pre_pedido) {
				foreach ($consulta_pre_pedido as $key) {
					$id_pre_pedido=$key->id;
					$total_prepedido=$key->total;
				}
				$cantidad_2=$cantidad;
				$total_carrito=$total*$cantidad_2;
				$nuevo_total=$total_prepedido+$total_carrito;
				$this->pre_pedido_model->guardar_det_pre_pedido($id_pre_pedido,$id_inventario,$talla,$color,$nombre_producto,$cantidad_2,$precio_neto,$iva,$total_carrito);
				$this->pre_pedido_model->actualizar_prepedido($id_pre_pedido,$nuevo_total);
			}
			}
		$this->session->set_flashdata('alerta', 'Articulo Agregado');
				redirect('pagina_principal/home','refresh');
		}else{
			$this->session->set_userdata($id_producto1);
			$this->session->set_userdata($cantidad);
			$this->session->set_userdata($talla);
			$this->session->set_userdata($color);
			redirect('login/index','refresh');
		}
	}
	public function check_out(){
		
		if ($this->session->userdata('logueado')) {
				$id_pre_pedido=$this->uri->segment(3);
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		
			if (!$id_pre_pedido) {
				$id_pre_pedido=$this->input->post('txt_id_pre_pedido','true');
						echo $id_pre_pedido;
						
			}
			if (!$id_pre_pedido) {
				$id_pre_pedido=$this->session->userdata('pepe');
			}

			if (!$id_pre_pedido) {
				$this->session->set_flashdata('alerta', 'No hay Articulos');
					redirect('pagina_principal/home','refresh');
			}
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Zonas');
			$crud->set_language('spanish');
			$output = $crud->render();
			/*masculino*/
			$id_genero1=3;
			/*femenino*/
			$id_genero2=4;
			$consulta=$this->pre_pedido_model->get_pre_pedido_id($id_pre_pedido);
			if (!$consulta) {
				$this->session->set_flashdata('alerta', 'No hay Articulos');
				redirect('pagina_principal/home','refresh');
			}elseif ($consulta) {
				foreach ($consulta as $key) {
					$total=$key->total;
				}
				if ($total<=0) {
					$this->pre_pedido_model->borrar_pre_pedido($id_pre_pedido);
					$this->session->set_flashdata('alerta', 'No hay Articulos');
							redirect('pagina_principal/home','refresh');
				}
			}
			$consulta=$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']);
			if ($consulta) {
				foreach ($consulta as $key) {
					$id_pre_pedido=$key->id;
				}
				$suma_det_pre_pedido=$this->pre_pedido_model->sumar_articulos_det_pre_pedido($id_pre_pedido);
			foreach ($suma_det_pre_pedido as $key) {
				$total=$key->total;
			}
			}else{
				$total=0;
			}
			$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'pre_pedido'=>$this->pre_pedido_model->get_pre_pedido_id($id_pre_pedido),
				'det_pre_pedido'=>$this->pre_pedido_model->get_det_pre_pedido_id($id_pre_pedido),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'tipo_moneda'=>$this->tipo_moneda_model->get_tipo_moneda(),
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/cabecera_check_out');
			$this->load->view('../../assets/lib_visa/lib.inc');
			$this->load->view('../../assets/lib_visa/funciones.php');
			$this->load->view('../../assets/inc/head_common_check_out', $output);
			$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('pre_pedido/check_out',$data);
			$this->load->view('../../assets/inc/footer_common_principal',$output);
		}else{
			redirect('login','refresh');
		}
	}
	public function terminos_condiciones(){
		$this->load->library('visanet/visanet');
		if ($this->session->userdata('logueado')) {
				$id_pre_pedido=$this->uri->segment(3);
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		
			if (!$id_pre_pedido) {
				$id_pre_pedido=$this->input->post('txt_id_pre_pedido','true');
						echo $id_pre_pedido;
						
			}
			if (!$id_pre_pedido) {
				$id_pre_pedido=$this->session->userdata('pepe');
			}

			if (!$id_pre_pedido) {
				$this->session->set_flashdata('alerta', 'No hay Articulos');
					redirect('pagina_principal/home','refresh');
			}
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Zonas');
			$crud->set_language('spanish');
			$output = $crud->render();
			/*masculino*/
			$id_genero1=3;
			/*femenino*/
			$id_genero2=4;
			$consulta=$this->pre_pedido_model->get_pre_pedido_id($id_pre_pedido);
			if (!$consulta) {
				$this->session->set_flashdata('alerta', 'No hay Articulos');
				redirect('pagina_principal/home','refresh');
			}elseif ($consulta) {
				foreach ($consulta as $key) {
					$total=$key->total;
				}
				if ($total<=0) {
					$this->pre_pedido_model->borrar_pre_pedido($id_pre_pedido);
					$this->session->set_flashdata('alerta', 'No hay Articulos');
							redirect('pagina_principal/home','refresh');
				}
			}
			$consulta=$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']);
			if ($consulta) {
				foreach ($consulta as $key) {
					$id_pre_pedido=$key->id;
				}
				$suma_det_pre_pedido=$this->pre_pedido_model->sumar_articulos_det_pre_pedido($id_pre_pedido);
			foreach ($suma_det_pre_pedido as $key) {
				$total=$key->total;
			}
			}else{
				$total=0;
			}

			/* CREACION DE VARIABLES PARA PASARELA VISANET */

				$amount = number_format((float)round(($total),2), 2, '.', '');
				$sessionToken = $this->visanet->getGUID();
				$merchantid = "601653907";
				$sessionKey = $this->visanet->create_token($amount,"prd",$merchantid,"AKIAIQNH4QT56YCEDETA","o8a6VV58bMwgof5evrgbswJZzbmMMxwHuBAQr1AV",$sessionToken);
				$this->visanet->guarda_sessionKey($sessionKey);
				$this->visanet->guarda_sessionToken($sessionToken);
				
			/* FIN - CREACION DE VARIABLES PARA PASARELA VISANET */

			$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'pre_pedido'=>$this->pre_pedido_model->get_pre_pedido_id($id_pre_pedido),
				'det_pre_pedido'=>$this->pre_pedido_model->get_det_pre_pedido_id($id_pre_pedido),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'tipo_moneda'=>$this->tipo_moneda_model->get_tipo_moneda(),
				'slide'=>$this->slide_model->get_slide(),
				'pol_ter_con'=>$this->pol_ter_con_model->get_pol_ter_con(),
				'sessionToken' => $sessionToken,
				'merchantid'   => $merchantid,
				'numorden'	=> $id_pre_pedido,
				'monto'	=> $amount
			);
			$this->load->view('../../assets/inc/cabecera_check_out');
			//$this->load->view('../../assets/lib_visa/lib.inc');
			//$this->load->view('../../assets/lib_visa/funciones.php');
			$this->load->view('../../assets/inc/head_common_check_out', $output);
			$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('pol_ter_con/terminos_condiciones_pago',$data);
			$this->load->view('../../assets/inc/footer_common_principal',$output);
		}else{
			redirect('login','refresh');
		}
	
	}
	public function borrar_producto(){
		$id_det_pre_pedido=$this->uri->segment(3);
		$id_pre_pedido['id_pre_pedido']=$this->uri->segment(4);
	
		$this->session->set_userdata($id_pre_pedido);
		$id_pre_pedido_2=$id_pre_pedido['id_pre_pedido'];	
		$consulta=$this->pre_pedido_model->get_det_pre_pedido($id_det_pre_pedido);
		if ($consulta) {
		foreach ($consulta as $key) {
			$total=$key->total_det_pedido;
		}
		}else{
			redirect('pagina_principal/home','refresh');
		}

		$consulta_2=$this->pre_pedido_model->get_pre_pedido_id($id_pre_pedido_2);
		foreach ($consulta_2 as $key_2) {
			$total_pre_pedido=$key_2->total;
		}
		/*echo "llega aqui";
		exit();*/
		$nuevo_total=$total_pre_pedido-$total;
		$this->pre_pedido_model->actualizar_prepedido($id_pre_pedido_2,$nuevo_total);
		$this->pre_pedido_model->borrar_det_pedido($id_det_pre_pedido);
		$id_pre_pedido_3['pepe']=$id_pre_pedido['id_pre_pedido'];
		$this->session->set_userdata($id_pre_pedido_3);
		redirect('pre_pedido/check_out','refresh');
		
	}
	public function borrar_pre_pedido(){
		$id_pre_pedido=$this->uri->segment(3);
		$this->pre_pedido_model->borrar_pre_pedido($id_pre_pedido);
		$this->session->set_flashdata('alerta', 'Carrito Vacio');
				redirect('pagina_principal/home','refresh');
	}
	public function diferentes_pagos(){
		
	}


}

/* End of file genero.php */
/* Location: ./application/controllers/genero.php */