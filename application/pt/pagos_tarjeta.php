<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Stripe\Stripe;
use \Stripe\Charge;
use \Stripe\Customer;
class Pagos_tarjeta extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('categoria_model');
			$this->load->model('banner_model');
			$this->load->model('modas_model');
			$this->load->model('coleccion_destacada_model');
			$this->load->model('productos_recomendados_model');
			$this->load->model('producto_model');
			$this->load->model('pre_pedido_model');
			$this->load->model('genero_model');
			$this->load->model('pedido_model');
			$this->load->model('slide_model');
	}

	public function tipo_pago(){

			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$consulta=$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']);
			if ($consulta) {
				foreach ($consulta as $key) {
					$id_pre_pedido=$key->id;
				}
				$suma_det_pre_pedido=$this->pre_pedido_model->sumar_articulos_det_pre_pedido($id_pre_pedido);
			foreach ($suma_det_pre_pedido as $key) {
				$total=$key->total;
			}
			}else{
				$total=0;
			}
			$id_producto=$this->uri->segment(3);
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Zonas');
			$crud->set_language('spanish');
			$output = $crud->render();
			/*masculino*/
			$id_genero1=3;
			/*femenino*/
			$id_genero2=4;
		$id_pre_pedido=$this->input->post('txt_id_pre_pedido','true');
		$total=$this->input->post('txt_total','true');

			$data = array('genero' =>$this->genero_model->get_genero(),
				'categoria'=>$this->categoria_model->get_categoria_general(),
				'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
				'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
				'banner'=>$this->banner_model->get_producto_banner(),
				'modas'=>$this->modas_model->get_producto_modas(),
				'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
				'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
				'producto'=>$this->producto_model->get_producto_id($id_producto),
				'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
				'total_articulos'=>$total,
				'id_pre_pedido' =>$id_pre_pedido,
		'total'=>$total);
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('pagos/tipos_pagos',$output);
			$this->load->view('../../assets/inc/footer_common_principal',$output);		
	}
}

	public function pago_paypal(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		$id_pedido=$this->input->post('txt_id_pre_pedido');
		$descripcion_proyecto=$this->input->post('txt_descripcion');
		$monto=$this->input->post('txt_total');
		$this->session->set_flashdata('id_pedido', $id_pedido);
		$config['business']= 'issalex22-facilitator-1@gmail.com';
		$config['cpp_header_image'] 	= ''; //Image header url [750 pixels wide by 90 pixels high]
		$config['return'] 				= base_url().'pagos_tarjeta/notificar_pago_paypal';
		$config['cancel_return'] 		= base_url().'pagos_tarjeta/cancel_payment';
		$config['notify_url'] 			= 'process_payment.php'; //IPN Post
		$config['production'] 			= false; //Its false by default and will use sandbox
		$config["invoice"]				= random_string('numeric',8); //The invoice id
		$this->load->library('paypal',$config);
		#$this->paypal->add(<name>,<price>,<quantity>[Default 1],<code>[Optional]);
		$this->paypal->add($descripcion_proyecto,$monto); //First item
		$this->paypal->pay(); //Proccess the payment
			}else{
		redirect('pagina_principal/home','refresh');
		}
	}

	public function cancel_payment(){
		redirect('pre_pedido/checkout','refresh');
	}
		public function visanet(){
			echo "aqui llega";
			exit();
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$consulta=$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']);

		$transactionToken=$this->input->post('transactionToken','true');
		$environment=$this->uri->segment(3);
		$sessionToken=$this->uri->segment(4);
		$merchantid="148009103";
		$accessKey="AKIAIV7F7AJDQBDGC6LA";
		$secretKey="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";
		 if ($environment=="prd") {
              $url = "https://apice.vnforapps.com/api.authorization/api/v1/authorization/web/{$merchantid}";
           
        }else{
             $url = "https://devapice.vnforapps.com/api.authorization/api/v1/authorization/web/{$merchantid}";
           
        }
        $header = array("Content-Type: application/json","VisaNet-Session-Key: $sessionToken");
        $request_body="{
            \"transactionToken\":\"$transactionToken\",
            \"sessionToken\":\"$sessionToken\"
        }";
          $ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
				curl_setopt($ch, CURLOPT_USERPWD, "$accessKey:$secretKey");
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_HEADER, FALSE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);				
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //curl_setopt($ch, CURLOPT_PROXY, PROXY);
        $result = curl_exec($ch);
		//*Convertir la respuesta en Json Format*/
		$json = json_decode($result, true);
  	/*recojer el error e imprimirlo*/
        $error = curl_error($ch);
        if ($error) echo $error;
     /*pido la respuesta*/
	
		print_r($json);
		exit();  
	/*******************************************************************/
	/*******************************************************************/
		/*si la transaccion pasa*/
		if ($respuesta==1) {

			$id_pre_pedido= $json['data']['NUMORDEN'];
			/*aqui hace todo el proceso de pago directo y pasa al pre-pedido*/
		$consulta_pre_pedido=$this->pre_pedido_model->buscar_pre_pedido_id_prepedido($id_pre_pedido);
		$consulta_det_prepedido=$this->pre_pedido_model->buscar_det_pedido_id($id_pre_pedido);
		if (!$consulta_pre_pedido) {
			redirect('pagina_principal','refresh');
		}
		foreach ($consulta_pre_pedido as $key) {
			$id_usuario=$key->id_usuario;
			$total=$key->total;
			$fecha=$key->fecha;
		}
		$num_tarjeta=$json['data']['PAN'];
		$dominio="www.encurvas.com";
		$tienda="MAS BENEFICIOS";
		$telefono="998700308";
		$direccion="CAL UGARTE Y MOCOSO NUM 580 OFC 402";
		$fecha_hora_pedido=$json['data']['FECHAYHORA_TX'];
		$total_p=$json['data']['IMP_AUTORIZADO'];
		$moneda="Sol";
		$id_estado_pedido=1;
		$id_tipo_pago=3;
		$fecha_pago=date('Y-m-d');
		$this->pedido_model->guardar_pedido($id_estado_pedido,$id_tipo_pago,$data_usuario['id_usuario'],$id_pre_pedido,$total,$fecha,$fecha_pago);
		$consulta_pedido=$this->pedido_model->get_max_pedido();
		if ($consulta_pedido) {
			foreach ($consulta_pedido as $key) {
				$id_pedido_2=$key->id;
			}

		/*toma los datos del det_prepedido y los guarda en el pedido*/
		foreach ($consulta_det_prepedido as $key) {
			$id_inventario_producto=$key->id_inventario_producto;
			$id_talla_producto=$key->id_talla_producto;
			$id_color_producto=$key->id_color_producto;
			$descripcion=$key->descripcion;
			$cantidad=$key->cantidad;
			$total=$key->total;
			$this->pedido_model->guardar_det_pedido($id_pedido_2,$id_inventario_producto,$id_talla_producto,$id_color_producto,$descripcion,$cantidad,$total);
		}
		$this->pre_pedido_model->borrar_pre_pedido($id_pre_pedido);
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empresa');
			$crud->set_subject('Zonas');
			$crud->set_language('spanish');
			$output = $crud->render();
				/*masculino*/
			$id_genero1=3;
			/*femenino*/
			$id_genero2=4;
			$data = array('pedido' =>$this->pedido_model->get_pedido_id($id_pedido_2),
			'det_pedido'=>$this->pedido_model->get_det_pedido_id_pedido($id_pedido_2),
			'tienda'=>$tienda,
			'telefono'=>$telefono,
			'fecha_hora'=>$fecha_hora_pedido,
			'total_p'=>$total_p,
			'moneda'=>$moneda,
			'direccion'=>$direccion,
			'num_tarjeta'=>$num_tarjeta,
			'genero' =>$this->genero_model->get_genero(),
			'categoria'=>$this->categoria_model->get_categoria_general(),
			'categoria1'=>$this->categoria_model->get_categoria($id_genero1),
			'categoria2' =>$this->categoria_model->get_categoria($id_genero2),
			'banner'=>$this->banner_model->get_producto_banner(),
			'modas'=>$this->modas_model->get_producto_modas(),
			'coleccion'=>$this->coleccion_destacada_model->get_producto_coleccion_destacada(),
			'producto_recomendado'=>$this->productos_recomendados_model->get_productos_recomendados(),
			'prepedido'=>$this->pre_pedido_model->buscar_pre_pedido($data_usuario['id_usuario']),
			'slide'=>$this->slide_model->get_slide(),
			'num_pedido'=>$id_pre_pedido);
			$this->load->view('../../assets/inc/head_common_principal', $output);
			$this->load->view('../../assets/inc/menu_cabecera_logueado',$data);
			$this->load->view('../../assets/inc/mega_menu',$data);
			$this->load->view('pagos/aprobado');
			$this->load->view('../../assets/inc/footer_common_principal',$output);
			/****************************************************************/
		}
	}else{
			echo "no paso";
}
}
	public function notificar_pago_paypal(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
			'nombre_usuario'=>$this->session->userdata('nombre'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		$id_pre_pedido  = $this->session->flashdata('id_pedido');
		$consulta_pre_pedido=$this->pre_pedido_model->buscar_pre_pedido_id_prepedido($id_pre_pedido);
		$consulta_det_prepedido=$this->pre_pedido_model->buscar_det_pedido_id($id_pre_pedido);
		foreach ($consulta_pre_pedido as $key) {
			$id_usuario=$key->id_usuario;
			$total=$key->total;
			$fecha=$key->fecha;
		}

		$id_estado_pedido=1;
		$id_tipo_pago=1;
		$fecha_pago=date('Y-m-d');
		
		$this->pedido_model->guardar_pedido($id_estado_pedido,$id_tipo_pago,$data_usuario['id_usuario'],$id_pre_pedido,$total,$fecha,$fecha_pago);
		$consulta_pedido=$this->pedido_model->get_max_pedido();
		if ($consulta_pedido) {
			foreach ($consulta_pedido as $key) {
				$id_pedido_2=$key->id;
			}
		/*toma los datos del det_prepedido y los guarda en el pedido*/
		foreach ($consulta_det_prepedido as $key) {
			$id_inventario_producto=$key->id_inventario_producto;
			$id_talla_producto=$key->id_talla_producto;
			$id_color_producto=$key->id_color_producto;
			$descripcion=$key->descripcion;
			$cantidad=$key->cantidad;
			$total=$key->total;
			
			$this->pedido_model->guardar_det_pedido($id_pedido_2,$id_inventario_producto,$id_talla_producto,$id_color_producto,$descripcion,$cantidad,$total);
		}
		/*aqui elimina el pre_pedido*/
		$this->pre_pedido_model->borrar_pre_pedido($id_pre_pedido);
		$this->session->set_flashdata('alerta', 'Se ha Efectuado el Pago');
				redirect('pagina_principal/home','refresh');
		}
	}else{
				redirect('pagina_principal/home','refresh');

			}

	}

	public function checkout(){
		if ($this->session->userdata('logueado')) {
				$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
				'nombre_usuario'=>$this->session->userdata('nombre'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
		$token = $_POST['stripeToken'];
		try {
			
		$id_pre_pedido=$this->input->post('txt_id_pre_pedido_1');	
		$consulta_pre_pedido=$this->pre_pedido_model->buscar_pre_pedido_id_prepedido($id_pre_pedido);
		$consulta_det_prepedido=$this->pre_pedido_model->buscar_det_pedido_id($id_pre_pedido);
		foreach ($consulta_pre_pedido as $key) {
			$id_usuario=$key->id_usuario;
			$total=$key->total;
			$fecha=$key->fecha;
		}
		$id_estado_pedido=1;
		$id_tipo_pago=2;
		$fecha_pago=date('Y-m-d');
		
		$this->pedido_model->guardar_pedido($id_estado_pedido,$id_tipo_pago,$data_usuario['id_usuario'],$id_pre_pedido,$total,$fecha,$fecha_pago);
		$consulta_pedido=$this->pedido_model->get_max_pedido();
		if ($consulta_pedido) {
			foreach ($consulta_pedido as $key) {
				$id_pedido_2=$key->id;
			}
		/*toma los datos del det_prepedido y los guarda en el pedido*/
	foreach ($consulta_det_prepedido as $key) {
			$id_inventario_producto=$key->id_inventario_producto;
			$id_talla_producto=$key->id_talla_producto;
			$id_color_producto=$key->id_color_producto;
			$descripcion=$key->descripcion;
			$cantidad=$key->cantidad;
			$total=$key->total;
			$this->pedido_model->guardar_det_pedido($id_pedido_2,$id_inventario_producto,$id_talla_producto,$id_color_producto,$descripcion,$cantidad,$total);
		}
		/*aqui elimina el pre_pedido*/
			require_once('vendor/autoload.php');
			Stripe::setApiKey('sk_test_fDvXUDSsn37zXmBcJtbFjrhO');
			$charge=Charge::create(array(
				 "amount" => 1000, // Amount in cents
    "currency" => "usd",
    "source" => $token,
    "description" => "Example charge"
				));
		$this->pre_pedido_model->borrar_pre_pedido($id_pre_pedido);
		
		$this->session->set_flashdata('alerta', 'Se ha Efectuado el Pago');
				redirect('pagina_principal/home','refresh');

		}
			
		} catch (\Stripe\Error\Card $e) {
			$error=$e->getmessage();
			echo $error;

		}
		}else{
					redirect('pagina_principal/home','refresh');
		}
	}
}

/* End of file stripe_payment.php */
/* Location: ./application/controllers/stripe_payment.php */