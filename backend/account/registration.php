<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// ASSIGN VARIABLE FROM FORM
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$dateofbirth = $_POST['yy'] .'-'. $_POST['mm'] .'-'. $_POST['dd'];

$password = password_hash($password, PASSWORD_BCRYPT);

// CHECK IF USER IS UNIQUE

$stmt = $pdo->prepare("SELECT email FROM users WHERE email=:email");
$stmt->bindParam(':email', $email);
$stmt->execute();

if ($stmt->fetch()) {
    echo "That email already exist!";
} else {
    //INSERT DATA INTO DATABASE
    $sql = "INSERT INTO users ( fullname, password, email, dateofbirth )
  VALUES ( :fullname, :password, :email, :dateofbirth )";

    // EXECUTE AND PREPARE
    $query = $pdo->prepare($sql);
    $result = $query->execute(array(':fullname' => $fullname, ':password' => $password, ':email' => $email, ':dateofbirth' => $dateofbirth));

    //EXECUTE QUERY
    if ($result) {
        $_SESSION['Accountsucess'] = "Account has been added sucessfully.";
        header("location: ../../index");
    } else {
        echo "Error database failure";
    }
}
