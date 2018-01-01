<?php
if (!isset($_SESSION)) {
    session_start();
}
include($_SERVER["DOCUMENT_ROOT"] . "/system/connection.php");


$email = $_SESSION['loggedin'];
$id    = $_SESSION['user_id'];

$account_info = $pdo->prepare("SELECT * FROM users WHERE email=:email");
$account_info->bindParam(':email', $email);
$account_info->execute();
$account_info = $account_info->fetchAll(PDO::FETCH_ASSOC);

try {
    if (isset($_POST["update_account"])) {
        $old_email = $_POST['email'];
        $new_email = $_POST['email'];
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        if (!empty($new_password) && strlen($new_password) < 6) {
            $_SESSION['Password_Email_Changed'] = "ERROR Password must be atleast 6 characters.";
            exit;
        }

        if ($new_email !== $email) {
            $update_email = $pdo->prepare("UPDATE users, votes, user_biography, posts SET email = :email_new WHERE email=:email");
            $update_email->bindParam(':email_new', $old_email);
            $update_email->bindParam(':email', $email);
            $update_result_email = $update_email->execute();
            if ($update_result_email && $update_result) {
                $_SESSION['Password_Email_Changed'] = "Password and email has been updated.";
                header("location: ../../account-settings");
                exit;
            }
            if ($update_result_email) {
                $_SESSION['Email_Changed'] = "Email has been updated.";
                header("location: ../../account-settings");
                exit;
            }
        }
        if (!empty($old_password) && !empty($new_password)) {
            $new_password = password_hash($new_password, PASSWORD_BCRYPT);
            if (password_verify($old_password, $account_info[0]['password']) && !empty($new_password)) {
                $update_password = $pdo->prepare("UPDATE users SET password = :new_password WHERE email=:email");
                $update_password->bindParam(':new_password', $new_password);
                $update_password->bindParam(':email', $email);
                $update_result = $update_password->execute();
                if ($update_result) {
                    $_SESSION['Password_Changed'] = "Password has been changed.";
                    header("location: ../../account-settings");
                    exit;
                }
            } else {
                $_SESSION['Wrong_Password'] = "Wrong Password, try again.";
                header("location: ../../account-settings");
                exit;
            }
        }




        header("location: ../../account-settings");
    }
} catch (PDOException $e) {
    echo "Database error" . "<br>" . $e->getMessage();
}

$pdo = null;
