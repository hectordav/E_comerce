<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Principal extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->database();
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('principal/grilla');
	}
	public function grilla(){
		redirect('pedido','refresh');
	}
	public function config_general(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_empresa');
					$crud->set_subject('Zonas');
					$crud->set_language('spanish');
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('../../assets/inc/config_general');
					$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function config_inicial(){

		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_empresa');
						$crud->set_subject('Zonas');
						$crud->set_language('spanish');
						$output = $crud->render();
						$this->load->view('../../assets/inc/head_common', $output);
						$this->load->view('../../assets/inc/menu_superior');
						$this->load->view('../../assets/inc/config_inicial');
						$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}



	
	}
}