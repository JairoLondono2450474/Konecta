<?php
function chk() {
    /*Esta función valida que la información recibida no sea diferente a la que espera la BD y retorna falso en caso de no concordar
    con los parámetros mínimos o al detectar posible inyección de código caso contrario retorna un arreglo con la información ya
    formateada lista para registrar en la BD. */
    $code = $name = $ref = $price = $weight = $category = $stock = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $code = test_input($_POST["code"]);
        $name = test_input($_POST["name"]);
        $ref = test_input($_POST["ref"]);
        $price = test_input($_POST["price"]);
        $weight = test_input($_POST["weight"]);
        $category = test_input($_POST["category"]);
        $stock = test_input($_POST["stock"]);

        $numbers = array($code, $price, $weight, $stock);

        foreach ($numbers as $data) {
            if (!isnum($data)){
                return false;
            }
        }        
        if (!preg_match("/^[a-zA-Z- ]*$/",$name) or empty($name)) {
            return false;
        }
        if (!preg_match("/^[a-zA-Z- ]*$/",$category) or empty($category)) {
            return false;
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/",$ref) or empty($ref)) {
            return false;
        }
        return array($code, $name, $ref, $price, $weight, $category, $stock);
    }
}


function test_input($data) {
    /*Esta función da formato a la información limpiando espacios en blanco y desenmascarando posible inyección de código. Recibe como parámetro un String.*/
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function isnum($data) {
    /*Esta función verifica que el dato corresponda solamente a números. Recibe como parámetro un String.*/
    if (!preg_match("/^[0-9]*$/",$data) or empty($data)) {
        return false;
    }
    return true;
}