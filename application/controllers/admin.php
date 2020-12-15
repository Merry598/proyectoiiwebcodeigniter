<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->database();
	}

	public function index()
	{
		$this->load->view("AdministradorMain");
	}
	/**
	* Funciona para poder obtener productos los existentes y luego lo muestra a la vista 
	*del sistema de la tienda
	*/
	public function verProductos(){
		$info = $this->AdminModel->getAllProducts();

		$this->load->view("VerProductos",array('info' => $info));
	}
	/**
	*Se encarga de llamar a la función que mostrará el frm 
	*para agregar un nuevo producto
	*/
	public function cargarInsercionProducto(){
		$infoCates = $this->AdminModel->getCategories();

		$this->load->view("AgregarProducto",array('infoCates' => $infoCates));
	}
	/**
	*Función que se encarga de agregar un nuevo producto en la DB.
	*/
	public function agregarProducto(){

		$nombre = $this->input->post("nombre");
		//$nombresProducto = $this->AdminModel->verificarExistenciaNombreProducto($nombre);
		//if($nombresProducto == 0){
			$descripcion = $this->input->post("descri");

			$restante = $this->input->post("restante");
			
			$precio = $this->input->post("precio");
			
			$imagen = $_FILES['imagen']['name'];
	
			$ruta = $_FILES['imagen']['tmp_name'];
	
			$destino = "../img/".$imagen;
	
			if($imagen != null){
	
			copy($ruta,$destino);
		}
	
		$categoria = $this->input->post("cates");
	
			if($categoria !=null){
			$cateSeleccionada = $this->AdminModel->obtenerCategoriaSeleccionada($categoria);
	
			$idCategoria = $cateSeleccionada->id;
	
			if($this->AdminModel->guardarProducto($nombre,$descripcion,$destino,$idCategoria,$restante,$precio)){
	
			echo '<script type="text/javascript">alert("Producto agregado exitosamente")</script>';
	
			$this->cargarInsercionProducto();
		}
	}
	else{
		if($this->AdminModel->guardarProducto($nombre,$descripcion,$destino,0,$restante,$precio)){
	
			echo '<script type="text/javascript">alert("Producto agregado exitosamente")</script>';
			
			$this->cargarInsercionProducto();
			
		}
	}
		//}
		//else{
		//	     echo '<script type="text/javascript">alert("Este producto ya se encuentra en el sistema")</script>';
			
				//$this->cargarInsercionProducto();
		//}
	}
	/**
	*Sen encarga de llamar al frm para editar los productos con los
	*datos correspondientes del producto
	*/
	public function cargarEdicionProducto(){
		$info = $this->AdminModel->getAllProducts();

		$this->load->view("CargarProductosEdicion",array('info' => $info));
	}
	/**
	* Se encarga de obtener el producto a editar seleccionado por el usuario
	*con el nombre de la cat a la que pertenece
	*/
	public function obtenerProductoSeleccionado(int $id,string $nombreCategoria){
		$info = $this->AdminModel->obtenerProductoSeleccionadoId($id);

		$infoCate = $this->AdminModel->obtenerCategoriaSeleccionada($nombreCategoria);

		$categorias = $this->AdminModel->getCategories();

		$this->load->view("ModificarProducto",array('info' => $info,'infoCate' => $infoCate,'cates'=>$categorias));
	}
	/**
	* Se encarga de llamar a la función que actualizará el producto seleccionado
	*/
	public function editarProducto(){

			$id = $this->input->post("id");


			$nombre = $this->input->post("nombrePro");

			$descripcion = $this->input->post("descriPro");
		

			$imagen = $_FILES['imagenPro']['name'];

			$ruta = $_FILES['imagenPro']['tmp_name'];

			$destino = "../img/".$imagen;

			if($imagen != null){

			copy($ruta,$destino);

	}

			$categoria = $this->input->post("cates");

			$cateSeleccionada = $this->AdminModel->obtenerCategoriaSeleccionada($categoria);

			$idCategoria = $cateSeleccionada->id;
	
			$restante = $this->input->post("resPro");
			
			$precio = $this->input->post("prePro");
	
			if($this->AdminModel->editarProducto($id,$nombre,$descripcion,$destino,$idCategoria,$restante,$precio)){
				echo '<script type="text/javascript">alert("Producto editado satisfactoriamente")</script>';

				$this->cargarEdicionProducto();
		}
	}
	/**
	* Se encarga de llamar frm para eliminar los productos enviadoles los
	*datos que se eliminarán
	*/
	public function cargarEliminarProducto(){
		$info = $this->AdminModel->getAllProducts();
		$this->load->view("EliminarProducto",array('info' => $info));
	}
	/**
	* Sen encarga de llamar al método que eliminará de la DB el producto seleccionado
	*por medio del identificador del producto a eliminar"$idProducto"
	*/
	public function eliminarProducto(int $idProducto)
	{
	if($this->AdminModel->eliminarProducto($idProducto)){

		echo '<script type="text/javascript">alert("Producto eliminado satisfactoriamente")</script>';

		redirect(site_url(['admin', 'cargarEliminarProducto']));
	}
}
/**
* Se encarga de llamar al frm que  cargará las categorias  
*/
public function verCategoria(){
		$info = $this->AdminModel->getCategories();

		$this->load->view("VerCategorias",array('info' => $info));
	}
