<?php
include 'template.php';
require 'dbModels.php';

startP('Prueba Konecta - Eliminar');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $product = getById($_GET['id']);

    if ($product != false) {
        $product = $product->fetch_assoc();
    }
    echo '
    <div class="container">
    <form class="row g-3 needs-validation" novalidate action="'. htmlspecialchars($_SERVER["PHP_SELF"]).'?id='.trim($_GET['id']) .'" method="POST">
        <h2 class="text-center">Datos del Producto</h2>
        <p>Seguro de que quiere eliminar este producto esta acción no se puede deshacer</p>
        <div class="col-12 col-md-4">
            <label for="code" class="form-label">Código</label>
            <input type="hidden" name="code" value="'. intval($_GET['id']) .'">
            <input type="number" class="form-control" id="code" min="0" value="'. intval($_GET['id']) .'" disabled required>
            <div class="invalid-feedback">
                Por favor ingrese solo números.
            </div>
        </div>
        <div class="col-12 col-md-4">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="'.  trim($product['nameProduct']) .'" disabled required>
            <div class="invalid-feedback">
                El nombre solo puede contener letras, espacios o guiones al medio [-].
            </div>
        </div>
        <div class="col-12 col-md-4">
            <label for="ref" class="form-label">Referencia</label>
            <input type="text" class="form-control" id="ref" name="ref" value="'.  trim($product['refProduct']) .'" disabled required>
            <div class="invalid-feedback">
                El código de referencia solo puede estar conformado por números y/o letras.
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" min="0" value="'.  trim($product['priceProduct']) .'" disabled required>
            <div class="invalid-feedback">
                El precio no puede ser una cantidad decimal.
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="weight" class="form-label">Peso</label>
            <input type="number" class="form-control" id="weight" name="weight" min="0" value="'.  trim($product['weightProduct']) .'" disabled required>
            <div class="invalid-feedback">
                El peso no puede ser una cantidad decimal.
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="category" class="form-label">Categoría</label>
            <input type="text" class="form-control" id="category" name="category" value="'.  trim($product['catProduct']) .'" disabled required>
            <div class="invalid-feedback">
                La categoría solo puede contener letras.
            </div>
        </div>
        <div class="col-6 col-md-3">
            <label for="stock" class="form-label">Cantidad en inventario</label>
            <input type="number" class="form-control" id="stock" name="stock" min="0" value="'. trim($product['stockProduct']) .'" disabled required>
            <div class="invalid-feedback">
                La cantidad solo se puede ingresar en números y la mínima es 0.
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-danger" type="submit">Eliminar</button>
            <a href="http://127.0.0.1/ptKonecta/index.php" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>

</div>';
       
}elseif ($_SERVER["REQUEST_METHOD"] == "POST"){

    deleteP(trim($_GET['id'])); 
}

endP();
?>