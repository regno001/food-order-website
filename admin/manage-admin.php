
  <body> <?php include('partials/menu.php') ?>
    <!-- Main Content Section Starts -->
    <div class="main-content">
      <div class="wrapper">
        <h1>Manage Admin</h1>
        <br>
    <!-- button to create admin -->
  <?php 
  if(isset($_SESSION['add']))
  {
    echo $_SESSION['add'];
    unset($_SESSION['add']);
  }
  if(isset($_SESSION['delete']))
  {
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
  }
  ?>
  <br/><br/>
        
        
        <a href="add-admin.php" class="btn-primary"> add Admin</a><br>
        
        <table class="tbl-full">
          <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>

  <?php 
  $sql="SELECT * FROM tbl_admin";
  $res =mysqli_query($conn,$sql);
  //Check Weather the Query is Executed or NOt
  if($res==TRUE){
    // Count Rows to Check whether we have data in database or not
    $count=mysqli_num_rows($res);
    $sn=1;
    // Check the no of rows
    if($count>0){
      //WE HAve data in database while
 while($rows=mysqli_fetch_assoc($res))
 {


//Using While loop to get all the data from database.

//And while loop will run as long as we have data in database

//Get individual DAta
$id=$rows['id'];
$full_name=$rows['full_name'];
$username=$rows['username'];

//display the values in table
?> 

          <tr>
            <td><?php echo $sn++ ?></td>
            <td><?php echo $full_name ?></td>
            <td><?php echo $username ?></td>
            <td> 
           <a href="<?php echo SITEURL ;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
              
            </td>
          </tr>
<?php
 }
    }
    else{
  //

    }
  }
  ?>
        
        </table>
      </div>
    </div>
    <!-- Main Content Setion Ends --> <?php include('partials/footer.php'); ?>
  </body>
</html>