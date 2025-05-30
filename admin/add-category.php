<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Category</h1>
    <br><br>

    <?php
    if (isset($_SESSION['add']))
    {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }

    if (isset($_SESSION['upload']))
     {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }
    ?>
    <br><br>

    <!-- Add Category Form Starts -->
    <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Title: </td>
          <td>
            <input type="text" name="title" placeholder="Category Title">
          </td>
        </tr>

        <tr>
          <td>Select Image: </td>
          <td>
            <input type="file" name="image">
          </td>
        </tr>

        <tr>
          <td>Featured: </td>
          <td>
            <input type="radio" name="featured" value="Yes"> Yes
            <input type="radio" name="featured" value="No"> No
          </td>
        </tr>

        <tr>
          <td>Active: </td>
          <td>
            <input type="radio" name="active" value="Yes"> Yes
            <input type="radio" name="active" value="No"> No
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>
    <!-- Add Category Form Ends -->

    <?php
    if (isset($_POST['submit'])) {
        // 1. Get the values from the form
        $title = $_POST['title'];

        $featured = isset($_POST['featured']) ? $_POST['featured'] : "No";
        $active   = isset($_POST['active']) ? $_POST['active'] : "No";

        // 2. Image Upload Handling
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            $image_name = $_FILES['image']['name'];
          //upload the image 
          if($image_name !="")
          {
            // Get extension
            $ext = end(explode('.', $image_name));

            // Rename the image
            $image_name = "Food_Category_" .rand(000, 999).'.'.$ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            // Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            // Check if upload was successful
            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
                header('location:' .SITEURL. 'admin/add-category.php');
                die();
            }
          }
        } else {
            $image_name = "";
        }

        // 3. Insert into database
        $sql = "INSERT INTO tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'";

        $res = mysqli_query($conn, $sql);

        // 4. Check if inserted
        if ($res == true) {
            $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
            header('location:' .SITEURL. 'admin/manage-category.php');
        } else {
            $_SESSION['add'] = "<div class='error'>Failed to add category.</div>";
            header('location:' .SITEURL. 'admin/add-category.php');
        }
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>
