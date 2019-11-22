<?php
	class Usuario extends BaseModel {
		// Atributos
		private $table;
		private $nickUsuario;
		private $nombreUsuario;
		private $apellidoUsuario;
		private $emailUsuario;
		private $contraseniaUsuario;
		private $idRol;

		// Métodos
		public function __construct() {
			$this->table = 'usuarios';
			parent::__construct();
		}

		public function getNickUsuario() {
 			return $this->nickUsuario;
		}

		public function getNombreUsuario() {
 			return $this->nombreUsuario;
		}

		public function getApellidoUsuario() {
 			return $this->apellidoUsuario;
		}

		public function getEmailUsuario() {
 			return $this->emailUsuario;
		}

		public function getContraseniaUsuario() {
 			return $this->contraseniaUsuario;
		}

		public function getIdRol() {
 			return $this->idRol;
		}

		public function setNickUsuario($nickUsuario) {
			$this->nickUsuario = $nickUsuario;
		}

		public function setNombreUsuario($nombreUsuario) {
			$this->nombreUsuario = $nombreUsuario;
		}

		public function setApellidoUsuario($apellidoUsuario) {
			$this->apellidoUsuario = $apellidoUsuario;
		}

		public function setEmailUsuario($emailUsuario) {
			$this->emailUsuario = $emailUsuario;
		}

		public function setContraseniaUsuario($contraseniaUsuario) {
			$this->contraseniaUsuario = $contraseniaUsuario;
		}

		public function setIdRol($idRol) {
			$this->idRol = $idRol;
		}

		public function setContraseniaEncriptada ($contraseniaUsuario) {
			$this->contraseniaUsuario = password_hash($contraseniaUsuario, PASSWORD_DEFAULT, array('cost'=>12));
		}

		public function insert() {
			// $this->registerBiracora(USUARIOS,REGISTRAR);			
			$query = "INSERT INTO $this->table (nick_usuario,nombre_usuario,apellido_usuario,email_usuario,contrasenia_usuario,id_rol) VALUES (:nick_usuario,:nombre_usuario,:apellido_usuario,:email_usuario,:contrasenia_usuario,:id_rol) "; // COnsulta SQL
			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
			$result->bindParam(':nick_usuario',$this->nickUsuario);
			$result->bindParam(':nombre_usuario',$this->nombreUsuario);
			$result->bindParam(':apellido_usuario',$this->apellidoUsuario);
			$result->bindParam(':email_usuario',$this->emailUsuario);
			$result->bindParam(':contrasenia_usuario',$this->contraseniaUsuario);
			$result->bindParam(':id_rol',$this->idRol);
			$save = $result->execute(); // Ejecuta la consulta
			return $save;
		}

		public function update() {
			// $this->registerBiracora(USUARIOS,ACTUALIZAR);			
			$query = "UPDATE $this->table SET 
						nick_usuario = :nick_usuario, nombre_usuario = :nombre_usuario,
						apellido_usuario = :apellido_usuario, email_usuario = :email_usuario,
						contrasenia_usuario = :contrasenia_usuario, id_rol = :id_rol 
						WHERE nick_usuario = :nick_usuario";
			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
			$result->bindParam(':nick_usuario',$this->nickUsuario);
			$result->bindParam(':nombre_usuario',$this->nombreUsuario);
			$result->bindParam(':apellido_usuario',$this->apellidoUsuario);
			$result->bindParam(':email_usuario',$this->emailUsuario);
			$result->bindParam(':contrasenia_usuario',$this->contraseniaUsuario);
			$result->bindParam(':id_rol',$this->idRol);
			$update = $result->execute(); // Ejecuta la consulta
			return $update;
		}

		public function delete() {
			// $this->registerBiracora(USUARIOS,ELIMINAR);			
			$query = "DELETE FROM $this->table WHERE nick_usuario = '$this->nickUsuario'"; // Consulta SQL
			$delete = $this->db()->query($query); 
			return $delete;
		}

		public function getAll() {
			// $this->registerBiracora(USUARIOS,CONSULTAR);			
			$sql = "SELECT * FROM $this->table";
            $query = $this->db()->query($sql);
            if($query){ // Evalua la cansulta
                if($query->rowCount() != 0) { // Si existe al menos un registro...
                    while($row = $query->fetch(PDO::FETCH_OBJ)) { // Recorre un array (tabla) fila por fila.
                        $resultSet[] = $row; // Llena el array con cada uno de los registros de la tabla.
                    }
                }
                else{ // Sino...
                    $resultSet = null; // Almacena null
                }
            }
            return $resultSet; // Finalmente retornla el arreglo con los elementos.
		}

		public function getOne($nickUsuario) {
			// $this->registerBiracora(USUARIOS,CONSULTAR);						
			$sql = "SELECT * FROM $this->table WHERE nick_usuario = '$nickUsuario'"; // Consulta SQL
			$query = $this->db()->query($sql); // Ejecuta la consulta SQL
            if($row = $query->fetch(PDO::FETCH_OBJ)){ // Si el objeto existe en la tabla
                $register = $row; // Lo almacena en $register
            }
            return $register; // Y finalmente, lo retorna.
		}

		public function login() {
			$query = "SELECT * FROM $this->table WHERE nick_usuario = '$this->nickUsuario'"; // Consulta SQL
			$login = $this->db()->query($query); // Ejecuta la consulta SQL directamente
			if($login && $login->rowCount() == 1) { // Si existe un registro...
				if($usuario = $login->fetch(PDO::FETCH_OBJ)) { 
					$verify = password_verify($this->contraseniaUsuario,$usuario->contrasenia_usuario); // Verifica la contraseña
                    if($verify){ // Si la verificacion es exitosa
                        $register = $usuario;
                    }
				}
				else {
					$register = null;
				}
			}
			else {
				$register = null;
			}
			return $register;
		}

		public function changePassword() {
			
		}
	}
?>