/**
* Se encarga de llamar a la función que mostrará el formulario para insertar una nueva categoría
*/
public function cargarFormularioAgregarCategoria(){
		$this->load->view("AgregarCategoria");
} 
/**
*Se encarga de llamar a la función que insertará una nueva categoría
*/
public function agregarCategoria(){
		$nombreCategoria = $this->input->post("nombre");

		$categoriaNombre= $this->AdminModel->verificarExistenciaNombreCategoria($nombreCategoria);

		if($categoriaNombre == 0){
			if($this->AdminModel->agregarCategoria($nombreCategoria)){

				echo '<script type="text/javascript">alert("Categoría agregada satisfactoriamente")</script>';
	
				$this->cargarFormularioAgregarCategoria();
	
			}
		}

		else{

			echo '<script type="text/javascript">alert("Esta categoría ya existe en el sistema")</script>';
	
			$this->cargarFormularioAgregarCategoria();

		}
	}

	/**
	* Se encarga de llamar al formulario que mostrará las categorías 
	*/
	public function cargarEditarCategoria(){
		$info = $this->AdminModel->getCategories();
		
		$this->load->view('CargarCategoriasEdicion',array('info' => $info));
	}
	/**
	 * Obtiene la categoría asociada al identificador enviado 
	 *$idCategoria
	 */
	public function obtenerCategoriaSeleccionada(int $idCategoria){
		$info = $this->AdminModel->obtenerCategoriaSeleccionadaId($idCategoria);
		$this->load->view('ModificarCategoria',array('info' => $info));
	}
	/**
	 * Obtiene el nombre de la categoría con el identificador enviado
	 *
	*/
	public function obtenerNombreCategoria(int $idCategoria){
		$info = $this->AdminModel->obtenerNombreCategoria($idCategoria);
	}
	/**
	 * Se encarga de llamar al método para actualizar los datos de la categoría
	 */
	public function editarCategoria(){
		if($this->input->post())
		{
			$idCategoria = $this->input->post("id");
			$nombreCategoria = $this->input->post("nombre");
			
			if($this->AdminModel->actualizarCategoria($idCategoria, $nombreCategoria)){

			echo '<script type="text/javascript">alert("Categoría editada satisfactoriamente")</script>';

				$this->cargarEditarCategoria();
			}	
		}
	}

	/**
	 *Se encarga de llamar al formulario para eliminar categorías 
	 */

	public function cargarEliminarCategoria(){
		$info = $this->AdminModel->getCategories();
		$this->load->view("EliminarCategoria",array('info' => $info));
	}
	/**
	*Se encarga de llamar al método para elimnar la categoría seleccionada
	*$idCategoria  a eliminar
	*/
	public function eliminarCategoria(int $idCategoria)
	{

		$productosCategoria = $this->AdminModel->validarProductosCategoria($idCategoria);

        if($productosCategoria == 0){
			if($this->AdminModel->eliminarCategoria($idCategoria)){

				echo '<script type="text/javascript">alert("Categoría eliminada satisfactoriamente")</script>';
	
			$this->cargarEliminarCategoria();
	
			}
	}
	else{
			echo '<script type="text/javascript">alert("Esta categoría no se puede eliminar ya que tiene productos asociados")</script>';

			$this->cargarEliminarCategoria();
		}
	}
}