<?php

include('../config/constants.php');

// 1. Get the ID of Admin to be deleted 
$id = (int) $_GET['id']; // Prevent SQL injection

// 2. Create SQL Query to Delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the Query 
$res = mysqli_query($conn, $sql);

// 3. Check whether the query executed successfully or not 
if ($res == true) {
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";
} else {
    $_SESSION['delete'] = "<div class='error'>Failed to delete. Try again later.</div>";
}

// 4. Redirect to Manage Admin Page
header('Location: ' . SITEURL . 'admin/manage-admin.php');
?>
