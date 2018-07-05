<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario_producto extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('producto_model');
			$this->load->model('iva_model');
			$this->load->model('inventario_producto_model');
	}
	public function index(){
			redirect('inventario_producto/grilla');
	}
	public function grilla(){


		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_inventario_producto');
			$crud->set_relation('id_producto','t_producto','{Codigo}, {nombre}');
			$crud->set_subject('Inventario');
			$crud->set_language('spanish');
			$crud->display_as('id_producto','Producto');
			$crud->display_as('cantidad','Cantidad');
			$crud->display_as('precio_neto','P Neto');
			$crud->display_as('iva','Iva');
			$crud->display_as('total','Total');
			$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
			$crud->add_action('Editar precio', '', '','fa fa-pencil',array($this,'fn_editar'));
			$crud->add_action('Agregar Cantidad', '', '','fa fa-plus',array($this,'fn_agregar_cantidad'));
				$crud->add_action('Restar Cantidad', '', '','fa fa-minus',array($this,'fn_restar_cantidad'));
			$crud->columns('id_producto','cantidad','precio_neto','iva','total');
			$crud->unset_delete();
			$crud->unset_read();
			$crud->unset_edit();
			$output = $crud->render();
			$state = $crud->getState();
			if($state == 'add'){
			redirect('inventario_producto/add');
			}
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('inventario_producto/inventario_producto',$output);
			$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
	}
	function fn_ver($primary_key , $row){
		return site_url('inventario_producto/ver').'/'.$row->id;
	}
	function fn_editar($primary_key , $row){
		return site_url('inventario_producto/editar_precio').'/'.$row->id;
	}
	function fn_agregar_cantidad($primary_key , $row){
		return site_url('inventario_producto/agregar_cantidad').'/'.$row->id;
	}
		function fn_restar_cantidad($primary_key , $row){
		return site_url('inventario_producto/restar_cantidad').'/'.$row->id;
	}
	public function add(){

		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_producto');
					$output = $crud->render();
					$data = array('producto' =>$this->producto_model->get_producto(),
					'iva'=>$this->iva_model->get_iva());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('inventario_producto/add',$data);
					$this->load->view('../../assets/script/script_precio_producto');
					$this->load->view('../../assets/inc/footer_common',$output);	
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function guardar_inventario(){
		$this->form_validation->set_rules('id_producto', 'Producto', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_cantidad', 'Cantidad', 'required|required');
		$this->form_validation->set_rules('txt_precio_neto', 'Precio Neto', 'required|required');
		$this->form_validation->set_rules('txt_iva_2', 'Iva', 'required|required');
		$this->form_validation->set_rules('txt_total', 'Total', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");

		if ($this->form_validation->run()===false) {
			/*lo regresa al add*/
				$this->add();
		}else{
			$id_producto=$this->input->post('id_producto',TRUE);
			$cantidad=$this->input->post('txt_cantidad',TRUE);
			$precio_neto=$this->input->post('txt_precio_neto',TRUE);
			$iva=$this->input->post('txt_iva_2',TRUE);
			$total=$this->input->post('txt_total',TRUE);
			$this->inventario_producto_model->guardar_inventario($id_producto,$cantidad,$precio_neto,$iva,$total);
			redirect('inventario_producto/grilla','refresh');
			}
		}
	public function ver(){	
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$id_inventario=$this->uri->segment(3);
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_producto');
					$output = $crud->render();
					$data = array('producto' =>$this->inventario_producto_model->get_inventario_producto_id($id_inventario));
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('inventario_producto/ver',$data);
					$this->load->view('../../assets/script/script_precio_producto');
					$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
}
	public function editar_precio(){
	if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$id_inventario['id_inventario']=$this->uri->segment(3);
					if ($id_inventario['id_inventario']) {
					$id_inventario_2=$this->session->set_userdata($id_inventario);
					}
					$id_inventario=$this->session->userdata('id_inventario');
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_producto');
					$output = $crud->render();
					$data = array('producto' =>$this->inventario_producto_model->get_inventario_producto_id($id_inventario),
					'iva'=>$this->iva_model->get_iva());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('inventario_producto/editar',$data);
					$this->load->view('../../assets/script/script_precio_producto');
					$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function actualizar_precio_inventario(){
		$this->form_validation->set_rules('txt_id_inventario', 'Producto', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_cantidad', 'Cantidad', 'required|required');
		$this->form_validation->set_rules('txt_precio_neto', 'Precio Neto', 'required|required');
		$this->form_validation->set_rules('txt_iva_2', 'Iva', 'required|required');
		$this->form_validation->set_rules('txt_total', 'Total', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al editar*/
				$this->editar_precio();
		}else{
			$id_producto=$this->input->post('txt_id_inventario',TRUE);
			$precio_neto=$this->input->post('txt_precio_neto',TRUE);
			$iva=$this->input->post('txt_iva_2',TRUE);
			$total=$this->input->post('txt_total',TRUE);
			$this->inventario_producto_model->actualizar_precio_inventario($id_producto,$precio_neto,$iva,$total);
			redirect('inventario_producto/grilla','refresh');
			}
	}
	public function agregar_cantidad(){

		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$id_inventario['id_inventario']=$this->uri->segment(3);
					if ($id_inventario['id_inventario']) {
					$id_inventario_2=$this->session->set_userdata($id_inventario);
					}
					$id_inventario=$this->session->userdata('id_inventario');
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_producto');
					$output = $crud->render();
					$data = array('producto' =>$this->inventario_producto_model->get_inventario_producto_id($id_inventario),
					'iva'=>$this->iva_model->get_iva());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('inventario_producto/agregar_cantidad',$data);
					$this->load->view('../../assets/script/script_precio_producto');
					$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function restar_cantidad(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
						$id_inventario['id_inventario']=$this->uri->segment(3);
		if ($id_inventario['id_inventario']) {
					$id_inventario_2=$this->session->set_userdata($id_inventario);
		}
		$id_inventario=$this->session->userdata('id_inventario');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_producto');
		$output = $crud->render();
		$data = array('producto' =>$this->inventario_producto_model->get_inventario_producto_id($id_inventario),
			'iva'=>$this->iva_model->get_iva());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('inventario_producto/restar_cantidad',$data);
		$this->load->view('../../assets/script/script_precio_producto');
		$this->load->view('../../assets/inc/footer_common',$output);	
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function actualizar_cantidad(){
		$this->form_validation->set_rules('txt_id_inventario', 'Producto', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_cantidad_1', 'Cantidad Agregar', 'required|required');
		$this->form_validation->set_rules('txt_cantidad_2', 'Nueva Cantidad', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add*/
				$this->agregar_cantidad();
		}else{
			$id_inventario=$this->input->post('txt_id_inventario',TRUE);
			$cantidad=$this->input->post('txt_cantidad_2',TRUE);
			$this->inventario_producto_model->actualizar_cantidad_inventario($id_inventario,$cantidad);
			redirect('inventario_producto/grilla','refresh');
			}
			
	}
}
/* End of file genero.php */
/* Location: ./application/controllers/genero.php */