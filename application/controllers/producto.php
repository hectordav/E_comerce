<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('genero_model');
			$this->load->library('upload');
			$this->load->model('producto_model');
			$this->load->model('talla_model');
			$this->load->model('color_model');
	}
	public function index(){
			redirect('producto/grilla');
	}
	public function grilla(){

		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_producto');
			$crud->set_relation('id_genero','t_genero','descripcion');
			$crud->set_relation('id_categoria','t_categoria','descripcion');
			$crud->set_relation('id_sub_categoria','t_sub_categoria','descripcion');
		/*	$crud->set_relation('id_talla','t_talla','descripcion');
			$crud->set_relation('id_color','t_color','descripcion');*/
			$crud->set_subject('Producto');
			$crud->set_language('spanish');
			$crud->display_as('id_genero','Genero');
			$crud->display_as('id_categoria','Categoria');
			$crud->display_as('id_sub_categoria','Sub Cat');
			
			$crud->display_as('codigo','Codigo');
			$crud->display_as('nombre','Producto');
			$crud->display_as('descripcion_1','descripcion');
			$crud->display_as('descripcion_2','descripcion');
			$crud->display_as('descripcion_3','descripcion');
			$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
			$crud->add_action('editar', '', '','fa fa-pencil',array($this,'fn_edit'));
			$crud->columns('id_genero','id_categoria','id_sub_categoria','codigo','nombre');
			$crud->unset_read();
			$crud->unset_edit();
			$output = $crud->render();
			$state = $crud->getState();
				if($state == 'add'){
				redirect('producto/add');
				}
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('producto/producto',$output);
			$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
	}
	function fn_ver($primary_key , $row){
		return site_url('producto/ver').'/'.$row->id;
	}
	function fn_edit($primary_key , $row){
		return site_url('producto/editar').'/'.$row->id;
	}
	public function add(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_producto');
					$output = $crud->render();
					$data = array('genero' =>$this->genero_model->get_genero(),
					'talla'=>$this->talla_model->get_talla(),
					'color'=>$this->color_model->get_color());
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('producto/add',$data);
					$this->load->view('../../assets/script/script_combo_producto');
					$this->load->view('../../assets/inc/footer_common',$output);					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}

	}
	public function fill_producto(){
         $id_sub_categoria = $this->input->post('id_sub_categoria');
        if($id_sub_categoria){
            $producto = $this->producto_model->get_producto_id_sub_categoria($id_sub_categoria);
            echo '<option value="">Seleccione Producto</option>';
            foreach($producto as $fila){
                echo '<option value="'. $fila->id_producto .'">'. $fila->nombre.'</option>';
            }
        }  else {
            echo '<option value="">Sin Resultados</option>';
        }
    }
	public function guardar_producto(){
		$this->form_validation->set_rules('id_genero', 'Genero', 'required|callback_check_default');
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('id_sub_categoria', 'Sub Categoria', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_codigo', 'Codigo', 'required|required');
		$this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|required');
		$this->form_validation->set_rules('txt_descripcion', 'Descripcion', 'trim|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add*/
				$this->add();
		}else{
			$id_genero=$this->input->post('id_genero',TRUE);
			$id_categoria=$this->input->post('id_categoria',TRUE);
			$id_sub_categoria=$this->input->post('id_sub_categoria',TRUE);
			$id_talla=$this->input->post('id_talla',TRUE);
			$id_color=$this->input->post('id_color',TRUE);
			$codigo=$this->input->post('txt_codigo',TRUE);
			$nombre=$this->input->post('txt_nombre',TRUE);
			$descripcion=$this->input->post('txt_descripcion',TRUE);
			$mi_archivo_1 = 'mi_archivo_1';
			$mi_archivo_2 = 'mi_archivo_2';
			$mi_archivo_3 = 'mi_archivo_3';
			$mi_archivo_4 = 'mi_archivo_4';
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
				}else{
					$archivo_1=null;
				}
				if (!empty($_FILES['mi_archivo_2']['name'])) {
						$config['upload_path'] = "./assets/img";
						$config['allowed_types'] = "*";
						$config['max_size'] = "0";
						$config['max_width'] = "0";
						$config['max_height'] = "0";
						$config['remove_spaces']=TRUE;
						$config['overwrite'] = true;
						$this->upload->initialize($config);
					if ($this->upload->do_upload('mi_archivo_2')){
						$data= $this->upload->data();
						$archivo_2=$data['file_name'];
						}else{
						echo $this->upload->display_errors();
						$archivo_2=null;
						}
				}else{
					$archivo_2=null;
				}
				if (!empty($_FILES['mi_archivo_3']['name'])) {
						$config['upload_path'] = "./assets/img";
						$config['allowed_types'] = "*";
						$config['max_size'] = "0";
						$config['max_width'] = "0";
						$config['max_height'] = "0";
						$config['remove_spaces']=TRUE;
						$config['overwrite'] = true;
						$this->upload->initialize($config);
					if ($this->upload->do_upload('mi_archivo_3')){
						$data= $this->upload->data();
						$archivo_3=$data['file_name'];
						}else{
						echo $this->upload->display_errors();
						$archivo_3=null;
						}
				}else{
					$archivo_3=null;
				}
				if (!empty($_FILES['mi_archivo_4']['name'])) {
						$config['upload_path'] = "./assets/img";
						$config['allowed_types'] = "*";
						$config['max_size'] = "0";
						$config['max_width'] = "0";
						$config['max_height'] = "0";
						$config['remove_spaces']=TRUE;
						$config['overwrite'] = true;
						$this->upload->initialize($config);
					if ($this->upload->do_upload('mi_archivo_4')){
						$data= $this->upload->data();
						$archivo_4=$data['file_name'];
						}else{
						echo $this->upload->display_errors();
						$archivo_4=null;
						}
				}else{
					$archivo_4=null;
				}
				$this->producto_model->guardar_producto($id_genero,$id_categoria,$id_sub_categoria,$codigo,$nombre,$descripcion,$archivo_1,$archivo_2,$archivo_3,$archivo_4);
				$consulta_id_producto=$this->producto_model->get_max_producto();
				foreach ($consulta_id_producto as $key) {
					$id_producto=$key->id;
				}
				/*busca la talla en el add*/
				foreach ($this->input->post('talla') as $data){
					$id_talla=$data;
					$this->producto_model->guardar_talla($id_producto,$id_talla);
				}
				/*busca el color en el add*/
				foreach ($this->input->post('color') as $data2){
					$id_color=$data2;
					$this->producto_model->guardar_color($id_producto,$id_color);
				}
				redirect('producto/grilla','refresh');
			}	
		}
		public function ver(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				if ($data_usuario['id_nivel']==1) {
					$id_producto=$this->uri->segment(3);
					if (!$id_producto) {
						redirect('producto/grilla','refresh');
					}
					$data = array('producto' =>$this->producto_model->get_producto_id($id_producto),
						'talla'=>$this->producto_model->get_talla_id_producto($id_producto),
						'color'=>$this->producto_model->get_color_id_producto($id_producto));
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_producto');
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('producto/ver',$data);
					$this->load->view('../../assets/script/script_combo_producto');
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
					$id_producto['id_producto']=$this->uri->segment(3);
			if ($id_producto['id_producto']) {
					$id_producto_2=$this->session->set_userdata($id_producto);
			}
			$id_producto=$this->session->userdata('id_producto');
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_producto');
			$output = $crud->render();
			$data = array('genero' =>$this->genero_model->get_genero(),
			'talla'=>$this->talla_model->get_talla(),
			'color'=>$this->color_model->get_color(),
			'producto'=>$this->producto_model->get_producto_id($id_producto));
			$this->load->view('../../assets/inc/head_common_add', $output);
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('producto/editar',$data);
			$this->load->view('../../assets/script/script_combo_producto');
			$this->load->view('../../assets/inc/footer_common',$output);
					
				}else{
					redirect('pagina_principal/home','refresh');	
				}
			}else{
			redirect('pagina_principal/home','refresh');	
			}
		}
		public function actualizar_producto(){
			$this->form_validation->set_rules('id_genero', 'Genero', 'required|callback_check_default');
			$this->form_validation->set_rules('id_categoria', 'Categoria', 'required|callback_check_default');
			$this->form_validation->set_rules('id_sub_categoria', 'Sub Categoria', 'required|callback_check_default');
			$this->form_validation->set_rules('txt_codigo', 'Codigo', 'required|required');
			$this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|required');
			$this->form_validation->set_rules('txt_descripcion', 'Descripcion', 'trim|required');
			$this->form_validation->set_message("required","El campo %s es Requerido");
			$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
			if ($this->form_validation->run()===false) {
				/*lo regresa al add*/
					$this->editar();
			}else{
				$id_producto=$this->input->post('txt_id_producto',TRUE);
				$id_genero=$this->input->post('id_genero',TRUE);
				$id_categoria=$this->input->post('id_categoria',TRUE);
				$id_sub_categoria=$this->input->post('id_sub_categoria',TRUE);
				$id_talla=$this->input->post('id_talla',TRUE);
				$id_color=$this->input->post('id_color',TRUE);
				$codigo=$this->input->post('txt_codigo',TRUE);
				$nombre=$this->input->post('txt_nombre',TRUE);
				$descripcion=$this->input->post('txt_descripcion',TRUE);
				$this->producto_model->actualizar_producto_sin_adjunto($id_producto,$id_genero,$id_categoria,$id_sub_categoria,$codigo,$nombre,$descripcion);
				foreach ($this->input->post('talla') as $data){
					$id_talla=$data;
					$this->producto_model->guardar_talla($id_producto,$id_talla);
				}
				/*busca el color en el add*/
				foreach ($this->input->post('color') as $data2){
					$id_color=$data2;
					$this->producto_model->guardar_color($id_producto,$id_color);
				}
					redirect('producto/grilla','refresh');
				}	
		}

}
/* End of file producto.php */
/* Location: ./application/controllers/producto.php */