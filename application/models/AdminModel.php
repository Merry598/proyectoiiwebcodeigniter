<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model{

    function __construct(){
        parent:: __construct();
        $this->load->database();
    }  
    
    /**
    * Se encarga de btener la categoría con el nombre enviado
    *  "$nombreCategoria" 
    * return la categoría con el nombre indicado o enviado
    */
    public function obtenerCategoriaSeleccionada(string $nombreCategoria){
      return $this->db->where('nombre', $nombreCategoria)->get('categorias')->row();
}

    /**
     * Obtiene el nombre de la categoría con el identificador id enviado.
     * 
     * return la cat con el identificador enviado 
     */

    public function obtenerNombreCategoria(int $id){
      return $this->db->where('id', $id)->get('categorias')->row();
        
    }

    /**
     * Se encarga de obtener la categoría con el identificador enviado
     * o sea $idCategoria  y return Categoría con el identificador indicado
     */
    public function obtenerCategoriaSeleccionadaId(int $idCategoria){
      $query = $this->db->get_where('categorias', array('id' => $idCategoria));
    
      if ($query->result()) {
          return $query->result();
        } else {
          return false;
        }

}

    /**
     * Obtiene el producto con el identificador enviado
     * o sea  $idProducto Identificador del producto.
     * posteriormente return Producto con el identificador enviado
*/

public function obtenerProductoSeleccionadoId(int $idProducto){
  $query = $this->db->get_where('productos', array('id' => $idProducto));

  if ($query->result()) {
      return $query->result();
    } else {
      return false;
    }

}
    /**
    * Se encarga de obtener todos los productos de la DB
      * @return Productos registrados 
      */
     public function getAllProducts(){
       $query =  $this->db->query("SELECT * FROM productos");

       if ($query->result()) {
        return $query->result();
      } else {
        return false;
      }
    }

     /**
      * Obtiene todas las categorías de la DB
      * @return Categorías registradas 
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
     * Registra un nuevo producto en la DB
     * @return true si lo inserta, false si no
     */
    public function guardarProducto(string $nombre,string $descripcion,string $imagen,int $categoria,int $restante, int $precio){

        $query = $this->db->insert("productos",array("nombre"=> $nombre,"descripcion"=> $descripcion,"imagen"=>$imagen,
        "categoria"=>$categoria,"restante"=>$restante,"precio"=>$precio));

            if ($query) {
                return true;
          } else {
                return false;
            }
    }
    
    /**
     * Editar un producto de la DB
     * @return true si lo actualiza, false si no
     */
    public function editarProducto(int $id,string $nombre,string $descripcion,string $imagen,int $categoria,int $restante, int $precio){

      $this->db->where('id', $id);

      $data  = array( 
        'nombre'=> $nombre,
        'descripcion'=> $descripcion,
        'imagen'=>$imagen,
        'categoria'=>$categoria,
        'restante'=>$restante,
        'precio'=>$precio
        
    );

    if($this->db->update('productos',$data)){
        return true;
    }

    else{
      return false;
    }

        
  }
    
    /**
     * Elimina un producto de la DB
     * @return true si lo elimina, false si no
     */
    public function eliminarProducto(int $id){
		
        $this->db->where('id', $id);
        if($this->db->delete('productos')){
          return true;
        }

        else{
          return false;
        }
  }

  /**
   * Agrega una nueva categoría al sistema 
   *@return true si se guarda correctamente, false si no
   */
  public function agregarCategoria(string $nombre){
    $query = $this->db->insert("categorias",array("nombre"=> $nombre));

            if ($query) {
                return true;
             } else {
                return false;
            }
  }
  
  /**
   * Actualiza una categoría en la BD
   *return true si la edita, false si no
   */
  public function actualizarCategoria(int $id,string $nombre){
    $this->db->where('id', $id);

    $data  = array( 
        'nombre' => $nombre
        
    );

    if($this->db->update('categorias',$data)){
      return true;
    }

    else{
      return false;
    }
  }
  
  /**
   * Valida que la categoría que se desea eliminar no posea productos asociados
   *$idCategoria Identificador de la categoría a verificar
   *return cantidad de filas que se verán afectadas en la validación correspondiente
   */
  public function validarProductosCategoria(int $idCategoria){
    $query = $this->db->get_where('productos', array('categoria' => $idCategoria));

        if($query){
            return $this->db->affected_rows();

        }

  }
  
  /**
   *Elimina la categoría seleccionada por el usuario
   *
   *$id Identificador de la categoría a eliminar
   *return true si la elimina, false si no
   */
  public function eliminarCategoria(int $id){
		
    $this->db->where('id', $id);
    if($this->db->delete('categorias')){
      return true;
    }

    else{
      return false;
    }
}

/**
*Verifica que el nombre del producto que se están dando no se encuentre ya registrado
*
*$nombreProducto  a verificar
*return Cantidad de productos con ese nombre, de no haber ninguno el retorno de la función será de cero
*/
public function verificarExistenciaNombreProducto(string $nombreProducto){
        
  $query = $this->db->get_where('productos', array('nombre' => $nombreProducto));

  if($query){

      return $this->db->affected_rows();

  }
}

/**
*Verifica que el nombre de la categoría que se está dando no se encuentre ya registrado
*
*$nombreCategoria Nombre de la categoría a verificar
* return Cantidad de categorías con ese nombre, de no haber ninguno el retorno de la función será de cero
*/
      public function verificarExistenciaNombreCategoria(string $nombreCategoria){
        
        $query = $this->db->get_where('categorias', array('nombre' => $nombreCategoria));

        if($query){

            return $this->db->affected_rows();

        }
      }
/**
 * Obtiene la cantidad de clientes registrados en el sistema
 *
 * return Cantidad de filas afectadas en la consulta
 */
public function obtenerClientesRegistrados(){
  $query =  $this->db->query("SELECT * FROM usuarios WHERE privilegio !=1");

    if ($query->result()) {
        return $this->db->affected_rows();

      } else {
        return false;
      }
}
/**
 * Obtiene la cantidad de productos vendidos
 *
 * return Cantidad de productos vendidos 
 */
public function obtenerCantidadProductosVendidos(){
  $this->db->select_sum('cantidad_requerida');
    $this->db->from('productos_compra');
    $query = $this->db->get();
    return $query->row();
}

/**
 * Obtiene el monto total de las ventas 
 *
 * return Monto total de ventas 
 */
public function obtenerMontoTotalVentas(){
  $this->db->select_sum('total');
    $this->db->from('compras');
    $query = $this->db->get();
    return $query->row();
}

}