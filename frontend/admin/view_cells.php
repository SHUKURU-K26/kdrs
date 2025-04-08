<?php
 session_start();

 if (isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Cells</title>
    <link rel="stylesheet" href="../../web_styles/view_sectors.css">
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
        <div class="containers" style="height: 700px; overflow-y:scroll;">
            <table border="2px">
                <tr style="background-color: hsl(216, 88%, 20%);color: white;">
                    <th style="width: 200px;">N#</th>
                    <th style="width: 200px;" >CELL NAME</th>
                    <th style="width: 200px;" >CELL LEADER NAMES</th>
                    <th style="width: 200px;" >CORRESPOND SECTOR</th>
                    <th style="width: 200px;" colspan="2" >ACTION</th>
                </tr>
                <?php
                  include "../../web_connection/connection.php";
                  $sql="SELECT cells.cell_id, cells.cell_name, sectors.sector_name, cell_leaders.cleader_f_name,cell_leaders.cleader_s_name
                  FROM cells 
                  INNER JOIN sectors ON cells.sector_id=sectors.sector_id
                  INNER JOIN cell_leaders ON cell_leaders.cell_id=cells.cell_id";
                  $query=$conn->query($sql);
                  if ($query->num_rows >0) {
                    $count=0;
                    while($row=$query->fetch_assoc()){
                        $count++;
                        ?>
                        <tr>
                            <td><?php echo $count?></td>
                            <td><?php echo $row["cell_name"]?></td>
                            <td><?php echo $row["cleader_f_name"]." ".$row["cleader_s_name"]?></td>
                            <td><?php echo $row["sector_name"]?></td>


                                <form action="update_cell.php" method="GET">
                                    <input type="hidden" name="cell_id" value="<?php echo $row["cell_id"]?>">
                                    <td style="cursor: pointer;">
                                        <button style="cursor: pointer;" type="submit" name="update"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </td>
                                </form>
                           
                                <form action="delete_cell.php" method="GET">
                                    <input type="hidden" name="cell_id" value="<?php echo $row["cell_id"]?>">
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
      let sentence="TABLE-SHOWING-ALL-REGISTERED-CELLS";
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
}else{
   header("location:../admin_login.php");
}
?>