<?php
namespace people\UsuarioBundle\Modelo;
include('functionsRepository.php');

class Manejador{
	

	
	 function Login($usuario,$password){
		$link=connect('localhost','root','','people');
		$comparer=com($usuario,$password,$link);
		if($comparer)
			return true;
		else 
			return false;
	}
	function register($usuario,$password,$email){
		$link=connect('localhost','root','','people');
		$reg=register($usuario,$password,$email, $link);
		if($reg)
			return true;
		else
			return false;
	}
	function scrollingAjax(){
		$link=connect('localhost','root','','people');
		$start=0;
		$limit=2;
		return scrolling($start,$limit,$link);
	}
}


