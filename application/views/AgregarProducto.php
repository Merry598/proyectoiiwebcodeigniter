<?php
require ('header.php');
error_reporting(0);
if($this->session->userdata('logeado')){

    if($this->session->userdata('privilegio')!=1){
          redirect(site_url("Cliente"));
    }


}

else{
    
    redirect(site_url("LoginCont"));
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleUno.css">


</head>
<body class ="cuerpoApp">
<form action="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin/agregarProducto" method="POST" enctype="multipart/form-data">

<div class="contenedor">

<div>
    <input type="text" name="nombre" placeholder="Nombre"  class="input__text"required>
</div>
    
<div>
<input type="text" name="descri" placeholder="Descripcion" class="input__text" required>
</div>

<div>
 <input id= "ima" name="imagen"  class="input__text" type="file">
</div> 

<div>

<select name="cates" class="input__text">
<option selected disabled>--Sin Seleccionar--</option>

<?php foreach($infoCates as $row){ ?>

    

    <option><?php echo $row->nombre?></option>;

 

<?php } ?>
</select>

</div>

<div>
    <input type="text" name="restante" placeholder= "Restante" class="input__text" required>
</div>

<div>
   <input type="text" name="precio" placeholder="Precio" class="input__text" required>
</div>

<div>
<button type="submit" class="btn__primary">Guardar</button>
</div>


<div>
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin">Volver a la página principal</a>

</div>

</table>

</div>


</form>

</body>
</html>

