<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('pedido_model');
			$this->load->model('estado_pedido_model');
			$this->load->model('tipo_moneda_model');
	}
	public function index(){
			redirect('pedido/grilla');
	}
	public function grilla(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==2) {
					$id_usuario=$data_usuario['id_usuario'];
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_pedido');
				$crud->set_relation('id_estado_pedido','t_estado_pedido','descripcion');
				$crud->where('id_usuario',$id_usuario);
				$crud->set_subject('Pedidos');
				$crud->set_language('spanish');
				$crud->display_as('num_factura','# Pedido');
				$crud->display_as('total','Total');
				$crud->display_as('fecha','Fecha');
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->columns('num_factura','total','fecha');
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_delete();
				$crud->unset_read();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_superior_n2');
				$this->load->view('pedido/pedido',$output);
				$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					/*nivel 1*/

				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_pedido');
				$crud->set_relation('id_estado_pedido','t_estado_pedido','descripcion');
				$crud->set_relation('id_tipo_pago','t_tipo_pago','descripcion');
				$crud->set_subject('Pedidos');
				$crud->set_language('spanish');
				$crud->display_as('num_factura','# Pedido');
				$crud->display_as('total','Total');
				$crud->display_as('fecha','Fecha');
				$crud->display_as('id_estado_pedido','Status');
				$crud->display_as('id_tipo_pago','Plataforma');
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->add_action('Cambiar Estado', '', '','fa fa-arrow',array($this,'fn_estado'));
				$crud->columns('num_factura','total','id_tipo_pago','fecha','id_estado_pedido');
				$crud->unset_add();
				$crud->unset_edit();
				$crud->unset_delete();
				$crud->unset_read();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('pedido/pedido_n1',$output);
				$this->load->view('../../assets/inc/footer_common',$output);
				}
			}else{
				redirect('pagina_principal/home','refresh');
			}
	
	}
		function fn_ver($primary_key , $row){
		return site_url('pedido/ver').'/'.$row->id;
	}
	function fn_estado($primary_key , $row){
		return site_url('pedido/cambiar_estado').'/'.$row->id;
	}
		public function ver(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==2) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_empresa');
					$crud->set_subject('Zonas');
					$crud->set_language('spanish');
					$output = $crud->render();
					$id_pedido=$this->uri->segment(3);
			if (!$id_pedido) {
				redirect('pagina_principal/home','refresh');
			}
			$consulta=$this->pedido_model->get_pedido_id($id_pedido);
			$consulta_det_pedido=$this->pedido_model->get_det_pedido_id_pedido($id_pedido);
			$data = array('pedido' =>$this->pedido_model->get_pedido_id($id_pedido),
			'det_pedido'=>$this->pedido_model->get_det_pedido_id_pedido($id_pedido),
			'tipo_moneda'=>$this->tipo_moneda_model->get_tipo_moneda());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_superior_n2',$data);
			$this->load->view('pedido/ver',$data);
			}else{
					$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Zonas');
			$crud->set_language('spanish');
			$output = $crud->render();
			$id_pedido=$this->uri->segment(3);
			if (!$id_pedido) {
				redirect('pagina_principal/home','refresh');
			}
			$consulta=$this->pedido_model->get_pedido_id($id_pedido);
			$consulta_det_pedido=$this->pedido_model->get_det_pedido_id_pedido($id_pedido);
			$data = array('pedido' =>$this->pedido_model->get_pedido_id($id_pedido),
			'det_pedido'=>$this->pedido_model->get_det_pedido_id_pedido($id_pedido),
			'tipo_moneda'=>$this->tipo_moneda_model->get_tipo_moneda());
				$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('pedido/ver_n1',$data);
			}
		}else{
			redirect('pagina_principal/home','refresh');
		}

		}
		public function cambiar_estado(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==2) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_empresa');
					$crud->set_subject('Zonas');
					$crud->set_language('spanish');
					$output = $crud->render();
					$id_pedido=$this->uri->segment(3);
			if (!$id_pedido) {
				redirect('pagina_principal/home','refresh');
			}
			$consulta=$this->pedido_model->get_pedido_id($id_pedido);
			$consulta_det_pedido=$this->pedido_model->get_det_pedido_id_pedido($id_pedido);

			$data = array('pedido' =>$this->pedido_model->get_pedido_id($id_pedido),
			'det_pedido'=>$this->pedido_model->get_det_pedido_id_pedido($id_pedido),
			'estado_pedido'=>$this->estado_pedido_model->get_estado_pedido(),
			'tipo_moneda'=>$this->tipo_moneda_model->get_tipo_moneda());
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_superior_n2',$data);
			$this->load->view('pedido/ver',$data);
			}else{
					$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Zonas');
			$crud->set_language('spanish');
			$output = $crud->render();
			$id_pedido=$this->uri->segment(3);
			if (!$id_pedido) {
				redirect('pagina_principal/home','refresh');
			}
			$consulta=$this->pedido_model->get_pedido_id($id_pedido);
			$consulta_det_pedido=$this->pedido_model->get_det_pedido_id_pedido($id_pedido);
			$data = array('pedido' =>$this->pedido_model->get_pedido_id($id_pedido),
			'det_pedido'=>$this->pedido_model->get_det_pedido_id_pedido($id_pedido),
			'estado_pedido'=>$this->estado_pedido_model->get_estado_pedido(),
			'tipo_moneda'=>$this->tipo_moneda_model->get_tipo_moneda());
				$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('pedido/estado_pedido',$data);
			}
		}else{
			redirect('pagina_principal/home','refresh');
		}

		}
	public function guardar_cambiar_estado(){
		$this->form_validation->set_rules('id_estado_pedido', 'Estado Pedido', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_observaciones', 'Observaciones', 'required|required');
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->cambiar_estado();
		}else{
			$id_pedido=$this->input->post('txt_id_pedido','true');
			$id_estado_pedido=$this->input->post('id_estado_pedido','true');
			$observaciones=$this->input->post('txt_observaciones','true');
			$this->pedido_model->actualizar_estado($id_pedido,$id_estado_pedido,$observaciones);
			$this->session->set_flashdata('alerta', 'Se ha Cambiado el estado');
					redirect('pedido/grilla','refresh');
		}
	}
}

/* End of file genero.php */
/* Location: ./application/controllers/genero.php */