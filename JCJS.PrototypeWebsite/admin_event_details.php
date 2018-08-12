<?php include 'functionList.php';?>
<?php
  $title = "List of Events";
  $navbarlinks = createNavLink("Create Event","admin_create_event.php");
  $navbarlinks .= createNavLink("Change Password","admin_change_password.php");
  $navbarlinks .= createNavLink("Logout","#");
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
     <form>
      <div class="container">
         <h4 class="h4-responsive font-weight-bold" style="color:grey">Existing Events</h4>
         <table class="table table-hover">
                <thead>
                  <tr>
                    <th style="color:#cc0052">Event Name</th>
                    <th style="color:#cc0052">Event ID</th>
                    <th style="color:#cc0052">Date</th>
                    <th style="color:#cc0052">Guest Code</th>
                    <th style="color:#cc0052">Host Code</th>
                    <th style="color:#cc0052">Booth Uploads</th>
                    <th style="color:#cc0052">Guest Uploads</th>
                    <th style="color:#cc0052">Guest Downloads</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM events ORDER BY EventDate;";
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
                        echo "<td>-</td>";
                        echo "<td>-</td>";
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
      </form>
     </div>
   </div>
 </div>
<?php include 'ppFooter.php';?>
