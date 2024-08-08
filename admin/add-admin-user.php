<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    if (isset($_POST['submit'])) {
        $username = mysqli_real_escape_string($con, $_POST['username']);
        $password = mysqli_real_escape_string($con, $_POST['password']);

        // You may want to add more validation and sanitization here

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $creationDate = date('Y-m-d H:i:s');
        $updationDate = $creationDate;

        // Insert new admin user into the "admin" table
        $query = "INSERT INTO admin (username, password, creationDate, updationDate) VALUES ('$username', '$hashedPassword', '$creationDate', '$updationDate')";
        $result = mysqli_query($con, $query);
        if ($result) {
            // Admin user added successfully
            $_SESSION['successmsg'] = "Admin user added successfully!";
            header('location: manage-users.php'); // Redirect to the manage users page or any other appropriate page
            exit();
        } else {
            // Error occurred while adding admin user
            $_SESSION['errormsg'] = "Failed to add admin user. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add Admin Users</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>
    <?php include('include/header.php');?>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php');?>
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Add Admin Users</h3>
                            </div>
                            <div class="module-body">
                                <!-- Add your HTML form for adding admin users here -->
                                <form class="form-horizontal" method="post">
                                    <!-- Your form fields for adding admin users -->
                                    <!-- For example: Username, Password, etc. -->

                                    <div class="control-group">
                                        <label class="control-label" for="username">Username</label>
                                        <div class="controls">
                                            <input type="text" id="username" name="username" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="password">Password</label>
                                        <div class="controls">
                                            <input type="password" id="password" name="password" required>
                                        </div>
                                    </div>

                                    <!-- Add more form fields as needed -->

                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" name="submit" class="btn btn-primary">Add Admin User</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Display existing admin users -->
                        <div class="module">
                            <div class="module-head">
                                <h3>Existing Admin Users</h3>
                            </div>
                            <div class="module-body table">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Username</th>
                                            <th>Creation Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM admin";
                                        $result = mysqli_query($con, $query);
                                        $cnt = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlentities($cnt); ?></td>
                                                <td><?php echo htmlentities($row['username']); ?></td>
                                                <td><?php echo htmlentities($row['creationDate']); ?></td>
                                            </tr>
                                            <?php
                                            $cnt++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End of display existing admin users -->

                    </div><!--/.content-->
                </div><!--/.span9-->
            </div>
        </div><!--/.container-->
    </div><!--/.wrapper-->

    <?php include('include/footer.php');?>

    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Add any additional scripts or validation libraries as required -->

</body>
</html>