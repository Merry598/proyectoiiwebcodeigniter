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
	<title>Editar Producto</title>


   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleUno.css">


</head>
<body class="cuerpoApp">

<div id="container">

	<div id="body">

	<table class= "">

    <tr>
     <th>Nombre  </th>
     <th>Descripción  </th>
    <th>Imagen  </th>
    <th>Categoría  </th>
    <th>Restante  </th>
    <th>Precio  </th>
    <th>Acciones</th>

	

	</tr>

	<?php
				foreach($info as $row)
				{
                    
                   $cateSeleccionada = $this->AdminModel->obtenerNombreCategoria($row->categoria);
                    
				   $nombreCategoria = "";


				   
				   if($cateSeleccionada->nombre !=null){
                       $nombreCategoria = $cateSeleccionada->nombre;
				   }
                    

					echo "<tr>".
                    "<td>".$row->nombre."</td>".
                    "<td>".$row->descripcion."</td>".
                    "<td>". '<img src = "../'.$row->imagen.'" width="100" height="100"></img>'."</td>".
                    "<td>".$nombreCategoria."</td>".
                    "<td>".$row->restante."</td>".
                    "<td>".$row->precio."</td>".
				    "<td><a href='/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin/obtenerProductoSeleccionado/".$row->id."/$nombreCategoria' class='btn__update'>Modificar</a></td>".
					
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