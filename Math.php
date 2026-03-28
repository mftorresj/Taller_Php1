<?php
class Math {

    public function fibonacci($n) {
        $serie = [];

        if ($n == 1) {
            return [0];
        }

        $serie[0] = 0;
        $serie[1] = 1;

        for ($i = 2; $i < $n; $i++) {
            $serie[$i] = $serie[$i - 1] + $serie[$i - 2];
        }

        return $serie;
    }

    public function factorial($n) {
        $resultado = 1;

        for ($i = 1; $i <= $n; $i++) {
            $resultado *= $i;
        }

        return $resultado;
    }
}

$resultado = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $numero = intval($_POST["numero"]);
    $operacion = $_POST["operacion"];

    if ($numero <= 0) {
        $error = "El número debe ser mayor que 0";
    } else {

        $math = new Math();

        if ($operacion == "fibonacci") {
            $serie = $math->fibonacci($numero);
            $resultado = "Serie Fibonacci: " . implode(", ", $serie);
        } else if ($operacion == "factorial") {
            $resultado = "Factorial: " . $math->factorial($numero);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fibonacci y Factorial</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h2>Fibonacci y Factorial</h2>

<form method="POST">
    <input type="number" name="numero" placeholder="Ingrese un número" required>

    <select name="operacion">
        <option value="fibonacci">Fibonacci</option>
        <option value="factorial">Factorial</option>
    </select>

    <button type="submit">Calcular</button>
</form>

<?php if ($error != ""): ?>
    <p style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>

<?php if ($resultado != ""): ?>
    <h3><?php echo $resultado; ?></h3>
<?php endif; ?>

</body>
</html>