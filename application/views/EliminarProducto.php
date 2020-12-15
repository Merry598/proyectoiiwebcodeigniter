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
    <title>Eliminar Productos</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleUno.css">
</head>
<body class="cuerpoApp">
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">

<tr>
    
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Imagen</th>
    <th>Categoría</th>
    <th>Restante</th>
    <th>Precio</th>
    <th>Acciones</th>

</tr>

<?php
				foreach($info as $row)
				{
					echo "<tr>".
					"<td>".$row->nombre."</td>".
					"<td>".$row->descripcion."</td>".
                    "<td>".'<img src = "../'.$row->imagen.'" width="100" height="100"></img>'."</td>".
                    "<td>".$row->categoria."</td>".
                    "<td>".$row->restante."</td>".
                    "<td>".$row->precio."</td>".
                    "<td><a href='/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin/eliminarProducto/".$row->id."'  class='btn__delete'>Eliminar</a></td>".
				
					"</tr>";
				}
			?>
</table>


<div>
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin">Volver a la página principal</a>

</div>

</body>
</html>

