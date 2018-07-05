<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('producto_model');
			$this->load->model('genero_model');
			$this->load->model('categoria_model');
			$this->load->model('sub_categoria_model');
			$this->load->model('banner_model');
	}
	public function index(){
			redirect('banner/grilla');
	}
	public function grilla(){
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_banner');
			$crud->set_relation('id_producto','t_producto','nombre');
			$crud->order_by('id','asc');
			$crud->set_subject('banner');
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
			redirect('banner/add');
			}
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('banner/banner',$output);
			$this->load->view('../../assets/inc/footer_common',$output);
	}
	function fn_ver($primary_key , $row){
		return site_url('banner/ver').'/'.$row->id;
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_banner');
		$output = $crud->render();
		$data = array('genero' =>$this->genero_model->get_genero());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('banner/add',$data);
		$this->load->view('../../assets/script/script_combo_producto');
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function ver(){
		$id_banner=$this->uri->segment(3);
		if (!$id_banner) {
			redirect('banner/grilla','refresh');
		}
		$consulta=$this->banner_model->get_banner_id($id_banner);
		foreach ($consulta as $key) {
			$id_producto=$key->id_producto;
		}

		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_banner');
		$output = $crud->render();
		$data = array('producto' =>$this->producto_model->get_producto_id($id_producto));
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('banner/ver',$data);
		$this->load->view('../../assets/script/script_combo_producto');
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function guardar_banner(){
		$this->form_validation->set_rules('id_genero', 'Genero', 'required|callback_check_default');
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('id_sub_categoria', 'Sub Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('id_producto', 'producto', 'required|callback_check_default');
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add*/
				$this->add();
		}else{
			$contar_producto=$this->banner_model->contar_productos_banner();

			if ($contar_producto>=4) {
			$this->session->set_flashdata('alerta', 'Esta seccion permite solo 4 productos, elimine uno y a continuacion vuelva a Crearlo');
					redirect('banner/grilla','refresh');
			}
			$id_producto=$this->input->post('id_producto','true');
			$this->banner_model->guardar_banner($id_producto);
			redirect('banner/grilla','refresh');
		}
	}

}

/* End of file banner.php */
/* Location: ./application/controllers/banner.php */