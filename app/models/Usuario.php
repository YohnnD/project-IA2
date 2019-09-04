<?php
	class Usuario extends BaseModel {
		// Atributos
		private $table;
		private $nick_usuario;
		private $nombre_usuario;
		private $apellido_usuario;
		private $email_usuario;
		private $contrasenia_usuario;
		private $id_rol;

		// Métodos
		public function __construct() {
			$this->table = 'usuarios';
			parent::__construct();
		}

		public function getNickUsuario() {
 			return $this->nick_usuario;
		}

		public function getNombreUsuario() {
 			return $this->nombre_usuario;
		}

		public function getApellidoUsuario() {
 			return $this->apellido_usuario;
		}

		public function getEmailUsuario() {
 			return $this->email_usuario;
		}

		public function getContraseniaUsuario() {
 			return $this->contrasenia_usuario;
		}

		public function getIdRol() {
 			return $this->id_rol;
		}

		public function setNickUsuario($nick_usuario) {
			$this->nick_usuario = $nick_usuario;
		}

		public function setNombreUsuario($nombre_usuario) {
			$this->nombre_usuario = $nombre_usuario;
		}

		public function setApellidoUsuario($apellido_usuario) {
			$this->apellido_usuario = $apellido_usuario;
		}

		public function setEmailUsuario($email_usuario) {
			$this->email_usuario = $email_usuario;
		}

		public function setContraseniaUsuario($contrasenia_usuario) {
			$this->contrasenia_usuario = $contrasenia_usuario;
		}

		public function setIdRol($id_rol) {
			$this->id_rol = $id_rol;
		}

		public function insert() {
			$query = "INSERT INTO $this->table (nick_usuario,nombre_usuario,apellido_usuario,email_usuario,contrasenia_usuario,id_rol) VALUES (:nick_usuario,:nombre_usuario,:apellido_usuario,:email_usuario,:contrasenia_usuario,:id_rol) "; // COnsulta SQL
			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
			$result->bindParam(':nick_usuario',$this->nick_usuario);
			$result->bindParam(':nombre_usuario',$this->nombre_usuario);
			$result->bindParam(':apellido_usuario',$this->apellido_usuario);
			$result->bindParam(':email_usuario',$this->email_usuario);
			$result->bindParam(':contrasenia_usuario',$this->contrasenia_usuario);
			$result->bindParam(':id_rol',$this->id_rol);
			$save = $result->execute(); // Ejecuta la consulta
			return $save;
		}

		public function update() {
			$query = "UPDATE $this->table SET 
						nick_usuario = :nick_usuario, nombre_usuario = :nombre_usuario,
						apellido_usuario = :apellido_usuario, email_usuario = :email_usuario,
						contrasenia_usuario = :contrasenia_usuario, id_rol = :id_rol 
						WHERE nick_usuario = :nick_usuario";
			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			// Limpia los parametros
			$result->bindParam(':nick_usuario',$this->nick_usuario);
			$result->bindParam(':nombre_usuario',$this->nombre_usuario);
			$result->bindParam(':apellido_usuario',$this->apellido_usuario);
			$result->bindParam(':email_usuario',$this->email_usuario);
			$result->bindParam(':contrasenia_usuario',$this->contrasenia_usuario);
			$result->bindParam(':id_rol',$this->id_rol);
			$update = $result->execute(); // Ejecuta la consulta
			return $update;
		}

		public function delete() {
			$query = "DELETE FROM $this->table WHERE nick_usuario = :nick_usuario"; // Consulta SQL
			$result = $this->db()->prepare($query); // Prepara la consulta SQL
			$result->bindParam(':nick_usuario',$this->nick_usuario);
			$delete = $result->execute(); // Ejecuta la consulta
			return $delete;
		}

		public function getAll() {
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

		public function getOne($nick_usuario) {
			$sql = "SELECT * FROM $this->table WHERE nick_usuario = '$nick_usuario'"; // Consulta SQL
			$query = $this->db()->query($sql); // Ejecuta la consulta SQL
            if($row = $query->fetch(PDO::FETCH_OBJ)){ // Si el objeto existe en la tabla
                $register = $row; // Lo almacena en $register
            }
            return $register; // Y finalmente, lo retorna.
		}

		public function login() {
			$query = "SELECT * FROM $this->table WHERE nick_usuario = '$this->nick_usuario'"; // Consulta SQL
			$login = $this->db()->query($query); // Ejecuta la consulta SQL directamente
			if($login && $login->rowCount() == 1) { // Si existe un registro...
				if($usuario = $login->fetch(PDO::FETCH_OBJ)) { 
					$verify = password_verify($this->contrasenia_usuario,$usuario->contrasenia_usuario); // Verifica la contraseña
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