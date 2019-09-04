<?php
	class UsuarioController extends BaseController {
		public function __construct() {
			parent::__construct();
		}

		public function index() {
			$this->view('Usuarios/Usuarios');
		}

		public function create() {
			$this->view('Usuarios/Usuarios.Registrar');
		}

		public function getAll() {
			$usuario = new Usuario(); // Instancia el objeto
			$allUsuarios = $usuario->getAll(); // Obtiene todos los usuarios
			$this->view('Usuarios/Usuarios.Consultar', ['allUsuarios' => $allUsuarios]);
		}

		public function register() {
			if($_POST) { // Si se pasan datos por post
				// Valida los datos recibidos por los inputs
				$nick_usuario = $this->input('nick_usuario', true, 'string');
				$nombre_usuario = $this->input('nombre_usuario', true, 'string');
				$apellido_usuario = $this->input('apellido_usuario', true, 'string');
				$email_usuario = $this->input('email_usuario', true, 'string');
				$contrasenia_usuario = $this->input('contrasenia_usuario', true, 'string');
				$id_rol = $this->input('id_rol', true, 'int');

				if($this->validateFails()) { // Si la validacion falla
					$this->redirect('Usuario','index'); // Redirecciona al inicio.
				}
				else { // Si no falla la validacion
					$usuario = new Usuario(); // Instancia el objeto
					// Setea los datos
					$usuario->setNickUsuario($nick_usuario);
					$usuario->setNombreUsuario(ucwords($nombre_usuario));
					$usuario->setApellidoUsuario(ucwords($apellido_usuario));
					$usuario->setEmailUsuario($email_usuario);
					// Contraseña encriptada
					$contrasenia_encriptada = password_hash($contrasenia_usuario, PASSWORD_DEFAULT, array('cost' => 12));
					$usuario->setContraseniaUsuario($contrasenia_encriptada);
					$usuario->setIdRol($id_rol);
					$data = $usuario->insert();
					$this->sendAjax($data);
				}
			}
		}

		public function details() {
			if(isset($_GET['id'])) {
				$nick_usuario = $_GET['id'];
				$usuario = new Usuario();
				$register = $usuario->getOne($nick_usuario);
				$this->view('Usuarios/Usuarios.Detalles', ['usuario' => $register]);
			}
		}

		public function update() {
			if($_POST) { // Si se pasan datos por post
				// Valida los datos recibidos por los inputs
				$nick_usuario = $this->input('nick_usuario', true, 'string');
				$nombre_usuario = $this->input('nombre_usuario', true, 'string');
				$apellido_usuario = $this->input('apellido_usuario', true, 'string');
				$email_usuario = $this->input('email_usuario', true, 'string');
				$contrasenia_usuario = $this->input('contrasenia_usuario', true, 'string');
				$id_rol = $this->input('id_rol', true, 'int');

				if($this->validateFails()) { // Si la validacion falla
					$this->redirect('Usuario','index'); // Redirecciona al inicio.
				}
				else { // Si no falla la validacion
					$usuario = new Usuario(); // Instancia el objeto
					// Setea los datos
					$usuario->setNickUsuario($nick_usuario);
					$usuario->setNombreUsuario(ucwords($nombre_usuario));
					$usuario->setApellidoUsuario(ucwords($apellido_usuario));
					$usuario->setEmailUsuario($email_usuario);
					// Contraseña encriptada
					$contrasenia_encriptada = password_hash($contrasenia_usuario, PASSWORD_DEFAULT, array('cost' => 12));
					$usuario->setContraseniaUsuario($contrasenia_encriptada);
					$usuario->setIdRol($id_rol);
					$data = $usuario->update();
					$this->sendAjax($data);
				}
			}
		}

		public function delete() {
			if(isset($_GET['id'])) {
				$nick_usuario = $_GET['id'];
				$usuario = new Usuario();
				$usuario->setNickUsuario($nick_usuario);
				$data = $usuario->delete();
				$this->sendAjax($data);
			}
		}
	}
?>