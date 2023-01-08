<?php

use App\Database\Models\User;

$title = "CRUD SYSTEM";
include "layouts/header.php";
include "App/Database/Models/User.php";


$users = new User;


if($_SERVER['REQUEST_METHOD'] == "POST"){

    // delete user by id
    if(isset($_POST['delete'])){

        if($users->Delete($_POST['id'])){
            echo "<div class='alert alert-success text-center'> User Deleted Successfully </div>";
        }
        else {
            echo "<div class='alert alert-danger text-center'> Something Went Wrong </div>";
        }
    }
    
}

// get users data from database
$usersData =  $users->AllUsersData()->fetch_all(MYSQLI_BOTH);


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
                            <h1><?= $title?></h1>
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
                                <div class="card-header">
                                    <a target="_blank" href="Operations/Create.php"><button type="button" class="btn btn-outline-primary">CREATE NEW USER</button></a>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NAME</th>
                                                <th>National ID</th>
                                                <th>Email</th>
                                                <th>Details</th>
                                                <th>Operations</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($usersData as $user){ ?>
                                                <tr>
                                                    <td><?= $user["id"]?></td>
                                                    <td><?= $user["name"]?></td>
                                                    <td><?= $user["national_id"]?></td>
                                                    <td><?= $user["email"]?></td>
                                                    <td><a target="_blank" href=<?="Operations/Details.php?UserID={$user["id"]}"?>> <button type="button" class="btn btn-outline-primary">VIEW</button></a></td>
                                                    <td>
                                                        <a target="_blank" href=<?="Operations/Edit.php?UserID={$user["id"]}"?>><button type="button" class="btn btn-outline-secondary">EDIT</button></a>
                                                        <form  method="post" class="d-inline">
                                                            <input type="text" name="id" value="<?= $user['id']; ?>" hidden>
                                                            <button type="submit" name="delete"  class="btn btn-outline-danger">DELETE</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php }?>
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
    </div>
    <!-- ./wrapper -->


<?php 

include "layouts/script.php";

?>