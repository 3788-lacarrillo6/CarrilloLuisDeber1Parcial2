<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Ejercicio1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/main.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('../Imagenes/fondo.jpg') no-repeat center center fixed;
            background-size: cover;
            
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>

    <div class="container" style="border-radius: 10px ; border: 3px solid rgb(184, 107, 89); margin-top: 3%;">
        <div class="row" style="margin-top: 1%; margin-left:8%;">
            <div class="col-xs-3 col-sm-4"></div>
            <div class="col-xs-4 col-sm-3">
            <h3 class="text-center">Menu</h3>
                <ul class="list-group mt-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">1. FACTORIAL</li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">2. PRIMO</li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">3. SERIE MATEMÁTICA</li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">S. SALIR</li>
                </ul>
            </div>
        </div>

        <div class="row " style="margin-left:8%;">
            <div class="col-xs-3 col-sm-4"></div>
            <div class="col-xs-4 col-sm-3">
                <form class="form-group" method="post">
                    <label for="ingresoOpcion">Ingrese opción (1, 2, 3, S):</label>
                    <input type="text" name="ingresoOpcion" id="ingresoOpcion" class="form-control" required />

                    <label for="ingresoNumero" class="mt-2">Ingrese número:</label>
                    <input type="number" value="1" name="ingresoNumero" id="ingresoNumero" class="form-control" required />

                    <button type="submit" class="btn btn-primary mt-3" style="margin-top: 2%;">Enviar</button>
                </form>
            </div>
        </div>

<?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $opcion = isset($_POST['ingresoOpcion']) ? strtolower($_POST['ingresoOpcion']) : '';
            $numero = isset($_POST["ingresoNumero"]) ? intval($_POST["ingresoNumero"]) : 0;

            if ($numero !== null && ($numero < 0 || $numero > 10)) {
                $error = "El número debe estar en el rango de 0 a 10.";
            } else {

                function factorial($numero) {
                    $total = 1;
                    for ($i = $numero; $i >= 1; $i--) {
                        $total *= $i;
                    }
                    return $total;
                }
    
                function primo($numero) {
                    if ($numero <= 1) return false;
                    for ($i = 2; $i <= sqrt($numero); $i++) {
                        if ($numero % $i == 0) return false;
                    }
                    return true;
                }
    
                function calcularSerie($n) {
                    $resultado = 0;
                    $total = '';
                    for ($cont = 1; $cont <= $n; $cont++) {
                        $numerador = $cont * $cont;
                        $denominador = factorial($cont);
                        $termino = ($cont % 2 == 0 ? -1 : 1) * ($numerador / $denominador);
                        $resultado += $termino;
                        $signo = $cont % 2 == 0 ? '-' : '+';
                        $total .= "$signo $numerador/$denominador ";
                    }
                    return $total . " = $resultado";
                }
    
                echo '<div class="row mt-5"><div class="col-sm-12 text-center">';
    
                switch ($opcion) {
                    case "1":
                        echo "<h2>Factorial</h2>";
                        echo "<p>El factorial de $numero es: " . factorial($numero) . "</p>";
                        break;
                    case "2":
                        echo "<h2>Primo</h2>";
                        $esPrimo = primo($numero) ? "es primo" : "no es primo";
                        echo "<p>El número $numero $esPrimo.</p>";
                        break;
                    case "3":
                        echo "<h2>Serie Matemática</h2>";
                        echo "<p>Serie resultante: " . calcularSerie($numero) . "</p>";
                        break;
                    case "s":
                        
                        header("Location: ../index.html");
                        exit;
                        echo "<p>Programa finalizado.</p>";
                        break;
                    default:
                        echo "<p>Opción no válida. Inténtelo de nuevo.</p>";
                        break;
                }
    
                echo '</div></div>';
            }

            }

           
        ?>
    </div>
</body>
</html>
