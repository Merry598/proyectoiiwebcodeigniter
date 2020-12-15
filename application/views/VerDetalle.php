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
    <title>Ver Detalle de compra</title>
    <link rel="stylesheet" href="styleHeader.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleHeaderClientes.css">

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">

</head>
<body class="cuerpoApp">
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
<tr>
    
    
    <th>Producto</th>
    <th>Descripción</th>
    <th>Imagen</th>
    <th>Precio</th>
    <th>Cantidad Solicitada</th>

  

    

</tr>

<?php

        $i = 0;
    
        while($i < count($cantidades)){

            foreach($productos as $row)
				{

                    echo "<tr>".
                        "<td>".$row->nombre."</td>".
                        "<td>".$row->descripcion."</td>".
                        "<td>".'<img src = "../'.$row->imagen.'" width="100" height="100"></img>'."</td>".
                        "<td>".$row->precio."</td>".
                        "<td>".$cantidades[$i]."</td>".
                    
                        "</tr>";

                        $i++;
                    
                    
					
				}

        }

				
			?>


</table>

<div>
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Cliente">Volver a la página principal</a>

</div>

</body>
</html>