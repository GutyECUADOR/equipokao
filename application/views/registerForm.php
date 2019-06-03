<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>


<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

    <title>Equipo KAO</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    
    <!-- select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
    <!-- uikit -->
    <link rel="stylesheet" href="bower_components/uikit/css/uikit.almost-flat.css"/>

    <!-- altair admin -->
    <link rel="stylesheet" href="assets/css/main.min.css" media="all">

    <!-- altair admin login page -->
    <link rel="stylesheet" href="assets/css/login_page.css" />

</head>
<body class="login_page login_page_v2">

    <div class="uk-container uk-container-center">
        <div class="md-card">
            <div class="md-card-content padding-reset">
                <div class="uk-grid uk-grid-collapse">
                    <div class="uk-width-large-6-10 uk-hidden-medium uk-hidden-small">
                        <div class="login_page_info uk-height-1-1 backgrounBanner" >
                            <div class="info_content">
                                <h1 class="heading_b"></h1>
                                El equipo KAO es ...
                               
                            </div>
                        </div>
                    </div>
                    <div class="uk-width-large-4-10 uk-width-medium-2-3 uk-container-center">
                        <div class="login_page_forms">
                            <div id="login_card">
                                <div id="login_form">
                                    <div class="login_heading">
                                       <h3 class="center-text">Registro #equipoKAO<h3>
                                    </div>
                                    <?php echo form_open('registro/register', array('id' => 'registerForm', 'autocomplete' => 'off')); ?>
                                        <div class="uk-form-row">
                                            <label for="nombres">Nombres</label>
                                            <input class="md-input label-fixed" type="text" id="nombres" name="nombres" required/>
										</div>

										<div class="uk-form-row">
                                            <label for="apellidos">Apellidos</label>
                                            <input class="md-input label-fixed" type="text" id="apellidos" name="apellidos" required/>
                                        </div>

                                        <div class="uk-form-row">
                                            <label for="celular">Celular</label>
                                            <input class="md-input label-fixed" type="text" id="celular" name="celular" placeholder='099XXXXXXX' required/>
                                       </div>
										
										<div class="uk-form-row">
                                            <label for="email">Email</label>
                                            <input class="md-input label-fixed" type="email" id="email" name="email" placeholder='micorreo@correo.com' required/>
										</div>

										<div class="uk-form-row">
                                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                            <input class="md-input label-fixed" type="date" id="fechaNacimiento" name="fechaNacimiento" required/>
										</div>

										<div class="uk-form-row">
                                            <label for="genero">Sexo: </label>
											<span class="icheck-inline">
												<input type="radio" value="M" name="radio_sexo" id="radio_masculino" data-md-icheck checked required/>
												<label for="radio_masculino" class="inline-label">Masculino</label>
											</span>
											<span class="icheck-inline">
												<input type="radio" value="F" name="radio_sexo" id="radio_femenino" data-md-icheck />
												<label for="radio_femenino" class="inline-label">Femenino</label>
											</span>
											
										</div>

                                        <div class="uk-form-row" >
                                            <label for="deporteFavorito">Deportes Favoritos</label>
                                            <select id="deporteFavorito" name="deporteFavorito[]" class="uk-width-1-1" multiple data-md-select2 required>
                                                   
                                                <?php 
                                                    foreach($arrayDeportes as $row) { 
                                                    echo '<option value="'.$row['codigo'].'">'.$row['deporteName'].'</option>';
                                                    }
                                                ?>
                                                   
                                            </select>
                                       
                                        </div>

                                        <br/>
                                        <label for="deporteFavorito">Marcas Favoritas</label>
                                        <div class="uk-form-row">

                                            <?php 

                                                foreach($arrayMarcasDeportivas as $row) { 
                                                    echo '
                                                    <span class="icheck-inline">
                                                        <input type="checkbox" name="marcasFavoritas[]" id="marcasFavoritas" value="'.$row['codigo'].'" data-md-icheck />
                                                        <label class="inline-label">'.$row['marcaName'].'</label>
                                                    </span>
                                                        ';
                                            }
                                            ?>
                                           
                                        </div>
                                       
                                        <div class="uk-margin-medium-top">
											<button class="md-btn md-btn-primary md-btn-block" type="submit">Registrarme!</button>
                                        </div>

                                        <!-- <div class="uk-margin-medium-top">
											<button id="testButton" class="md-btn md-btn-danger md-btn-block" type="button">test</button>
                                        </div> -->
                                        
                                        
                                    </form>
                                </div>
                               
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- common functions -->
    <script src="assets/js/common.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.js"></script>
    <!-- altair core functions -->
    <script src="assets/js/altair_admin_common.js"></script>

    <!-- select2 -->
    <script src="bower_components/select2/dist/js/select2.min.js"></script>

    <!-- kendo UI -->
    <script src="assets/js/kendoui_custom.min.js"></script>

    <!-- altair login page functions -->
    <script src="assets/js/pages/login.js"></script>

    

</body>
</html>