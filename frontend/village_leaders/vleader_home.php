<?php
 session_start();
 if (isset($_SESSION['village_leader'])) {
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KDRS| Village-Leader-Home</title>
    <link rel="stylesheet" href="../../web_styles/vleader_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <header>
        <div class="header">
            <img src="../../web_images/District.png" alt="" class="header-logo">
            <h2>KDRS|<span style="color: white;font-size:20px;">Kicukiro Disputes Resolving System</span></h2>
            <img src="../../web_images/Kckr.jpg" alt="" class="header-logo">
        </div>
        <div class="pairs-of-account-info">
            <p id="automatic-paragraph"></p>
            <div class="user-names-alphabet-letters" title="
            <?php
               $vleader_id=$_SESSION["vleader_id"];
                include "../../web_connection/connection.php";
                $sql="SELECT  vleader_f_name, vleader_s_name FROM village_leaders WHERE vleader_id='$vleader_id'";
                $query=$conn->query($sql);
                $row=$query->fetch_assoc();
                $firstName=$row["vleader_f_name"];
                $secondName=$row["vleader_s_name"];
                 echo $firstName ." ". $secondName;

               ?>   
            
            ">
               <?php
               $vleader_id=$_SESSION["vleader_id"];
                include "../../web_connection/connection.php";
                $sql="SELECT  vleader_f_name, vleader_s_name FROM village_leaders WHERE vleader_id='$vleader_id'";
                $query=$conn->query($sql);
                $row=$query->fetch_assoc();
                $firstName=$row["vleader_f_name"];
                $secondName=$row["vleader_s_name"];
                 echo $firstName[0] . $secondName[0];

               ?>
            </div>
        </div>
    </header>


    <?php
    include "../../web_connection/connection.php";
    $vleader_id=$_SESSION["vleader_id"];
    $sql="SELECT * FROM village_leaders WHERE vleader_id='$vleader_id' ";
    $query=$conn->query($sql);
    $row=$query->fetch_assoc();
    $username=$row["vleader_f_name"];
    $convertedToUpper=strtoupper($username)
    
    ?>
    <div class="sections">
        <div class="menu-section">
            <h2><i class="fa-solid fa-bars fa-lg" style="color:rgb(255, 255, 255);"></i></h2>
            <div>
                <ul>
                    <li><i class="fa-solid fa-house fa-lg" style="color:rgb(255, 255, 255);"></i><a href="./vleader_home.php">Dashboard</a></li>
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
                                <li><a href="./new_citizen.php">+New Citizen</a></li>
                            </ul>
                    </li>
                    <li></i><a href="#">VIEW &#9660</a>
                            <ul class="dropdown">
                               <li><a href="./view_all_citizen.php">All Citizens</a></li>
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
            header("location: ../vleader_login.php");
        }
        ?>

        <div class="section-two">
            <p id="dashboard-paragraph">Village Leader Dashboard - Dispute Status</p>
            <div class="dashboard-container">

                    
                    <div class="card new">
                        <p>New Disputes</p>
                    </div>

                    
                    <div class="card resolved">
                        
                        <p>Resolved Disputes</p>
                    </div>

                    
                    <div class="card pending">
                        
                        <p>Pending Disputes</p>
                    </div>

                    
                    <div class="card escalated">
                        
                        <p>Escalated Disputes</p>
                    </div>

            </div>

                
        </div>

    </div>

    <footer>
            <img src="../../web_images/clear coat of arms.png" alt="Court of Arms" class="footer-logo">
            <p>Repubulika y’u Rwanda</p>
        </footer>
  <script>
      let sentence="<?php echo $convertedToUpper?> Welcome Back to Home-Dashboard Page";
      let myElement=document.getElementById("automatic-paragraph");
      let speed=20;

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
    header('location: ../vleader_login.php');
 }
?>