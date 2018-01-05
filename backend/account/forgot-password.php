<?php
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
$email = $_POST['email'];
try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $sql->bindParam(':email', $email);
    $sql->execute();
    $sql = $sql->fetchAll(PDO::FETCH_ASSOC);


    if (!empty($sql[0]['email'])) {
        $password = $sql[0]['password'];
        $to = $sql[0]['email'];
        $subject = "Your Recovered Password";
        $message = "please use this password to login" . $password;
        $headers = "From : fpetersson96@gmail.com";
        if (mail($to, $subject, $message, $headers)) {
            echo "Your Password has been sent to your email id";
        } else {
            echo "Failed to Recover your password, try again";
        }
    } else {
        echo "User not found!";
    }
} catch (PDOException $e) {
    echo "Database error" . "<br>" . $e->getMessage();
}

$pdo = null;
