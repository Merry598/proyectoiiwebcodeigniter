<?php
error_reporting(0);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/CSS/style.css">
</head>

<body class="cuerpoApp">
    <!--Sección Encabezado de la Página-->
    <section class="hero is-small is-info is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="encabezadoPrincipal">Shopping</h1>

                <h1 class="seccionActual">Registrar</h1>
            </div>
        </div>
    </section>

    <!--Sección de Datos Requeridos del Usuario-->
    <section class="section">
        <div class="container">
            <div class="">
            <div class="">
            
               <form action="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Registro/registrar" method="post">
               
            
                        <div class="form-group">
                            <input class="usuario" id="nombreCompletoUsuario" placeholder="Nombre" type="text" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <input class="usuario" placeholder="Primer Apellido" type="text" name="primerApellido" required>
                        </div>

                        <div class="form-group">
                            <input class="usuario" placeholder="Segundo Apellido" type="text" name="segundoApellido" required>
                        </div>

                        <div class="form-group">
                            <input class="usuario" placeholder="Teléfono" type="text" name="telefono" required>
                        </div>


                        <div class="form-group">
                            <input class="usuario" id="correoUsuario" type="email" name="correo" placeholder="Correo" required>
                        </div>

                        <div class="form-group">
                            <input class="usuario" placeholder="Direccion" type="text" name="direccion" required>
                        </div>

                       <div class="form-group">
                            <input class="usuario" id="usuario" placeholder="Nombre de Usuario" type="text" name="nombreUsuario" required>
                        </div>
                    
                        <div class="form-group">
                            <input class="usuario" id="contrasenna" placeholder="Contraseña" type="password" name="contrasenna" required>
                        </div>
                        <div>
                            
                            <button id="botonEnviar" type="submit" class="btnaceptLo">Registrar</button>

                        </div>
                </form>
           
           
            </div> 
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column"> 
                    <a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/">¿Ya Tienes Una Cuenta?,<strong>Inicia sesión!!</strong> </a>
                </div>
            </div>
        </div>
    </section>  
</body>
</html>



