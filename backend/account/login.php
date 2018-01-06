<?php
if (!isset($_SESSION)) {
    session_start();
}
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";
// ASSIGN VARIABLE FROM FORM
$email = $_POST['email'];
$password = $_POST['password'];

$loginquery = $pdo->prepare("SELECT * FROM users WHERE email=:email COLLATE NOCASE");
$loginquery->bindParam(':email', $email);
$loginquery->execute();
$loginquery = $loginquery->fetchAll(PDO::FETCH_ASSOC);
if (!empty($loginquery)) {
    if (password_verify($password, $loginquery[0]['password'])) {
        $_SESSION['user_id'] = $loginquery[0]['userid'];
        $_SESSION['loggedin'] = $loginquery[0]['email'];
        // $_SESSION['user_dateofbirth'] = $loginquery[0]['dateofbirth'];
        $_SESSION['timestamp'] = time();
        require_once 'frontend/templates/loading.php';
    } else {
        echo "Invalid Password!";
    }
} else {
    echo "Invalid email!";
}
