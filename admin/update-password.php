
<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Update Password</h1>
    <br><br>

    <?php 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    ?>

    <form action="" method="POST">
      <table class="tbl-30">
        <tr>
          <td>Current Password:</td>
          <td>
            <input type="password" name="current_password" placeholder="Current Password" required>
          </td>
        </tr>

        <tr>
          <td>New Password:</td>
          <td>
            <input type="password" name="new_password" placeholder="New Password" required>
          </td>
        </tr>

        <tr>
          <td>Confirm Password:</td>
          <td>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Password" class="btn-secondary">
          </td>
        </tr>
      </table>
    </form>

    <?php 
    if (isset($_POST['submit'])) {
        // Get data from form
        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        // Check if current password is correct
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        $res = mysqli_query($conn, $sql);

        if ($res == true && mysqli_num_rows($res) == 1) {
            // Password match
            if ($new_password == $confirm_password) {
                // Update password
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
                }
            } else {
                $_SESSION['change-pwd'] = "<div class='error'>New Password and Confirm Password did not match.</div>";
            }
        } else {
            $_SESSION['change-pwd'] = "<div class='error'>Current Password is incorrect.</div>";
        }

        header('location:' . SITEURL . 'admin/manage-admin.php');
    }
    ?>
  </div>
</div>

<?php include('partials/footer.php'); ?>


<?php include('partials/footer.php');?>
