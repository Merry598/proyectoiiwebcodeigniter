<?php
require ('headerClientes.php');
error_reporting(0);
if($this->session->userdata('logeado')){

  if($this->session->userdata('privilegio')!=0){
        redirect(site_url("Admin"));
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
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="styleHeader.css">
    <link rel="stylesheet" href="styleCarro.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleHeaderClientes.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">

</head>
<body class="cuerpoApp">

<form action= "/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Cliente/comprarProductos" method="post">

<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">

<tr>
    
    
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Imagen</th>
    <th>Precio</th>
    <th>Cantidad Requerida</th>
    <th>Acciones</th>

</tr>
<?php
$i=0;
while($i < count($cantidad)){


foreach($productos as $fila)
				{
                    
                    
					echo "<tr>".
					"<td>".$fila->nombre."</td>".
					"<td>".$fila->descripcion."</td>".
          "<td>". '<img src = "../'.$fila->imagen.'" width="100" height="100"></img>'."</td>".
          "<td>".$fila->precio."</td>".
          "<td>".'<input type="number" min="1" name="cantidadProducto[]" value= "'.$cantidad[$i].'" >'."</td>".
          "<td><a href='/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Cliente/eliminarProductoCarrito/".$fila->id."'>Descartar</a></td>".
				  "<td>".'<input type="hidden" name="idProductos[]" value= "'.$fila->id.'" >'."</td>".          
          "</tr>";
                    
$i++;

                }

                
}

?>

</table>

<div class="contenedor">



<div>
<button type="submit"  class='btn__update'>Comprar Productos</button>
</div>

<div>
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Cliente">Volver a la página principal</a>

</div>

</div>

</form>

</body>
</html>





