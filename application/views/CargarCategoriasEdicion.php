<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require ('header.php');
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
	<meta charset="utf-8">
	<title>Editar Categoría</title>

	
	
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.2/css/bulma.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleUno.css">

</head>
<body class="cuerpoApp">

<div id="container">

	<div id="body">

	<table class= "table is-bordered is-striped is-narrow is-hoverable is-fullwidth">

    <tr>
     <th>Nombre</th>

	

	</tr>

	<?php
				foreach($info as $row)
				{
					echo "<tr>".
					"<td>".$row->nombre."</td>".
				"<td><a href='/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin/obtenerCategoriaSeleccionada/".$row->id."' class='btn__update'>Actualizar</a></td>".
					
					"</tr>";
				}
			?>





	</table>

	
<div>
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin">Volver a la página principal</a>

</div>

	
	</div>

	
	


</div>


</body>
</html>