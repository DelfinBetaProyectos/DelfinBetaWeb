<?php
class Articulo {
	########################################  Atributos  ########################################
	
	private $id;
	public  $titulo;
	public  $descripcion;
	public  $contenido;
	public  $imagen;
	private $estado;
	public  $fecha_registro;
	private $conexion;
	public  $error = NULL;
	
	#######################################  Operaciones  #######################################
	
	function __construct($conexion) {
		$this->error = NULL;
		$this->conexion = $conexion;
		$this->seguridad = new Seguridad();
	}
	
	// Insertar un Articulo a la Base de Datos
	public function insertar($titulo, $descripcion, $contenido, $imagen) {
		if(!$titulo = $this->seguridad->texto_seguro($this->conexion, $titulo)) {
			$this->error = "Nombre no es Seguro";
			return false;
		}
		
		if(!is_string($descripcion = $this->seguridad->texto_seguro($this->conexion, $descripcion))) {
			$this->error = "Descripcion no es Seguro";
			return false;
		}
		
		if(!is_string($contenido = $this->seguridad->texto_seguro($this->conexion, $contenido))) {
			$this->error = "Contenido no es Seguro";
			return false;
		}
		
		if(!is_string($imagen = $this->seguridad->texto_seguro($this->conexion, $imagen))) {
			$this->error = "Imagen no es Seguro";
			return false;
		}
		
		$sql = sprintf("INSERT INTO articulos(titulo, descripcion, contenido, imagen, estado, fecha_registro) VALUES('%s', '%s', '%s', '%s', 1, CURDATE())", $titulo, $descripcion, $contenido, $imagen, $_SESSION['usuario_id']);
		
		if($inserto = mysqli_query($this->conexion, $sql)) {
			return true;
		} else {
			$this->error = "No se puede Insertar";
			return false;
		}
	}
	
	// Actualizar un Articulo a la Base de Datos identificado por su id
	public function actualizar($id, $titulo, $descripcion, $imagen) {
		if(!$titulo = $this->seguridad->texto_seguro($this->conexion, $titulo)) {
			$this->error = "Nombre no es Seguro";
			return false;
		}
		
		if(!is_string($descripcion = $this->seguridad->texto_seguro($this->conexion, $descripcion))) {
			$this->error = "Descripcion no es Seguro";
			return false;
		}
		
		if(!is_string($contenido = $this->seguridad->texto_seguro($this->conexion, $contenido))) {
			$this->error = "Contenido no es Seguro";
			return false;
		}
		
		if(!is_string($imagen = $this->seguridad->texto_seguro($this->conexion, $imagen))) {
			$this->error = "Imagen no es Seguro";
			return false;
		}
		
		$sql = sprintf("UPDATE articulos SET titulo='%s', descripcion='%s', contenido='%s', imagen='%s' WHERE id='%d'", $titulo, $descripcion, $contenido, $imagen, $id);
		
		if($actualizo = mysqli_query($this->conexion, $sql)) {
			return true;
		} else {
			$this->error = "No se puede Modificar";
			return false;
		}
	}
	
	// Eliminar un Articulo de la Base de Datos identificado por su id
	private function eliminar($id) {
		if(!$id = $this->seguridad->entero_seguro($id)) {
			$this->error = "ID no es Seguro";
			return false;
		}
		
		$sql = sprintf("DELETE FROM articulos WHERE id='%d'", $id);
		
		if($elimino = mysqli_query($this->conexion, $sql)) {
			return true;
		} else {
			$this->error = "No se puede Eliminar";
			return false;
		}
	}
	
	// Desactivar un Articulo de la Base de Datos identificado por su id
	public function desactivar($id) {
		if(!$id = $this->seguridad->entero_seguro($id)) {
			$this->error = "ID no es Seguro";
			return false;
		}
		
		$sql = sprintf("UPDATE articulos SET estado=0 WHERE id='%d'", $id);
		
		if($desactivo = mysqli_query($this->conexion, $sql)) {
			return true;
		} else {
			$this->error = "No se puede Eliminar (D)";
			return false;
		}
	}
	
	// Obtener datos de un Articulo identifiado por su id
	public function datos($id) {
		if(!$id = $this->seguridad->entero_seguro($id)) {
			$this->error = "ID no es Seguro";
			return false;
		}
		
		$sql = sprintf("SELECT * FROM articulos WHERE id='%d'", $id);
		
		if($query = mysqli_query($this->conexion, $sql)) {
			if($rarticulo = mysqli_fetch_assoc($query)) {
				$this->id = $rarticulo['id'];
				$this->titulo = $rarticulo['titulo'];
				$this->descripcion = $rarticulo['descripcion'];
				$this->contenido = $rarticulo['contenido'];
				$this->imagen = $rarticulo['imagen'];
				$this->estado = $rarticulo['estado'];
				$this->fecha_registro = $rarticulo['fecha_registro'];
				return true;
			} else {
				$this->error = "ID no aroja resultados";
				return false;
			}
		} else {
			$this->error = "No se puede consultar ID";
			return false;
		}
	}
	
