<?php include('partials/menu.php'); ?>

<?php 
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
  $res2 = mysqli_query($conn, $sql2);
  $row = mysqli_fetch_assoc($res2);

  $title = $row['title'];
  $description = $row['description'];
  $price = $row['price'];
  $current_image = $row['image_name'];
  $current_category = $row['category_id'];
  $featured = $row['featured'];
  $active = $row['active'];
}
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Food</h1>
    <br><br>

    <form action="" method="POST" enctype="multipart/form-data">
      <table class="tbl-30">
        <tr>
          <td>Title:</td>
          <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
        </tr>
        <tr>
          <td>Description:</td>
          <td><textarea name="description" rows="5" cols="30"><?php echo $description; ?></textarea></td>
        </tr>
        <tr>
          <td>Price:</td>
          <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
        </tr>
        <tr>
          <td>Current Image:</td>
          <td>
            <?php 
            if ($current_image == "") {
              echo "<div class='error'>Image Not Available</div>";
            } else {
              echo "<img src='" . SITEURL . "images/food/" . $current_image . "' width='100px'>";
            }
            ?>
          </td>
        </tr>
        <tr>
          <td>New Image:</td>
          <td><input type="file" name="image"></td>
        </tr>
        <tr>
          <td>Category:</td>
          <td>
            <select name="category">
              <?php
              $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
              $res = mysqli_query($conn, $sql);
              if ($res && mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                  $cat_id = $row['id'];
                  $cat_title = $row['title'];
                  ?>
                  <option <?php if ($current_category == $cat_id) echo "selected"; ?> value="<?php echo $cat_id; ?>"><?php echo $cat_title; ?></option>
                  <?php
                }
              } else {
                echo "<option value='0'>No category found</option>";
              }
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td>Featured:</td>
          <td>
            <input <?php if ($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes"> Yes
            <input <?php if ($featured == "No") echo "checked"; ?> type="radio" name="featured" value="No"> No
          </td>
        </tr>
        <tr>
          <td>Active:</td>
          <td>
            <input <?php if ($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes"> Yes
            <input <?php if ($active == "No") echo "checked"; ?> type="radio" name="active" value="No"> No
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="submit" name="submit" value="Update Food" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>

    <?php 
    if (isset($_POST['submit'])) {
      $id = $_POST['id']; 
      $title = $_POST['title']; 
      $description = $_POST['description']; 
      $price = $_POST['price']; 
      $current_image = $_POST['current_image'];
      $category = $_POST['category']; 
      $featured = $_POST['featured'];
      $active = $_POST['active'];

      // Image upload handling
      if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
        $image_name = $_FILES['image']['name'];
        $ext = end(explode('.', $image_name));
        $image_name = "Food-Name-" . rand(0000, 9999) . "." . $ext;

        $src_path = $_FILES['image']['tmp_name'];
        $dest_path = "../images/food/" . $image_name;

        $upload = move_uploaded_file($src_path, $dest_path);

        if ($upload == false) {
          $_SESSION['upload'] = "<div class='error'>Failed to upload new image.</div>";
          header('location:' . SITEURL . 'admin/manage-food.php');
          die();
        }

        // Remove old image
        if ($current_image != "") {
          $remove_path = "../images/food/" . $current_image;
          $remove = unlink($remove_path);

          if ($remove == false) {
            $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image.</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
          }
        }
      } else {
        $image_name = $current_image;
      }

      // Update food in database
      $sql3 = "UPDATE tbl_food SET
        title='$title',
        description='$description',
        price='$price',
        image_name='$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'
        WHERE id=$id";

      $res3 = mysqli_query($conn, $sql3);

      if ($res3 == true) {
        $_SESSION['update'] = "<div class='success'>Food Updated Successfully.</div>";
      } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Food.</div>";
      }

      header('location:' . SITEURL . 'admin/manage-food.php');
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>
