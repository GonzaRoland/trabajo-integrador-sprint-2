<?php

    session_start();

    function dd($var)
    {
        echo"<pre>";
        die(var_dump($var));
        echo"<pre>";
    }

    function old($user_input)
    {
        if (isset($_POST["$user_input"])){
            return $_POST["$user_input"];
        }
    }

    
    //Validaciones

    function validate($datos){
        
        $errores = [];

        $username = trim($datos['username']);

        if ($username =="") {
            $errores['username'] = "El nombre de usuario es obligatorio";
        } elseif (strlen($username) <= 4){
            $errores['username'] = "El nombre de usuario debe tener mínimo 5 caracteres";
        }
        
        
        $email = trim($datos['email']);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ($datos['email'] == ""){
            $errores['email'] = "El mail es obligatorio";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errores['email'] = "Introduzca un email válido";
        }

        
        $password = trim($datos['password']);

        if ($datos['password'] == ""){
            $errores['password'] = "Tenés que elegir una contraseña";
        } elseif (strlen($datos['password']) <= 5){
            $errores['password'] = "La contraseña debe tener mínimo 6 caracteres";
        } elseif ($datos['password'] != $datos['cpassword']){
            $errores['password'] = "Las contraseñas deben ser iguales";
        }

        if(!isset($datos['confirm'])){
            $errores['confirm'] = "Debes aceptar los términos y condiciones";
        }

        return $errores;

    }

    function logValidate($usuario)
    {
        $errores = [];
        $email = trim($usuario['email']);
        
        if ($usuario = buscamePorEmail($email) == null || $email === "")
        {
            $errores['email'] = "El email ingresado es inválido";
            //  dd($errores);
            //  exit;
        }
        // elseif ($email == "")
        // {
        //     $errores['email'] = "Tienes que ingresar tu email para ingresar";
        //     dd($errores);
        //     exit;
        // }
        $usuario = buscamePorEmail($_POST['email']);
         //dd($usuario['password']);
        // dd($_POST['password']);
        if (password_verify($_POST['password'],$usuario['password']) !== true)
        {
            // dd('éntro');
            $errores['password'] = "La contraseña ingresada es inválida";
            // dd($errores);
            // exit;
        }
        return $errores;
    }

    // Registro/Login

    function createUser($datos){
        $usuario = [
            'username' => $datos['username'],
            'email' => $datos['email'],
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'genero' => $datos['genero'],
            'role' => 1,
            'password' => password_hash($datos['password'], PASSWORD_DEFAULT)
        ];

        $usuario['id'] = idGenerate();

        return $usuario;
    }

    function idGenerate(){
        $file = file_get_contents('users.json');

        if($file == ""){
            return 1;
        }
        
        $users = explode(PHP_EOL, $file);
        array_pop($users);

        $lastUser = $users[count($users) - 1];
        $lastUser = json_decode($lastUser, true);

        return $lastUser["id"] + 1;

    }

    function saveUser($usuario) 
    {
        $jsonUser = json_encode($usuario);
        file_put_contents('users.json', $jsonUser . PHP_EOL, FILE_APPEND);
    }

    // 1 -Traer TODA la base
    // 2 - Buqueda por email
 
    function traerTodaLaBase()
    {
        $baseJson = file_get_contents('users.json');
        $users = explode(PHP_EOL, $baseJson);
        array_pop($users);

        foreach($users as $user) {
            $arrayUsers[] = json_decode($user, true);
        }
        return $arrayUsers;
    }

    function buscamePorEmail($email)
    {
        $arrayDeUsuariosTraidos = traerTodaLaBase();
        foreach($arrayDeUsuariosTraidos as $user) {
            if($user['email'] == $email) {
                return $user;
            }
        }
        return null;
    }

    
    // MANEJO DE SESSION

    // 1- Login

    function login($usuario) {
        $_SESSION["email"] = $usuario["email"];
        // dd($_SESSION);
        // Luego seteo la cookie. La mejor explicacion del uso de 
        // setcookie() la tienen como siempre, en el manual de PHP
        // http://php.net/manual/es/function.setcookie.php
        setcookie("email", $usuario["email"], time()+3600);
        // A TENER EN CUENTA las observaciones de MDN sobre la seguridad
        // a la hora de manejar cookies, y de paso para comentarles por que
        // me hacia tanto ruido tener que manejar la session asi:
        // https://developer.mozilla.org/es/docs/Web/HTTP/Cookies#Security
    }

    // 2 - Controlador de Login
    function loginController(){
        // SI la superglobal con el indice $_SESSION['email'] esta seteada
        if (isset($_SESSION["email"])) {
            // Dame TRUE
            return true;
        } else {
            // O...
            if (isset($_COOKIE["email"])) {
                // si la superglobal con el indice $_COOKIE['email']
                // esta seteada
                $_SESSION["email"] = $_COOKIE["email"];
                // Dame TRUE
                return true;
            } else {
                // Cualquier otra cosa, dame FALSE
                return false;
            }
        }
    }
    // 3 - Funcion de Logout
    function logout(){   
        session_destroy();
        setcookie("email", "", time() -1);
        header('Location: dogo.php?pagina=main');
    }

    // FILES!

    function saveAvatar($usuario){

        $errores = [];
        
        $id = $usuario["id"];

        if ($_FILES["avatar"]["error"] === UPLOAD_ERR_OK) {

            $nombre = $_FILES["avatar"]["name"];
            $archivo = $_FILES["avatar"]["tmp_name"];

            $ext = pathinfo($nombre, PATHINFO_EXTENSION);

            if ($ext != "jpg" && $ext != "png" && $ext != "jpeg") {
                $errores["avatar"] = "Solo admitimos formatos jpg y png";
                return $errores;
            }

            $miArchivo = dirname(__FILE__);

            $miArchivo = $miArchivo . "/img/";

            $miArchivo = $miArchivo. "perfil" . $id . "." . $ext;

            move_uploaded_file($archivo, $miArchivo);

        } else {

            $errores["avatar"] = "Hubo un error al procesar el archivo";

        }

        return $errores;
    }

    
    // Control de roles!

    function checkRole($data){        
        $usuario = buscamePorEmail($data);
        // Defino 7 como rol correspondiente a admin
        if($usuario['role'] == 7) {
            return true;
        } else {
        // para todo lo demas existe mastercard!
            return false;
        }

    }


?>