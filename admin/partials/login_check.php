<?php

//authorization access control
//check wheather the user is logged in or not
if(!isset($_SESSION['user']))   
{
    $_SESSION['no-login-message']="<div class='error text-center'>please login to access Admin Panal.</div>";
    header('location:' .SITEURL.'admin/login.php');
}


?>