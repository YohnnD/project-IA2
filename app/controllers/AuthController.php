<?php
	class AuthController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Auth/Login');
		}

		public function recoverPasswordView (){
		    $this->view('Auth/Recover.Password');
        }

        public function verifyEmail(){
			$email = $_POST['email'];
			$usuario = new Usuario ();
			$usuario->setEmailUsuario($email);

			$response= $usuario->verifyEmail();
			$this->sendAjax($response);

		}

		public function recoverPassword (){
			$email = $_POST['email'];
			$usuario = new Usuario();

			$usuario->setEmailUsuario($email);
			$usuario->sendEmail();

			$this->redirect('Auth', 'index');

		}

		public function recoverAccount (){
			$token = $_GET['id'];
			$user = new Usuario();

			$result = $user->recoverAccount($token);

			//var_dump($result);
			if($result){
				$user->updateToken($token);
				$this->view('Auth/Recover.Account', ['token' => $token]);
			}else{
				$this->view('Auth/Recover.Password', ['message' => 'Este Token ya fue revocado...']);

			}
		}

		public function updatePassword (){
			$password = $_POST['repeat_contrasenia_usuario'];
			$token = $_POST['token'];

			$usuario = new Usuario();
			$usuario->setContraseniaEncriptada($password);

			$response= $usuario->updatePassword($token);

			$this->redirect('Auth', 'index');

		}

		public function login() {
			if($_POST) { // Si se enviaron datos por post
				$usuario = new Usuario(); // Instancia del objeto
				$rol = new ROl();
				// Se setean los datos
				$usuario->setNickUsuario($_POST['nick_usuario']);
				$usuario->setContraseniaUsuario($_POST['contrasenia_usuario']);
				$usuarioSession = $usuario->login();
				if($usuarioSession && is_object($usuarioSession)) { // Si se definio el usuario y es un objeto
					$idRol = $usuarioSession->id_rol;
					$PermisosXModulos = $rol->getPermisosXModulosByRol($idRol);
					$_SESSION['nick_usuario'] = $usuarioSession->nick_usuario;
					$_SESSION['user'] = $usuarioSession;
					$_SESSION['authenticated'] = true;
					$_SESSION['permissions'] = $PermisosXModulos;
					$_SESSION['error'] = false;
					$_SESSION['message'] = "Log in successfully";
					// $_SESSION['permissions'] =
					// $this->registerBiracora(LOGIN, LOGIN);
					$usuario->registerBitacora(USUARIOS,INICIAR_SESION);
					$this->redirect('Home','index');
				}
				else {
					$_SESSION['error'] = true;
					$_SESSION['message'] = "Sus credenciales son incorrectas. Por favor, intente de nuevo.";
					$this->redirect('Auth', 'index');
				}
			}
		}

		public function logout() {
			if(isset($_SESSION)) {
				$usuario = new Usuario();
				$usuario->registerBitacora(LOGOUT,CERRAR_SESION);
				session_destroy();
				$this->redirect();
			}
		}

		public function passwordRestore() {

		}
	}
?>
