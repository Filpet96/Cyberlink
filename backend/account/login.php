<?php
declare(strict_types=1);
// If no session already set start session, to prevent error.
if (!isset($_SESSION)) {
    session_start();
}
// Database Connection
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
// Variables from field submitted in the form.
$email = $_POST['email'];
$password = $_POST['password'];


try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Fetch all rows from users where email is submitted email in loginform.
    $loginquery = $pdo->prepare("SELECT * FROM users WHERE email=:email COLLATE NOCASE");
    $loginquery->bindParam(':email', $email);
    $loginquery->execute();
    $loginquery = $loginquery->fetchAll(PDO::FETCH_ASSOC);
    // Check if submitted email exists in the user database.
    if (!empty($loginquery)) {
        // Verified the submitted password to the hashed password in database.
        if (password_verify($password, $loginquery[0]['password'])) {
            $_SESSION['user_id'] = $loginquery[0]['userid'];
            $_SESSION['loggedin'] = $loginquery[0]['email'];
            // $_SESSION['user_dateofbirth'] = $loginquery[0]['dateofbirth'];
            $_SESSION['timestamp'] = time();
            // require loading file to create nice looking loading screen on login.
            require_once 'frontend/templates/loading.php';
        } else {
            echo "Wrong Password!";
        }
    } else {
        echo "Wrong email!";
    }
} catch (PDOException $e) {
    echo "Database error" . "<br>" . $e->getMessage();
}

$pdo = null;
