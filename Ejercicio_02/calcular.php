<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $option = $_POST['option'];

    switch ($option) {
        case '1': // Opción Fibonacci
            if (isset($_POST['fibonacci_n'])) { // Verificar que 'fibonacci_n' esté definido
                $n = intval($_POST['fibonacci_n']);
                if ($n < 1 || $n > 50) {
                    $error = "El número debe estar en el rango de 1 a 50.";
                } else {
                    // Calcular y mostrar los N primeros números de Fibonacci
                    $f1 = 1;
                    $f2 = 1;
                    $fibonacci = [$f1, $f2];

                    for ($i = 3; $i <= $n; $i++) {
                        $fibonacci[] = $fibonacci[$i - 3] + $fibonacci[$i - 2];
                    }

                    $result = "Los primeros $n números de Fibonacci son: " . implode(", ", $fibonacci);
                }
            } else {
                $error = "Por favor, ingrese un valor para N.";
            }
            break;

        case '2': // Opción Cubo
            define("MAX", 1000000);
            $resultados = [];

            for ($i = 1; $i <= MAX; $i++) {
                $suma = 0;
                $numero = $i;
                while ($numero > 0) {
                    $digito = $numero % 10;
                    $suma += pow($digito, 3);
                    $numero = intval($numero / 10);
                }

                if ($suma === $i) {
                    $resultados[] = $i;
                }
            }

            $result = "Los números entre 1 y " . MAX . " que cumplen la condición son: " . implode(", ", $resultados);
            break;

        case '3': // Opción Fraccionarios
            // Verificar que las claves de los fraccionarios existan
            if (isset($_POST['num_a'], $_POST['den_a'], $_POST['num_b'], $_POST['den_b'], $_POST['num_c'], $_POST['den_c'], $_POST['num_d'], $_POST['den_d'])) {
                // Leer fraccionarios
                $num_a = intval($_POST['num_a']);
                $den_a = intval($_POST['den_a']);
                $num_b = intval($_POST['num_b']);
                $den_b = intval($_POST['den_b']);
                $num_c = intval($_POST['num_c']);
                $den_c = intval($_POST['den_c']);
                $num_d = intval($_POST['num_d']);
                $den_d = intval($_POST['den_d']);

                if ($den_a <= 0 || $den_b <= 0 || $den_c <= 0 || $den_d <= 0) {
                    $error = "Los denominadores deben ser mayores que 0.";
                } else {
                    // Calcular la expresión A + B * C - D
                    $a = $num_a / $den_a;
                    $b = $num_b / $den_b;
                    $c = $num_c / $den_c;
                    $d = $num_d / $den_d;

                    $resultado = $a + ($b * $c) - $d;
                    $result = "El resultado de la operación es: $resultado";
                }
            } else {
                $error = "Por favor, ingrese todos los valores de los fraccionarios.";
            }
            break;

        case 'S': // Salir
            $result = "Gracias por usar el programa.";
            header("Location: ../index.html");
            exit;
            break;

        default:
            $error = "Opción inválida.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú PHP</title>
    
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
            <div class="col-xs-4 col-sm-3 ">
                <h3 class="text-center">Menu</h3>
                <ul class="list-group mt-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center">1. FACTORIAL</li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">2. PRIMO</li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">3. SERIE MATEMÁTICA</li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">S. SALIR</li>
                </ul>
            </div>
        </div>
 
        <div class="container" style="margin-top: 0%; margin-left:8%;">
          

        <div class="row">
            <div class="col-xs-1 col-sm-1"></div>
            <div class="col-xs-10 col-sm-9">
                <form method="post">
                    <div class="col-sm-3">
                        <label for="option">Escoja una opción:</label>
                    </div>

                <div class="col-sm-5">
                    <select class="form-control form-control-sm col-sm-2" type="text" placeholder=".form-control-sm" id="option" name="option" required>
                        <option value="">Seleccione...</option>
                        <option value="1" <?= isset($option) && $option == '1' ? 'selected' : '' ?>>1 - Fibonacci</option>
                        <option value="2" <?= isset($option) && $option == '2' ? 'selected' : '' ?>>2 - Cubo</option>
                        <option value="3" <?= isset($option) && $option == '3' ? 'selected' : '' ?>>3 - Fraccionarios</option>
                        <option value="S" <?= isset($option) && $option == 'S' ? 'selected' : '' ?>>S - Salir</option>
                    </select>
                </div>

                    <div class="col-sm-4">
                    <button class="btn btn-info" type="submit">Enviar</button>
                    </div>
                </div>
                
                <div class="container">
                
                </div>
                
                <div class="row mt-1" style="margin-top: 2%; ">
                    <div class="row" id="inputs" style="margin-left: 30%;">
                        <?php if (isset($option) && $option == '1'): ?>
                            <label for="fibonacci_n">Ingrese un número entero (1 ≤ N ≤ 50):</label>
                            <input type="number" id="fibonacci_n" name="fibonacci_n" min="1" max="50" value="<?= isset($n) ? $n : 1 ?>" required>
                        <?php elseif (isset($option) && $option == '3'): ?>
                            <label>Ingrese 4 fraccionarios:</label><br>
                            A: <input type="number" name="num_a" value="1" required> / <input type="number" name="den_a" value="1" required><br>
                            B: <input type="number" name="num_b" value="1" required> / <input type="number" name="den_b" value="1" required><br>
                            C: <input type="number" name="num_c" value="1" required> / <input type="number" name="den_c" value="1" required><br>
                            D: <input type="number" name="num_d" value="1" required> / <input type="number" name="den_d" value="1" required><br>
                        <?php endif; ?>
                    </div>
                </div>

                
               </form>
             </div>
            </div>


        <div class="row" style="margin-left:10%;">
            <div class="col-sm-1"></div>
            <div class="col-sm-8">
            <?php if (isset($result)): ?>
            <div class="result text-center">
                <h2 >Resultado:</h2>
                <h3><?= $result ?></h3>
            </div>
        <?php elseif (isset($error)): ?>
            <div class="result error">
                <h2>Error:</h2>
                <p><?= $error ?></p>
            </div>
        <?php endif; ?>
            </div>

        </div>
       
    </div>
</body>
</html>
