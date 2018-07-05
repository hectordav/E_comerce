<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('categoria/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_categoria');
						$crud->set_relation('id_genero','t_genero','descripcion');
						$crud->set_subject('Categoria');
						$crud->set_language('spanish');
						$crud->display_as('id_genero','Genero');
						$crud->display_as('descripcion','Categoria');
						$crud->required_fields('id_genero','descripcion');
						$crud->columns('id_genero','descripcion');
						$output = $crud->render();
						$this->load->view('../../assets/inc/head_common', $output);
						$this->load->view('../../assets/inc/menu_superior');
						$this->load->view('categoria/categoria',$output);
						$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
	}

}

/* End of file genero.php */
/* Location: ./application/controllers/genero.php */