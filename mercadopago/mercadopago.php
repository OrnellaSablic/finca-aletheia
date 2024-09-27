<?php

require 'lib/vendor/autoload.php';
require_once 'credenciales-mp.php';

MercadoPago\SDK::setAccessToken($access_token);
    if (!$_SESSION['carrito']) {
        $_SESSION['carrito'] = array();
    }else{

if (isset($_SESSION['carrito'])) {
    foreach ($_SESSION['carrito'] as $indice => $producto) {

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();

    $item->title = $producto['nombre_producto'];
    $item->quantity = intval($producto['cantidad']);
    $item->unit_price = intval($producto['precio']);
   
    $preference->back_urls = array(
        "success" => "http://localhost/finca-aletheia/index.php",
        "failure" => "http://localhost/finca-aletheia/index.php",
        "pending" => "http://localhost/finca-aletheia/index.php"
    );

    $items[] = $item; 
};
    $preference->items = $items;
    
    $preference->save();

    var_dump($preference->save());

    }
}

// MercadoPago\SDK::setAccessToken($access_token);

// if (!isset($_SESSION['carrito'])) {
//     $_SESSION['carrito'] = array();
// }

// if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {

//     // Crea un objeto de preferencia
//     $preference = new MercadoPago\Preference();

//     foreach ($_SESSION['carrito'] as $indice => $producto) {
//         // Crea un ítem en la preferencia
//         $item = new MercadoPago\Item();
//         $item->title = $producto['nombre_producto'];
//         $item->quantity = intval($producto['cantidad']);
//         $item->unit_price = intval($producto['precio']);
//         $items[] = $item; 
//     }

//     // Añade los ítems a la preferencia
//     $preference->items = $items;

//     $preference->back_urls = array(
//         "success" => "http://localhost/finca-aletheia/index.php",
//         "failure" => "http://localhost/finca-aletheia/index.php",
//         "pending" => "http://localhost/finca-aletheia/index.php"
//     );

//     $preference->save();

//     echo "<pre>";
//     var_dump($preference->save());
//     echo "<pre>";
// }
