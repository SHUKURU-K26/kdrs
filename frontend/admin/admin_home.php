<?php
 session_start();

 if (isset($_SESSION['admin'])) {
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Home</title>
    <link rel="stylesheet" href="../../web_styles/admin_home.css">
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
                                <li><a href="./new_village.php">Villages</a></li>
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

                <div class="pair1">
                        <p style="color: white;font-weight: bold; font-size: 20px;">All Registered Sectors</p>
                        <div id="box1" class="boxes" name="see-all-sectors" onclick="window.location.href='view_sectors.php'">
                                <?php
                                 include "../../web_connection/connection.php";
                                $sql = "SELECT COUNT(*) AS total_sectors FROM sectors";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo "<p style='font-size: 44px;color:white; font-weight: bold;text-align:center;'>" . $row['total_sectors'] . "</p>";
                                ?>
                        </div>
                        <p style="color: white;font-weight: bold; font-size: 20px;">All Registered Cells</p>
                        <div id="box2" class="boxes" name="see-all-cells" onclick="window.location.href='view_cells.php'">
                        <?php
                                 include "../../web_connection/connection.php";
                                $sql = "SELECT COUNT(*) AS total_cells FROM cells";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo "<p style='font-size: 44px;color:white; font-weight: bold;text-align:center;'>" . $row['total_cells'] . "</p>";
                                ?>
                        </div>
                </div>

                <div class="pair2">
                    <p style="color: white;font-weight: bold; font-size: 20px;">All Registered Villages</p>
                    <div id="box3" class="boxes" onclick="window.location.href='view_villages.php'">
                    <?php
                                 include "../../web_connection/connection.php";
                                $sql = "SELECT COUNT(*) AS total_villages FROM villages";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo "<p style='font-size: 44px;color:white; font-weight: bold;text-align:center;'>" . $row['total_villages'] . "</p>";
                        ?>  
                    </div>
                    <p style="color: white;font-weight: bold; font-size: 20px;">All Registered Sector Leaders</p>
                    <div id="box4" class="boxes" onclick="window.location.href='view_sector_leaders.php'">
                    <?php
                                 include "../../web_connection/connection.php";
                                $sql = "SELECT COUNT(*) AS total_sector_leaders FROM sector_leaders";
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                echo "<p style='font-size: 44px;color:white; font-weight: bold;text-align:center;'>" . $row['total_sector_leaders'] . "</p>";
                        ?>  
                    </div>
                </div>


        </div>

    </div>

    <footer>
            <img src="../../web_images/clear coat of arms.png" alt="Court of Arms" class="footer-logo">
            <p>Repubulika y’u Rwanda</p>
        </footer>
  <script>
      let sentence="WELCOME TO HOME-DASHBOARD PAGE";
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
 else{
    header('location: ../admin_login.css');
 }
?>