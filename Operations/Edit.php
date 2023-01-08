<?php

use App\Database\Models\User;
use App\Http\Request\Validation;

$title = "EDIT USER";
include "layouts/header.php";
include __DIR__ . "/../App/Database/Models/User.php";
include __DIR__ . "/../App/Http/Request/Validation.php";


// query string validation
if(( isset($_GET['UserID']) ) and (! empty($_GET['UserID']) ) and ( is_numeric($_GET['UserID']) )){
    // get user data from database by ID
    $user = new User;
    $userData = $user->setId($_GET['UserID'])->getUserById()->fetch_assoc();
    // check if user ID is valid and exist in database
    if($userData == null){
        echo  "<div class='alert alert-danger text-center'> User ID Invalid <br> You Will Be Redirected To Main Page </div>";
        header('refresh:5;url=../index.php');die;
    }
}else{
    // query string validation error
    echo "<div class='alert alert-danger text-center'> User ID Invalid <br> You Will Be Redirected To Main Page </div>";
    header('refresh:5;url=../index.php');die;
}


$validation = new Validation;

if($_SERVER['REQUEST_METHOD'] === "POST"){

    // check input validation 
    $validation->setInput($_POST['name'] ?? "")->setInputName('name')->required()->string()->between( 2 , 32);
    $validation->setInput($_POST['national_id'] ?? "")->setInputName('national_id')->required()->numeric()->regex('/^([1-9]{1})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})[0-9]{3}([0-9]{1})[0-9]{1}$/');
    $validation->setInput($_POST['email'] ?? "")->setInputName('email')->required()->regex('/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/');
    $validation->setInput($_POST['phone'] ?? "")->setInputName('phone')->required()->numeric()->regex('/^01[0125][0-9]{8}$/');
    $validation->setInput($_POST['country'] ?? "")->setInputName('country')->required()->between(2,32);
    $validation->setInput($_POST['city'] ?? "")->setInputName('city')->required()->between(2,32);
    $validation->setInput($_POST['role'] ?? "")->setInputName('role')->required()->In(['user' , 'admin' , 'superadmin']);
    $validation->setInput($_POST['gender'] ?? "")->setInputName('gender')->required()->In(['male' , 'female']);
    $validation->setInput($_POST['age'] ?? "")->setInputName('age')->required()->numeric();

    // if user update the email then check if it's unique 
    if($_POST['email'] != $userData['email']){
        $validation->setInput($_POST['email'])->setInputName('email')->unique('users' , 'email');
    }
    // if user update the national_id then check if it's unique
    if($_POST['national_id'] != $userData['national_id']){
        $validation->setInput($_POST['national_id'])->setInputName('national_id')->unique('users' , 'national_id');
    }
    // if user update the phone then check if it's unique
    if($_POST['phone'] != $userData['phone']){
        $validation->setInput($_POST['phone'])->setInputName('phone')->unique('users' , 'phone');
    }


    // check if there isn't input validation error
    if(empty($validation->getErrors())){
        
        // insert user data in database
        $user = new User;
        $user->setId($userData['id'])->setName($_POST['name'])->setNational_id($_POST['national_id'])->setEmail($_POST['email'])
            ->setPhone($_POST['phone'])->setCountry($_POST['country'])->setCity($_POST['city'])
            ->setRole($_POST['role'])->setGender($_POST['gender'])->setAge($_POST['age']);
        if($user->Update()){
            echo "<div class='alert alert-success text-center'> User Updated Successfully <br> You Will Be Redirected To User Details Page</div>";
            header("refresh:5;url=Details.php?UserID={$userData['id']}");
        }
        else{
            echo  "<div class='alert alert-danger text-center'> Something went wrong <br> You Will Be Redirected To Main Page  </div>";
            header('refresh:5;url=../index.php');die;
        }
    }

    
}


?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= $title ?></h1>
                        </div>
                        
                    </div>
                </div><!-- /.container-fluid -->
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                <form action="" method="post">
                                        <table id="example2" class="table table-bordered table-hover">
                                            <tbody>
                                                <tr class="table-active fw-bolder">
                                                    <td>Name</td>
                                                    <td>National ID</td>
                                                    <td>Email</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="name" value="<?= $_POST['name'] ?? $userData["name"] ?? ""  ?>"> 
                                                        <?= $validation->getErrorMessage('name') ?? "" ?>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="national_id" value=<?=  $_POST['national_id'] ?? $userData['national_id'] ?? "" ?>> 
                                                        <?= $validation->getErrorMessage('national_id') ?? "" ?>
                                                    </td>
                                                    <td>
                                                        <input type="email" name="email" value=<?=  $_POST['email'] ?? $userData['email'] ?? "" ?>> 
                                                        <?= $validation->getErrorMessage('email') ?? "" ?> 
                                                    </td>
                                                </tr>
                                                <tr class="table-active fw-bolder">
                                                    <td>Phone</td>
                                                    <td>Country</td>
                                                    <td>City</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="number" name="phone" value=<?=  $_POST['phone'] ?? '0'.$userData['phone'] ?? "" ?>> 
                                                        <?= $validation->getErrorMessage('phone') ?? "" ?> 
                                                    </td>
                                                    <td>
                                                        <input type="text" name="country" value="<?=  $_POST['country'] ?? $userData['country'] ?? "" ?>"> 
                                                        <?= $validation->getErrorMessage('country') ?? "" ?> 
                                                    </td>
                                                    <td>
                                                        <input type="text" name="city" value="<?=  $_POST['city'] ?? $userData['city'] ?? "" ?>"> 
                                                        <?= $validation->getErrorMessage('city') ?? "" ?> 
                                                    </td>
                                                </tr>
                                                <tr class="table-active fw-bolder">
                                                    <td>Role</td>
                                                    <td>Age</td>
                                                    <td>Gender</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <select name="role">
                                                            <option value=""></option>
                                                            <option value="user" <?= (( isset($_POST['role']) && $_POST['role'] == "user") ?  "selected" : ( $userData['role'] == "user" )) ? "selected" : "" ?>>USER</option>
                                                            <option value="admin" <?= (( isset($_POST['role']) && $_POST['role'] == "admin") ?  "selected" : ( $userData['role'] == "admin" )) ? "selected" : "" ?>>ADMIN</option>
                                                            <option value="superadmin" <?= (( isset($_POST['role']) && $_POST['role'] == "superadmin") ?  "selected" : ( $userData['role'] == "superadmin" )) ? "selected" : "" ?>>SUPER ADMIN</option>
                                                        </select>
                                                        <?= $validation->getErrorMessage('role') ?? "" ?>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="age" value=<?=   $_POST['age'] ?? $userData['age'] ?? "" ?>> 
                                                        <?= $validation->getErrorMessage('age') ?? "" ?> 
                                                    </td>
                                                    <td>
                                                        <select name="gender">
                                                            <option value=""></option>
                                                            <option value="male" <?= (( isset($_POST['gender']) && $_POST['gender'] == "male") ?  "selected" : ( $userData['gender'] == "male" )) ? "selected" : "" ?>>MALE</option>
                                                            <option value="female" <?= (( isset($_POST['gender']) && $_POST['gender'] == "female") ?  "selected" : ( $userData['gender'] == "female" )) ? "selected" : "" ?>>FEMALE</option>
                                                        </select>
                                                        <?= $validation->getErrorMessage('gender') ?? "" ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br><input type="submit" value="submit" class="btn btn-outline-primary">
                                    </form>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->

<?php 

include "layouts/script.php";


?>