<?php
session_start();
if (isset($_SESSION['sector_leader'])) {
    if (isset($_GET["cleader_id"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Cell Leader</title>
    <link rel="stylesheet" href="../../web_styles/deleteCell_leader.css">
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
            <div class="user-names-alphabet-letters">
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
                                <li><a href="#">Addressed Issues</a></li>
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

        <div class="section-two">
            <?php
            include "../../web_connection/connection.php";
            $cleader_id=$_GET["cleader_id"];
            $sql="SELECT * FROM cell_leaders WHERE cleader_id='$cleader_id'";
            $query=$conn->query($sql);
            if ($query->num_rows >0) {
                $row=$query->fetch_assoc();
            ?>
              <form action="" method="POST">
                     <div class="delete-cell-form">
                        <p> Confirm Deletion of <span style="color:hsl(216, 60%, 14%);font-weight:bold;">
                            <?php echo $row["cleader_f_name"] ." ". $row["cleader_s_name"]."'s"?> </span>Account</p>
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
                $cleader_id=$_GET["cleader_id"];
                if (isset($_POST["deleteBtn"])) {
                    $sql="DELETE  FROM cell_leaders WHERE cleader_id='$cleader_id'";
                    $query=$conn->query($sql);
                    if ($query) {
                      echo"<p id='success-message'>Deletion Went Successfully</p>";
                      echo"
                       <script>
                         setTimeout(()=>{
                          window.location.href='./view_cell_leaders.php';
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
            window.location.href='./view_cell_leaders.php';
        }, 0);
    }
      let sentence="YOU'RE ABOUT TO DELETE A VILLAGE-LEADER ACCOUNT";
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
    header('location: ../sleader_login.php');
 }
?>