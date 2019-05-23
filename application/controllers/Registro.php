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
    
    public function test() {
        return $this->load->view('emailRegisterHTML');
    }


	public function register() {
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
            if ($nombres && $apellidos && $celular && $email ) {
                // Loading model
                $this->load->model('usuario');
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

                if ($this->usuario->insert($data)) {
                    $statusEmail = $this->sendEmail($data['email']);
                    $response = array('message'     => 'Registro exitoso, Bienvenido al #equipoKAO', 
                                      'statusEmail' => $statusEmail);
                    
                }else{
                    $response = array('message' => 'Lo sentimos, no hemos podido completar tu registro, reintente mas tarde');
                }
            }
        }
        echo json_encode($response);
    }
    
    
    public function sendEmail($email) {
        $mail = $this->customemail->load();

        $pcID = php_uname('n'); // Obtiene el nombre del PC
        $correoCliente = $email;

        try {
            //Server settings
            $mail->SMTPDebug = false;                                 // Enable verbose debug output 0->off 2->debug
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp-mail.outlook.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'kaomantenimientos@hotmail.com';                 // SMTP username
            $mail->Password = 'kaomnt2019$$';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;  
        
            //Recipients
            $mail->setFrom('kaomantenimientos@hotmail.com', 'Kao Sport');
            $mail->addAddress($correoCliente);
            $mail->addCC('soporteweb@sudcompu.net');
           
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Bienvenido al #equipoKAO';
            $mail->AltBody = 'Notificacion de registro';
            $mail->Body    =  $this->load->view('emailRegisterHTML', '', true);
            
        
            $mail->send();
            $detalleMail = 'Email enviado a : ' . $correoCliente;
            $log  = "User: ".' - '.date("F j, Y, g:i a").PHP_EOL.
                "PCid: ".$pcID.PHP_EOL.
                "Detail: ".$detalleMail.PHP_EOL.
                "-------------------------".PHP_EOL;
                //Save string to log, use FILE_APPEND to append.

                if (!is_dir('logs/')) {
                    // dir doesn't exist, make it
                    mkdir('logs/');
                  }
                file_put_contents('logs/logMailOK.txt', $log, FILE_APPEND );
            
            $response = array('status' => 'ok', 'mensaje' => $detalleMail );
            return $response;

        } catch (Exception $e) {
          
            
                $log  = "User: ".' - '.date("F j, Y, g:i a").PHP_EOL.
                "PCid: ".$pcID.PHP_EOL.
                "Detail: ".$mail->ErrorInfo .' No se pudo enviar correo a: ' . $correoCliente . PHP_EOL.
                "-------------------------".PHP_EOL;
                //Save string to log, use FILE_APPEND to append.
                file_put_contents('logs/logMailError.txt', $log, FILE_APPEND);
                $detalleMail = 'Error al enviar el correo. Mailer Error: '. $mail->ErrorInfo;
               
            $response = array('status' => 'false', 'mensaje' => $detalleMail ); 
            return $response; 
        }
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
