<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iva extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('iva/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_iva');
					$crud->set_subject('Iva');
					$crud->set_language('spanish');
					$crud->display_as('descripcion','iva');
					$crud->required_fields('descripcion');
					$crud->columns('descripcion');
					$crud->unset_add();
					$crud->unset_delete();
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('iva/iva',$output);
					$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}		
	}
}
