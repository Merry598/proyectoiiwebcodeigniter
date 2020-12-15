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
    <title>Ver Compras Realizadas</title>
    <link rel="stylesheet" href="styleHeader.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleHeaderClientes.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">



</head>
<body class="cuerpoApp">
<form action= "#" method="post">
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
<tr>
    
    
    <th>Fecha</th>
    <th>Monto total</th>
    <th>Acciones</th>

    

</tr>


<?php
				foreach($info as $row)
				{
                    
					echo "<tr>".
					"<td>".$row->fecha."</td>".
					"<td>".$row->total."</td>".
				    "<td><a href='/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Cliente/verDetalle/".$row->id."' class='btn__update'>Ver detalle</a></td>".
                    
				
					"</tr>";
				}
?>

</table>

<div>
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Cliente">Volver a la página principal</a>

</div>

</form>

</body>
</html>