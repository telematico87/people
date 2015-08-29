<?php

namespace people\UsuarioBundle\Modelo;

class Tema {
	private $texto;
	private $titulo;
	private $usuario;
	private $fecha;
	
	
	function getUsuario(){
		return $this->usuario;
	}
	function getTitulo(){
		return $this->titulo;
	}
	function getTexto(){
		return $this->texto;
	}
	function getFecha(){
		return $this->fecha;
	}
	function setTitulo($titulo){
		$this->titulo=$titulo;
	}
	function setTexto($texto){
		$this->texto=$texto;
	}
	function setUsuario($usuario){
		$this->usuario=$usuario;
	}
	function setFecha($fecha){
		$this->fecha=$fecha;
	}
}