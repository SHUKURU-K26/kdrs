<?php
session_start();
if (isset($_SESSION["admin"])) {
    if (isset($_GET["sleader_id"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Sector Leader</title>
    <link rel="stylesheet" href="../../web_styles/delete_sector.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <header>
        <div class="header">
            <img src="../../web_images/District.png" alt="" class="header-logo">
            <h2>KDRS|<span style="color: grey;font-size:20px;">Kicukiro Disputes Resolving System</span></h2>
            <img src="../../web_images/Kckr.jpg" alt="" class="header-logo">
        </div>
        <p id="automatic-paragraph"></p>
    </header>

    <div class="sections">
        <div class="menu-section">
            <h2><i style="font-size: 40px;" class="fa-solid fa-bars"></i></h2>
            <div>
                <ul>
                    <li><i style="font-size: 30px;" class="fa-solid fa-house"></i><a href="admin_home.php">Dashboard</a></li>
                    <li><i style="font-size: 30px;" class="fa-solid fa-user-tie"></i><a href="#">Leaders</a></li>
                    <li><i style="font-size: 30px;" class="fa-solid fa-id-card"></i><a href="#">Registration &#9660</a>
                            <ul class="dropdown">
                                <li><a href="./sector_leader.php">+Sector Leaders</a></li>
                                <li><a href="./new_category.php">+New Category</a></li>
                            </ul>
                    </li>
                    <li><i style="font-size: 30px;" class="fa-solid fa-list-check"></i><a href="#">Administration &#9660</a>
                            <ul class="dropdown">
                                <li><a href="./new_sector.php">Sectors</a></li>
                                <li><a href="./new_cell.php">Cell</a></li>
                                <li><a href="#">Districts</a></li>
                            </ul>
                    </li>
                    <form action="" method="POST">
                        <li><Button name="logout">Logout</Button></i></li>
                    </form>
                </ul>
            </div>
        </div>
        <?php
        if(isset($_POST["logout"])){
            session_unset();
            session_destroy();
            header("location: ../admin_login.php");
        }
        ?>

        <div class="containers">
            <?php
            include "../../web_connection/connection.php";
            $sleader_id=$_GET["sleader_id"];
            $sql="SELECT * FROM sector_leaders WHERE sleader_id='$sleader_id'";
            $query=$conn->query($sql);
            if ($query->num_rows >0) {
                $row=$query->fetch_assoc();
            ?>
              <form action="" method="POST">
                     <div class="delete-sector-form">
                        <p> Confirm Deletion of <span style="color: grey;">
                            <?php echo $row["sleader_f_name"] ." ". $row["sleader_s_name"]."'s"?> </span>Account</p>
                            <span style="color: grey;font-size:15px;">Are you sure you want to Delete?</span>
                         <div class="proceed-buttons">
                             <input type="submit" name="deleteBtn" value="Delete" id="delete">
                             <input type="button" name="cancel" onclick="Redirect()" value="Cancel" id="cancel">
                         </div>
                     </div>
                </form>
            <?php
            }
            ?>
                <?php
                include "../../web_connection/connection.php";
                $sleader_id=$_GET["sleader_id"];
                if (isset($_POST["deleteBtn"])) {
                    $sql="DELETE  FROM sector_leaders WHERE sleader_id='$sleader_id'";
                    $query=$conn->query($sql);
                    if ($query) {
                      echo"<p id='success-message'>Deletion Went Successfully</p>";
                      echo"
                       <script>
                         setTimeout(()=>{
                          window.location.href='./view_sectors_leaders.php';
                    }, 2000);
                       </script>
                      ";
                    }
                }
                ?>

        </div>

    </div>

    <footer>
            <img src="../../web_images/clear coat of arms.png" alt="Court of Arms" class="footer-logo">
            <p>Repubulika y’u Rwanda</p>
        </footer>
  <script>
    function Redirect(){
        alert("Deletion Operation Canceled")
        setTimeout(()=>{
            window.location.href='./view_sector_leaders.php';
        }, 0);
    }
      let sentence="YOU'RE ABOUT TO DELETE A SECTOR-LEADER ACCOUNT";
      let myElement=document.getElementById("automatic-paragraph");
      let speed=30;
      
      function automation(){
            let counter=0;
            let myInterval=setInterval(()=>{
             myElement.textContent+=sentence[counter];
             counter++;

             if (counter===sentence.length) {
                clearInterval(myInterval)
             }

         }, speed)
      }
      automation()

  </script>
</body>
</html>
<?php
    }
}

else{
    header('location: ../admin_login.php');
 }
?>