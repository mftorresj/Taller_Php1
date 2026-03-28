<?php
class Acronym {

    public function generar($texto) {
        $texto = str_replace('-', ' ', $texto);
        $texto = preg_replace("/[^a-zA-Z ]/", "", $texto);
        $palabras = explode(" ", $texto);
        $acronimo = "";

        foreach ($palabras as $palabra) {
            if (!empty($palabra)) {
                $acronimo .= strtoupper($palabra[0]);
            }
        }

        return $acronimo;
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $texto = $_POST["texto"];

    $obj = new Acronym();
    $resultado = $obj->generar($texto);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Generador de Acrónimos</title>
</head>
<body>

<h2>Generador de Acrónimos</h2>

<form method="POST">
    <input type="text" name="texto" placeholder="Ingrese una frase" required>
    <button type="submit">Generar</button>
</form>

<?php if ($resultado != ""): ?>
    <h3>Resultado: <?php echo $resultado; ?></h3>
<?php endif; ?>

</body>
</html>