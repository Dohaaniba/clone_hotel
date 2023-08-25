<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e1688b77c2.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="/YARAY_HOTEL/images/YARAY-removebg-preview.png" type="image/x-icon">
    <title>YARAY</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial;
        }
        body{
            height: 100svh;
            width: 100%;
            display: flex;
            justify-content: center;
            
            background-image: url(../images/pool.jpg);
            backdrop-filter: brightness(.7);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            padding: 8px;

        }
        .booking-validation{
            height: fit-content;
            width: auto;
            margin-top: 30vh;
            background-color: rgba(255, 255, 255, 0.7);
            text-align: center;
            color: black;
            display: flex;
            box-shadow: 5px 5px 5px #00000099;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            border-radius: 5px;
            padding: 15px;
        }
        .booking-validation p{
            font-size: 1.2rem;
            text-align: center;
            color: green;
        }
        .booking-validation > div > a{
            font-size: 1.7rem;
            color: black;
            cursor: pointer;
        }
        .booking-validation p i:nth-child(2){
            font-size: 1.7rem;
           
        }


    </style>

</head>
<body>
    <div class="booking-validation">
        <h2>Registration Validation</h2>
        <p>Room reserved successfully,Please check your email!<br> Thank you</p>
        <div id="link_home">
            <a href="index.html"><i class="fa-solid fa-house"></i></a>
        </div>
    
    </div>
    <script>
        setTimeout(function(){
            window.location.href = "index.html";
          }, 2500);
    </script>
</body>
</html>