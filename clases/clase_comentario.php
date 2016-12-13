<?php
class Comentario {
	########################################  Atributos  ########################################
	
	private $id;
	public  $nombre;
	public  $email;
	public  $mensaje;
	public  $respondido;
	public  $respuesta;
	private $estado;
	private $fecha_registro;
	private $conexion;
	private $seguridad;
	public  $error;
	
	#######################################  Operaciones  #######################################
	
	function __construct($conexion) {
		$this->error = NULL;
		$this->conexion = $conexion;
		$this->seguridad = new Seguridad();
	}
	
	// Insertar un Comentario a la Base de Datos
	public function insertar($nombre, $email, $mensaje) {
		if(!$nombre = $this->seguridad->texto_seguro($this->conexion, $nombre)) {
			$this->error = "Nombre no es Seguro";
			return false;
		}
		
		if(!$email = $this->seguridad->texto_seguro($this->conexion, $email)) {
			$this->error = "Email no es Seguro";
			return false;
		}
		
		if(!$mensaje = $this->seguridad->texto_seguro($this->conexion, $mensaje)) {
			$this->error = "Mensaje no es Seguro";
			return false;
		}
		
		$sql = sprintf("INSERT INTO comentarios(nombre, email, mensaje, estado, fecha_registro) VALUES('%s', '%s', '%s', 1, CURDATE())", $nombre, $email, $mensaje);
		
		if($inserto = mysqli_query($this->conexion, $sql)) {
			return true;
		} else {
			$this->error = "No se puede Insertar<br />".$sql;
			return false;
		}
	}
	
	// Actualizar un Comentario en la Base de Datos identificado por su id
	public function actualizar($id, $nombre, $email, $mensaje, $respondido, $respuesta) {
		if(!$id = $this->seguridad->entero_seguro($id)) {
			$this->error = "ID no es Seguro";
			return false;
		}
		
		if(!$nombre = $this->seguridad->texto_seguro($this->conexion, $nombre)) {
			$this->error = "Nombre no es Seguro";
			return false;
		}
		
		if(!$email = $this->seguridad->texto_seguro($this->conexion, $email)) {
			$this->error = "Email no es Seguro";
			return false;
		}
		
		if(!$mensaje = $this->seguridad->texto_seguro($this->conexion, $mensaje)) {
			$this->error = "Mensaje no es Seguro";
			return false;
		}
		
		if(!is_int($respondido = $this->seguridad->entero_seguro($respondido))) {
			$this->error = "Respondido no es Seguro";
			return false;
		}
		
		if(!is_string($respuesta = $this->seguridad->texto_seguro($this->conexion, $respuesta))) {
			$this->error = "Respuesta no es Seguro";
			return false;
		}
		
		$sql = sprintf("UPDATE comentarios SET nombre='%s', email='%s', mensaje='%s', respondido='%d', respuesta='%s' WHERE id='%d'", $nombre, $email, $mensaje, $respondido, $respuesta, $id);
		
		if($actualizo = mysqli_query($this->conexion, $sql)) {
			return true;
		} else {
			$this->error = "No se puede Modificar";
			return false;
		}
	}
	
	// Eliminar un Comentario de la Base de Datos identificado por su id
	private function eliminar($id) {
		if(!$id = $this->seguridad->entero_seguro($id)) {
			$this->error = "ID no es Seguro";
			return false;
		}
		
		$sql = sprintf("DELETE FROM comentarios WHERE id='%d'", $id);
		
		if($elimino = mysqli_query($this->conexion, $sql)) {
			return true;
		} else {
			$this->error = "No se puede Eliminar";
			return false;
		}
	}
	
	// Desactivar un Comentario de la Base de Datos identificado por su id
	public function desactivar($id) {
		if(!$id = $this->seguridad->entero_seguro($id)) {
			$this->error = "ID no es Seguro";
			return false;
		}
		
		$sql = sprintf("UPDATE comentarios SET estado=0 WHERE id='%d'", $id);
		
		if($desactivo = mysqli_query($this->conexion, $sql)) {
			return true;
		} else {
			$this->error = "No se puede Eliminar (D)";
			return false;
		}
	}
	
	// Obtener datos de un Comentario identificado por su id
	public function datos($id) {
		if(!$id = $this->seguridad->entero_seguro($id)) {
			$this->error = "ID no es Seguro";
			return false;
		}
		
		$sql = sprintf("SELECT * FROM comentarios WHERE id='%d'", $id);
		
		if($query = mysqli_query($this->conexion, $sql)) {
			if($rcomentario = mysqli_fetch_assoc($query)) {
				$this->id = $rcomentario['id'];
				$this->nombre = $rcomentario['nombre'];
				$this->email = $rcomentario['email'];
				$this->mensaje = $rcomentario['mensaje'];
				$this->respondido = $rcomentario['respondido'];
				$this->respuesta = $rcomentario['respuesta'];
				$this->estado = $rcomentario['estado'];
				$this->fecha_registro = $rcomentario['fecha_registro'];
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
	
	public function obtener_fecha_registro() {
		return $this->fecha_registro;
	}
	
	// Obtener listado de todos los Comentarioes
	public function listado($respondido=-1, $estado=-1) {
		if(!is_int($respondido = $this->seguridad->entero_seguro($respondido))) {
			$this->error = "Respondido no es Seguro";
			return false;
		}
		
		if(!is_int($estado = $this->seguridad->entero_seguro($estado))) {
			$this->error = "Estado no es Seguro";
			return false;
		}
		
		$formato = "SELECT id FROM comentarios WHERE 1=1 ";
		$argumentos = array();

		if($respondido != -1) {
			$formato .= "AND respondido='%d' ";
			$argumentos[] = $respondido;
		}
		
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
				$objeto_comentario = new Comentario($this->conexion);
				$objeto_comentario->datos($lista['id']);
				$arreglo[] = $objeto_comentario;
			}
		}
		
		return $arreglo;
	}
	
	// Obtener listado de todos los Comentarioes paginados
	public function listado_paginado($respondido=-1, $estado=-1, $inicio=0, $fin=10) {
		if(!is_int($respondido = $this->seguridad->entero_seguro($respondido))) {
			$this->error = "Respondido no es Seguro";
			return false;
		}
		
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
		
		$formato = "SELECT id FROM comentarios WHERE 1=1 ";
		$argumentos = array();

		if($respondido != -1) {
			$formato .= "AND respondido='%d' ";
			$argumentos[] = $respondido;
		}
		
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
				$objeto_comentario = new Comentario($this->conexion);
				$objeto_comentario->datos($lista['id']);
				$arreglo[] = $objeto_comentario;
			}
		}
		
		return $arreglo;
	}
	
	// Contar el total de Comentarioes
	public function total_listado($respondido=-1, $estado=-1) {
		if(!is_int($respondido = $this->seguridad->entero_seguro($respondido))) {
			$this->error = "Respondido no es Seguro";
			return false;
		}
		
		if(!is_int($estado = $this->seguridad->entero_seguro($estado))) {
			$this->error = "Estado no es Seguro";
			return false;
		}
		
		$formato = "SELECT id FROM comentarios WHERE 1=1 ";
		$argumentos = array();

		if($respondido != -1) {
			$formato .= "AND respondido='%d' ";
			$argumentos[] = $respondido;
		}
		
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
}
?>