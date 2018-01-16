<?php
declare(strict_types=1);
if (!isset($_SESSION)) {
    session_start();
}
include($_SERVER["DOCUMENT_ROOT"] . "/system/connection.php");



try {
    if (isset($_POST["biography"])) {
        $email = $_SESSION['loggedin'];
        $user_id = $_SESSION['user_id'];
        $dateofbirth = $_POST['dateofbirth'];
        $country = $_POST['country'];
        $gender = $_POST['gender'];
        $fullname = $_POST['fullname'];

        $update_biography = $pdo->prepare("UPDATE user_biography SET fullname = :fullname, dateofbirth = :dateofbirth, country = :country, gender = :gender WHERE userid=:user_id");

        $update_biography->bindParam(':fullname', $fullname);
        $update_biography->bindParam(':dateofbirth', $dateofbirth);
        $update_biography->bindParam(':country', $country);
        $update_biography->bindParam(':gender', $gender);
        $update_biography->bindParam(':user_id', $user_id);
        $result = $update_biography->execute();

        if ($result) {
            header("location: ../../profile-settings");
        }
    }
} catch (PDOException $e) {
    echo "Database error" . "<br>" . $e->getMessage();
}

$pdo = null;
