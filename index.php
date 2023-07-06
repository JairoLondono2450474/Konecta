<?php
include 'template.php';
startP('Prueba Konecta - Inicio');
?>
<div class="container-fluid">
    <div class="container mt-3">
        <a href="http://127.0.0.1/ptKonecta/sales.php" class='btn btn-warning'>Vender</a>
        <div class="row mt-3">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-create-tab" data-bs-toggle="tab" data-bs-target="#nav-create" type="button" role="tab" aria-controls="nav-create" aria-selected="true">Crear Producto</button>
                        <button class="nav-link" id="nav-products-tab" data-bs-toggle="tab" data-bs-target="#nav-products" type="button" role="tab" aria-controls="nav-products" aria-selected="false">Productos</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-create" role="tabpanel" aria-labelledby="nav-create-tab" tabindex="0">
                        <?php
                        //Lógica para el manejo de la información cuando el usuario envía el formulario
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            require 'checkers.php';
                            require 'dbModels.php';
                            $dataPost = chk();
                            if ($dataPost != false) {
                                if (getById($dataPost[0]) == false) {

                                    create($dataPost);
                                    echo '<p style="color:green;">Producto añadido.</p>';
                                } else {
                                    echo "<META HTTP-EQUIV='Refresh' CONTENT='5; URL=http://127.0.0.1/ptKonecta/index.php'>";
                                    echo '<p style="color:red;">El código ingresado ya está en uso.</p>';
                                }
                            } else {
                                echo '<p style="color:red;">No se han podido procesar los datos enviados.</p>';
                            }
                        }
                        ?>
                        <form class="row g-3 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <h2 class="text-center">Datos del Producto</h2>
                            <div class="col-12 col-md-4">
                                <label for="code" class="form-label">Código</label>
                                <input type="number" class="form-control" id="code" name="code" min="0" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese solo números.
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                                <div class="invalid-feedback">
                                    El nombre solo puede contener letras, espacios o guiones al medio [-].
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="ref" class="form-label">Referencia</label>
                                <input type="text" class="form-control" id="ref" name="ref" required>
                                <div class="invalid-feedback">
                                    El código de referencia solo puede estar conformado por números y/o letras.
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="price" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="price" name="price" min="0" required>
                                <div class="invalid-feedback">
                                    El precio no puede ser una cantidad decimal.
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="weight" class="form-label">Peso</label>
                                <input type="number" class="form-control" id="weight" name="weight" min="0" required>
                                <div class="invalid-feedback">
                                    El peso no puede ser una cantidad decimal.
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="category" class="form-label">Categoría</label>
                                <input type="text" class="form-control" id="category" name="category" required>
                                <div class="invalid-feedback">
                                    La categoría solo puede contener letras.
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <label for="stock" class="form-label">Cantidad en inventario</label>
                                <input type="number" class="form-control" id="stock" name="stock" min="0" required>
                                <div class="invalid-feedback">
                                    La cantidad solo se puede ingresar en números y la mínima es 0.
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">Crear</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab" tabindex="0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Código Referencia</th>
                                    <th>Precio</th>
                                    <th>Peso (g/oz)</th>
                                    <th>Categoría</th>
                                    <th>Cantidad Disponible</th>
                                    <th>Fecha de Creación</th>
                                    <th>Opciones </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Lógica para recuperar y listar los productos registrados en la base de datos
                                require 'dbModels.php';
                                $rows = read();
                                if ($rows->num_rows > 0) {
                                    while ($row = $rows->fetch_assoc()) {
                                        echo "<tr>
                                        <td>" . $row['idProduct'] . "</td>
                                        <td>" . $row['nameProduct'] . "</td>
                                        <td>" . $row['refProduct'] . "</td>
                                        <td>" . $row['priceProduct'] . "</td>
                                        <td>" . $row['weightProduct'] . "</td>
                                        <td>" . $row['catProduct'] . "</td>
                                        <td>" . $row['stockProduct'] . "</td>
                                        <td>" . $row['creationProduct'] . "</td>
                                        <td>
                                            <a href='delete.php?id=" . $row['idProduct'] . "' class='btn btn-danger'>Eliminar</a> 
                                            <a href='update.php?id= " . $row['idProduct'] . "' class='btn btn-success'>Modificar</a>
                                        </td>
                                        </tr>";
                                    }
                                    echo "</tbody>
                                        </table>";
                                } else {
                                    echo "</tbody>
                                        </table>
                                        <p>No hay productos registrados</p>";
                                }
                                ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
endP('<script src="./js/checker.js"></script>');
?>