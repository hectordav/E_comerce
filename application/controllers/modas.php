<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class modas extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('producto_model');
			$this->load->model('genero_model');
			$this->load->model('categoria_model');
			$this->load->model('sub_categoria_model');
			$this->load->model('modas_model');
	}
	public function index(){
			redirect('modas/grilla');
	}
	public function grilla(){

		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_modas');
					$crud->set_relation('id_producto','t_producto','nombre');
					$crud->order_by('id','asc');
					$crud->set_subject(' Seccion Modas');
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
					redirect('modas/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('modas/modas',$output);
					$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
			
	}
	function fn_ver($primary_key , $row){
		return site_url('modas/ver').'/'.$row->id;
	}
	public function add(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_modas');
					$output = $crud->render();
					$data = array('genero' =>$this->genero_model->get_genero());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('modas/add',$data);
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
					$id_modas=$this->uri->segment(3);
					if (!$id_modas) {
					redirect('modas/grilla','refresh');
					}
					$consulta=$this->modas_model->get_modas_id($id_modas);
					foreach ($consulta as $key) {
					$id_producto=$key->id_producto;
					}
					
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_modas');
					$output = $crud->render();
					$data = array('producto' =>$this->producto_model->get_producto_id($id_producto));
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('modas/ver',$data);
					$this->load->view('../../assets/script/script_combo_producto');
					$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}		
	}
	public function guardar_modas(){
		$this->form_validation->set_rules('id_genero', 'Genero', 'required|callback_check_default');
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('id_sub_categoria', 'Sub Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('id_producto', 'producto', 'required|callback_check_default');
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add*/
				$this->add();
		}else{
			$contar_producto=$this->modas_model->contar_productos_modas();
			if ($contar_producto>=3) {
				$this->session->set_flashdata('alerta', 'Esta seccion permite solo 3 productos, elimine uno y a continuacion vuelva a Crearlo');
						redirect('modas/grilla','refresh');
			}
			$id_producto=$this->input->post('id_producto','true');
			$this->modas_model->guardar_modas($id_producto);
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('modas/grilla','refresh');
		}
	}

}

/* End of file modas.php */
/* Location: ./application/controllers/modas.php */