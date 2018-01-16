<?php
declare(strict_types=1);
if (!isset($_SESSION)) {
    session_start();
}
 error_reporting(~E_NOTICE);
 include $_SERVER["DOCUMENT_ROOT"] . "/system/connection.php";

 $email = $_SESSION['loggedin'];
 $user_id = $_SESSION['user_id'];


     $stmt_edit = $pdo->prepare('SELECT userPic FROM users WHERE userid=:userid');
     $stmt_edit->execute(array(':userid'=>$user_id));
     $edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
     extract($edit_row);

 if (isset($_FILES['user_image'])) {
     $imgFile = $_FILES['user_image']['name'];
     $tmp_dir = $_FILES['user_image']['tmp_name'];
     $imgSize = $_FILES['user_image']['size'];

     if ($imgFile) {
         $upload_dir = '../../frontend/user_images/'; // upload directory
   $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
   $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
   $userpic = $user_id.".".$imgExt;
         if (in_array($imgExt, $valid_extensions)) {
             if ($imgSize < 5000000) {
                 if (!empty($edit_row['userPic'])) {
                     unlink($upload_dir.$edit_row['userPic']);
                 }
                 move_uploaded_file($tmp_dir, $upload_dir.$userpic);
             } else {
                 $errMSG = "Sorry, your file is too large it should be less then 5MB";
             }
         } else {
             $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
         }
     } else {
         // if no image selected the old image remain as it is.
   $userpic = $edit_row['userPic']; // old image from database
     }


     // if no error occured, continue ....
     if (!isset($errMSG)) {
         $stmt = $pdo->prepare('UPDATE users
              SET userPic=:upic
               WHERE userid=:userid');
         $stmt->bindParam(':userid', $user_id);
         $stmt->bindParam(':upic', $userpic);
         if ($stmt->execute()) {
             $_SESSION['Image_Updated'] = "Successfully Updated ...";
             header("location: ../../profile-settings");
         } else {
             $errMSG = "Sorry Data Could Not Updated !";
         }
     }
 }
