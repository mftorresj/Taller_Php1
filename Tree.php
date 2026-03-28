<?php
class Nodo {
    public $valor;
    public $izq;
    public $der;

    public function __construct($valor) {
        $this->valor = $valor;
        $this->izq = null;
        $this->der = null;
    }
}

class Tree {

    // Construcción usando PREORDEN + INORDEN
    public function construirDesdePreIn($pre, $in) {

        if (empty($pre) || empty($in)) {
            return null;
        }

        $raizValor = $pre[0];
        $raiz = new Nodo($raizValor);

        $index = array_search($raizValor, $in);

        $inIzq = array_slice($in, 0, $index);
        $inDer = array_slice($in, $index + 1);

        $preIzq = array_slice($pre, 1, count($inIzq));
        $preDer = array_slice($pre, 1 + count($inIzq));

        $raiz->izq = $this->construirDesdePreIn($preIzq, $inIzq);
        $raiz->der = $this->construirDesdePreIn($preDer, $inDer);

        return $raiz;
    }

    // Mostrar árbol en forma estructurada
    public function mostrar($nodo, $nivel = 0) {
        if ($nodo == null) return "";

        $resultado = str_repeat("--", $nivel) . $nodo->valor . "<br>";

        $resultado .= $this->mostrar($nodo->izq, $nivel + 1);
        $resultado .= $this->mostrar($nodo->der, $nivel + 1);

        return $resultado;
    }
}

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pre = $_POST["preorden"];
    $in = $_POST["inorden"];

    if (!empty($pre) && !empty($in)) {

        // Convertir texto a array
        $preArray = preg_split("/[\s,→]+/", trim($pre));
        $inArray = preg_split("/[\s,→]+/", trim($in));

        $tree = new Tree();
        $raiz = $tree->construirDesdePreIn($preArray, $inArray);

        $resultado = $tree->mostrar($raiz);

    } else {
        $resultado = "Debe ingresar al menos Preorden e Inorden";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Árbol Binario</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

<div class="container">
    <h2>Construcción de Árbol Binario</h2>

    <form method="POST">
        <textarea name="preorden" placeholder="Ej: A B D E C"></textarea>
        <textarea name="inorden" placeholder="Ej: D B E A C"></textarea>

        <button type="submit">Construir Árbol</button>
    </form>

    <div class="resultado">
        <?php echo $resultado; ?>
    </div>
</div>

</body>
</html>