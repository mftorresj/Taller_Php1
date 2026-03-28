<?php
class Binary {
    public function convertir($numero) {

        if (!is_numeric($numero) || $numero < 0) {
            return "Error: ingrese un número entero positivo";
        }

        if ($numero == 0) {
            return "0";
        }

        $binario = "";

        // Algoritmo manual (divisiones sucesivas)
        while ($numero > 0) {
            $residuo = $numero % 2;
            $binario = $residuo . $binario;
            $numero = floor($numero / 2);
        }

        return $binario;
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST["numero"];

    $obj = new Binary();
    $resultado = $obj->convertir($numero);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Conversor a Binario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>

    <div class="container">
        <h2>Convertir a Binario</h2>

        <form method="POST">
            <input type="number" name="numero" placeholder="Ingrese número entero" required>
            <br>
            <button type="submit">Convertir</button>
        </form>

        <?php if ($resultado != ""): ?>
            <h3>Resultado: <?php echo $resultado; ?></h3>
        <?php endif; ?>

    </div>

</body>
</html>