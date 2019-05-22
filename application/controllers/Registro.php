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
        echo 'Controller ready';
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
    
    
    private function sendEmail($email) {
        $mail = $this->phpmailer_library->load();

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
            $mail->setFrom('kaomantenimientos@hotmail.com');
            $mail->addAddress($correoCliente);
            $mail->addCC('soporteweb@sudcompu.net');
           
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Bienvenido al #equipoKAO';
            $mail->AltBody = 'Notificacion de registro';
            $mail->Body    = $this->getBodyHTMLofEmail();
            
        
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

    private function getBodyHTMLofEmail(){
       
        return '
        <!doctype html>
            <html>
                <head>
                <meta name="viewport" content="width=device-width" />
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <title>Email</title>
                <style>
                    /* -------------------------------------
                        GLOBAL RESETS
                    ------------------------------------- */
                    
                    /*All the styling goes here*/
                    
                    img {
                    border: none;
                    margin-bottom: 10px;
                    -ms-interpolation-mode: bicubic;
                    max-width: 100%; 
                    }
                    body {
                    background-color: #f6f6f6;
                    font-family: sans-serif;
                    -webkit-font-smoothing: antialiased;
                    font-size: 14px;
                    line-height: 1.4;
                    margin: 0;
                    padding: 0;
                    -ms-text-size-adjust: 100%;
                    -webkit-text-size-adjust: 100%; 
                    }
                    table {
                    border-collapse: separate;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                    width: 100%; }
                    table td {
                        font-family: sans-serif;
                        font-size: 14px;
                        vertical-align: top; 
                    }
                    /* -------------------------------------
                        BODY & CONTAINER
                    ------------------------------------- */
                    .body {
                    background-color: #f6f6f6;
                    width: 100%; 
                    }
                    /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
                    .container {
                    display: block;
                    margin: 0 auto !important;
                    /* makes it centered */
                    max-width: 580px;
                    padding: 10px;
                    width: 580px; 
                    }
                    /* This should also be a block element, so that it will fill 100% of the .container */
                    .content {
                    box-sizing: border-box;
                    display: block;
                    margin: 0 auto;
                    max-width: 580px;
                    padding: 10px; 
                    }
                    /* -------------------------------------
                        HEADER, FOOTER, MAIN
                    ------------------------------------- */
                    .main {
                    background: #ffffff;
                    border-radius: 3px;
                    width: 100%; 
                    }
                    .wrapper {
                    box-sizing: border-box;
                    padding: 20px; 
                    }
                    .content-block {
                    padding-bottom: 10px;
                    padding-top: 10px;
                    }
                    .footer {
                    clear: both;
                    margin-top: 10px;
                    text-align: center;
                    width: 100%; 
                    }
                    .footer td,
                    .footer p,
                    .footer span,
                    .footer a {
                        color: #999999;
                        font-size: 12px;
                        text-align: center; 
                    }
                    /* -------------------------------------
                        TYPOGRAPHY
                    ------------------------------------- */
                    h1,
                    h2,
                    h3,
                    h4 {
                    color: #000000;
                    font-family: sans-serif;
                    font-weight: 400;
                    line-height: 1.4;
                    margin: 0;
                    margin-bottom: 30px; 
                    }
                    h1 {
                    font-size: 35px;
                    font-weight: 300;
                    text-align: center;
                    text-transform: capitalize; 
                    }
                    p,
                    ul,
                    ol {
                    font-family: sans-serif;
                    font-size: 14px;
                    font-weight: normal;
                    margin: 0;
                    margin-bottom: 15px; 
                    }
                    p li,
                    ul li,
                    ol li {
                        list-style-position: inside;
                        margin-left: 5px; 
                    }
                    a {
                    color: #3498db;
                    text-decoration: underline; 
                    }
                    /* -------------------------------------
                        BUTTONS
                    ------------------------------------- */
                    .btn {
                    box-sizing: border-box;
                    width: 100%; }
                    .btn > tbody > tr > td {
                        padding-bottom: 15px; }
                    .btn table {
                        width: auto; 
                    }
                    .btn table td {
                        background-color: #ffffff;
                        border-radius: 5px;
                        text-align: center; 
                    }
                    .btn a {
                        background-color: #ffffff;
                        border: solid 1px #3498db;
                        border-radius: 5px;
                        box-sizing: border-box;
                        color: #3498db;
                        cursor: pointer;
                        display: inline-block;
                        font-size: 14px;
                        font-weight: bold;
                        margin: 0;
                        padding: 12px 25px;
                        text-decoration: none;
                        text-transform: capitalize; 
                    }
                    .btn-primary table td {
                    background-color: #3498db; 
                    }
                    .btn-primary a {
                    background-color: #3498db;
                    border-color: #3498db;
                    color: #ffffff; 
                    }
                    /* -------------------------------------
                        OTHER STYLES THAT MIGHT BE USEFUL
                    ------------------------------------- */
                    .last {
                    margin-bottom: 0; 
                    }
                    .first {
                    margin-top: 0; 
                    }
                    .align-center {
                    text-align: center; 
                    }
                    .align-right {
                    text-align: right; 
                    }
                    .align-left {
                    text-align: left; 
                    }
                    .clear {
                    clear: both; 
                    }
                    .mt0 {
                    margin-top: 0; 
                    }
                    .mb0 {
                    margin-bottom: 0; 
                    }
                    .preheader {
                    color: transparent;
                    display: none;
                    height: 0;
                    max-height: 0;
                    max-width: 0;
                    opacity: 0;
                    overflow: hidden;
                    mso-hide: all;
                    visibility: hidden;
                    width: 0; 
                    }
                    .powered-by a {
                    text-decoration: none; 
                    }
                    hr {
                    border: 0;
                    border-bottom: 1px solid #f6f6f6;
                    margin: 20px 0; 
                    }
                    /* -------------------------------------
                        RESPONSIVE AND MOBILE FRIENDLY STYLES
                    ------------------------------------- */
                    @media only screen and (max-width: 620px) {
                    table[class=body] h1 {
                        font-size: 28px !important;
                        margin-bottom: 10px !important; 
                    }
                    table[class=body] p,
                    table[class=body] ul,
                    table[class=body] ol,
                    table[class=body] td,
                    table[class=body] span,
                    table[class=body] a {
                        font-size: 16px !important; 
                    }
                    table[class=body] .wrapper,
                    table[class=body] .article {
                        padding: 10px !important; 
                    }
                    table[class=body] .content {
                        padding: 0 !important; 
                    }
                    table[class=body] .container {
                        padding: 0 !important;
                        width: 100% !important; 
                    }
                    table[class=body] .main {
                        border-left-width: 0 !important;
                        border-radius: 0 !important;
                        border-right-width: 0 !important; 
                    }
                    table[class=body] .btn table {
                        width: 100% !important; 
                    }
                    table[class=body] .btn a {
                        width: 100% !important; 
                    }
                    table[class=body] .img-responsive {
                        height: auto !important;
                        max-width: 100% !important;
                        width: auto !important; 
                    }
                    }
                    /* -------------------------------------
                        PRESERVE THESE STYLES IN THE HEAD
                    ------------------------------------- */
                    @media all {
                    .ExternalClass {
                        width: 100%; 
                    }
                    .ExternalClass,
                    .ExternalClass p,
                    .ExternalClass span,
                    .ExternalClass font,
                    .ExternalClass td,
                    .ExternalClass div {
                        line-height: 100%; 
                    }
                    .apple-link a {
                        color: inherit !important;
                        font-family: inherit !important;
                        font-size: inherit !important;
                        font-weight: inherit !important;
                        line-height: inherit !important;
                        text-decoration: none !important; 
                    }
                    .btn-primary table td:hover {
                        background-color: #34495e !important; 
                    }
                    .btn-primary a:hover {
                        background-color: #34495e !important;
                        border-color: #34495e !important; 
                    } 
                    }
                </style>
                </head>
                <body class="">
                <span class="preheader">Cotizacion</span>
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
                    <tr>
                    <td>&nbsp;</td>
                    <td class="container">
                        <div class="content">
            
                        <!-- START CENTERED WHITE CONTAINER -->
                        <table role="presentation" class="main">
            
                            <!-- START MAIN CONTENT AREA -->
                            <tr>
                            <td class="wrapper">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                            <td style="text-align: center">
                                            <img src="http://kaosport.com/logokao.png" height="100" width="200" alt="Logo"> </td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    
                                        <p>Estimado, te demos la bienvenida al equipo KAO</p>

                                    
                                    <p>Muchas gracias por su confianza!</p>
                                    </td>
                                </tr>
                                </table>
                            </td>
                            </tr>
            
                        <!-- END MAIN CONTENT AREA -->
                        </table>
            
                        <!-- START FOOTER -->
                       
                        <!-- END FOOTER -->
            
                        <!-- END CENTERED WHITE CONTAINER -->
                        </div>
                    </td>
                    <td>&nbsp;</td>
                    </tr>
                </table>
                </body>
            </html>
        
        ';
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
