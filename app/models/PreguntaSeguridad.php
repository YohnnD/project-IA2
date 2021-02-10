<?php
	class PreguntaSeguridad extends BaseModel {
		// Atributos
        private  $idPreguntaSeguridad;
        private  $nickUsuario;
        private  $pregunta;
        private  $imagen;


        // Métodos
        public function __construct() {
            $this->table = 'preguntas_seguridad';
            parent::__construct();
        }

        public function getIdPreguntaSeguridad()
        {
            return $this->idPreguntaSeguridad;
        }

        public function setIdPreguntaSeguridad($idPreguntaSeguridad)
        {
            $this->idPreguntaSeguridad = $idPreguntaSeguridad;
        }


        public function getNickUsuario()
        {
            return $this->nickUsuario;
        }


        public function setNickUsuario($nickUsuario)
        {
            $this->nickUsuario = $nickUsuario;
        }


        public function getPregunta(){
            return Helpers::aesDecrypt($this->pregunta);
        }


        public function setPregunta($pregunta){
            $this->pregunta = Helpers::aesEncrypt($pregunta);
        }

        public function getImagen(){
            return  Helpers::aesDecrypt($this->imagen);
        }


        public function setImagen($imagen)
        {
            $this->imagen =  Helpers::aesEncrypt($imagen);
        }


        public function getBy(){
            $register=null;

            $sql="SELECT * FROM  $this->table WHERE nick_usuario='$this->nickUsuario'";
            $row=$this->db()->query($sql);
            if($row = $row->fetch(PDO::FETCH_OBJ)){
                $register = $row;
            }
            return $register;
        }




        public function delete(){
            $sql="DELETE FROM $this->table WHERE nick_usuario='$this->nickUsuario'";
            $register=$this->db()->query($sql);
            if($register){
                return true;
            }else{
                return false;
            }
        }







        public function getAll() {
			// $this->registerBiracora(PRODUCTOS,CONSULTAR);
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




        public function save() {
            $query = "INSERT INTO $this->table (nick_usuario,pregunta,imagen) VALUES (:nick_usuario,:pregunta,:imagen) "; // COnsulta SQL
            $result = $this->db()->prepare($query); // Prepara la consulta SQL
            // Limpia los parametros
            $result->bindParam(':nick_usuario',$this->nickUsuario);
            $result->bindParam(':pregunta',$this->pregunta);
            $result->bindParam(':imagen',$this->imagen);
            $save = $result->execute(); // Ejecuta la consulta
            return $save;
        }



	}
