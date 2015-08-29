<?php
namespace people\UsuarioBundle\Modelo;

include('Tema.php');
include('ArrayList.php');
//Función que recibe 4 parámetros: el servidor, el usuario, el password del administrador y la tabla a seleccionar.
function connect($server, $user, $password, $namedb) {
	//conection:
	$link = mysqli_connect($server,$user,$password,$namedb) or die("Error " . mysqli_error($link));
    return $link;
}

//función que recibe el usuario y password y la conexión establecida para comprobarlo con los mismos valores correspondientes en la tabla ususarioWeb.
function com($usuario,$password, $link){
	$query="SELECT COUNT(idUsuarioWeb) AS id  FROM usuarioWeb where Usuario='$usuario' and Password='$password'";
	$result=mysqli_query($link, $query) or die("Error".mysqli_error($link));
	$row=mysqli_fetch_array($result);// Use something like this to get the result
	$get_total_rows= $row['id'];
	if($get_total_rows>0 ){
  		return 1;  // Usuario y Password existe
	}else{ 
 		return 0; // Usuario y Password no existe
	}
 } 
  
 //Funci—n que interviene en el registo.Para registrar primero verifica; si existe 'Usuario' o 'email' no le permite.
 function register($usuario,$password,$email, $link)
 {
	$query="SELECT COUNT(idUsuarioWeb) AS id  FROM usuarioWeb where Usuario='$usuario' OR Email='$email'";
 	$result=mysqli_query($link, $query) or die("Error".mysqli_error($link));
	$row=mysqli_fetch_array($result);
	$get_total_rows= $row['id'];
	if($get_total_rows<=0 ){
		$query_insert= "INSERT INTO usuarioWeb VALUES('','$usuario','$password','$email','','','')";
		$newuser=mysqli_query($link, $query_insert) or die("Error".mysqli_error($link));
  		return 1;  
	}else{ 
 		echo"Try another, the user is already loged <br><br>";
 		return 0;
	}
 }
 //Función que lista un determinado numero de temas para el scroling
 
  function scrolling($start,$limit,$link){
  $temas=new ArrayList();
  $query = "select Titulo,Texto,fecha from tema order by idTema asc limit $start,$limit";
  $result=mysqli_query($link, $query) or die("Error".mysqli_error($link));
  while($row=mysqli_fetch_array($result)){
  	$get_titulo= $row['Titulo'];
  	$get_texto= $row['Texto'];
  	$get_fecha= $row['fecha'];
  	$tema=new Tema();
  	$tema->setTitulo($get_titulo);
  	$tema->setTexto($get_texto);
  	$tema->setFecha($get_fecha);
  	$temas->Add($tema);
  	}
    return $temas;
  } 
 
?>