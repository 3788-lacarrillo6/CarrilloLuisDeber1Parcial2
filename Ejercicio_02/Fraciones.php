<?php

function manejarFracciones() {
        // Mostrar el formulario
        echo '<form method="post" >
            <h3>Fracción A</h3>
            <input type="number" name="numerador_a" required placeholder="Numerador A">
            <input type="number" name="denominador_a" required placeholder="Denominador A">
            <h3>Fracción B</h3>
            <input type="number" name="numerador_b" required placeholder="Numerador B">
            <input type="number" name="denominador_b" required placeholder="Denominador B">
            <h3>Fracción C</h3>
            <input type="number" name="numerador_c" required placeholder="Numerador C">
            <input type="number" name="denominador_c" required placeholder="Denominador C">
            <h3>Fracción D</h3>
            <input type="number" name="numerador_d" required placeholder="Numerador D">
            <input type="number" name="denominador_d" required placeholder="Denominador D">
            <button type="submit" name="accion" value="calcular_fracciones">Calcular</button>
        </form>';
    
        // Si se reciben datos del formulario
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['accion']) && $_POST['accion'] === 'calcular_fracciones') {
            try {
                // Leer y validar las fracciones
                $a = leerFraccion((int)$_POST['numerador_a'], (int)$_POST['denominador_a']);
                $b = leerFraccion((int)$_POST['numerador_b'], (int)$_POST['denominador_b']);
                $c = leerFraccion((int)$_POST['numerador_c'], (int)$_POST['denominador_c']);
                $d = leerFraccion((int)$_POST['numerador_d'], (int)$_POST['denominador_d']);
    
                // Calcular el resultado
                $resultado = calcularResultadoFracciones($a, $b, $c, $d);
    
                // Mostrar el resultado
                echo "<p>Fracción A: {$a[0]}/{$a[1]}</p>";
                echo "<p>Fracción B: {$b[0]}/{$b[1]}</p>";
                echo "<p>Fracción C: {$c[0]}/{$c[1]}</p>";
                echo "<p>Fracción D: {$d[0]}/{$d[1]}</p>";
                echo "<p>Resultado: $resultado</p>";
            } catch (Exception $e) {
                // Manejar errores
                echo "<p>Error: " . $e->getMessage() . "</p>";
            }
        }
    }
    
    // Función para validar y leer una fracción
    function leerFraccion($numerador, $denominador) {
        if ($denominador <= 0) {
            throw new Exception("El denominador debe ser un número positivo.");
        }
        return [$numerador, $denominador];
    }
    
    // Función para calcular el resultado de las fracciones
    function calcularResultadoFracciones($a, $b, $c, $d) {
        $valorA = $a[0] / $a[1];
        $valorB = $b[0] / $b[1];
        $valorC = $c[0] / $c[1];
        $valorD = $d[0] / $d[1];
        return $valorA + ($valorB * $valorC) - $valorD;
    }


    manejarFracciones();

    ?>