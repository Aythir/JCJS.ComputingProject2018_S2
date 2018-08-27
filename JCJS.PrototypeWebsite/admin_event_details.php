<?php include 'functionList.php';?>
<?php
  $title = "List of Events";
  $navbarlinks = createNavLink("Create Event","admin_create_event.php");
  $navbarlinks .= createNavLink("Change Password","admin_change_password.php");
  $navbarlinks .= createLogout();
?>
<?php include 'adminHeader.php';?>
 <!-- Content -->
  <div class="container-liquid">
    <!--Grid row-->
    <div class="row" style="margin-top:80px">
      <!--Grid column-->
      <div class="container mt-3">
        <div class="clearfix">
          <span class="float-left">
            <h3 class="h3-responsive font-weight-bold" style="color:white" ><?php echo $title?></h3>
          </span>
        </div>
        <!--Table-->
        <div class="container" style='border:3px solid #e6e6e6;background-color:white;padding:5px;box-shadow:1px 1px 1px 1px black;border-radius:10px;'>
          <table class="table table-hover">
              <thead>
              <tr>
                <th style="color:#cc0052">Event</th>
                <th style="color:#cc0052">Event&nbsp;ID</th>
                <th style="color:#cc0052">Date</th>
                <th style="color:#cc0052">Guest Code</th>
                <th style="color:#cc0052">Host Code</th>
                <th style="color:#cc0052">Booth&nbsp;Uploads</th>
                <th style="color:#cc0052">Guest&nbsp;Uploads</th>
                <th style="color:#cc0052">Downloads</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM events ORDER BY EventDate;";
              $sql = "SELECT events.EventID,EventName,EventDate,GuestAccessCode,HostAccessCode,SUM(CASE WHEN IsUserUpload = 1 THEN 1 ELSE 0 END) AS GuestUploads,COUNT(Photoid) AS TotalUploads FROM `events` LEFT JOIN Photos ON events.EventID = photos.EventID GROUP BY events.EventID,EventName,EventDate,GuestAccessCode,HostAccessCode ORDER BY EventDate;";
              //echo $sql;
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                      echo '<tr onclick="location.href=\'admin_create_event.php?EventID='.$row["EventID"].'\'" style="cursor:pointer;">';
                      echo "<td>".$row["EventName"]."</td>";
                      echo "<td>".$row["EventID"]."</td>";
                      echo "<td>".$row["EventDate"]."</td>";
                      echo "<td>".$row["GuestAccessCode"]."</td>";
                      echo "<td>".$row["HostAccessCode"]."</td>";
                      echo "<td>".$row["GuestUploads"]."</td>";
                      $boothUploads = (int)$row["TotalUploads"]-(int)$row["GuestUploads"];
                      echo "<td>".$boothUploads."</td>";
                      echo "<td>-</td>";
                      echo "</tr>";
                  }
              } else {
                  header("Location: adminLogin.php?error=1");
              }
            ?>
            </tbody>
          </table>
          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
            <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" style="color:green" id='modalText'>New Event Created</h4>
                  <i class="fa fa-check green-text"style="font-size:20px"></i>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
                </div>
              </div>
            </div>
          </div>

          <a href= "admin_create_event.php"><button type="button" class="btn">Create Event</button></a>
          <?php
          if(isset($_GET['saved'])) {
            echo "<script>";
            if($_GET['saved'] == "0") {
              echo "document.getElementById('modalText').innerHTML = 'New Event Created';";
            } else
            {
              echo "document.getElementById('modalText').innerHTML = 'Event Updated';";
            }
            echo "$('#myModal').modal('show');";
            echo "</script>";
          }
        ?>
      </div>
    </div>
  </div>
</div>
<?php include 'ppFooter.php';?>
