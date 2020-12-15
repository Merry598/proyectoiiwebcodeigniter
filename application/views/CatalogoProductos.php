<?php
error_reporting(0);

require ('headerClientes.php');


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
    <title>Catálogo de productos</title>
    <link rel="stylesheet" href="styleHeader.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleHeaderClientes.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">


</head>
<body class="cuerpoApp">

<form action= "#" method= "POST">

<div>
<label>Seleccionar una categoría:</label>

<select onchange="submit()" name="categorias" > 
<option selected disabled>--Sin Seleccionar--</option>

<?php foreach($infoCategorias as $resultado){ ?>

    

    <option><?php echo $resultado->nombre?></option>;

 

<?php } ?>
</select>


</div>

</form>

<table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
<tr>
    
    
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Imagen</th>
    
    <th>Precio</th>
    <th>Acciones</th>

</tr>


<?php
 
$categoriaSeleccionada = $this->input->post("categorias");

        if ($categoriaSeleccionada !== null) {

      

$infoCategoriaSeleccionada = $this->ClienteModel->obtenerInfoCategoriaSeleccionada($categoriaSeleccionada);
    
        
$idCategoria = $infoCategoriaSeleccionada->id;


$resultado = $this->ClienteModel->obtenerProductosAsociadosCategoria($idCategoria);

    

    for($i =0;$i< count($resultado);$i++)
    {
        
        echo "<tr>".
        "<td>".$resultado[$i]->nombre."</td>".
        "<td>".$resultado[$i]->descripcion."</td>".
        "<td>". '<img src = "../'.$resultado[$i]->imagen.'" width="100" height="100"></img>'."</td>".
        "<td>".$resultado[$i]->precio."</td>".
        "<td><a href='/Programacion-Web/Proyecto-2/proyectoiiwebcodeigniter/index.php/Cliente/annadirAlCarrito/".$resultado[$i]->id."'>Añadir al Carrito</a></td>".
    
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


