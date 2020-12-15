<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/CSS/style.css">
	 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio se sesión</title>
    
</head>

<body class="cuerpoApp">

<div id="container">

	<div id="body">

    <!--Sección encabezado de la página-->
    <section class="hero is-small is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="encabezadoPrincipal column">Login</h1>

               
            </div>
        </div>
    </section>


    <!--Sección para pedir los datos requeridos del usuario-->



    <section class="">
        <div class="container">
            <div class="">
                <div class="">
                    <div class="form-group">

                        <form  method="POST" action="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/LoginCont/validar">
                            <div class="form-group">
                                <input type="text" class="usuario" id="nombreUsuario" type="text"
                                    placeholder="Usuario" name="nUsu" required>
                            </div>

                            <div class="form-group">
                                <input class="usuario" id="contrasenna" type="password"
                                    placeholder="Contraseña" name="passUsu" required>
                            </div>


                            <div class="form-group">
                                <button type="submit" name="iniciar" class="btnaceptLo">Iniciar
                                    Sesión</button>
                            </div>


                        </form>
                    </div>
                </div>




            </div>


        </div>

    </section>


    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <a type="rel" href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Registro">¿No tienes una cuenta?,<strong>Regístrate
                            ahora!!</strong></a>
                </div>
            </div>
        </div>
    </section>







</body>

</html>