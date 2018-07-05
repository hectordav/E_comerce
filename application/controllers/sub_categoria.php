<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_categoria extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('genero_model');
			$this->load->model('categoria_model');
			$this->load->model('sub_categoria_model');
	}
	public function index(){
			redirect('sub_categoria/grilla');
	}
	public function grilla(){

		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_sub_categoria');
					$crud->set_relation('id_categoria','t_categoria','descripcion');
					$crud->set_relation('id_genero','t_genero','descripcion');
					$crud->set_subject('Sub categoria');
					$crud->set_language('spanish');
					$crud->display_as('id_categoria','Categoria');
					$crud->display_as('id_genero','Genero');
					$crud->display_as('descripcion','Sub Categoria');
					$crud->required_fields('nombre','dni','direccion','telf','email');
					$crud->columns('id_genero','id_categoria','descripcion');
					$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'fn_edit'));
					$crud->unset_edit();
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('sub_categoria/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('sub_categoria/sub_categoria',$output);
					$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
	}
	function fn_edit($primary_key , $row){
		return site_url('sub_categoria/edit').'/'.$row->id;
	}
	public function add(){

		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_sub_categoria');
					$output = $crud->render();
					$data = array('genero' =>$this->genero_model->get_genero());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('sub_categoria/add',$data);
					$this->load->view('../../assets/script/script_combo_sub_categoria');
					$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function edit(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
			$id_sub_categoria['id_sub_categoria']=$this->uri->segment(3);
				if ($id_sub_categoria['id_sub_categoria']) {
					$id_sub_categoria_2=$this->session->set_userdata($id_sub_categoria);
			}
			$id_sub_categoria=$this->session->userdata('id_sub_categoria');
			$crud->set_theme('bootstrap');
			$crud->set_table('t_sub_categoria');
			$output = $crud->render();
			$data = array(
				'genero' =>$this->genero_model->get_genero(),
				'sub_categoria'=>$this->sub_categoria_model->get_sub_categoria($id_sub_categoria));
			$this->load->view('../../assets/inc/head_common_add', $output);
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('sub_categoria/edit',$data);
			$this->load->view('../../assets/script/script_combo_sub_categoria');
			$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	#***************llena el combo de la categoria****************
	public function fill_categoria() {
         $id_genero = $this->input->post('id_genero');
        if($id_genero){
            $categoria = $this->categoria_model->get_categoria($id_genero);
            echo '<option value="">Seleccione Categoria</option>';
            foreach($categoria as $fila){
                echo '<option value="'. $fila->id .'">'. $fila->descripcion.'</option>';
            }
        }  else {
            echo '<option value="0">Sin Resultados</option>';
        }
    }
    #********************************************************************************
    ##***************llena el combo de la sub_categoria****************
	public function fill_sub_categoria(){
         $id_categoria = $this->input->post('id_categoria');
        if($id_categoria){
            $sub_categoria = $this->sub_categoria_model->get_sub_categoria_id_categoria($id_categoria);
            echo '<option value="">Seleccione Sub Categoria</option>';
            foreach($sub_categoria as $fila){
                echo '<option value="'. $fila->id .'">'. $fila->descripcion.'</option>';
            }
        }  else {
            echo '<option value="0">Sin Resultados</option>';
        }
    }
    #********************************************************************************
	public function guardar_subcategoria(){
		/*validacion pa que tambien lo tome safari*/
		$this->form_validation->set_rules('id_genero', 'Genero', 'required|callback_check_default');
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_sub_categoria', 'Sub Categoria', 'trim|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add();
		}else{
			$id_genero=$this->input->post('id_genero',TRUE);
			$id_categoria=$this->input->post('id_categoria',TRUE);
			$sub_categoria=$this->input->post('txt_sub_categoria',TRUE);
			$this->sub_categoria_model->guardar_subcategoria($id_genero,$id_categoria,$sub_categoria);
						$this->session->set_flashdata('alerta', 'Sub Categoria Guardada');
						redirect('sub_categoria/grilla','refresh');
		}
	}
	public function actualizar_subcategoria(){
		/*validacion pa que tambien lo tome safari*/
		$this->form_validation->set_rules('id_genero', 'Genero', 'required|callback_check_default');
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_sub_categoria', 'Sub Categoria', 'trim|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->edit();
		}else{
			$id_sub_categoria=$this->input->post('txt_id_sub_categoria',TRUE);
			$id_genero=$this->input->post('id_genero',TRUE);
			$id_categoria=$this->input->post('id_categoria',TRUE);
			$sub_categoria=$this->input->post('txt_sub_categoria',TRUE);
			$this->sub_categoria_model->actualizar_sub_categoria($id_sub_categoria,$id_genero,$id_categoria,$sub_categoria);
						$this->session->set_flashdata('alerta', 'Sub Categoria Guardada');
						redirect('sub_categoria/grilla','refresh');
		}
	}
}

/* Location: ./application/controllers/genero.php */