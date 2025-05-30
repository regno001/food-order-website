<?php
include('../config/constants.php'); 
// echo "Delete Page";

if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    // Remove the image file if it exists
    if ($image_name != "") {
        $path = "../images/category/" . $image_name;
        $remove = unlink($path);

        if ($remove == false) {
            $_SESSION['remove'] = "<div class='error'>Failed to remove category image.</div>";
            header('location:' . SITEURL . 'admin/manage-category.php');
            die();
        }
    }

    // Delete data from database
    $sql = "DELETE FROM tbl_category WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully.</div>";
    } else {
        $_SESSION['delete'] = "<div class='error'>Failed to delete category.</div>";
    }

    header('location:' . SITEURL . 'admin/manage-category.php');
} else {
    // Redirect if accessed without required params
    header('location:' . SITEURL . 'admin/manage-category.php');
}
?>
