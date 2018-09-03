<?php include 'databaseConnection.php';?>
<?php include 'functionList.php';?>
<?php
  $title = "Create New Event";

  $navbarlinks = "";
  $navbarlinks .= createNavLink("Event List","admin_event_details.php");
  $navbarlinks .= createNavLink("Change Password","admin_change_password.php");
  $navbarlinks .= createLogout();

  $EventID = 0;
  $EventName = "";
  $EventLocation = "";
  $GuestAccessCode = "";
  $HostAccessCode = "";

  if(isset($_GET['EventID'])) {
    $title = "Modify Event";
    $EventID = mysqli_real_escape_string($conn,$_GET["EventID"]);
    $sql = "SELECT * FROM events WHERE EventID = ".$EventID.";";
    //echo $sql;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $EventDate = trim($row["EventDate"]);
            $EventName = trim($row["EventName"]);
            $EventLocation = trim($row["EventLocation"]);
            $GuestAccessCode = trim($row["GuestAccessCode"]);
            $HostAccessCode = trim($row["HostAccessCode"]);
        }
    }
  } 
?>
<?php include 'adminHeader.php';?>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id='modalText'>Are you sure you want to PERMANENTLY DELETE this event and all associated images?</h4>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
      <button type="button" id='modalButton' class="btn btn-error" onclick="location.href='deleteEvent.php?EventID=<?php echo $EventID ?>';">OK</button>
    </div>
    </div>
  </div>
</div>
<!-- Content -->
<div class="container-liquid">
  <!--Grid row-->
  <div class="row" style="margin-top:80px;">
    <!--Grid column-->
    <div class="container mt-3 col-md-6" >
      <div class= "login-form">
        <h3 class="h3-responsive font-weight-bold" style="color:white" ><?php echo $title?></h3>
        <!--Reset password form-->
        <form method="post" action="/eventProcessor.php?EventID=<?php echo $EventID?>">
          <div class="form-group">
            <div class="container" >
              <input type="hidden" name="eventID" value="">

              <div class="form-group">
                <label for="eventDate"style="font-weight:bold">Event Date:</label>
                <input type="date" class="form-control" max="2100-12-31" value="<?php echo $EventDate?>" name="eventDate" placeholder="Enter the event date" id="eventDate" required>
              </div>

              <div class="form-group">
                <label for="eventName"style="font-weight:bold">Event Name:</label>
                <input type="text" class="form-control" maxlength = "50" value="<?php echo $EventName?>" placeholder="Enter a name for the event" id="eventName" name="eventName" required>
              </div>

              <div class="form-group">
                <label for="eventLocation"style="font-weight:bold">Event Location:</label>
                <input type="text" class="form-control" maxlength = "50" value="<?php echo $EventLocation?>" placeholder="Enter the venue name and address" id="eventLocation" name="eventLocation" required>
              </div>

              <div class="form-group">
                <label for="guestAccessCode"style="font-weight:bold">Event Access Code:</label>
                <input type="text" class="form-control" pattern="[0-9A-Za-z]{4,8}" title="Codes must be between 4 and 8 letter or numbers only (no spaces)." maxlength = "8" value="<?php echo $GuestAccessCode?>" placeholder="Enter the event code" id="guestAccessCode" name="guestAccessCode" required>
              </div>

              <div class="form-group">
                <label for="hostAccessCode"style="font-weight:bold">Host Access Code:</label>
                <input type="text" class="form-control" pattern="[0-9A-Za-z]{4,8}" title="Codes must be between 4 and 8 letter or numbers only (no spaces)." maxlength = "8" value="<?php echo $HostAccessCode?>" placeholder="Enter the host code" id="hostAccessCode" name="hostAccessCode" required>
              </div>

              <?php
              if($EventID > 0) {
                echo '<button type="submit" class="btn"><i class="fa fa-save"></i> Save Changes</button>';
                echo '<button type="button" class="btn" onclick="location.href=\'admin_gallery_transfer.php?eventID='.$EventID.'\';">Event Gallery</button>';
                echo '<button type="button" class="btn btn-warning" onclick="deleteEvent('.$EventID.');">Delete Event</button>';
              } else {
                echo '<button type="submit" class="btn">Create Event</button><button type="reset" class="btn grey">Reset</button>';
              }
              ?>
            </div>
          </div>
        </form>
      </div>
   </div>
  </div>
</div>
<script>
function deleteEvent(eventID) {
  $('#myModal').modal('show');
}
</script>
<?php include 'ppFooter.php';?>
