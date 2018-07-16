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
        <span class="float-right">
         <a class="nav-link" href="admin_create_event.php">
         <button type="submit" class="btn btn-white">Create New Event</button></a>
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
                    <th style="color:#cc0052">Date</th>
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
                        echo '<tr onclick="location.href=\'admin_create_event.php?EventID='.$row["EventID"].'\'";>';
                        echo "<td>".$row["EventName"]."</td>";
                        echo "<td>".$row["EventDate"]."</td>";
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
              
              <button type="submit" class="btn">View</button>
              <button type="submit" class="btn">Edit</button>  
              <button type="submit" class="btn grey">Delete</button>                
               
        </div>
      </form>
     </div>
   </div>
 </div>
<?php include 'ppFooter.php';?>