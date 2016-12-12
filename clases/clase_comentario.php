<?php
class Comentario {
	########################################  Atributos  ########################################
	
	private $id;
	public  $nombre;
	public  $email;
	public  $comentario;
	public  $respondido;
	public  $respuesta;
	private $estado;
	private $fecha_registro;
	private $conexion;
	public  $error;
	
	#######################################  Operaciones  #######################################
	
	function __construct($conexion) {
		$this->error = NULL;
		$this->conexion = $conexion;
	}
}
?>