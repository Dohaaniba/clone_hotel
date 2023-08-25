<?php
        use PHPMailer\PHPMailer\PHPMailer;
        require_once '/xampp/htdocs/hotel/PHPMailer/src/Exception.php';
        require_once '/xampp/htdocs/hotel/PHPMailer/src/SMTP.php';
        require_once '/xampp/htdocs/hotel/PHPMailer/src/PHPMailer.php';
        // Retrieve reservation details from the form
include('connection.php');


$clientName = $_POST['client_name'];
$clientEmail = $_POST['client_email'];
$roomType = $_POST['room_tyme'];
$phoneNumber = $_POST['phone_number'];
$checkIn = $_POST['check_in'];
$checkOut = $_POST['check_out'];
$numOfAdults = $_POST['number_of_adults'];
$numOfChildren = $_POST['number_of_children'];
$CIN = $_POST['CIN'];

        
        // Check the connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        if ($checkIn < $checkOut && $checkIn >= date('Y-m-d')) {
            
                // Check if there is an available room for the specified date and room type
                $sql_check_room = "SELECT id_room FROM roomshotel
                WHERE id_room NOT IN (
                    SELECT id_room FROM reserved_rooms
                    WHERE ((room_reserved_check_in <= '$checkIn' AND room_reserved_check_in >= '$checkOut') 
                    OR (room_reserved_check_out >= '$checkIn' AND room_reserved_check_out <= '$checkOut' )
                    OR (room_reserved_check_out >= '$checkIn' AND room_reserved_check_out >= '$checkOut' ))
                )
                LIMIT 1";

                $result_check_room = $con->query($sql_check_room);
                $row_check_room = $result_check_room->fetch_assoc();
                echo $row_check_room['id_room'];
                echo "<br>";
                if ($result_check_room->num_rows >= 1) {
                    // There are enough available rooms, proceed with reservation
                    $room_id = $row_check_room['id_room'];
                    $code = rand(100000000 , 999999999);//the unique code
                    $sql_codes = "SELECT ucode FROM reservation ";
                    $sql_codes_results = $con->query($sql_codes);
                    $existing_codes = array();
                    while ($row_check_codes = $sql_codes_results->fetch_assoc()) {
                        $existing_codes[] = $row_check_codes['ucode'];
                    }
                    while (in_array($code, $existing_codes)) {
                        
                        $code = rand(100000000, 999999999);
                    }
                    // Insert reservation details into reservation table
                    $sql = "INSERT INTO reservation (client_name, client_email, room_type, phone_number, check_in, check_out, number_of_adults, number_of_children, room_id ,cin,ucode)
                            VALUES ('$clientName', '$clientEmail', '$roomType', $phoneNumber, '$checkIn', '$checkOut', $numOfAdults, $numOfChildren, $room_id,'$CIN' ,$code)";
                    $result = $con->query($sql);

                    if ($result) {
                        // Update the room reservation dates in the rooms table
                        $sql2 = "INSERT INTO reserved_rooms (id_room,room_reserved_check_in,room_reserved_check_out ,ucode) VALUES ('$room_id','$checkIn','$checkOut','$code')";
                        $result2 = $con->query($sql2);

                        if ($result2) {
                            echo 'La chambre est réservée avec succée! <i class="fa-solid fa-circle-check"></i> ';
            
                            // Create a new PHPMailer instance
                            $mail = new PHPMailer(true);

                            // SMTP configuration
                            $mail->isSMTP();
                            $mail->Host = 'smtp.gmail.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'anibadoha9@gmail.com';
                            $mail->Password = 'kirbsqyxsirzlmrs';
                            $mail->SMTPSecure = 'tls';
                            $mail->Port = 587;

                            // Sender and recipient settings
                            $mail->setFrom('anibadoha9@gmail.com');
                            $mail->addAddress($_POST['client_email']);

                            // Email content
                            $mail->isHTML(true);
                            $mail->Subject = 'Hotel Reservation Confirmation';
                            $mail->Body = 'Chér(e) ' . $_POST['client_name'] . ',<br><br>Merci pour votre réservation. Votre unique code est ' . $code . '.<br><br>Enjoy <br> Gérant Mohamed';
                            
                            // Send email
                            if ($mail->send()) {
                                echo 'Email envoyé avec succée';
                                header('location:succe.html?');

                            } else {
                                $mail->ErrorInfo;
                                echo 'Erreur lors de lenvoie';
                            }


                        } else {
                            echo "erreur lors de l insertion en reserverd_rooms .";
                        }
                    } else {
                        echo "erreur lors de l insertion de l affichage des detailles .";
                    }
                } else {
                    echo 'Desolée aucune chambre n est disponible pour les informations que vous avez entré <i style="color:red;" class="fa-solid fa-circle-exclamation"></i>';
                    header('location:failure.html?');
                }
        }else{
            echo "invalide date !";
        }
        $con->close();
    ?>
   