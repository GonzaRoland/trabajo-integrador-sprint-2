<?php

include_once('funciones.php');

if (loginController() == true) {

    if($_SESSION)
    {
        $usuario = buscamePorEmail($_SESSION['email']);
        $username = $usuario['username'];
        $nombre = $usuario['nombre'];
        $genero = $usuario['genero'];
        $id = $usuario['id'];

        if(isset(glob("img/perfil$id.*")[0]))
        {
            $archivo = glob("img/perfil$id.*")[0];
        } else {
            $archivo = null;
        }
    }

} else {
    header ('Location: ?pagina=login');
}


?>

            <main>
                <section >
                    <fieldset class="login-form">

                    NADA
                    
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