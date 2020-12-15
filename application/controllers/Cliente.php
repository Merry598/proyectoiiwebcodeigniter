<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->database();
	
    }

    public function index()
    {
      $this->load->view("ClienteMain");
    }
    /**
    * Se encarga de llamar al método que carga el catálogo de productos de la tienda
    */
    public function cargarCatalogoProductos(){
  //  $infoCategorias = $this->ClienteModel->getCategories();

    if($this->ClienteModel !== null){
        $infoCategorias = $this->ClienteModel->getCategories();
      }else{
        $infoCategorias  = null;
      }

      $this->load->view("CatalogoProductos",array('infoCategorias' => $infoCategorias));

    }
    /**
    * Agrega al carrito del cliente el identificador del producto seleccionado
    * $idProducto 
    */
    public function annadirAlCarrito(int $idProducto){
    $idCliente = $this->session->userdata('id');
    $cantidadRequeridaPorDefecto = 1;

    if($this->ClienteModel->annadirCarrito($idCliente,$idProducto,$cantidadRequeridaPorDefecto)){
    $this->cargarCatalogoProductos();
            
    }
  }
  /**
  * Se encarga de obtener el carrito de compras del cliente que se encuentra en sesión
  */
    public function cargarCarritoCompras(){

      $idCliente = $this->session->userdata('id');
      $datosCarrito = $this->ClienteModel->cargarCarritoCliente($idCliente);

    //Obtiene productos asociados al carrito
    $productos = array();

    $cantidad = array();
          
      foreach($datosCarrito as $row){

        array_push($productos,$this->ClienteModel->cargarProductosCarrito($row->id_producto));

        array_push($cantidad,$row->cantidad_requerida);

      }
      $this->load->view("CarritoCompras",array('productos' => $productos,'cantidad' => $cantidad));
}
    /**
     *Se encarga de llamar al método que elimina del carrito el producto seleccionado por el cliente 
     * $idProducto 
     */
    public function eliminarProductoCarrito(int $idProducto){

        $idCliente = $this->session->userdata('id');

        if($this->ClienteModel->eliminarProductoCarrito($idCliente,$idProducto)){
          $this->cargarCarritoCompras();
        }
}
    /**
     * Método que guarda la compra de los productos restantes en el carrito del cliente en sesión
     */
    public function comprarProductos(){

    //Sen encarga de actualizar el restante de los productos solicitados en la compra


      $productosSeleccionados = $this->input->post("idProductos");

      $cantidadProducto = $this->input->post("cantidadProducto");

      $this->actualizarRestante($productosSeleccionados,$cantidadProducto);

    //Se encarga de registrar la compra en la DB

        $idCompra = $this->insertarCompra();

    //Sen encarga de registrar los productos asociados en la compra del cliente

    $idCliente = $this->session->userdata('id');

    $comprasCliente = $this->ClienteModel->obtenerRegistrosClienteCarrito($idCliente);
        
      $i=0;

      $totalCompra = 0;

      while($i < $comprasCliente){

        $idProducto = $productosSeleccionados[$i];

        $infoProducto = array($this->ClienteModel->getProductById($idProducto));

        $montoProducto = 0;
        
        foreach($infoProducto as $pro){
          $montoProducto = $pro->precio;

        }

        $cantidadRequerida = $cantidadProducto[$i];
        
        if($this->ClienteModel->registrarProductosCompra($idCompra,$idProducto,$montoProducto,$cantidadRequerida)){

          $totalCompra+= $montoProducto * $cantidadRequerida;  

            $i++;
          }
    }
    
    //Se encarga de actualizar el total de la compra

    $this->ClienteModel->actualizarTotalCompra($idCompra,$totalCompra);
      
      $idCliente = $this->session->userdata('id');

      //Se encarga de eliminar los productos del cliente en el carrito

      if($this->ClienteModel->eliminarRegistrosCarritoCliente($idCliente)){
        $this->cargarCarritoCompras();

      }
     
    }
        
    /**
     * Se encarga de actualizar el restante de los productos según la cantidad solicitada por el cliente
     *  es decir; $productosSeleccionados Productos a actualizar restante y
     *  $cantidadProducto Cantidad a restar del restante.
     */
    private function actualizarRestante(array $productosSeleccionados,array $cantidadProducto){

      $idCliente = $this->session->userdata('id');
      
        

      $registrosCliente = $this->ClienteModel->obtenerRegistrosClienteCarrito($idCliente);

      $producto = array();

      $cantidadEditar;


    $i=0;

    while($i < $registrosCliente){

      $idProducto = $productosSeleccionados[$i];

      $cantidadEditar = $cantidadProducto[$i];

      array_push($producto,$this->ClienteModel->getProductById($idProducto));

      foreach($producto as $row){
        $restante = $row->restante;

        $cantidadActualizar= $restante - $cantidadEditar;
}
      
      $this->ClienteModel->actualizarRestanteProducto($idProducto,$cantidadActualizar);

      $i++;
    
    }
}
  /**
  * Se encarga de registrar la compra del cliente   
  */
  private function insertarCompra(){

    $idCliente = $this->session->userdata('id');

    return $this->ClienteModel->registrarCompra($idCliente);
}
/**
*Se encarga de cargar las compras del cliente en sesión, luego de obtenerlas 
*las envía a la vista que las mostrará respectivamente  
*/
  public function verCompras(){
  
    $idCliente = $this->session->userdata('id');

    $info = $this->ClienteModel->obtenerComprasCliente($idCliente);

    $this->load->view("VerCompras",array('info' => $info));
  }
/**
*Se encarga de cargar los productos relacionados a la compra que el cliente seleccionó 
*y carga la vista que los mostrará posteriormente 
*/
  public function verDetalle(int $idCompraVisualizar){

      $productos = array();

      $cantidades = array();

      $info = $this->ClienteModel->obtenerDetalleCompraCliente($idCompraVisualizar);

      for($i=0;$i  < count($info);$i++){

            array_push($productos,$this->ClienteModel->getProductById($info[$i]->id_producto));

            array_push($cantidades,$info[$i]->cantidad_requerida);
}
        $this->load->view("VerDetalle",array('productos' => $productos,'cantidades'=>$cantidades));
      }

}