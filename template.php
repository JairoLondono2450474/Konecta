<?php

//Esta función genera el header y la etiqueta de apertura body recibe como parámetros el título de la página y de forma opcional se le puede pasar líneas para agregar hojas de estilo.
function startP($title, $css = "") {
    echo '<!doctype html>
    <html lang="es">
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>'.$title.'</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link href="./css/template.css" rel="stylesheet">
        '.$css.'
    </head>
    <body class="d-flex flex-column min-vh-100">';
    
}

//Esta función genera el footer y la etiqueta de cierre body recibe como parámetro de forma opcional se le puede pasar líneas para agregar hojas de JS.
function endP($js = "") {
    echo '<footer class="text-center mt-auto">
    Konecta Derechos Reservados
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    '.$js.'
</body>
</html>';
}

?>