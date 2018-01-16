<?php
declare(strict_types=1);
// Database Connection
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
// Variables
$email = $_POST['email'];


try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all rows from table users with same email as loggedin user.
    $sql = $pdo->prepare("SELECT * FROM users WHERE email=:email");
    $sql->bindParam(':email', $email);
    $sql->execute();
    $sql = $sql->fetchAll(PDO::FETCH_ASSOC);

    // Check if there is a row with submitted email.
    // If no email found echo "User not found"
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
