<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Slide extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('slide_model');
			$this->load->library('upload');
	}
	public function index(){
			redirect('slide/grilla');
	}
	public function grilla(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_slide');
				$crud->set_subject('Slide');
				$crud->set_language('spanish');
				$crud->display_as('adjunto','Adjunto');
				$crud->columns('adjunto');
				$crud->required_fields('adjunto');
				$crud->unset_edit();
				$output = $crud->render();
				$state = $crud->getState();
					if($state == 'add'){
					redirect('slide/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('slide/slide',$output );
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
		$contar_slide=$this->slide_model->contar_slide();
		if ($contar_slide>8) {
			$this->session->set_flashdata('alerta', 'ya tiene el maximo de imagenes, si desea colocar mas imagenes debe eliminar uno y a continuacion vuelva a agregarlo');
				redirect('slide/grilla','refresh');
		}
		$this->load->view('../../assets/inc/head_common_quienes_somos', $output);
			$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('slide/add',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function guardar_slide(){
			$mi_archivo_1 = 'mi_archivo_1';
			if (!empty($_FILES['mi_archivo_1']['name'])) {
						$config['upload_path'] = "./assets/img";
						$config['allowed_types'] = "*";
						$config['max_size'] = "0";
						$config['max_width'] = "0";
						$config['max_height'] = "0";
						$config['remove_spaces']=TRUE;
						$config['overwrite'] = true;
						$this->upload->initialize($config);
					if ($this->upload->do_upload('mi_archivo_1')){
						$data= $this->upload->data();
						$archivo_1=$data['file_name'];
						}else{
						echo $this->upload->display_errors();
						$archivo_1=null;
						}
				}
		$this->slide_model->guardar_slide($archivo_1);
		$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
				redirect('slide/grilla','refresh');
		
	}

}