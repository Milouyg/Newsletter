<?php
if(empty($_POST['email'])){
    echo '400';
    return false;
}else
    $fname = validation("fname");
    $lname = validation("lname");
    $email = validation("email");
    echo "Je $fname, $lname en $email is gelukt";

    $servername = "localhost";
    $user = "milou";
    $password = "createApi";
    $db = "newsletters";

    try{
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$db", $user, $password);
        $stmt = $conn->prepare("INSERT INTO user(email, active, create_date, first_name, last_name) VALUES(:email, :active, :create_date, :first_name, :last_name)");
        $stmt->execute([
            ":email" => $email,
            ":active" => false,
            ":create_date" => new DateTime("now"),
            ":first_name" => $fname,
            ":last_name" => $lname
        ]);
    } catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
    };

function validation($value){
    if(isset($_POST[$value]) && !empty($_POST[$value])){
        if($value === "fname" || $value === "lname"){
            $filter = htmlspecialchars($_POST[$value]);
            $filter = trim($_POST[$value]);
            $filter = preg_replace('/\s+/', '', $_POST[$value]);
        }
        if($value === "email"){
            $filter = filter_var($_POST[$value],  FILTER_VALIDATE_EMAIL); 
        }
        return $filter;
        
    }else{
        return false;
    }
}





