<?php

use App\Database\Models\User;

include "layouts/header.php";
include __DIR__ . "/../App/Database/Models/User.php";


if(( isset($_GET['UserID']) ) and (! empty($_GET['UserID']) ) and ( is_numeric($_GET['UserID']) )){
    // get user data from database by ID
    $user = new User;
    $userData = $user->setId($_GET['UserID'])->UserData()->fetch_assoc();
    // check if user ID is valid and exist in database
    if($userData == null){
        echo  "<div class='alert alert-danger text-center'> User ID Invalid </div>";
        header('refresh:3;url=../index.php');die;
    }
}else{
    // query string validation error
    echo "<div class='alert alert-danger text-center'> User ID Invalid </div>";
    header('refresh:3;url=../index.php');die;
}

include "layouts/script.php";


?>

