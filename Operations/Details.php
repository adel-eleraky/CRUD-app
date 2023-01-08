<?php

use App\Database\Models\User;

$title = "USER DETAILS";
include "layouts/header.php";
include __DIR__ . "/../App/Database/Models/User.php";



// query string validation
if(( isset($_GET['UserID']) ) and (! empty($_GET['UserID']) ) and ( is_numeric($_GET['UserID']) )){

    // get user data from database by ID
    $user = new User;
    $userData = $user->setId($_GET['UserID'])->getUserById()->fetch_assoc();
    // check if user ID is valid and exist in database
    if($userData == null){
        echo  "<div class='alert alert-danger text-center'> Invalid User ID  <br> You Will Be Redirected To Main Page </div>";
        header('refresh:5;url=../index.php');die;
    }
}else{
    // query string validation error
    echo "<div class='alert alert-danger text-center'> Invalid User ID  <br> You Will Be Redirected To Main Page </div>";
    header('refresh:5;url=../index.php');die;
}



?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Wrapper. Contains page content -->
        <?= $error ?? ""?>
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
                                    <table id="example2" class="table table-bordered table-hover">
                                        <tbody>
                                            <tr class="table-active fw-bolder">
                                                <td>ID</td>
                                                <td>Name</td>
                                                <td>National ID</td>
                                                <td>Role</td>
                                            </tr>
                                            <tr>
                                                <td><?= $userData['id'] ?? ""?></td>
                                                <td><?= $userData['name'] ?? ""?></td>
                                                <td><?= $userData['national_id'] ?? ""?></td>
                                                <td><?= $userData['role'] ?? ""?></td>
                                            </tr>
                                            <tr class="table-active fw-bolder">
                                                <td>Email</td>
                                                <td>Phone</td>
                                                <td>Country</td>
                                                <td>City</td>
                                            </tr>
                                            <tr>
                                                <td><?= $userData['email'] ?? ""?></td>
                                                <td><?= '0'.$userData['phone'] ?? ""?></td>
                                                <td><?= $userData['country'] ?? ""?></td>
                                                <td><?= $userData['city'] ?? ""?></td>
                                            </tr>
                                            <tr class="table-active fw-bolder">
                                                <td>Age</td>
                                                <td>Gender</td>
                                                <td>Created at</td>
                                                <td>Updated at</td>
                                            </tr>
                                            <tr>
                                                <td><?= $userData['age'] ?? ""?></td>
                                                <td><?= $userData['gender'] ?? ""?></td>
                                                <td><?= $userData['created_at'] ?? ""?></td>
                                                <td><?= $userData['updated_at'] ?? ""?></td>
                                            </tr>
                                        </tbody>
                                    </table>
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