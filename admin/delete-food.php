<?php
include('../config/constants.php');

// Check if id and image_name are set
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Check if the image exists and delete it from the folder
    if ($image_name != "") {
        $path = "../images/food/" . $image_name;

        // Attempt to remove the image file
        if (!unlink($path)) {
            $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }

    // Delete food from the database
    $sql = "DELETE FROM tbl_food WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    // Check if the deletion was successful
    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} else {
    // Redirect if unauthorized access
    $_SESSION['unauthorised'] = "<div class='error'>Unauthorized Access.</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>
