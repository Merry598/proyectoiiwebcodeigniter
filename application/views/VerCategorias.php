


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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>Ver Productos</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleUno.css">

</head>
<body class="cuerpoApp">
<div class="conten_tabla">
<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">

<tr class="head">
    
    <th>Nombre</th>
  

</tr>

<?php
				foreach($info as $row)
				{
					echo "<tr>".
					"<td>".$row->nombre."</td>".
					"</tr>";
				}
?>


   

</table>
            </div>
<div>
<a href="/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Admin">Volver a la página principal</a>

</div>

</body>
</html>
