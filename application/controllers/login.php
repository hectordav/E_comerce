<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->helper('security');
			$this->load->model('usuario_model');
			$this->load->model('cliente_model');
	}
	public function index(){
		$this->load->view('../../assets/inc/head_common_principal');
		$this->load->view('../../assets/inc/menu_cabecera_login');
		$this->load->view('login/login');
	}
	public function iniciar_sesion(){
		$this->form_validation->set_rules('txt_login', 'Login', 'required|required');
		$this->form_validation->set_rules('txt_password', 'Password', 'required|required');
		$this->form_validation->set_rules('txt_login', 'Login', 'required|valid_email');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("valid_email","El campo %s Debe contener un Email");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->index();
		}else{
			$login=$this->input->post('txt_login','true');
			$pass=do_hash($this->input->post('txt_password','true'));
			$consulta=$this->usuario_model->get_usuario_log_pass($login,$pass);
			if ($consulta) {
				foreach ($consulta as $key) {
					$estado=$key->id_tipo_estado_usuario;
					$id_nivel=$key->id_nivel;
						$usuario_data = array(
             'id' => $key->id,
             'id_estado_usuario'=>$key->id_tipo_estado_usuario,
             'id_nivel' => $key->id_nivel,
             'nombre' => $key->nombre,
             'logueado' => TRUE
          );
				}
			if ($estado==2) {
						$this->session->set_flashdata('alerta', 'Usuario Inactivo');
						redirect('login/index','refresh');
					}
			if ($id_nivel==2) {
				$this->session->set_userdata($usuario_data);
				redirect('login/logueado','refresh');
			}else{
				$this->session->set_userdata($usuario_data);
				redirect('login/logueado','refresh');
			}
			}else{
				$this->session->set_flashdata('alerta', 'Usuario o Clave Invalidos');
			redirect('login/index','refresh');

			}
		}
	}
	public function logueado() {
			if($this->session->userdata('logueado')){
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_producto=$this->session->userdata('id_producto');
				if ($id_producto) {
					redirect('pre_pedido/agregar_producto_carrito','refresh');
				}else{
					if ($data_usuario['id_nivel']==2) {
						$this->session->set_flashdata('alerta', 'Benvenido');
								redirect('pagina_principal/home','refresh');
					}else{	
					redirect('pagina_principal/home','refresh');
					}
				}
				}else{
					redirect('login/index');
				}
  		}
	public function registro_usuario(){
		$this->load->view('../../assets/inc/head_common_principal');
		$this->load->view('../../assets/inc/menu_cabecera_login');
		$this->load->view('login/registro');
	}
	public function guardar_reg_usuario(){
		$this->form_validation->set_rules('txt_dni', 'DNI', 'required|required');
		$this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|required');
		$this->form_validation->set_rules('txt_direccion_1', 'Direccion', 'required|required');
		$this->form_validation->set_rules('txt_direccion_2', 'Direccion de Envio', 'required|required');
		$this->form_validation->set_rules('txt_telf', 'Telefono', 'required|required');
		$this->form_validation->set_rules('txt_login', 'Login', 'required|required');
		$this->form_validation->set_rules('txt_clave_1', 'Clave', 'required|required');
		$this->form_validation->set_rules('txt_clave_2', 'Repita su Clave', 'required|required');
		$this->form_validation->set_rules('txt_clave_2', ' Confirmacion de Clave', 'required|matches[txt_clave_1]');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("valid_email","El campo %s Debe contener un Email");
		$this->form_validation->set_message("matches","Las Claves no coinciden");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->registro_usuario();
		}else{
			$dni=$this->input->post('txt_dni','true');
			$nombre=$this->input->post('txt_nombre','true');
			$direccion_1=$this->input->post('txt_direccion_1','true');
			$direccion_2=$this->input->post('txt_direccion_2','true');
			$telf=$this->input->post('txt_telf','true');
			$login['login']=$this->input->post('txt_login','true');
			$clave_1=do_hash($this->input->post('txt_clave_1','true'));
			$email=$login['login'];
			$this->cliente_model->guardar_cliente($dni,$nombre,$direccion_1,$direccion_2,$telf,$email);
			$id_nivel=2;
			$login_2=$this->session->set_userdata($login);
			$this->session->set_userdata($login);
			$id_tipo_estado_usuario=2;
			$this->usuario_model->guardar_usuario($id_nivel, $id_tipo_estado_usuario, $nombre, $email, $clave_1);
			
			redirect('login/activar_cuenta');

		}
	}

		public function activar_cuenta(){$correo=$this->session->userdata('login');
				$consulta=$this->usuario_model->get_usuario_login($correo);
				foreach ($consulta as $key) {
					$id_login=$key->id;
				}

				/*La parte del mail*/
			/* configuracion del correo*/
			$config = Array(
			'IsSMTP'=>true,
			'useragent'=>'Codeigniter',
	    'protocol' => 'sendmail',
	    'smtp_host' => 'ssl://smtp.gmail.com',
	    'smtp_port' =>  '465',
	    'smtp_timeout'=>'10',
	    'smtp_user' => 'hectordav@gmail.com',
	    'smtp_pass' => 'Fidelito13__',
	    'mailtype'  => 'html',
	    'charset'   => 'utf-8',
	    'smtp_crypto'=>'tls',
	    'wordwrap'=>true,
	    'wrapchars'=>76,
	    'validate'=>true,
	    'crlf'=>'\r\n',
	    'newline'=>'\r\n',
	    'bcc_batch_mode'=>false,
	    'bcc_batch_size'=>200,
	    'smtp_secure'=>'tls'
	);

			/************************/
			$id_login_hash= do_hash($id_login);
			$destinatario=$correo;
			$mensaje_español="Para Activar su Cuenta haga clic en el siguiente Enlace para Continuar.";
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->load->library('email');
			$this->email->from('hectordav@gmail.com');
			$this->email->to($destinatario);
			$this->email->subject('Registro');
			$direccion=base_url();
			$this->email->message(''.$mensaje_español.'&nbsp;<a href="'.base_url().'login/registro_exitoso/'.$id_login_hash.'">Haga Clic Aqui</a>');
				$result = $this->email->send();
				/********************/
				$this->load->view('../../assets/inc/head_common_principal');
				$this->load->view('login/validar_email');
	}
	public function olvido_password(){
		$this->load->view('../../assets/inc/head_common_principal');
		$this->load->view('login/olvido_password');
	}
	public function reset_password(){
		$this->form_validation->set_rules('txt_login', 'Login', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->olvido_password();
		}else{
				$correo=$this->input->post('txt_login','true');
				$consulta=$this->usuario_model->get_usuario_login($correo);
				if (!$consulta) {
					$this->session->set_flashdata('alerta', 'Email no se encuentra registrado en Nuestra base de datos');
							redirect('login/olvido_password','refresh');
				}else{
				foreach ($consulta as $key) {
					$id_login=$key->id;
				}

				/*La parte del mail*/
			/* configuracion del correo*/
			$config = Array(
			'IsSMTP'=>true,
			'useragent'=>'Codeigniter',
	    'protocol' => 'sendmail',
	    'smtp_host' => 'ssl://smtp.gmail.com',
	    'smtp_port' =>  '465',
	    'smtp_timeout'=>'10',
	    'smtp_user' => 'hectordav@gmail.com',
	    'smtp_pass' => 'Fidelito13__',
	    'mailtype'  => 'html',
	    'charset'   => 'utf-8',
	    'smtp_crypto'=>'tls',
	    'wordwrap'=>true,
	    'wrapchars'=>76,
	    'validate'=>true,
	    'crlf'=>'\r\n',
	    'newline'=>'\r\n',
	    'bcc_batch_mode'=>false,
	    'bcc_batch_size'=>200,
	    'smtp_secure'=>'tls'
	);

			/************************/
			$id_login_hash= do_hash($id_login);
			$destinatario=$correo;
			$mensaje_español="Para Cambiar su password haga clic en el siguiente Enlace para Continuar.";
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			$this->load->library('email');
			$this->email->from('hectordav@gmail.com');
			$this->email->to($destinatario);
			$this->email->subject('Registro');
			$direccion=base_url();
			$this->email->message(''.$mensaje_español.'&nbsp;<a href="'.base_url().'login/cambiar_password/'.$id_login_hash.'">Haga Clic Aqui</a>');
				$result = $this->email->send();
				/********************/
				$this->load->view('../../assets/inc/head_common_principal');
				$this->load->view('login/reset_password_1');
		}
	}
	
	}
		public function registro_exitoso(){
		$id_usuario=$this->uri->segment(3);
		if (!$id_usuario) {
			redirect('login/index','refresh');
		}
		$consulta=$this->usuario_model->get_usuario();
		foreach ($consulta as $key) {
			$id_usuario_hash=do_hash($key->id);
			if ($id_usuario==$id_usuario_hash){
				$id_usuario_2=$key->id;
			}
		}
		$id_tipo_estado_usuario=1;
		$this->usuario_model->actualizar_estado_usuario($id_usuario_2,$id_tipo_estado_usuario);
		$this->session->set_flashdata('alerta', 'Se ha Activado el usuario, ingrese su usuario y contraseña para continuar');
				redirect('login/index','refresh');
	}
		public function cambiar_password(){
			$id_usuario['id_usuario']=$this->uri->segment(3);
					if ($id_usuario['id_usuario']) {
						$this->session->set_userdata($id_usuario);
						}
			$id_usuario=$this->session->userdata('id_usuario');
			$data = array('id_usuario' =>$id_usuario);
			$this->load->view('../../assets/inc/head_common_principal');
			$this->load->view('login/reset_password_2',$data);
	}
	public function cambiar_password_2(){
		$this->form_validation->set_rules('txt_clave_1', 'Clave', 'required|required');
		$this->form_validation->set_rules('txt_clave_2', 'Repita su Clave', 'required|required');
		$this->form_validation->set_rules('txt_clave_2', ' Confirmacion de Clave', 'required|matches[txt_clave_1]');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("matches","Las Claves no coinciden");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->cambiar_password();
		}else{
		$id_usuario=$this->input->post('txt_id_usuario','true');
		$clave=do_hash($this->input->post('txt_clave_1','true'));
		$consulta=$this->usuario_model->get_usuario();
		foreach ($consulta as $key) {
			$id_usuario_hash=do_hash($key->id);
			if ($id_usuario===$id_usuario_hash){
				$id_usuario_2=$key->id;
			}
		}
		$this->usuario_model->actualizar_usuario_password($id_usuario_2,$clave);
		$this->session->set_flashdata('alerta', 'Se ha cambiado el passwords correctamente');
					redirect('login/index','refresh');	
		}
	}
	public function cerrar_sesion() {
      $usuario_data = array(
         'logueado' => FALSE
      );
     $this->session->sess_destroy();
      redirect('pagina_principal/home');
   }
}
