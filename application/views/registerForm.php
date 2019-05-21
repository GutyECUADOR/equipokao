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

    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon-16x16.png')?>" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon-32x32.png')?>" sizes="32x32">

    <title>Unete al equipo KAO</title>

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500' rel='stylesheet' type='text/css'>

    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url('bower_components/uikit/css/uikit.almost-flat.css')?>"/>

    <!-- altair admin login page -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/login_page.css')?>" />

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
                                El equipo KAO es Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aut culpa cumque eaque earum error esse exercitationem fuga, fugiat harum perferendis praesentium quasi qui, repellendus sapiente, suscipit totam! Eaque, excepturi!
                               
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
                                            <input class="md-input label-fixed" type="text" id="celular" name="celular" required/>
                                       </div>
										
										<div class="uk-form-row">
                                            <label for="email">Email</label>
                                            <input class="md-input label-fixed" type="email" id="email" name="email" required/>
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

										<div class="uk-form-row">
                                            <label for="deporteFavorito">Deporte Favorito</label>
                                            <select id="deporteFavorito"  name="deporteFavorito" class="md-input" required>
                                				<option value="" disabled="" selected="" hidden="">Seleccione un deporte</option>
												<?php 

                                                    foreach($arrayDeportes as $row) { 
                                                    echo '<option value="'.$row['codigo'].'">'.$row['deporteName'].'</option>';
                                                    }
                                                ?>
                               
                           					</select>
										</div>
										
										<div class="uk-form-row">
											<label for="marcaFavorita">Marca Favorito</label>
											<select id="marcaFavorita" name="marcaFavorita" class="md-input" required>
												<option value="" disabled="" selected="" hidden="">Seleccione una marca</option>
                                                <?php 

                                                    foreach($arrayMarcasDeportivas as $row) { 
                                                    echo '<option value="'.$row['codigo'].'">'.$row['marcaName'].'</option>';
                                                    }
                                                ?>
                                                
											</select>
                                        </div>
                                       
                                        <div class="uk-margin-medium-top">
											<button class="md-btn md-btn-primary md-btn-block" type="submit">Registrarme!</button>
                                        </div>
                                        
                                        
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
    <script src="<?php echo base_url('assets/js/common.js')?>"></script>
    <!-- uikit functions -->
    <script src="<?php echo base_url('assets/js/uikit_custom.js')?>"></script>
    <!-- altair core functions -->
    <script src="<?php echo base_url('assets/js/altair_admin_common.js')?>"></script>

     <!-- kendo UI -->
     <script src="<?php echo base_url('assets/js/kendoui_custom.min.js')?>"></script>

    <!-- altair login page functions -->
    <script src="<?php echo base_url('assets/js/pages/login.js')?>"></script>


</body>
</html>