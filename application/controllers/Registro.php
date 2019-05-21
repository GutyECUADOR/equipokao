<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

	public function __constructor() {
		parent::__contructor();
		$this->load->database();
	
	}

	public function index(){
		$arrayDeportes = $this->getAllDeportes();
		$arrayMarcasDeportivas = $this->getAllMarcasDeportivas();
		$this->load->view('registerForm', compact('arrayDeportes','arrayMarcasDeportivas'));
	}

	public function saveData() {
		// If you have post data...
        if (!empty($_POST)) {
            $nombres = $this->input->post('nombres');
            $apellidos = $this->input->post('apellidos');
            $celular = $this->input->post('celular');
            $email = $this->input->post('email');
            $fechaNacimiento = $this->input->post('fechaNacimiento');
            $radio_sexo = $this->input->post('radio_sexo');
            $deporteFavorito = $this->input->post('deporteFavorito');
            $marcaFavorita = $this->input->post('marcaFavorita');

            // Checking if everything is there
            if ($nombres) {
                // Loading model
                $this->load->model('usuarios_Model');
                $data = array(
                    'nombres' => $nombres,
                    'apellidos' => $apellidos,
                    'celular' => $celular,
                    'email' => $email,
                    'fechaNacimiento' => $fechaNacimiento,
                    'genero' => $radio_sexo,
                    'deporteFavorito' => $deporteFavorito,
                    'marcaDepFavorita' => $marcaFavorita,
                );

                // Calling model
                $id = $this->usuarios_Model->insert($data);
            }
        }
       
       /*  $this->load->view('registerForm'); */
       redirect('/registro', 'refresh');
	}

	function getAllDeportes() {
		$this->load->database();
        $query = $this->db->query('SELECT * FROM deportes');
		$resultSet = $query->result_array();
		return $resultSet;

	}
	

	function getAllMarcasDeportivas() {
		$this->load->database();
        $query = $this->db->query('SELECT * FROM marcasdeportivas');
		$resultSet = $query->result_array();
		return $resultSet;

    }

}
