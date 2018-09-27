<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Mascota extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('mascota_model');
        $config = array(
				'upload_path' => "assets/upload/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'overwrite' => TRUE,
				'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
				'max_height' => "768",
				'max_width' => "1024"
			);
		$this->load->library('upload', $config);
		$this->load->helper(array('form', 'url'));

    }
    
    function index(){
        $data['title'] = 'Prueba mitocondria';
        $pages = 6; 
        $this->load->library('pagination'); 
        $config['base_url'] = base_url() . 'mascota/pagina/'; 
        $config['total_rows'] = $this->mascota_model->filas();
        $config['per_page'] = $pages;
        $config['num_links'] = 20; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera';
        $config['last_link'] = 'Última';
        $config['next_link'] = 'Siguiente';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div id="paginacion">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);
        
        $data["mascotas"] = $this->mascota_model->getMascotas();
        
        $this->load->view('mascota_view', $data);
    }
  
  	function subir(){
  		$datos['title'] = 'Prueba mitocondria';


  		
        if($this->input->post()){
        	$form = $this->input->post();

        	$tmp_name = $_FILES["imagen"]["tmp_name"];
	        // basename() may prevent filesystem traversal attacks;
	        // further validation/sanitation of the filename may be appropriate
	        $name = './assets/upload/' . $_FILES["imagen"]["name"];
	        move_uploaded_file($tmp_name, $name);

   			$formulario = array(
			  	'nombre' => $form['nombre'],
			  	'nickname' => $form['nickname'],
			  	'imagen' => $_FILES['imagen']['name'],
			  	'votos' => 0
			);
			

			$this->db->insert('mascotas',$formulario);
			redirect(base_url());	
			// if($this->upload->do_upload()){

			// 	$data = array('upload_data' => $this->upload->data());
			// 	$this->load->view('subir_view',$data);
			// }else{
			// 	$error = array('error' => $this->upload->display_errors());
			// 	$this->load->view('subir_view', $error);
			// }
        }else{
        	$this->load->view('subir_view',$datos) ;
        }
        
        
  	}

  	function votar(){
  		$id = $this->input->post();
  		$mascota = $this->mascota_model->getByID($id['id']);
  		
  		$voto = $mascota[0]->votos+1;
  		
  		if($this->mascota_model->votar($id['id'], $voto)){
  			echo 200;
  		}
  		
  	}

}