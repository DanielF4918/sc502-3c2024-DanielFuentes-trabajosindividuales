<?php
$transacciones = [];

function registrarTransaccion($id, $descripcion, $monto)
{
    global $transacciones;
    $transaccion = [
        'id' => $id,
        'descripcion' => $descripcion,
        'monto' => $monto
    ];
    array_push($transacciones, $transaccion);
    echo "Transacción registrada: ID {$id}, Descripción: {$descripcion}, Monto: {$monto}\n";
}

function generarEstadoDeCuenta()
{
    global $transacciones;
    $montoContado = 0;

    foreach ($transacciones as $transaccion) {
        $montoContado += $transaccion['monto'];
    }

    $interes = $montoContado * 0.026;
    $montoConInteres = $montoContado + $interes;
    $cashBack = $montoContado * 0.001;
    $montoFinal = $montoConInteres - $cashBack;

    foreach ($transacciones as $transaccion) {
        echo "ID: {$transaccion['id']} - Descripción: {$transaccion['descripcion']} - Monto: {$transaccion['monto']}\n";
    }
    echo "Monto Total de Contado: $montoContado\n";
    echo "Monto Total con Interés (2.6%): $montoConInteres\n";
    echo "Cashback (0.1%): $cashBack\n";
    echo "Monto Final a Pagar: $montoFinal\n";

    $contenido = '';
    foreach ($transacciones as $transaccion) {
        $contenido .= "ID: {$transaccion['id']} - Descripción: {$transaccion['descripcion']} - Monto: {$transaccion['monto']}\n";
    }
    $contenido .= "Monto Total de Contado: $montoContado\n";
    $contenido .= "Monto Total con Interés (2.6%): $montoConInteres\n";
    $contenido .= "Cashback (0.1%): $cashBack\n";
    $contenido .= "Monto Final a Pagar: $montoFinal\n";

    $archivo = fopen("estado_cuenta.txt", "w") or die("¡No se pudo abrir el archivo para escribir!");
    fwrite($archivo, $contenido);
    fclose($archivo);
}

registrarTransaccion(1, "Compra en supermercado", 34658);
registrarTransaccion(2, "Pago de servicios", 10000);
registrarTransaccion(3, "Compra en tienda online", 18700);
registrarTransaccion(4, "Compra en librería", 3500);
registrarTransaccion(5, "Pago de internet", 2500);
registrarTransaccion(6, "Compra de ropa", 10000);
registrarTransaccion(7, "Pago de gimnasio", 5000);
registrarTransaccion(8, "Compra de electrónicos", 25000);
registrarTransaccion(9, "Pago de teléfono móvil", 4500);
registrarTransaccion(10, "Compra en farmacia", 3000);
registrarTransaccion(11, "Pago de suscripción de software", 4000);

generarEstadoDeCuenta();