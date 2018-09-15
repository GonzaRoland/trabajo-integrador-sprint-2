<?php

include_once('funciones.php');

$nombre = "";
$apellido = "";
$genero = "";
$username = "";
$email = "";
$errores = [];

if($_POST) {
   // $errores = [];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $genero = $_POST['genero'];
    $errores = validate($_POST);
    //dd($errores);
    if (count($errores) === 0){
        $usuario = createUser($_POST);
        saveUser($usuario);
        $erroresAvatar = saveAvatar($usuario);
        $errores = array_merge($errores, $erroresAvatar);

        header('Location: $pagina=login');
        exit;
        // if(count($errores) === 0){

        // dd($_POST);
        // exit;

        // }
    }
}

?>
            <main class="main-form">    
                <section class="form">
                    
                    
                    <form class="datos" action="" method="POST" enctype="multipart/form-data">
                        <div align="center">
                        <fieldset class="reg-form">
                                <h2> Creá tu cuenta con nosotros</h2>
                                <br>
                            
                                <label for="nombre"></label>
                                <input class="form-input" type="text" name="nombre" value="<?= $nombre ?>" placeholder="Nombre">
                                
                                <br>
                                <label for="apellido"></label>
                                <input class="form-input" type="text" name="apellido" value="<?= $apellido ?>" placeholder="Apellido">
                                
                                <br>
                                
                                
                                <label for="email"></label>
                                <input class="form-input" type="email" name="email" value="<?= $email ?>" placeholder="Corre Electrónico">
                                <?php if(isset($errores['email'])):?>
                                <div class="alert"><p><strong><?=$errores['email']?></strong></p></div>
                                <?php endif;?>
                                
                                <br>
                                <label for="username"></label>
                                
                                <input class="form-input" type="text" name="username" value="<?= $username ?>" placeholder="Nombre de Usuario">
                                <?php if(isset($errores['username'])) :?>
                                <div class="alert"><p><strong><?= $errores['username'] ?></strong></p></div>
                                <?php endif; ?>
                                
                                <br>
                                <label for="genero" name="genero">Género</label>
                                <br>
                                <input type="radio" name="genero">
                                <label for="genero" name="femenino">Femenino</label>
                                
                                <input type="radio" name="genero">
                                <label for="genero" name="masculino">Masculino</label>
                                
                                <input type="radio" name="genero">
                                <label for="genero" name="otro">Otro</label>
                                <br>
                                <br>
                                <label for="avatar">Foto de Perfil</label>
                                <br>
                                
                                <input type="file" name="avatar">
                                <?php if(isset($errores['avatar'])) :?>
                                <div class="alert"><p><strong><?= $errores['avatar'] ?></strong></p></div>
                                <?php endif; ?>
                                
                                <br>
                                <br>
                                <label for="password">Password</label>
                                <br>
                                <input class="form-input" type="password" name="password" placeholder="Elegí tu contraseña">
                                <br>
                                <input class="form-input" type="password" name="cpassword" placeholder="Confirmá tu contraseña">
                                <?php if(isset($errores['password'])) :?>
                                <div class="alert"><p><strong><?= $errores['password'] ?></strong></p></div>
                                <?php endif; ?>
                            
                                <br>
                                <br>
                                <h3><label for="animals">¿Qué animales te gustan?</label></h3>
                                <br>
                                <label for="animals" name="gatos">Gatos</label>
                                <input type="checkbox" name="gatos">
                                <label for="animals" name="perros">Perros</label>
                                <input type="checkbox" name="perros">
                                <label for="animals" name="aves">Aves</label>
                                <input type="checkbox" name="aves">
                                <label for="animals" name="reptiles">Reptiles</label>
                                <input type="checkbox" name="reptiles">
                                <label for="animals" name="peces">Peces</label>
                                <input type="checkbox" name="peces">
                            
                            <div align="center">
                                <br>
                                <label for="newsletter">Quiero inscribirme al newsletter semanal</label>
                                <input type="checkbox" name="newsletter">
                                <br>
                                <label for="confirm">Accedo a los TÉRMINOS Y CONDICIONES</label>
                                <input type="checkbox" name="confirm">
                                <?php if(isset($errores['confirm'])) :?>
                                <div class="alert"><p><strong><?= $errores['confirm'] ?></strong></p></div>
                                <?php endif; ?>
                                <br>
                                <br>
                                <button class="btn" type="submit">ENVIAR</button>
                                <button class="btn" type="reset">BORRAR</button>
                            </div>
                        </div>    
                        </fieldset>
                        <br>
                    </form>
                </section>
            </main>
            <footer>
            <nav class="footer-nav">
                <a href="?pagina=main">Inicio</a>
                    <a href="?pagina=catalogo">Productos</a>
                    <a href="?pagina=servicios">Servicios</a>
                    <a href="?pagina=contacto">Contacto</a>
                    <a href="?pagina=frecuentes">Preguntas Frecuentes</a>
            </nav>
            <i>2018 Todos los Derechos reservados.</i>
        </footer>
        </div>
    </body>
</html>
