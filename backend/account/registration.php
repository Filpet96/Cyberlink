<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// ASSIGN VARIABLE FROM FORM
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$dateofbirth =  '19'. $_POST['yy'] .'-'. $_POST['mm'] .'-'. $_POST['dd'];

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
    $query = $pdo->prepare($sql);
    $result = $query->execute(array(':fullname' => $fullname, ':password' => $password, ':email' => $email));

    $get_user_id = $pdo->prepare('SELECT userid FROM users WHERE email=:email');
    $get_user_id->execute(array(':email'=>$email));
    $user_id_fetched = $get_user_id->fetch(PDO::FETCH_ASSOC);
    extract($user_id_fetched);
    $user_id = $user_id_fetched['userid'];

    $sql_biography = "INSERT INTO user_biography ( userid, fullname, dateofbirth, email )
VALUES ( :userid, :fullname, :dateofbirth, :email )";

    $query_biography = $pdo->prepare($sql_biography);
    $result_biography = $query_biography->execute(array(':userid' => $user_id, ':fullname' => $fullname, ':dateofbirth' => $dateofbirth, ':email' => $email));

    //EXECUTE QUERY
    if ($result && $result_biography) {
        $_SESSION['Accountsucess'] = "Account has been added sucessfully.";
        header("location: ../../index");
    } else {
        echo "Error database failure";
    }
}
