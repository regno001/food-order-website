<?php include('partials/menu.php'); ?>

<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>
<br/>
<?php 
if(isset($_SESSION['add']))
{
  echo $_SESSION['add'];
  unset($_SESSION['add']);
}
?> 
    <form action="" method="POST">
       <table class="tbl-30">
      <tr>
        <td>Full Name:</td>
        <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
      </tr>
 <tr>
        <td>Username:</td>
        <td><input type="text" name="username" placeholder="Enter your Username"></td>
      </tr>
 <tr>
        <td>Password:</td>
        <td><input type="password" name="password" placeholder="Enter your Password"></td>
      </tr>
       <tr>
        <td colspan="2">
          <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
        </td>
       </tr>
     </table>

    </form>
  </div>
</div>

<?php include('partials/footer.php'); ?>
<?php 
//process the value from from and save it in db

//check weather the button is clicked or not
if(isset($_POST['submit']))
{
//get the data from form
 $full_name =$_POST['full_name'];
   $username =$_POST['username'];
$password =md5($_POST['password']);
//sql query to save data into db
$sql="INSERT INTO tbl_admin SET 
full_name='$full_name',
username='$username',
password='$password'
";
//executing query and saving data into db 
$res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
//4 check query is executed or not
if($res==TRUE)
{
 //create a variable to display msg
 $_SESSION['add'] = "Admin Added Successfully";
 //redirect Page
 header("http//:localhost:8080".SITEURL.'admin/manage-admin.php');
}
else
{
 $_SESSION['add'] = "failed to add Admin";
 //redirect Page
 header("location".SITEURL.'admin/manage-admin.php');
}
}

?>
