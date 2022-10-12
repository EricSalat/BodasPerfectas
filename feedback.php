<?php
    session_start(); //Sirve para poder tener variables de sesión
    $saludo =  $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/521097fe0a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>Solicitud de información enviada</title>
</head>
<body>
<a href="#main" class="screen-reader-only">Salta al contingut principal</a>
    <header>
        <p>Bodas Perfectas</p>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="#">Sobre nosotros</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Bodas</a></li>
                <li><a href="#">Testimonios</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
        <a href="#formulario"><button type="button" class="btn btn-primary">Pide información</button></a>
    </header>

    
    <main>
        <div class="foto-portada">    
                <div class="container">
                    <h1>Haz tu boda memorable</h1>
                    <p>Haremos que recuerdes tu boda como el mejor momento de tu vida</p>
                </div>
            </div>
    <div class="container">
        <h1>Hecho!</h1>
        <p>Gracias, <?php echo $saludo; ?>! En breves nos pondremos en contacto contigo.</p>
    </div>
</body>
</html>