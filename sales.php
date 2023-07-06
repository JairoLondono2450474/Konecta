<?php
include 'template.php';
startP('Prueba Konecta - Ventas');
?>
<div class="container-fluid">
    <div class="container mt-3">
        <a href="http://127.0.0.1/ptKonecta/index.php" class='btn btn-secondary'>Inicio</a>
        <div class="row mt-3">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-sales-tab" data-bs-toggle="tab" data-bs-target="#nav-sales" type="button" role="tab" aria-controls="nav-create" aria-selected="true">Vender Producto</button>
                        <button class="nav-link" id="nav-hotSale-tab" data-bs-toggle="tab" data-bs-target="#nav-hotSale" type="button" role="tab" aria-controls="nav-hotSale" aria-selected="false">Producto más vendido</button>
                        <button class="nav-link" id="nav-moreStock-tab" data-bs-toggle="tab" data-bs-target="#nav-moreStock" type="button" role="tab" aria-controls="nav-moreStock" aria-selected="false">Producto con más Stock</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-sales" role="tabpanel" aria-labelledby="nav-create-tab" tabindex="0">
                        <?php
                        //Lógica para realizar la venta y determinar si hay stock suficiente.
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            require 'dbModels.php';
                            require 'checkers.php';
                            $code = test_input($_POST["code"]);
                            $cant = test_input($_POST["cant"]);
                            $sale = getById($code);

                            if ($sale != false) {

                                $sale = $sale->fetch_assoc();

                                if ($sale['stockProduct'] > $cant){

                                    sale($code, (intval($sale['stockProduct']) - $cant), $cant, ($cant*intval($sale['priceProduct'])));
                                    echo "<META HTTP-EQUIV='Refresh' CONTENT='5; URL=http://127.0.0.1/ptKonecta/sales.php'>";
                                    echo '<p style="color:green;">Venta realizada.</p>';
                                }else{

                                    echo "<META HTTP-EQUIV='Refresh' CONTENT='5; URL=http://127.0.0.1/ptKonecta/sales.php'>";
                                    echo '<p style="color:red;">No se puede realizar la venta no hay suficiente Stock.</p>';
                                }
                            } else {
                                echo "<META HTTP-EQUIV='Refresh' CONTENT='5; URL=http://127.0.0.1/ptKonecta/sales.php'>";
                                echo '<p style="color:red;">El código ingresado no se pudo encontrar.</p>';
                            }
                        }

                        ?>
                        <form class="row g-3 needs-validation" novalidate action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <h2 class="text-center">Datos del Producto</h2>
                            <div class="col-6">
                                <label for="code" class="form-label">Código</label>
                                <input type="number" class="form-control" id="code" name="code" min="0" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese solo números.
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="price" class="form-label">Cantidad por vender</label>
                                <input type="number" class="form-control" id="cant" name="cant" min="0" value="<?php echo trim($product['priceProduct']); ?>" required>
                                <div class="invalid-feedback">
                                    El precio no puede ser una cantidad decimal.
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-success" type="submit">Vender</button>
                                <a href="http://127.0.0.1/ptKonecta/sales.php" class="btn btn-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="nav-hotSale" role="tabpanel" aria-labelledby="nav-hotSale-tab" tabindex="0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Cantidad Vendida</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Lógica para recuperar el producto más vendido
                                require 'dbModels.php';
                                $hotS = hotSale();
                                if ($hotS != false) {
                                        echo "<tr>
                                        <td>" . $hotS[0] . "</td>
                                        <td>" . $hotS[1] . "</td>
                                        </tr>";
                                        echo "</tbody>
                                            </table>";
                                    }else {
                                    echo "</tbody>
                                        </table>
                                        <p>No hay productos registrados</p>";
                                }
                                ?>

                    </div>
                    <div class="tab-pane fade" id="nav-moreStock" role="tabpanel" aria-labelledby="nav-moreStock-tab" tabindex="0">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Lógica para recuperar el producto con mayor cantidad en el inventario.
                                $rows = maxStock();
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