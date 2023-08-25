<?php
if(isset($_POST['ucode'])) {
    $entered_ucode = $_POST['ucode'];

    include('connection.php'); // Inclure votre fichier de connexion

    // Requête pour vérifier si le code est valide
    $sql_check_ucode = "SELECT id FROM reservation WHERE ucode = ?";
    $stmt_check_ucode = $con->prepare($sql_check_ucode);
    $stmt_check_ucode->bind_param("s", $entered_ucode);
    $stmt_check_ucode->execute();
    $stmt_check_ucode->store_result();

    if ($stmt_check_ucode->num_rows > 0) {
        // Le code est valide, rediriger vers la page de réservation
        header("Location: view_reservation.php?ucode=$entered_ucode");
        exit();
    } else {
        // Le code est invalide, afficher un message d'erreur
        $error_message = "Invalid code. Please try again.";
    }

    $stmt_check_ucode->close(); // Fermer la déclaration préparée
    $con->close(); // Fermer la connexion à la base de données
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check your reservation</title>
    <style>
        body {
            background-image: url('../images/home_page.jpg');
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border: black solid 1px ;
            backdrop-filter: blur(20px);
            border-radius: 5px;
            background-color: transparent;
            color: black;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="enter_code.php" method="post">
        <label for="reservation_code">Enter your reservation code:</label>
        <input type="text" name="ucode" id="reservation_code" required>
        <input type="submit" value="View Reservation">
    </form>
    
</body>
</html>
