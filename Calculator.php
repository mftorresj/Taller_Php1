<?php
session_start();

// ==========================
// CLASE CALCULADORA (POO)
// ==========================
class Calculadora {

    public function operar($a, $b, $operacion) {

        switch ($operacion) {
            case "+":
                return $a + $b;
            case "-":
                return $a - $b;
            case "*":
                return $a * $b;
            case "/":
                return ($b != 0) ? $a / $b : "Error: división por cero";
            case "%":
                return ($a * $b) / 100;
            default:
                return "Operación no válida";
        }
    }
}

// ==========================
// INICIALIZAR HISTORIAL
// ==========================
if (!isset($_SESSION["historial"])) {
    $_SESSION["historial"] = [];
}

// ==========================
// PROCESAR FORMULARIO
// ==========================
$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Limpiar historial
    if (isset($_POST["limpiar"])) {
        $_SESSION["historial"] = [];
    } else {

        $num1 = $_POST["num1"];
        $num2 = $_POST["num2"];
        $op = $_POST["operacion"];

        $calc = new Calculadora();
        $resultado = $calc->operar($num1, $num2, $op);

        // Guardar en historial
        $operacionTexto = "$num1 $op $num2 = $resultado";
        $_SESSION["historial"][] = $operacionTexto;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Calculadora PHP</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Calculadora</h2>

    <form method="POST">
        <input type="number" step="any" name="num1" placeholder="Número 1" required>
        <input type="number" step="any" name="num2" placeholder="Número 2" required>

        <select name="operacion">
            <option value="+">Suma (+)</option>
            <option value="-">Resta (-)</option>
            <option value="*">Multiplicación (*)</option>
            <option value="/">División (/)</option>
            <option value="%">Porcentaje (%)</option>
        </select>

        <button type="submit">Calcular</button>
    </form>

    <h3>Resultado: <?php echo $resultado; ?></h3>

    <form method="POST">
        <button class="limpiar" name="limpiar">Borrar Historial</button>
    </form>

    <div class="historial">
        <h4>Historial:</h4>
        <?php
        if (!empty($_SESSION["historial"])) {
            foreach ($_SESSION["historial"] as $item) {
                echo "<p>$item</p>";
            }
        } else {
            echo "<p>No hay operaciones aún</p>";
        }
        ?>
    </div>
</div>

</body>
</html>