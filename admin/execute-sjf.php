<?php 
include('partials/menu.php'); 
?>

<div class="main-content">
  <div class="wrapper">
    <h1>Orders Execution (SJF)</h1>
    <br><br>

    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Food</th>
        <th>Qty (Execution Time)</th>
        <th>Status</th>
      </tr>

      <?php 
      $sql = "SELECT * FROM tbl_order ORDER BY qty ASC"; // SJF: sort by shortest qty
      $res = mysqli_query($conn, $sql);
      $sn = 1;

      if ($res && mysqli_num_rows($res) > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
              $food = $row['food'];
              $qty = $row['qty'];
              $status = $row['status'];

              echo "<tr>
                      <td>$sn</td>
                      <td>$food</td>
                      <td>$qty</td>
                      <td>$status</td>
                    </tr>";
              $sn++;
          }
      } else {
          echo "<tr><td colspan='4' class='error'>No Orders to Execute</td></tr>";
      }
      ?>
    </table>

    <br><a href="manage-order.php" class="btn-secondary">← Back to Orders</a>
  </div>
</div>

<?php include('partials/footer.php'); ?>
