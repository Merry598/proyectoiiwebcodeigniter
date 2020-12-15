<?php
require("header.php");
if($this->session->userdata('logeado')){

    if($this->session->userdata('privilegio')!=1){
          redirect(site_url("Cliente"));
    }

}

else{
    
    redirect(site_url("LoginCont"));
}
?>

<?php

foreach($info as $row){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleUno.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/CSS/styleEditarProducto.css">

</head>
<body class="cuerpoApp">
<div class="container">
<h1>Editar Producto</h1>
	<form method="post" action="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin/editarProducto" enctype="multipart/form-data">


<div>
     
     <input type = "hidden" name="id" class="form-control" value="<?php echo $row->id; ?>">
</div>

<div>

<input type="text" name="nombrePro" class="input__text" value=<?php echo $row->nombre?>>
</div>

<div>

<input type="text" name="descriPro" class="input__text" value=<?php echo $row->descripcion?>>

</div>

<div>
<input id= "ima" name="imagenPro" class="input__text" type="file">

</div>

<div>
<select name="cates" class="input__text">
<?php
if($row->categoria ==0){?>
<option selected disabled>--Sin Seleccionar--</option>

<?php
}

else{
?>
<option selected><?php echo $infoCate->nombre?></option>
<?php
}
?>
<?php 
foreach($cates as $fila){ ?>

    

    <option><?php echo $fila->nombre?></option>;

 

<?php } ?>
</select>
</div>
<div>
<input type="text" name="resPro" class="input__text" value=<?php echo $row->restante?>>

</div>

<div>
<input type="text" name="prePro" class="input__text" value=<?php echo $row->precio?>>
</div>

   
<div>  
<button name="guardar" class="btn__primary">Guardar</button>
</div>



<?php	
}
?>



<div>
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin">Volver a la página principal</a>

</div>

	</form>

    
</div> 

</body>
</html>







