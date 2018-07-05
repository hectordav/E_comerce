<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pagina_principal extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
			$this->load->model('producto_model');
			$this->load->model('genero_model');
			$this->load->model('categoria_model');
			$this->load->model('sub_categoria_model');
			$this->load->model('banner_model');
			$this->load->model('modas_model');
			$this->load->model('coleccion_destacada_model');
			$this->load->model('productos_recomendados_model');
			$this->load->model('pre_pedido_model');
			$this->load->model('quienes_somos_model');
			$this->load->model('contacto_model');
			$this->load->model('tiendas_model');
			$this->load->model('tipo_moneda_model');
			$this->load->model('slide_model');
			$this->load->model('pol_ter_con_model');
			$this->load->model('politicas_devolucion_model');

	}
	public function index(){
			redirect('pagina_principal/home');
	}
	public function home(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
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
			if ($data_usuario['id_nivel']==2) {
				$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('../../assets/inc/banner');
			$this->load->view('../../assets/inc/fashion');
			$this->load->view('../../assets/inc/productos_recomendados');
			$this->load->view('../../assets/inc/footer_common_principal',$output);
			}else{
					$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_n1',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('../../assets/inc/banner');
			$this->load->view('../../assets/inc/fashion');
			$this->load->view('../../assets/inc/productos_recomendados');
			$this->load->view('../../assets/inc/footer_common_principal',$output);

			}
	}else{
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
			$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_login',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('../../assets/inc/banner');
			$this->load->view('../../assets/inc/fashion');
			$this->load->view('../../assets/inc/productos_recomendados');
			$this->load->view('../../assets/inc/footer_common_principal',$output);

	}
}
	public function categoria(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$id_categoria=$this->uri->segment(3);
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
		if (!$id_categoria) {
			redirect('pagina_principal/home','refresh');
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
				'producto_categoria' =>$this->categoria_model->get_productos_categoria_id($id_categoria),
				'nombre_categoria'=>$this->categoria_model->get_categoria_id_categoria($id_categoria),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('../../assets/inc/categoria');
			$this->load->view('../../assets/inc/footer_common_principal',$output);

			/**************************/
		}else{
			$id_categoria=$this->uri->segment(3);
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
		if (!$id_categoria) {
			redirect('pagina_principal/home','refresh');
		}
			$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'producto_categoria' =>$this->categoria_model->get_productos_categoria_id($id_categoria),
				'nombre_categoria'=>$this->categoria_model->get_categoria_id_categoria($id_categoria),
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_login',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('../../assets/inc/categoria');
			$this->load->view('../../assets/inc/footer_common_principal',$output);
		}
			
	}

	
	public function ver_articulo(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
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
				$id_producto=$this->uri->segment(3);
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
		if (!$id_producto) {
			redirect('pagina_principal/home','refresh');
		}
			$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'producto'=>$this->producto_model->get_producto_id($id_producto),
				'talla'=>$this->producto_model->get_talla_id_producto($id_producto),
				'color'=>$this->producto_model->get_color_id_producto($id_producto),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'tipo_moneda'=>$this->tipo_moneda_model->get_tipo_moneda(),
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('producto/ver_pagina_producto',$output);
			$this->load->view('../../assets/inc/footer_common_principal',$output);
			}else{

			$id_producto=$this->uri->segment(3);
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
		if (!$id_producto) {
			redirect('pagina_principal/home','refresh');
		}
			$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'producto'=>$this->producto_model->get_producto_id($id_producto),
				'slide'=>$this->slide_model->get_slide(),
				'tipo_moneda'=>$this->tipo_moneda_model->get_tipo_moneda(),
				'talla'=>$this->producto_model->get_talla_id_producto($id_producto),
				'color'=>$this->producto_model->get_color_id_producto($id_producto));
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_login',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('producto/ver_pagina_producto',$output);
			$this->load->view('../../assets/inc/footer_common_principal',$output);
			}
	}
	public function quienes_somos(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
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
			if ($data_usuario['id_nivel']==2) {
				$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'quienes_somos'=>$this->quienes_somos_model->get_quienes_somos(),
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('quienes_somos/quienes_somos_vista',$output );
			$this->load->view('../../assets/inc/footer_common_principal',$output);
			}else{
					$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'quienes_somos'=>$this->quienes_somos_model->get_quienes_somos(),
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_n1',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('quienes_somos/quienes_somos_vista',$output );
			$this->load->view('../../assets/inc/footer_common_principal',$output);

			}
	}else{
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
			$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'quienes_somos'=>$this->quienes_somos_model->get_quienes_somos(),
				'slide'=>$this->slide_model->get_slide());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_login',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('quienes_somos/quienes_somos_vista',$output );
			$this->load->view('../../assets/inc/footer_common_principal',$output);
	}
}
public function politicas_devolucion(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
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
		if ($data_usuario['id_nivel']==2) {
			$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'total_articulos'=>$total,
			'pol_ter_con'=>$this->pol_ter_con_model->get_pol_ter_con(),
			'politicas_devolucion'=>$this->politicas_devolucion_model->get_politicas_devolucion(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('politicas_devolucion/politicas_devolucion_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);
		}else{
				$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'total_articulos'=>$total,
			'pol_ter_con'=>$this->pol_ter_con_model->get_pol_ter_con(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_n1',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('pol_ter_con/pol_ter_con_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);

		}
}else{
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
		$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'pol_ter_con'=>$this->pol_ter_con_model->get_pol_ter_con(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_login',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('pol_ter_con/pol_ter_con_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);
}
}
public function pol_ter_con(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
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
		if ($data_usuario['id_nivel']==2) {
			$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'total_articulos'=>$total,
			'pol_ter_con'=>$this->pol_ter_con_model->get_pol_ter_con(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('pol_ter_con/pol_ter_con_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);
		}else{
				$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'total_articulos'=>$total,
			'pol_ter_con'=>$this->pol_ter_con_model->get_pol_ter_con(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_n1',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('pol_ter_con/pol_ter_con_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);

		}
}else{
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
		$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'pol_ter_con'=>$this->pol_ter_con_model->get_pol_ter_con(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_login',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('pol_ter_con/pol_ter_con_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);
}
}


public function contactanos(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
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
		if ($data_usuario['id_nivel']==2) {
			$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'total_articulos'=>$total,
			'contacto'=>$this->contacto_model->get_contacto(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('contacto/contacto_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);
		}else{
				$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'total_articulos'=>$total,
			'contacto'=>$this->contacto_model->get_contacto(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_n1',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('contacto/contacto_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);

		}
}else{
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
		$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'contacto'=>$this->contacto_model->get_contacto(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_login',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('contacto/contacto_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);
}
}
public function tiendas(){
	if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre_usuario'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
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
		if ($data_usuario['id_nivel']==2) {
			$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'total_articulos'=>$total,
			'tiendas'=>$this->tiendas_model->get_tiendas(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('tiendas/tiendas_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);
		}else{
				$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'total_articulos'=>$total,
			'tiendas'=>$this->tiendas_model->get_tiendas());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_n1',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('tiendas/tiendas_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);

		}
}else{
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
		$data = array('genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'tiendas'=>$this->tiendas_model->get_tiendas(),
			'slide'=>$this->slide_model->get_slide());
		$this->load->view('../../assets/inc/head_common_principal', $output);
		$this->load->view('../../assets/inc/menu_cabecera_login',$data);
		$this->load->view('../../assets/inc/mega_menu',$data);
		$this->load->view('tiendas/tiendas_vista',$output );
		$this->load->view('../../assets/inc/footer_common_principal',$output);
		}
	}
}