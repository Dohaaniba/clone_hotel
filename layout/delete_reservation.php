<?php
if(isset($_POST['reservation_id'])) {
    $reservation_id = $_POST['reservation_id'];

    include('connection.php'); 

    // Supprimez la réservation de la table reservation
    $sql_delete_reservation = "DELETE FROM reservation WHERE id = ?";
    $stmt_delete_reservation = $con->prepare($sql_delete_reservation);
    $stmt_delete_reservation->bind_param("i", $reservation_id);

    if ($stmt_delete_reservation->execute()) {
        // Supprimez également l'entrée de la réservation de la table reserved_rooms
        $sql_delete_reserved_room = "DELETE FROM reserved_rooms WHERE id_room = ?";
        $stmt_delete_reserved_room = $con->prepare($sql_delete_reserved_room);
        $stmt_delete_reserved_room->bind_param("i", $reservation_id);
        $stmt_delete_reserved_room->execute();

        header('location:delete_succes.php?');
    } else {
        echo "Error deleting reservation: " . $stmt_delete_reservation->error;
    }

    $con->close();
} else {
    echo "Invalid request.";
}
?>
