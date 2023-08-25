<style>
    body {
        background-image: url(../images/pool.jpg);
        font-family: Arial, sans-serif;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .reservation-details {
        border: 1px solid #fff;
        padding: 20px;
        margin: 20px auto;
        max-width: 600px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
       
    }

    .reservation-details h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    .reservation-details p {
        margin: 10px 0;
    }
    .delete-form {
        border: 1px solid #fff;
        padding: 20px;
        margin: 20px auto;
        max-width: 600px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .delete-form label {
        font-weight: bold;
    }

    .delete-form input[type="submit"] {
        background-color: red;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }
</style>


<?php
if(isset($_GET['ucode'])) {
    $reservation_ucode = $_GET['ucode'];

    include('connection.php'); 

    $sql = "SELECT * FROM reservation WHERE ucode = ?";
    
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $reservation_ucode);
    $stmt->execute();
    $stmt->bind_result($id, $clientName, $clientEmail, $roomType, $phoneNumber, $checkIn, $checkOut, $numOfAdults, $numOfChildren,$room_id,$CIN,$code);
    
    if ($stmt->fetch()) {
        echo '<div class="reservation-details">';
        echo "<h2>Hello dear $clientName</h2>";
        echo "<h2>Reservation Details</h2>";
        echo "<p><strong>Reservation ID:</strong> $id</p>";
        echo "<p><strong>Client Name:</strong> $clientName</p>";
        echo "<p><strong>Client Email:</strong> $clientEmail</p>";
        echo "<p><strong>Room Type:</strong> $roomType</p>";
        echo "<p><strong>Phone Number:</strong> $phoneNumber</p>";
        echo "<p><strong>Date Check-in:</strong> $checkIn</p>";
        echo "<p><strong>Date Check-out:</strong> $checkOut</p>";
        echo "<p><strong>Number of adults:</strong> $numOfAdults</p>";
        echo "<p><strong>Number of children:</strong> $numOfChildren</p>";
        echo "<p><strong>Room Id:</strong> $room_id</p>";
        echo "<p><strong>CIN:</strong> $CIN</p>";
        echo '<div class="delete-form">';
        echo "<form action='delete_reservation.php' method='post'>";
        echo "<input type='hidden' name='reservation_id' value='$id'>";
        echo "<input type='submit' value='Delete Reservation'>";
        echo "</form>";
        echo '</div>';
        echo '</div>';
    } else {
        echo "No reservation found with that code.";
    }

    $con->close();
} else {
    echo "Invalid request.";
}
?>
