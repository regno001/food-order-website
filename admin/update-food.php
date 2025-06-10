<?php include('partials/menu.php');?>
<?php 
if(isset($_FILES['images']['name']))
{
  $image_name =$_FILES['images']['name'];
  if($image_name!==)
  {

    $ext =end(explode('.',$image_name));
    $image_name="food-Name".rand(0000,9999).'.'.$ext;

    $src_path =$_FILES['image']['tmp_name'];
    $dest_path= "../images/food".$image_name;

    $upload =move_uploaded_file($src_path, $dest_path);

    if($upload==false)
    {
      $_SESSION['upload']="<div class='error'>Failed to upload new Image.</div>";

      header('location:' .SITEURL. 'admin/manage-food.php')
    die();
    if($current_image!="")
    {
      $remove_path="../images/food".$current_image;
      $remove =unlink($remove_path);
      if($remove==false)
      {
        $_SESSION['remove-failed']="<div class='error'>Failed to remove current Image</div>";
        header('locatio:' .SITEURL. 'admin/manage-food.php');
        die();
      }
    }
    else
    {
      $image_name =$current_image;
    }
    }
    else
    {
      $image_name =$current_image;
    }
  }
}
else
    {
      $image_name =$current_image;
    }
    }
    else
    {
      $image_name =$current_image;
    }
  }
}

//new code will be executed soon

<?php include('partials/footer.php');?>
