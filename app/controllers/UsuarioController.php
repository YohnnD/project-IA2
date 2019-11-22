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
				$nickUsuario = $this->input('nick_usuario', true, 'string');
				$nombreUsuario = $this->input('nombre_usuario', true, 'string');
				$apellidoUsuario = $this->input('apellido_usuario', true, 'string');
				$emailUsuario = $this->input('email_usuario', true, 'string');
				$contraseniaUsuario = $this->input('contrasenia_usuario', true, 'string');
				$idRol = $this->input('id_rol', true, 'int');

				if($this->validateFails()) { // Si la validacion falla
					$this->redirect('Usuario','index'); // Redirecciona al inicio.
				}
				else { // Si no falla la validacion
					$usuario = new Usuario(); // Instancia el objeto
					// Setea los datos
					$usuario->setNickUsuario($nickUsuario);
					$usuario->setNombreUsuario(ucwords($nombreUsuario));
					$usuario->setApellidoUsuario(ucwords($apellidoUsuario));
					$usuario->setEmailUsuario($emailUsuario);
					$usuario->setContraseniaEncriptada($contraseniaUsuario);
					$usuario->setIdRol($idRol);
					$data = $usuario->insert();
					$this->sendAjax($data);
				}
			}
		}

		public function details() {
			if(isset($_GET['id'])) {
				$nickUsuario = $_GET['id'];
				$usuario = new Usuario();
				$register = $usuario->getOne($nickUsuario);
				$this->view('Usuarios/Usuarios.Detalles', ['usuario' => $register]);
			}
		}

		public function update() {
			if($_POST) { // Si se pasan datos por post
				// Valida los datos recibidos por los inputs
				$nickUsuario = $this->input('nick_usuario', true, 'string');
				$nombreUsuario = $this->input('nombre_usuario', true, 'string');
				$apellidoUsuario = $this->input('apellido_usuario', true, 'string');
				$emailUsuario = $this->input('email_usuario', true, 'string');
				$contraseniaUsuario = $this->input('contrasenia_usuario', true, 'string');
				$idRol = $this->input('id_rol', true, 'int');

				if($this->validateFails()) { // Si la validacion falla
					$this->redirect('Usuario','index'); // Redirecciona al inicio.
				}
				else { // Si no falla la validacion
					$usuario = new Usuario(); // Instancia el objeto
					// Setea los datos
					$usuario->setNickUsuario($nickUsuario);
					$usuario->setNombreUsuario(ucwords($nombreUsuario));
					$usuario->setApellidoUsuario(ucwords($apellidoUsuario));
					$usuario->setEmailUsuario($emailUsuario);
					$usuario->setContraseniaEncriptada($contraseniaUsuario);
					$usuario->setIdRol($idRol);
					$data = $usuario->update();
					$this->sendAjax($data);
				}
			}
		}

		public function delete() {
			if(isset($_POST['nick_usuario'])) {
				$nickUsuario = $_POST['nick_usuario'];
				$usuario = new Usuario();
				$usuario->setNickUsuario($nickUsuario);
				$data = $usuario->delete();
				$this->sendAjax($data);
			}
		}
	}
?>