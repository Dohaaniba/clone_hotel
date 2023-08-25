<?php
session_start();
include('connection.php');
 

// Récupération des données du formulaire
$dateCheckIn = $_POST['date1'];
$dateCheckOut = $_POST['date2'];
$typeChambre = $_POST['choose_room'];
$nbAdultes = $_POST['choose_adult'];
$nbEnfants = $_POST['choose_child'];


if ($dateCheckIn  < $dateCheckOut && $dateCheckIn  >= date('Y-m-d')) {
    // checking the data and comparing
    $sql = " SELECT id_room FROM roomshotel
    WHERE room_type = '$typeChambre'
    AND adults >= '$nbAdultes'
    AND children >= '$nbEnfants'
    AND id_room NOT IN (
        SELECT id_room FROM reserved_rooms
        WHERE ((room_reserved_check_in <= '$dateCheckIn' AND room_reserved_check_in >= '$dateCheckOut') 
        OR (room_reserved_check_out >= '$dateCheckIn' AND room_reserved_check_out <= '$dateCheckOut' )
        OR (room_reserved_check_out >= '$dateCheckIn' AND room_reserved_check_out >= '$dateCheckOut' ))
    )";
    // Exécution de la requête SQL pour vérifier la disponibilité des chambres
$result = $con->query($sql);

// Vérification si la requête s'est exécutée avec succès
    if ($result) {
    // Compter le nombre de lignes dans le résultat
    $numRows = $result->num_rows;

    // Afficher un message en fonction des résultats de la requête
        if ($numRows > 0) {
            header('location:valide.php?');
        } else {
          echo "Désolé, aucune chambre n'est disponible pour les informations que vous avez saisies.";
        }

    // Libérer la mémoire utilisée par le résultat de la requête
 
    }
$result->free();
} else {
    // Afficher un message si la requête n'a pas été exécutée avec succès
    echo "La requête n'a pas été exécutée.";
}
?>




