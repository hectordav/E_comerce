<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('nivel_model');
			$this->load->helper('security');
			$this->load->model('usuario_model');
			$this->load->model('estado_usuario_model');
	}
	public function index(){
			redirect('usuario/grilla');
	}
	public function grilla(){


		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
						$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_usuario');
			$crud->set_relation('id_cliente','t_cliente','nombre');
			$crud->set_relation('id_nivel','t_nivel','descripcion');
			$crud->set_relation('id_tipo_estado_usuario','t_tipo_estado_usuario','descripcion');
			$crud->set_subject('Usuarios');
			$crud->set_language('spanish');
			$crud->display_as('id_cliente','Cliente');
			$crud->display_as('id_nivel','Nivel');
			$crud->display_as('id_tipo_estado_usuario','Estado');
			$crud->display_as('nombre','Nombre');
			$crud->display_as('login','Login');
			$crud->display_as('clave','Clave');
			$crud->columns('id_cliente','id_nivel','id_tipo_estado_usuario','nombre','login');
			$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
			$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'fn_edit'));
			$crud->add_action('Activar/Desactivar Usuario', '', '','fa fa-power',array($this,'fn_activar_desativar'));
			$crud->unset_read();
			$crud->unset_edit();
			$output = $crud->render();
			$state = $crud->getState();
				if($state == 'add'){
				redirect('usuario/add');
				}
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('usuario/usuario',$output);
			$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
	}
	function fn_ver($primary_key , $row){
		return site_url('usuario/ver').'/'.$row->id;
	}
	function fn_edit($primary_key , $row){
		return site_url('usuario/editar').'/'.$row->id;
	}
	function fn_activar_desativar($primary_key , $row){
		return site_url('usuario/activar_desactivar_usuario').'/'.$row->id;
	}
	public function add(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_usuario');
					$output = $crud->render();
					$data = array('nivel' =>$this->nivel_model->get_nivel());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('usuario/add',$data);
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
					$id_usuario=$this->uri->segment(3);
					if (!$id_usuario) {
					redirect('usuario/grilla','refresh');
					}
					$data['usuario']=$this->usuario_model->get_usuario_id($id_usuario);
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_usuario');
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('usuario/ver',$data);
					$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
	}
		public function editar(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$id_usuario['id_usuario']=$this->uri->segment(3);
					if (!$id_usuario) {
					redirect('usuario/grilla','refresh');
					}
					if ($id_usuario['id_usuario']) {
					$id_usuario_2=$this->session->set_userdata($id_usuario);
					}
					$id_usuario=$this->session->userdata('id_usuario');
					$data = array('usuario' =>$this->usuario_model->get_usuario_id($id_usuario),
					'nivel'=>$this->nivel_model->get_nivel());
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_usuario');
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('usuario/editar',$data);
					$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function guardar_usuario(){
		$this->form_validation->set_rules('id_nivel', 'Nivel', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_nombre', 'Codigo', 'required|required');
		$this->form_validation->set_rules('txt_login', 'Login', 'required|valid_email');
		$this->form_validation->set_rules('txt_clave', 'Clave', 'required');
		$this->form_validation->set_rules('txt_clave_2', ' Confirmacion de Clave', 'required|matches[txt_clave]');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("valid_email","El campo %s Debe contener un Email");
		$this->form_validation->set_message("matches","Las Claves no coinciden");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add();
		}else{
			$id_nivel=$this->input->post('id_nivel','true');
			$nombre=$this->input->post('txt_nombre','true');
			$login=$this->input->post('txt_login','true');
			$clave=do_hash($this->input->post('txt_clave','true'));
			$id_tipo_estado_usuario='1';
			$this->usuario_model->guardar_usuario($id_nivel,$id_tipo_estado_usuario,$nombre,$login,$clave);
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('usuario/grilla','refresh');
		}
	}
	public function actualizar_usuario(){
		$this->form_validation->set_rules('id_nivel', 'Nivel', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_nombre', 'Codigo', 'required|required');
		$this->form_validation->set_rules('txt_login', 'Login', 'required|valid_email');
		$this->form_validation->set_rules('txt_clave', 'Clave', 'required');
		$this->form_validation->set_rules('txt_clave_2', ' Confirmacion de Clave', 'required|matches[txt_clave]');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("valid_email","El campo %s Debe contener un Email");
		$this->form_validation->set_message("matches","Las Claves no coinciden");
		if ($this->form_validation->run()===false) {
			/*lo regresa al porque no furula*/
				$this->editar();
		}else{
			$id_usuario=$this->input->post('txt_id_usuario','true');
			$id_nivel=$this->input->post('id_nivel','true');
			$nombre=$this->input->post('txt_nombre','true');
			$login=$this->input->post('txt_login','true');
			$clave=do_hash($this->input->post('txt_clave','true'));
			$id_tipo_estado_usuario='1';
			$this->usuario_model->actualizar_usuario($id_usuario, $id_nivel, $id_tipo_estado_usuario, $nombre, $login, $clave);
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('usuario/grilla','refresh');
		}
	}
	public function activar_desactivar_usuario(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$id_usuario['id_usuario']=$this->uri->segment(3);
		if (!$id_usuario) {
			redirect('usuario/grilla','refresh');
		}
		if ($id_usuario['id_usuario']) {
					$id_usuario_2=$this->session->set_userdata($id_usuario);
		}
		$id_usuario=$this->session->userdata('id_usuario');
		$data = array('usuario' =>$this->usuario_model->get_usuario_id($id_usuario),
		'nivel'=>$this->nivel_model->get_nivel(),
		'estado_usuario'=>$this->estado_usuario_model->get_estado_usuario());
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_usuario');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('usuario/activar_desactivar',$data);
		$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}


		
	}
	public function actualizar_estado(){
			$id_usuario=$this->input->post('txt_id_usuario','true');
			$id_tipo_estado_usuario=$this->input->post('id_estado_usuario','true');
			$this->usuario_model->actualizar_estado_usuario($id_usuario,$id_tipo_estado_usuario);
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('usuario/grilla','refresh');
	}
}

/* End of file usuario.php */
/* Location: ./application/controllers/genero.php */