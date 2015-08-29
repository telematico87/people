<?php

namespace people\UsuarioBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\SecurityContext;
use people\UsuarioBundle\Modelo\Manejador;
use people\UsuarioBundle\Modelo\functionsRepository;

class DefaultController extends Controller
{
  
	
	public function indexAction()
	{
		
		return $this->render('UsuarioBundle:Default:index.html.twig');

	}

	
	public function loginAction(Request $peticion)
	{
		$sesion = $peticion->getSession();
		$error = $peticion->attributes->get(
				SecurityContext::AUTHENTICATION_ERROR,
				$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
		);
		return $this->render('UsuarioBundle:Default:login.html.twig', array(
				'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
				'error'         => $error
		));
	}
	
	public function check_loginAction(Request $request){
		$sesion = $request->getSession();
		$error = $request->attributes->get(
				SecurityContext::AUTHENTICATION_ERROR,
				$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
		);
		$manejador = new Manejador();
		$nombre=$request->request->get('nombre');
		$password= $request->request->get('password');
		$dev=$manejador->Login($nombre,$password);
		if($dev){
			return $this->render('UsuarioBundle:Default:login_ok.html.twig', array(
					'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
					'error'         => $error
			));
		}else{
			return $this->render('UsuarioBundle:Default:login_ko.html.twig', array(
					'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
					'error'         => $error
			));
		}
		
	}
	public function check_registerAction(Request $request){
		$sesion = $request->getSession();
		$error = $request->attributes->get(
				SecurityContext::AUTHENTICATION_ERROR,
				$sesion->get(SecurityContext::AUTHENTICATION_ERROR)
		);
		$manejador = new Manejador();
		$nombre=$request->request->get('nombre');
		$email=$request->request->get('correo');
		$password= $request->request->get('password');
		$dev=$manejador->register($nombre,$email,$password);
		if($dev){
			return $this->render('UsuarioBundle:Default:register_ok.html.twig', array(
					'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
					'error'         => $error
			));
		}else{
			return $this->render('UsuarioBundle:Default:register_ko.html.twig', array(
					'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
					'error'         => $error
			));
		}
		
	}
	public function scrollingAction(){


		$manejador = new Manejador();
		$temas=$manejador->scrollingAjax();
		
		return $this->render(
				'UsuarioBundle:Default:index.html.twig',
				array('temas' => $temas)
		);
		
	}

 
}
