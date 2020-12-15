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
    <title>Página para clientes</title>
   

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/styleHeaderClientes.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>CSS/style.css">
</head>
<body class="cuerpoApp">

<div class="estadisticas">

    <?php

    //Cantidad de productos adquiridos por el cliente

    $idCliente = $this->session->userdata('id');

    $cantidadAdquirida = 0;
    $comprasCliente=0;

    $comprasCliente= $this->ClienteModel->obtenerComprasEstadisticas($idCliente);


    $cantidadAdquiridaCliente = array();

    foreach($comprasCliente as $compra){
        $idCompra = $compra->id;
        array_push($cantidadAdquiridaCliente,$this->ClienteModel->obtenerProductosAdquiridosCliente($idCompra));

    }

    foreach($cantidadAdquiridaCliente as $cantidad){
        $cantidadAdquirida += $cantidad->cantidad_requerida;
    }

    //Obtener monto total de las ventas

    $sumaTotal= 0;

    $sumaProductosComprados = array($this->ClienteModel->obtenerMontoTotalComprasCliente($idCliente));

    foreach($sumaProductosComprados as $suma){
        $sumaTotal = $suma->total;
    }

   
?>


   <div class="productosAdquiridos">
   <label>Total de productos adquiridos:</label>
   <label><?php echo $cantidadAdquirida?></label>
   
    <label><?php// echo $contador?></label>
    </div>

    <div class="totalMonto">
    <label>Monto total de compras:</label>
    <label><?php echo $sumaTotal?></label>

    </div>

    
    


   
</div>
</body>
</html>