<?php
require_once("../functions/validation.php");

if(empty($_POST['email'])){ 
    echo '400';
    return false;
}else
    $fname = validation("fname");
    $lname = validation("lname");
    $email = validation("email");
    echo "Je $fname, $lname en $email is gelukt";

    $servername = "mariadb";
    $user = "milou";
    $password = "createApi";
    $db = "newsletters";
    $dateTime = new DateTime();
    $dateNow = $dateTime->format('Y-m-d H:i:s'); 

    try{
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$db", $user, $password);
        $stmt = $conn->prepare("INSERT INTO user(email, active, create_date, first_name, last_name) VALUES(:email, :active, :create_date, :first_name, :last_name)");
        $stmt->execute([
            ":email" => $email,
            ":active" => 0,
            ":create_date" => $dateNow,
            ":first_name" => $fname,
            ":last_name" => $lname
        ]);
    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    };


$mailRes = mail($email, "Aanmelding nieuwsbrief", "Klik op de link om je te activeren");
var_dump($mailRes);





