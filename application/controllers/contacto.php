<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Contacto extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('contacto_model');
	}
	public function index(){
			redirect('contacto/grilla');
	}
	public function grilla(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_contacto');
				$crud->set_subject('Contactanos');
				$crud->set_language('spanish');
				$crud->display_as('descripcion','Contacto');
				$crud->columns('descripcion');
				$crud->required_fields('descripcion');
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
					if($state == 'add'){
					redirect('contacto/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('contacto/contacto',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
			}else{
				redirect('pagina_principal/home','refresh');
			}
			}else{
				redirect('pagina_principal/home','refresh');
			}
	}

	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_contacto');
		$crud->set_subject('quienes_somos');
		$crud->set_language('spanish');
		$output = $crud->render();
		$consulta=$this->contacto_model->get_contacto();
		if ($consulta) {
			$this->session->set_flashdata('alerta', 'ya guardó una descripcion, si quiere guardar una nueva, borre la anterior y a continuacion cree una nueva');
				redirect('contacto/grilla','refresh');
		}
		$this->load->view('../../assets/inc/head_common_quienes_somos', $output);
			$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('contacto/add',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}

	public function guardar_contacto(){
		$this->form_validation->set_rules('txt_descripcion', 'Descripcion', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
			if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add();
		}else{
		$descripcion=$this->input->post('txt_descripcion','true');	
		$this->contacto_model->guardar_contacto($descripcion);
		$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
				redirect('contacto/grilla','refresh');
		}
	}

}