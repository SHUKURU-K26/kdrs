<?php
 session_start();

 if (isset($_SESSION['sector_leader'])) {
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leader-Home</title>
    <link rel="stylesheet" href="../../web_styles/leader_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <header>
        <div class="header">
            <img src="../../web_images/District.png" alt="" class="header-logo">
            <h2>KDRS|<span style="color: grey;font-size:20px;">Kicukiro Disputes Resolving System</span></h2>
            <img src="../../web_images/Kckr.jpg" alt="" class="header-logo">
        </div>
        <div class="pairs-of-account-info" title="
                
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


    <?php
    include "../../web_connection/connection.php";
    $sleader_id=$_SESSION["sleader_id"];
    $sql="SELECT * FROM sector_leaders WHERE sleader_id='$sleader_id' ";
    $query=$conn->query($sql);
    $row=$query->fetch_assoc();
    $username=$row["sleader_s_name"];
    $convertedToUpper=strtoupper($username)
    
    ?>
    <div class="sections">
        <div class="menu-section">
            <h2><i class="fa-solid fa-bars fa-lg" style="color: #051f4d;"></i></h2>
            <div>
                <ul>
                    <li><i class="fa-solid fa-house fa-lg" style="color: #051f4d;"></i><a href="./sleader_home.php">Dashboard</a></li>
                    <li><i class="fa-solid fa-id-card-clip fa-lg" style="color: #051f4d;"></i><a href="#">DISPUTES &#9660</a>
                    <ul class="dropdown">
                                <li><a href="#">New Issues</a></li>
                                <li><a href="#">Addressed Issues</a></li>
                                <li><a href="#">Pending Issues</a></li>
                                <li><a href="#">Escalated Issues</a></li>
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
              <p id="dashboard-paragraph">Dashboard Data Bar Representation</p>
            <div class="bars">
                
               <div class="green-bar">
                    
               </div>

               <div class="yellow-bar">
                   
               </div>


               <div class="red-bar">
                   
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