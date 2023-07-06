<?php
include 'template.php';
require 'dbModels.php';
require 'checkers.php';
startP('Prueba Konecta - Actualizar');

$product = null;

// Acá se recupera el producto para cargarlo en el formulario
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product = getById($_GET['id']);

    if ($product != false) {
        $product = $product->fetch_assoc();
    }
}

// Lógica para cargar la información enviada en el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dataPost = chk();
    if ($dataPost != false) {
        if (getById($dataPost[0]) != false) {

            update(trim($_GET['id']), $dataPost);
            echo '<p style="color:green;">Producto actualizado .</p>';
            echo "<META HTTP-EQUIV='Refresh' CONTENT='5; URL=http://127.0.0.1/ptKonecta/index.php'>";
        } else {
            echo '<p style="color:red;">El código ingresado ya está en uso.</p>';
        }
    } else {
        echo '<p style="color:red;">No se han podido procesar los datos enviados.</p>';
    }
}
//Vista del formulario para actualizar productos
?>

<div class="container">
    <form class="row g-3 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".trim($_GET['id']); ?>" method="POST">
        <h2 class="text-center">Datos del Producto</h2>
        <div class="col-12 col-md-4">
            <label for="code" class="form-label">Código</label>
            <input type="hidden" name="code" value="<?php echo intval($_GET['id']); ?>">
            <input type="number" class="form-control" id="code" min="0" value="<?php echo intval($_GET['id']); ?>" disabled required>
            <div class="invalid-feedback">
                Por favor ingrese solo números.
            </div>
        </div>
        <div class="col-12 col-md-4">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo trim($product['nameProduct']); ?>" required>
            <div class="invalid-feedback">
                El nombre solo puede contener letras, espacios o guiones al medio [-].
            </div>
        </div>
        <div class="col-12 col-md-4">
            <label for="ref" class="form-label">Referencia</label>
            <input type="text" class="form-control" id="ref" name="ref" value="<?php echo trim($product['refProduct']); ?>" required>
            <div class="invalid-feedback">
                El código de referencia solo puede estar conformado por números y/o letras.
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" min="0" value="<?php echo trim($product['priceProduct']); ?>" required>
            <div class="invalid-feedback">
                El precio no puede ser una cantidad decimal.
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="weight" class="form-label">Peso</label>
            <input type="number" class="form-control" id="weight" name="weight" min="0" value="<?php echo trim($product['weightProduct']); ?>" required>
            <div class="invalid-feedback">
                El peso no puede ser una cantidad decimal.
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="category" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="category" name="category" value="<?php echo trim($product['catProduct']); ?>" required>
            <div class="invalid-feedback">
                La categoría solo puede contener letras.
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="stock" class="form-label">Cantidad en inventario</label>
            <input type="number" class="form-control" id="stock" name="stock" min="0" value="<?php echo trim($product['stockProduct']); ?>" required>
            <div class="invalid-feedback">
                La cantidad solo se puede ingresar en números y la mínima es 0.
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-success" type="submit">Actualizar</button>
            <a href="http://127.0.0.1/ptKonecta/index.php" class="btn btn-danger">Cancelar</a>
        </div>
    </form>

</div>

<?php
endP('<script src="./js/checker.js"></script>');
?>