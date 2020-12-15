<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class ClienteModel extends CI_Model{

    function __construct(){
        parent:: __construct();
        $this->load->database();
    }  
    
    /**
     *Obtiene las categorías existentes en el sistema
     *return Categorías existentes 
     */
    public function getCategories(){
        $query =  $this->db->query("SELECT * FROM categorias");

        if ($query->result()) {
        return $query->result();
      } else {
        return false;
      }
    }
    /**
      * Obtiene la categoría con el nombre indicado
      *$nombreCategoria a buscar y return Categoría con el nombre indicado
      */
      public function obtenerInfoCategoriaSeleccionada(string $nombreCategoria){
        return $this->db->where('nombre', $nombreCategoria)->get('categorias')->row();
  }
      /**
       * Obtiene los productos asociados con la categoría indicada
       *
       * $idCategoria Identificador de la categoría y return Productos con la categoría indicada
       */
      public function obtenerProductosAsociadosCategoria(int $idCategoria){
        $query = $this->db->get_where('productos', array('categoria' => $idCategoria));

        if ($query->result()) {
        return $query->result();
      }      
      else {
      return false;
  }

}
      /**
       * Agrega al carrito del cliente los identificadores del cliente en sesión, identificador del producto y la cantidad  del mismo
       *o sea  $idCliente en sesion , $idProducto del producto del cliente
       * y $cantidadRequerida del producto  y return true si hace el registro, false si no 
       */
      public function annadirCarrito(int $idCliente, int $idProducto, int $cantidadRequerida){
        $query = $this->db->insert("carrito_clientes",array("id_cliente"=> $idCliente,"id_producto"=> $idProducto,
        "cantidad_requerida"=>$cantidadRequerida));

            if ($query) {
                return true;
            } else {
                return false;
            }
      }
      
      /**
       * Carga el carrito del cliente en sesión
       *$idCliente Identificador del cliente en sesión y posteriormente return Carrito del cliente en sesión
       */
      public function cargarCarritoCliente(int $idCliente){
        $query = $this->db->get_where('carrito_clientes', array('id_cliente' => $idCliente));

        if ($query->result()) {
        return $query->result();
      }      
        else {
      return false;
    }
  }
      /**
       * Obtiene los productos asociados al carrito del cliente en sesión
       *$idProducto Identificador del producto
       * y return Productos asociados al carrito
       */
      public function cargarProductosCarrito(int $idProducto){
        return $this->db->where('id', $idProducto)->get('productos')->row();
  
    }
    
    /**
     * Eliminar registro seleccionado del carrito del cliente
     *por medio del $idCliente  en sesión y $idProducto y 
     * return true si lo borra, false si no
     */
    public function eliminarProductoCarrito(int $idCliente, int $idProducto){
      $this->db->where('id_cliente', $idCliente);
      $this->db->where('id_producto', $idProducto);
      if($this->db->delete('carrito_clientes')){
        return true;
      }

      else{
        return false;
      }
    }
    
    /**
     * Obtener la cantidad de registros en el carrito del cliente en sesión
     *
     *$idCliente Identificador del cliente en sesión
     * y return Cantidad de filas afectadas por la consulta, que representan los
     *  registros del cliente en la tabla
     */
    public function obtenerRegistrosClienteCarrito(int $idCliente){
      $query = $this->db->get_where('carrito_clientes', array('id_cliente' => $idCliente));

        if ($query->result()) {
        return $this->db->affected_rows();
      }      
        else {
        return false;
    }

}    
    /**
     * Obtener los productos del carrito del cliente en sesión
     *
     *  $idCliente Identificador del cliente en sesión
     * y return Productos dentro del carrito del cliente
     */
    public function obtenerProductosClienteCarrito(int $idCliente){

      return $this->db->where('id_cliente', $idCliente)->get('carrito_clientes')->row();
       
  }
   
   /**
    * Actualiza la cantidad de los productos a comprar
    *
    *  $cantidadNueva Cantidad del productos, idCliente Identificador del cliente en sesión
    *  $idProducto Identificador del producto
    */
   public function editarCantidadRequeridaProducto(int $cantidadNueva, int $idCliente,int $idProducto){

      $this->db->where('id_cliente', $idCliente);
      $this->db->where('id_producto', $idProducto);

      $data  = array( 
      'cantidad_requerida'=> $cantidadNueva
      
      
      );

      $this->db->update('carrito_clientes',$data);

}

/**
 * Obtener el producto con el identificador 
 *
 *  $idProducto Identificador del producto 
 * y return Producto con el identificador enviado
 */
public function getProductById(int $idProducto){
  return $this->db->where('id', $idProducto)->get('productos')->row();

}
public function actualizarRestanteProducto(int $idProducto,$restante){

        $this->db->where('id', $idProducto);

        $data  = array( 
          'restante'=> $restante
          
          
      );
    
      $this->db->update('productos',$data);

  }
  /**
    * Registra la compra en el sistema
    *
    * $idCliente Identificador del cliente en sesión
    * y return Identificador de la compra recién insertada
    */
  public function registrarCompra(int $idCliente){

  date_default_timezone_set("America/Costa_Rica");

  $fecha = date("Y-m-d h:i");


    $query = $this->db->insert("compras",array("id_cliente"=> $idCliente,"fecha"=>$fecha));

      if ($query) {
          return $this->db->insert_id();  
        } else {
          return false;
      }
  }
    /**
    * Registrar los productos asociados a la compra
    * y return true si los guarda, false si no
    */
  public function registrarProductosCompra(int $idCompra,int $idProducto,int $montoProducto,int $cantidadRequerida){


    $query = $this->db->insert("productos_compra",array("id_compra"=> $idCompra,"id_producto"=> $idProducto,
        "monto_producto"=>$montoProducto,"cantidad_requerida"=>$cantidadRequerida));

            if ($query) {
                return true;
            } 
              else {
                return false;
            }
    }
    /**
     * Actualiza el total de la compra del cliente
     *
     */
    public function actualizarTotalCompra(int $idCompra, int $totalActualizar){

      
      $this->db->where('id', $idCompra);

      $data  = array( 

        'total'=> $totalActualizar
        
        
    );
  
    $this->db->update('compras',$data);

    }
    
    /**
     * Elimina los registros del carrito del cliente udespués que la compra finaliza
     *
     * $idCliente Identificador del cliente a borrar datos del carrito
     * y return true si borra los registros, false si no
     */
    public function eliminarRegistrosCarritoCliente(int $idCliente){

      $this->db->where('id_cliente', $idCliente);
      if($this->db->delete('carrito_clientes')){
        return true;
      }

      else{
        return false;
      }
    }
    
    /**
     * Obtiene las compras del cliente en sesión
     *
     * $idCliente Identificador del cliente en sesión
     * y return el arreglo con las compras del cliente en sesión
     */
    public function obtenerComprasCliente(int $idCliente)
    {

      $this->db->where('id_cliente', $idCliente);
      $this->db->from(compras);
      $this->db->order_by("fecha", "DESC");
      $query = $this->db->get(); 
      return $query->result();

    }
    
    /**
     * Obtiene el detalle(productos) de la compra seleccionada por el cliente
     *
     * $idCompra Identificador de la compra y return un arreglo con los productos asociados a esa compra
     */
    public function obtenerDetalleCompraCliente(int $idCompra){

      $query = $this->db->get_where('productos_compra', array('id_compra' => $idCompra));

      if ($query->result()) {
        return $query->result();
    }      
      else {
      return false;
}

}     
/**
 * Obtiene el total de compras del cliente
 *
 * $idCliente en sesión y return total de compras realizadas por el cliente en sesión
 */
public function obtenerComprasEstadisticas(int $idCliente){

        $query = $this->db->get_where('compras', array('id_cliente' => $idCliente));

        if ($query->result()) {
          return $query->result();
      }      
        else {
        return false;
  }

      }
    
    /**
     * Obtiene la cantidad de productos comprados por el cliente
     *
     * $idCompra Identificador de la compra
     * y return Cantidad de productos adquiridos por el cliente en sesión
     */
    public function obtenerProductosAdquiridosCliente(int $idCompra){
        $this->db->select_sum('cantidad_requerida');
        $this->db->from('productos_compra');
        $this->db->where('id_compra',$idCompra);
        $query = $this->db->get();
          return $query->row();
    } 
    
    /**
     * Obtiene el monto total de las compras del cliente en sesión
     *
     *  $idCliente Identificador del cliente en sesión
     * y return Monto total de las compras del cliente en sesión
     */
    public function obtenerMontoTotalComprasCliente(int $idCliente){
      $this->db->select_sum('total');
      $this->db->from('compras');
      $this->db->where('id_cliente',$idCliente);
      $query = $this->db->get();
        return $query->row();
    }

}