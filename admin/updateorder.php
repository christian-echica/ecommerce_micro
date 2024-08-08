<?php
session_start();

include_once 'include/config.php';
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    $oid = intval($_GET['oid']);
    if (isset($_POST['submit2'])) {
        $status = $_POST['status'];
        $remark = $_POST['remark']; //space char

        $query = mysqli_query($con, "insert into ordertrackhistory(orderId,status,remark) values('$oid','$status','$remark')");
        $sql = mysqli_query($con, "update orders set orderStatus='$status' where id='$oid'");
        echo "<script>alert('Order updated successfully...');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Add Admin Users</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
    <link href="css/theme.css" rel="stylesheet" type="text/css">
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
                            <!-- Add Admin Users Form (if any) should go here -->

                            <!-- ...

                            Add your form elements for adding admin users here.

                            ... -->
                        </div>
                    </div>
                    <div class="module">
                        <div class="module-head">
                            <h3>Admin Users List</h3>
                        </div>
                        <div class="module-body table">
                            <table class="datatable-1 table table-bordered table-striped display" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Creation Date</th>
                                        <th>Updation Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch and display the admin users list from the database
                                    $query = mysqli_query($con, "SELECT * FROM admin");
                                    $cnt = 1;
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt); ?></td>
                                            <td><?php echo htmlentities($row['username']); ?></td>
                                            <td><?php echo htmlentities($row['password']); ?></td>
                                            <td><?php echo htmlentities($row['creationDate']); ?></td>
                                            <td><?php echo htmlentities($row['updationDate']); ?></td>
                                        </tr>
                                        <?php $cnt++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!--/.content-->
            </div><!--/.span9-->
        </div>
    </div><!--/.container-->
</div><!--/.wrapper-->

<?php include('include/footer.php');?>

<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    });
</script>
</body>
</html>