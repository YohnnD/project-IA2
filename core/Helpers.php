<?php

class Helpers{//clases donde se añaden metodos que se necesiten en la vista

    public static function url($controller=DEFAULT_CONTROLLER,$action=DEFAULT_ACTION){//Pinta la url para la redirreciones
        $urlString=BASE_URL.$controller.'/'.$action;
         return  $urlString;
    }

    //verifica si hay un error en la validacion
    public static function isError($_name){
        if(isset($_SESSION[$_name])){
            return true;
        }else{
            return false;
        }
    }
    //muestra el mensaje de error en una session y luego lo borra
    public static function messageError($_name){
            if(isset($_SESSION[$_name])){
                $message=$_SESSION[$_name];
                $_SESSION[$_name]=null;
                unset($_SESSION[$_name]);
            }

            return $message;
        }

    // Mejorar para identificar al usuario
    /*public static function isAuth() {
        if(!isset($_SESSION['user_auth'])) {
            header("Location:".BASE_URL);
        }
        else{
            return true;
        }
    }
*/
    public static function saveImage($file,$directory){ // Se encarga de guardar los datos y mover la imagen a un directorio
        if(isset($file)){ // Si se ha definido un archivo
            $filename = $file['name']; // Nombre del archivo
            $tmpFilename = $file['tmp_name'];  // Nombre del archivo en carpeta temporal
            $mimetype = $file['type']; // Tipo del archivo
            if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || 
                $mimetype == 'image/png' || $mimetype == 'image/gif'){ // Verifica si el tipo de archivo es correcto
                if(!is_dir('storage/'.$directory)){ // Sino existe el directorio
                    mkdir('storage/'.$directory,0777,true); // Lo crea con todos los permisos
                }
                move_uploaded_file($tmpFilename,"storage/$directory/$filename"); // Y mueve el archivo del directorio temporal al directorio fisico
            }
            return $filename; // Finalmente, retorna el nombre del archivo para la base de datos
        }
        else{
            return null; // Sino, retorna null.
        }
    }

    public static function getTallas() {
        $producto = new Producto();
        $tallas = $producto->getAllTallas();
        return $tallas;
    }
}



