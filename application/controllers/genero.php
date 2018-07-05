<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genero extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('genero/grilla');
	}
	public function grilla(){

		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {

						$crud = new grocery_CRUD();
						$crud->set_theme('bootstrap');
						$crud->set_table('t_genero');
						$crud->set_subject('Genero');
						$crud->set_language('spanish');
						$crud->display_as('descripcion','Genero');
						$crud->required_fields('descripcion');
						$crud->columns('descripcion');
						$output = $crud->render();
						$this->load->view('../../assets/inc/head_common', $output);
						$this->load->view('../../assets/inc/menu_superior');
						$this->load->view('genero/genero',$output);
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