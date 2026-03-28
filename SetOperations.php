<?php
class SetOperations {

    public function union($A, $B) {
        return array_values(array_unique(array_merge($A, $B)));
    }

    public function interseccion($A, $B) {
        return array_values(array_intersect($A, $B));
    }

    public function diferencia($A, $B) {
        return array_values(array_diff($A, $B));
    }
}

$resultado = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $inputA = $_POST["conjuntoA"];
    $inputB = $_POST["conjuntoB"];

    $arrayA = explode(",", $inputA);
    $arrayB = explode(",", $inputB);

    $A = [];
    $B = [];

    foreach ($arrayA as $valor) {
        $valor = trim($valor);

        if (!is_numeric($valor)) {
            $error = "Todos los valores deben ser números enteros";
            break;
        }

        $A[] = intval($valor);
    }

    foreach ($arrayB as $valor) {
        $valor = trim($valor);

        if (!is_numeric($valor)) {
            $error = "Todos los valores deben ser números enteros";
            break;
        }

        $B[] = intval($valor);
    }

    if ($error == "") {

        $sets = new SetOperations();

        $union = $sets->union($A, $B);
        $interseccion = $sets->interseccion($A, $B);
        $difAB = $sets->diferencia($A, $B);
        $difBA = $sets->diferencia($B, $A);

        $resultado = "
            Unión: " . implode(", ", $union) . "<br>
            Intersección: " . implode(", ", $interseccion) . "<br>
            A - B: " . implode(", ", $difAB) . "<br>
            B - A: " . implode(", ", $difBA);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Operaciones con Conjuntos</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<h2>Operaciones con Conjuntos</h2>

<form method="POST">
    <input type="text" name="conjuntoA" placeholder="Ej: 1,2,3,4" required>
    <br>
    <input type="text" name="conjuntoB" placeholder="Ej: 3,4,5,6" required>
    <br>
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