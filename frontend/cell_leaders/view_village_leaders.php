<?php
 session_start();
 if (isset($_SESSION['cell_leader'])) {
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Village Leaders</title>
    <link rel="stylesheet" href="../../web_styles/leader_home.css">
    <link rel="stylesheet" href="../../web_styles/cleader_home.css">
    <link rel="stylesheet" href="../../web_styles/view_village_leaders.css">
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
               $cleader_id=$_SESSION["cleader_id"];
                include "../../web_connection/connection.php";
                $sql="SELECT  cleader_f_name, cleader_s_name FROM cell_leaders WHERE cleader_id='$cleader_id'";
                $query=$conn->query($sql);
                $row=$query->fetch_assoc();
                $firstName=$row["cleader_f_name"];
                $secondName=$row["cleader_s_name"];
                 echo $firstName ." ". $secondName;

               ?>   
            
            ">
            <?php
               $cleader_id=$_SESSION["cleader_id"];
                include "../../web_connection/connection.php";
                $sql="SELECT  cleader_f_name, cleader_s_name FROM cell_leaders WHERE cleader_id='$cleader_id'";
                $query=$conn->query($sql);
                $row=$query->fetch_assoc();
                $firstName=$row["cleader_f_name"];
                $secondName=$row["cleader_s_name"];
                 echo $firstName[0] . $secondName[0];

               ?>
            </div>
        </div>
    </header>

    <div class="sections">
    <div class="menu-section">
            <h2><i class="fa-solid fa-bars fa-lg" style="color:rgb(255, 255, 255);"></i></h2>
            <div>
                <ul>
                    <li><i class="fa-solid fa-house fa-lg" style="color:rgb(255, 255, 255);"></i><a href="./cleader_home.php">Dashboard</a></li>
                    <li><i class="fa-solid fa-id-card-clip fa-lg" style="color:rgb(255, 255, 255);"></i><a href="#">DISPUTES &#9660</a>
                    <ul class="dropdown">
                                <li><a href="#">New Issues</a></li>
                                <li><a href="#">Addressed Issues</a></li>
                                <li><a href="#">Pending Issues</a></li>
                                <li><a href="#">Escalated Issues</a></li>
                    </ul>
                    </li>
                    <li></i><a href="#">REGISTER &#9660</a>
                            <ul class="dropdown">
                                <li><a href="./village_leader.php">+Village Leader</a></li>
                            </ul>
                    </li>
                    <li></i><a href="#">VIEW &#9660</a>
                            <ul class="dropdown">
                               <li><a href="./view_village_leaders.php">All Village Leader</a></li>
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
            header("location: ../cleader_login.php");
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
                    <th style="width: 200px;" >DELETE</th>
                </tr>
                <?php
                  include "../../web_connection/connection.php";
                  $cleader_id=$_SESSION["cleader_id"];
                  $sql = "SELECT villages.village_id, villages.village_name,village_leaders.vleader_id,
                  village_leaders.vleader_f_name,village_leaders.vleader_s_name,
                  village_leaders.vleader_phone, village_leaders.vleader_password,village_leaders.vleader_national_id
                  FROM villages INNER JOIN village_leaders ON villages.village_id=village_leaders.village_id 
                   INNER JOIN cells ON villages.cell_id = cells.cell_id INNER JOIN cell_leaders  ON cell_leaders.cell_id = cells.cell_id
                  WHERE cell_leaders.cleader_id ='$cleader_id';";

                  $query=$conn->query($sql);
                  if ($query->num_rows >0) {
                    $count=0;
                    while($row=$query->fetch_assoc()){
                        $count++
                        ?>
                        <tr>
                            <td><?php echo $count?></td>
                            <td><?php echo $row["vleader_f_name"]?></td>
                            <td><?php echo $row["vleader_s_name"]?></td>
                            <td><?php echo $row["vleader_phone"]?></td>
                            <td><?php echo $row["vleader_password"]?></td>
                            <td><?php echo $row["vleader_national_id"]?></td>
                            <td><?php echo $row["village_name"]?></td>
  
                                <form action="deleteVillage_leader.php" method="GET">
                                    <input type="hidden" name="vleader_id" value="<?php echo $row["vleader_id"]?>">
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
      let sentence="TABLE SHOWING ALL REGISTERED VILLAGE LEADERS";
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
    header('location: ../cleader_login.php');
 }
?>