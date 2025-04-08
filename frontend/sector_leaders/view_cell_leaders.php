<?php
 session_start();
 if (isset($_SESSION['sector_leader'])) {
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Cell Leaders</title>
    <link rel="stylesheet" href="../../web_styles/view_cell.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <header>
        <div class="header">
            <img src="../../web_images/District.png" alt="" class="header-logo">
            <h2>KDRS|<span style="color: grey;font-size:20px;">Kicukiro Disputes Resolving System</span></h2>
            <img src="../../web_images/Kckr.jpg" alt="" class="header-logo">
        </div>
        <div class="pairs-of-account-info">
            <p id="automatic-paragraph"></p>
            <div class="user-names-alphabet-letters" title="
            <?php
               $sleader_id=$_SESSION["sleader_id"];
                include "../../web_connection/connection.php";
                $sql="SELECT  sleader_f_name, sleader_s_name FROM sector_leaders WHERE sleader_id='$sleader_id'";
                $query=$conn->query($sql);
                $row=$query->fetch_assoc();
                $firstName=$row["sleader_f_name"];
                $secondName=$row["sleader_s_name"];
                 echo $firstName ." ". $secondName;

               ?>   
            
            ">
               <?php
               $sleader_id=$_SESSION["sleader_id"];
                include "../../web_connection/connection.php";
                $sql="SELECT  sleader_f_name, sleader_s_name FROM sector_leaders WHERE sleader_id='$sleader_id'";
                $query=$conn->query($sql);
                $row=$query->fetch_assoc();
                $firstName=$row["sleader_f_name"];
                $secondName=$row["sleader_s_name"];
                 echo $firstName[0] . $secondName[0];

               ?>
            </div>
        </div>
    </header>

    <div class="sections">
        <div class="menu-section">
            <h2><i style="font-size: 40px;" class="fa-solid fa-bars"></i></h2>
            <div>
            <ul>
                    <li><i class="fa-solid fa-house fa-lg" style="color: #051f4d;"></i><a href="./sleader_home.php">Dashboard</a></li>
                    <li><i class="fa-solid fa-id-card-clip fa-lg" style="color: #051f4d;"></i><a href="#">ISSUES &#9660</a>
                    <ul class="dropdown">
                                <li><a href="">Addressed Issues</a></li>
                                <li><a href="#">Pending List</a></li>
                                <li><a href="#">Expired</a></li>
                    </ul>
                    </li>
                    <li></i><a href="#">REGISTER &#9660</a>
                            <ul class="dropdown">
                                <li><a href="./cell_leader.php">+Cell Leader</a></li>
                            </ul>
                    </li>
                    <li></i><a href="#">VIEW &#9660</a>
                            <ul class="dropdown">
                               <li><a href="./view_cell_leaders.php">All Cell Leader</a></li>
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
            header("location: ../sleader_login.php");
        }
        ?>
        <div class="section-two" style="overflow-y:scroll;">
            <table border="2px">
                <tr style="background-color: hsl(216, 88%, 20%);color: white;">
                    <th style="width: 200px;">N#</th>
                    <th style="width: 200px;" >FIRST NAME</th>
                    <th style="width: 200px;" >SECOND NAME</th>
                    <th style="width: 200px;" >PHONE-NUMBER</th>
                    <th style="width: 200px;" >ACCOUNT PASSWORD</th>
                    <th style="width: 200px;" >NATIONAL ID</th>
                    <th style="width: 200px;" >FIELD OF OFFICE</th>
                    <th style="width: 200px;" >ACTIONS</th>
                </tr>
                <?php
                  include "../../web_connection/connection.php";
                  $sleader_id=$_SESSION["sleader_id"];
                  $sql = "SELECT cl.cleader_id, cl.cleader_f_name, cl.cleader_s_name,
                   cl.cleader_phone, cl.cleader_password, cl.cleader_national_id,
                   c.cell_id, c.cell_name
            FROM cell_leaders cl
            INNER JOIN cells c ON cl.cell_id = c.cell_id
            INNER JOIN sector_leaders sl ON sl.sector_id = c.sector_id
            WHERE sl.sleader_id = '$sleader_id'";

                  $query=$conn->query($sql);
                  if ($query->num_rows >0) {
                    $count=0;
                    while($row=$query->fetch_assoc()){
                        $count++
                        ?>
                        <tr>
                            <td><?php echo $count?></td>
                            <td><?php echo $row["cleader_f_name"]?></td>
                            <td><?php echo $row["cleader_s_name"]?></td>
                            <td><?php echo $row["cleader_phone"]?></td>
                            <td><?php echo $row["cleader_password"]?></td>
                            <td><?php echo $row["cleader_national_id"]?></td>
                            <td><?php echo $row["cell_name"]?></td>
  
                                <form action="deleteCell_leader.php" method="GET">
                                    <input type="hidden" name="cleader_id" value="<?php echo $row["cleader_id"]?>">
                                    <td style="cursor: pointer;">
                                        <button style="cursor: pointer;" type="submit" name="delete"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </form>

                        </tr>
                <?php
                    }
                  }
                ?>
                
            </table>

        </div>

    </div>

    <footer>
            <img src="../../web_images/clear coat of arms.png" alt="Court of Arms" class="footer-logo">
            <p>Repubulika y’u Rwanda</p>
        </footer>
  <script>
      let sentence="TABLE SHOWING ALL REGISTERED CELL LEADERS";
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
    header('location: ../sleader_login.php');
 }
?>