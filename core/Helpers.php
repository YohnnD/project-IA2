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

    public static function hasPermissions($module,$permission=null,$route=null,$nameModule=null) {
        /*Funcion para la verificación de los permisos:
         * module:numero de modulo de registro en base de datos (OBLIGATORIO)
         * permission:numero de permisos en el registro en base de datos(OPCIONAL)
         *  route:parametro true se indica para el bloqueo de la ruta bool (OPCIONAL)
         * nameModule:Nombre de modulo se utiliza para la redireccion al index
         *
         * Objetivo:si solo se pasa el parametro module, verifica que el modulo sea del usuario
         *          si se le pasan los 2 parametros,verifica que el modulo sea del usaurio y tenga ese permiso
         *          si le pasan 3 y 4 parametros, si el modulo y ese permiso no le pertenece al usuario lo redirege al
         *          home de cada modulo
         *
         *          retorna true=SI tiene permiso.
         *                   false=NO tiene permiso.
         * */





        $band=false;
        if(isset($_SESSION['permissions'])){
            for($i=0;$i<count($_SESSION['permissions']);$i++){
               if(is_null($permission)){
                   if($_SESSION['permissions'][$i]->id_modulo==$module){
                       $band=true;
                       break;
                   }
               }else{

                   if($_SESSION['permissions'][$i]->id_modulo==$module&&$_SESSION['permissions'][$i]->id_permiso==$permission){
                       $band=true;
                       break;
                   }
               }

            }

            if(!is_null($route)&& !$band){
                header('Location:'.BASE_URL.$nameModule."/index");
            }
        }

        return $band;
    }
}



