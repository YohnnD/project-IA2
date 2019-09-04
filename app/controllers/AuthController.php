<?php
	class AuthController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Auth/Login');
		}

		public function login() {
			if($_POST) { // Si se enviaron datos por post
				$usuario = new Usuario(); // Instancia del objeto usuario
				// Se setean los datos
				$usuario->setNickUsuario($_POST['nick_usuario']);
				$usuario->setContraseniaUsuario($_POST['contrasenia_usuario']);
				$usuarioSession = $usuario->login();
				if($usuarioSession && is_object($usuarioSession)) { // Si se definio el usuario y es un objeto
					// Setea los datos de la sesión.
					// $_SESSION['identified'] = Helpers::isIdentified();
					$_SESSION['nick_usuario'] = $usuarioSession->nick_usuario;
					$_SESSION['nombre_usuario'] = $usuarioSession->nombre_usuario;
					$_SESSION['apellido_usuario'] = $usuarioSession->apellido_usuario;
					$_SESSION['email_usuario'] = $usuarioSession->email_usuario;
					$_SESSION['contrasenia_usuario'] = $usuarioSession->contrasenia_usuario;
					$_SESSION['id_rol'] = $usuarioSession->id_rol;
					$_SESSION['error'] = false;
					$_SESSION['message'] = "Log in successfully";
					$this->redirect('Home','index');
				}
				else {
					$_SESSION['error'] = true;
					$_SESSION['message'] = "Error log in";
					$this->redirect('Error', 'error404');
				}
			}
		}

		public function logout() {
			if(isset($_SESSION)) {
				session_destroy();
				$this->redirect();
			}
		}

		public function passwordRestore() {
			
		}
	}
?>