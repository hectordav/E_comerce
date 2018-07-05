<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class coleccion_destacada extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('producto_model');
			$this->load->model('genero_model');
			$this->load->model('categoria_model');
			$this->load->model('sub_categoria_model');
			$this->load->model('coleccion_destacada_model');
	}
	public function index(){
			redirect('coleccion_destacada/grilla');
	}
	public function grilla(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_coleccion_destacada');
					$crud->set_relation('id_producto','t_producto','nombre');
					$crud->set_subject(' Seccion Coleccion Destacada');
					$crud->set_language('spanish');
					$crud->display_as('id_producto','Producto');
					$crud->required_fields('id_producto');
					$crud->columns('id_producto');
					$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
					$crud->unset_edit();
					$crud->unset_read();
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('coleccion_destacada/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('coleccion_destacada/coleccion_destacada',$output);
					$this->load->view('../../assets/inc/footer_common',$output);		
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
	}
	function fn_ver($primary_key , $row){
		return site_url('coleccion_destacada/ver').'/'.$row->id;
	}
	public function add(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_coleccion_destacada');
					$output = $crud->render();
					$data = array('genero' =>$this->genero_model->get_genero());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('coleccion_destacada/add',$data);
					$this->load->view('../../assets/script/script_combo_producto');
					$this->load->view('../../assets/inc/footer_common',$output);					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function ver(){


		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$id_coleccion_destacada=$this->uri->segment(3);
		if (!$id_coleccion_destacada) {
			redirect('coleccion_destacada/grilla','refresh');
		}
		$consulta=$this->coleccion_destacada_model->get_coleccion_destacada_id($id_coleccion_destacada);
		foreach ($consulta as $key) {
			$id_producto=$key->id_producto;
		}

		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_coleccion_destacada');
		$output = $crud->render();
		$data = array('producto' =>$this->producto_model->get_producto_id($id_producto));
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('coleccion_destacada/ver',$data);
		$this->load->view('../../assets/script/script_combo_producto');
		$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
		
	}
	public function guardar_coleccion_destacada(){
		$this->form_validation->set_rules('id_genero', 'Genero', 'required|callback_check_default');
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('id_sub_categoria', 'Sub Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('id_producto', 'producto', 'required|callback_check_default');
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add*/
				$this->add();
		}else{
			$contar_producto_coleccion_destacada=$this->coleccion_destacada_model->contar_productos_coleccion_destacada();
			if ($contar_producto_coleccion_destacada>=3) {
				$this->session->set_flashdata('alerta', 'Esta seccion permite solo 3 productos, elimine uno y a continuacion vuelva a Crearlo');
						redirect('coleccion_destacada/grilla','refresh');
			}
			$id_producto=$this->input->post('id_producto','true');
			$this->coleccion_destacada_model->guardar_coleccion_destacada($id_producto);
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('coleccion_destacada/grilla','refresh');
		}
	}

}

/* End of file coleccion_destacada.php */
/* Location: ./application/controllers/coleccion_destacada.php */