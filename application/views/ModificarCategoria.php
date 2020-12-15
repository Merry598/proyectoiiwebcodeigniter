<?php 
require('header.php');
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
	<title>Editar Categoria</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleUno.css">
</head>
<body class="cuerpoApp">
<div class="container">
<h1>Editar Categoria</h1>
	<form method="post" action="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin/editarCategoria">
		
        <div>
     
		 <input type = "hidden" name="id" class="form-control" value="<?php echo $row->id; ?>">
		</div>

		<div class="form-group">
			
			<input type="text" name="nombre" class="input__text" required="true" value="<?php echo $row->nombre; ?>">
		</div>
		
		<div class="form-group">
		<input type="submit"  class="btn__primary" value="Guardar">
		
		</div>

<?php	
}
?>
	</form>

  
<div class="form-group">
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin" class='btn__danger'>Volver a la página principal</a>

</div>
  
</div>
</body>
</html>






