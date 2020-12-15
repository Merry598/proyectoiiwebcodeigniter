<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleUno.css">
</head>

<body class="cuerpoAppAdmin">

<?php require ('header.php') ?>

<div class="estadisticas">

<?php

//Se obtiene los clientes registrados en el sistema.

$clientesRegistrados = $this->AdminModel->obtenerClientesRegistrados();

//Se obtiene la cantidad de productos vendidos.

$cantidadProductosVendidos = 0;
$resultado = array($this->AdminModel->obtenerCantidadProductosVendidos());

foreach($resultado as $can){
    $cantidadProductosVendidos = $can->cantidad_requerida;

}

//Obtener monto total de las ventas

$sumaTotal = 0;

$sumaProductosVendidos = array($this->AdminModel->obtenerMontoTotalVentas());

foreach($sumaProductosVendidos as $total){
    $sumaTotal = $total->total;
}

?>
<div class="clientes">
<label>Cantidad de Clientes Registrados:</label>

<label><?php echo $clientesRegistrados;?></label>
</div>

    <div class="productosVendidos">
    <label>Cantidad de Productos Vendidos:</label>
    <label><?php echo $cantidadProductosVendidos?></label>

</div>

    <div class="totalVentas">
    <label>Monto Total de Ventas:</label>
    <label><?php echo $sumaTotal?></label>

    </div>
</div>
</body>
</html>

