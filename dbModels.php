<?php
require 'config.php';

$conn = new mysqli($servername, $username, $password);

// Verifica que se pueda conectar con la base de datos.
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


try {
  $newDb = "CREATE DATABASE cafekonecta;

  USE cafekonecta;
  
  CREATE TABLE product_tbl(idProduct INT NOT NULL, nameProduct VARCHAR(30) NOT NULL, refProduct VARCHAR(10) NOT NULL, priceProduct INT NOT NULL, weightProduct INT NOT NULL, catProduct VARCHAR(30) NOT NULL, stockProduct INT NOT NULL, creationProduct DATE DEFAULT NOW() NOT NULL, PRIMARY KEY(idProduct));
  
  CREATE TABLE sales_tbl(idProduct_tbl INT NOT NULL, amountSales INT NOT NULL, totalSales INT NOT NULL, FOREIGN key(idProduct_tbl) REFERENCES product_tbl(idProduct));";
  $conn->multi_query($newDb);
} catch (Exception $e) {
}

$conn->close();

//Fin verificación

function conn()
{
  //Esta función crea la conexión a la BD cuando se requiera.
  global $servername, $username, $password;
  $dbname = "cafekonecta";
  return new mysqli($servername, $username, $password, $dbname);
}

function create($array)
{
  //Esta función registra nuevos productos en la BD. Recibe un arreglo con los datos a registrar.
  $connDb = conn();
  $sql = "INSERT INTO product_tbl (idProduct, nameProduct, refProduct, priceProduct, weightProduct, catProduct, stockProduct)
  VALUES (" . $array[0] . ", '" . strtoupper($array[1]) . "', '" . $array[2] . "', " . $array[3] . ", " . $array[4] . ", '" . strtoupper($array[5]) . "', " . $array[6] . ")";

  if ($connDb->query($sql) === TRUE) {
    echo "<META HTTP-EQUIV='Refresh'
    CONTENT='5; URL=http://127.0.0.1/ptKonecta/index.php'>";
  } else {
    echo "Error: " . $sql . "<br>" . $connDb->error;
  }

  $connDb->close();
}

function read()
{
  //Esta función lista los productos registrados en la base de datos.
  $connDb = conn();
  $sql = "SELECT * FROM product_tbl";
  $result = $connDb->query($sql);
  $connDb->close();
  return $result;
}

function getById($id)
{
  //Esta función recupera los datos de un solo producto. Recibe como parámetro el ID del producto.
  try {
    $connDb = conn();
    $sql = "SELECT nameProduct, refProduct, priceProduct, weightProduct, catProduct, stockProduct FROM product_tbl WHERE idProduct =" . $id . ";";
    $result = $connDb->query($sql);
    if ($result->num_rows > 0) {
    } else {
      $result = false;
    }
  } catch (Exception $e) {
    $result = false;
  }
  $connDb->close();
  return $result;
}

function update($id, $array)
{
  //Esta función actualiza los datos de un solo producto a la vez. Recibe como parámetros el ID del producto y un arreglo con los nuevos datos.
  $connDb = conn();
  $sql = "UPDATE product_tbl SET nameProduct = '" . strtoupper($array[1]) . "', refProduct = '" . $array[2] . "', priceProduct = " . $array[3] . ", weightProduct = " . $array[4] . ", catProduct = '" . strtoupper($array[5]) . "', stockProduct = " . $array[6] . " 
  WHERE idProduct =" . $id . ";";

  if ($connDb->query($sql) === TRUE) {
    echo "<META HTTP-EQUIV='Refresh'
    CONTENT='5; URL=http://127.0.0.1/ptKonecta/index.php'>";
  } else {
    echo "Error: " . $sql . "<br>" . $connDb->error;
  }

  $connDb->close();
}

function deleteP($id)
{
  //Esta función elimina los datos de un solo producto a la vez. Recibe como parámetro el ID del producto.
  $connDb = conn();
  $sql = "DELETE FROM sales_tbl WHERE idProduct_tbl =" . $id . ";
  DELETE FROM product_tbl WHERE idProduct =" . $id . ";";

  if ($connDb->multi_query($sql) === TRUE) {
    echo "<META HTTP-EQUIV='Refresh'
    CONTENT='0; URL=http://127.0.0.1/ptKonecta/index.php'>";
  } else {
    echo "Error: " . $sql . "<br>" . $connDb->error;
  }

  $connDb->close();
}

function sale($id, $newCant, $cant, $total)
{
  //Esta función registra la venta
  $connDb = conn();
  $sql = "UPDATE product_tbl SET stockProduct = " . $newCant . " WHERE idProduct =" . $id . ";
  INSERT INTO sales_tbl (idProduct_tbl, amountSales, totalSales) VALUES (" . $id . ", " . $cant . ", " . $total . ")";

  if ($connDb->multi_query($sql) === TRUE) {
    echo "<META HTTP-EQUIV='Refresh'
    CONTENT='5; URL=http://127.0.0.1/ptKonecta/sales.php'>";
  } else {
    echo "Error: " . $sql . "<br>" . $connDb->error;
  }

  $connDb->close();
}

function hotSale()
{
  //Esta función agrupa los productos por cantidades vendidas.
  $connDb = conn();
  $sql = "SELECT idProduct_tbl as code, SUM(amountSales) as cant FROM sales_tbl GROUP by idProduct_tbl;";
  $result = $connDb->query($sql);
  if ($result->num_rows > 0) {
    $code = "";
    $cant = 0;
    while ($row = $result->fetch_assoc()) {
      if (intval($row['cant']) > $cant) {
        $cant = $row['cant'];
        $code = $row['code'];
      }
    }
    return array($code, $cant);
  } else {
    $result = false;
  }

  $connDb->close();
}

function maxStock()
{
  //Esta función recupera el producto con mayor cantidad en el inventario.
  $connDb = conn();
  $sql = "SELECT idProduct, nameProduct, refProduct, priceProduct, weightProduct, catProduct, MAX(stockProduct) as stockProduct, creationProduct FROM product_tbl;";
  $result = $connDb->query($sql);
  if ($result->num_rows > 0) {
  } else {
    $result = false;
  }

  $connDb->close();
  return $result;
}
