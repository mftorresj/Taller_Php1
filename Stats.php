<?php
class Stats {

    public function promedio($numeros) {
        return array_sum($numeros) / count($numeros);
    }

    public function media($numeros) {
        sort($numeros);
        $n = count($numeros);

        if ($n % 2 == 0) {
            // Si es par, promedio de los dos del centro
            $mid1 = $numeros[$n/2 - 1];
            $mid2 = $numeros[$n/2];
            return ($mid1 + $mid2) / 2;
        } else {
            // Si es impar, valor del centro
            return $numeros[floor($n/2)];
        }
    }

    public function moda($numeros) {
        $frecuencias = array_count_values($numeros);
        $maxFrecuencia = max($frecuencias);

        $modas = [];

        foreach ($frecuencias as $num => $freq) {
            if ($freq == $maxFrecuencia) {
                $modas[] = $num;
            }
        }

        return $modas;
    }
}

$resultado = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $entrada = $_POST["numeros"];

    // Convertir string a array
    $array = explode(",", $entrada);

    $numeros = [];

    foreach ($array as $valor) {
        $valor = trim($valor);

        if (!is_numeric($valor)) {
            $error = "Todos los valores deben ser números";
            break;
        }

        $numeros[] = floatval($valor);
    }

    if ($error == "" && count($numeros) > 0) {

        $stats = new Stats();

        $promedio = $stats->promedio($numeros);
        $media = $stats->media($numeros);
        $moda = $stats->moda($numeros);

        $resultado = "
            Promedio: $promedio <br>
            Media: $media <br>
            Moda: " . implode(", ", $moda);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Promedio, Media y Moda</title>
</head>
<body>

<h2>Calcular Promedio, Media y Moda</h2>

<form method="POST">
    <input type="text" name="numeros" placeholder="Ej: 1,2,3,4,5" required>
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