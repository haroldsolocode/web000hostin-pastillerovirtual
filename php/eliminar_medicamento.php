<?php
// eliminar_medicamento.php

include('conexion.php');

// Obtener el ID del medicamento a eliminar
$id_medicamento = isset($_GET['id']) ? $_GET['id'] : null;

// Utilizar una transacción para asegurar consistencia en la base de datos
$conexion->begin_transaction();

try {
    // Eliminar las alarmas asociadas
    $query_eliminar_alarmas = "DELETE FROM alarmas WHERE id_medicamento = ?";
    $stmt_eliminar_alarmas = $conexion->prepare($query_eliminar_alarmas);
    $stmt_eliminar_alarmas->bind_param("i", $id_medicamento);
    $stmt_eliminar_alarmas->execute();

    // Eliminar el medicamento
    $query_eliminar_medicamento = "DELETE FROM medicamentos WHERE id_medicamento = ?";
    $stmt_eliminar_medicamento = $conexion->prepare($query_eliminar_medicamento);
    $stmt_eliminar_medicamento->bind_param("i", $id_medicamento);
    $stmt_eliminar_medicamento->execute();

    // Confirmar la transacción
    $conexion->commit();

    // Redireccionar o mostrar un mensaje de éxito
    echo "<meta http-equiv='refresh' content='1; url=/PASTI/php/14-registroMedicamentoCRUD.php'>";
    exit();
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $conexion->rollback();
    echo "Error al eliminar el medicamento: " . $e->getMessage();
}
?>