	public function obtener_id() {
		return $this->id;
	}
	
	public function obtener_codEstado() {
		return $this->estado;
	}
	
	public function obtener_estado() {
		switch($this->estado) {
			case 0: $estado = "Eliminado"; break;
			case 1: $estado = "Activo"; break;
			case 2: $estado = "Protegido"; break;
			default: $estado = "---"; break;
		}
		
		return $estado;
	}
	
	// Obtener listado de todos los Articulos
	public function listado($estado=-1) {
		if(!is_int($estado = $this->seguridad->entero_seguro($estado))) {
			$this->error = "Estado no es Seguro";
			return false;
		}
		
		$formato = "SELECT id FROM articulos WHERE 1=1 ";
		$argumentos = array();
		
		if($estado == -1) {
			$formato .= "AND estado!=0 ";
		} else {
			$formato .= "AND estado='%d' ";
			$argumentos[] = $estado;
		}
		
		$formato .= "ORDER BY id DESC";
		$sql = vsprintf($formato, $argumentos);
		
		$arreglo = array();
		if($query = mysqli_query($this->conexion, $sql)) {
			while($lista = mysqli_fetch_assoc($query)) {
				$objeto_articulo = new Articulo($this->conexion);
				$objeto_articulo->datos($lista['id']);
				$arreglo[] = $objeto_articulo;
			}
		}
		
		return $arreglo;
	}
	
	// Obtener listado de todos los Articulos paginados
	public function listado_paginado($estado=-1, $inicio, $fin) {
		if(!is_int($estado = $this->seguridad->entero_seguro($estado))) {
			$this->error = "Estado no es Seguro";
			return false;
		}
		
		if(!is_int($inicio = $this->seguridad->entero_seguro($inicio))) {
			$this->error = "Número de Inicio no es Seguro";
			return false;
		}
		
		if(!is_int($fin = $this->seguridad->entero_seguro($fin))) {
			$this->error = "Número de Fin no es Seguro";
			return false;
		}
		
		$formato = "SELECT id FROM articulos WHERE 1=1 ";
		$argumentos = array();
		
		if($estado == -1) {
			$formato .= "AND estado!=0 ";
		} else {
			$formato .= "AND estado='%d' ";
			$argumentos[] = $estado;
		}
		
		$formato .= "ORDER BY id DESC LIMIT %d, %d";
		$argumentos[] = $inicio;
		$argumentos[] = $fin;
		
		$sql = vsprintf($formato, $argumentos);
		
		$arreglo = array();
		if($query = mysqli_query($this->conexion, $sql)) {
			while($lista = mysqli_fetch_assoc($query)) {
				$objeto_articulo = new Articulo($this->conexion);
				$objeto_articulo->datos($lista['id']);
				$arreglo[] = $objeto_articulo;
			}
		}
		
		return $arreglo;
	}
	
	// Contar el total de Articulos
	public function total_listado($estado=-1) {
		if(!is_int($estado = $this->seguridad->entero_seguro($estado))) {
			$this->error = "Estado no es Seguro";
			return false;
		}
		
		$formato = "SELECT id FROM articulos WHERE 1=1 ";
		$argumentos = array();
		
		if($estado == -1) {
			$formato .= "AND estado!=0 ";
		} else {
			$formato .= "AND estado='%d' ";
			$argumentos[] = $estado;
		}
		
		$sql = vsprintf($formato, $argumentos);
		if($query = mysqli_query($this->conexion, $sql)) {
			return mysqli_num_rows($query);
		} else {
			return 0;
		}
	}
	
	// Verificar si imagen ya existe
	public function imagen_existe($imagen, $id) {
		if(!$imagen = $this->seguridad->texto_seguro($this->conexion, $imagen)) {
			$this->error = "Imagen no es Seguro";
			return false;
		}
		
		if(!is_int($id = $this->seguridad->entero_seguro($id))) {
			$this->error = "ID no es Seguro";
			return false;
		}
		
		$sql = sprintf("SELECT * FROM articulos WHERE imagen='%s' AND id!='%d' AND estado!=0", $imagen, $id);
		
		if($query = mysqli_query($this->conexion, $sql)) {
			if($rarticulo = mysqli_fetch_assoc($query)) { return true; }
			else { return false; }
		} else {
			return false;
		}
	}
	
	// Cargar archivo de la imagen
	public function cargar_archivo($titulo_archivo, $temporal) {
		if($titulo_archivo != "") {
			$ruta = $GLOBALS['app_root']."/archivos_articulos/".$titulo_archivo;
			
			if(is_uploaded_file($temporal)) {
				move_uploaded_file($temporal, $ruta);
				chmod("$ruta", 0777);
				return true;
			} else {
				$this->error = 'No se pudo cargar el archivo';
				return false;
			}
		} else {
			$this->error = 'No hay archivo';
			return false;
		}
	}
}
?>