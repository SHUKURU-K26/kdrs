<?php
session_start();
 if (isset($_SESSION["admin"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Category</title>
    <link rel="stylesheet" href="../../web_styles/new_category.css">
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
                    <li><i style="font-size: 30px;" class="fa-solid fa-user-tie"></i><a href="">Leaders</a></li>
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
      

        <div class="section-two">
               
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <?php
                    include "../../web_connection/connection.php";
                     if (isset($_POST["SAVE"])){
                         $category_name=filter_var($_POST["category_name"], FILTER_SANITIZE_SPECIAL_CHARS);
                         $duration=filter_var($_POST["duration"], FILTER_SANITIZE_SPECIAL_CHARS);
                         $phone_number=filter_var($_POST["leader-phone"], FILTER_SANITIZE_NUMBER_INT);
                         $password=$_POST["password"];
                         $national_id=$_POST["national_id"];
                         $sector_name=$_POST["selected_leader"];
                         if (strlen($phone_number) < 10 && strlen($national_id)) {
                            echo"<p style='color: red; font-size: 24px;'>Invalid Phone-number & National-ID Detected</p>";

                        }
                         elseif (strlen($phone_number) < 10) {
                            echo"<p style='color: red; font-size: 24px;'>Phone number must be between 10 digits</p>";

                        }elseif(strlen($national_id) < 16) {
                            echo"<p style='color: red; font-size: 24px;'>National ID must be between 16 digits</p>";

                        }
                        else{
                            $sql="INSERT INTO sector_leaders VALUES('','$category_name','$duration','$phone_number','$password',
                            '$national_id','$sector_name')";
                            $query=$conn->query($sql);
                            if ($query) {
                                echo"<p style='color:rgb(0, 9, 59)8, 255); font-weight:bold; font-size: 24px;'>Leader Registered Successfully!</p>";
                                echo"<script>
                                 setTimeout(()=>{
                                    window.location.href='./admin_home.php';
                                 }, 2000);
                                </script>";
                            }
                        }
                        
                    }

            ?>
                <div class="new-category-form">
                        <p>New Category Registration</p>

                        <!-- Category Name Input -->
                        <label for="category_name">Category Name:</label>
                        <input type="text" id="category_name" name="category_name" class="inputs" placeholder="Enter Category Name" required>

                        <label>Duration Time:</label>
                    <div class="input-pairs">
                        <input type="checkbox" onclick="ToToggle(document.getElementById('weeks'), 
                        document.getElementById('days'), document.getElementById('hours'))" id="weeks" required><label for="">WEEKS</label>

                            <input type="checkbox" onclick="ToToggle(document.getElementById('days'), 
                        document.getElementById('weeks'), document.getElementById('hours'))" id="days" required><label for="">DAYS</label>

                        </div>

                            <select name="weeks" id="weekSelection" style="display: none;">
                                <option value="" >--Weeks--</option>
                                <option value="7">1 Weeks</option>
                                <option value="14">2 Weeks</option>
                            </select>

                            <select name="days" id="daySelection" style="display: none;">
                                <option value="" >--Days--</option>
                                <option value="1">1 Day</option>
                                <option value="2">2 Days</option>
                                <option value="3">3 Days</option>
                                <option value="4">4 Days</option>
                                <option value="5">5 Days</option>
                                <option value="6">6 Days</option>
                            </select>

                        <button id="save" type="submit">Save Category</button>
                    </div>

            </form>
           
        </div>
    </div>

    <footer>
            <img src="../../web_images/clear coat of arms.png" alt="Court of Arms" class="footer-logo">
            <p>Repubulika y’u Rwanda</p>
        </footer>
  <script>
      let weekSelection=document.getElementById("weekSelection");
      let weekCheckbox=document.getElementById("weeks");
      if (weekCheckbox.checked) {
          weekSelection.style.display="block";
      }else{
           weekSelection.style.display="none";
      }

      let daySelection=document.getElementById("daySelection");
      let daysCheckbox=document.getElementById("days");
      if (daysCheckbox.checked) {
          daySelection.style.display="block";
      }else{
           daySelection.style.display="none";
      }
            
      function ToToggle(selectedOption, opt2){
        let label=document.getElementById("label");
        if (selectedOption.checked){
            opt2.style.display="none";
            opt2.checked=false
        }else{
            opt2.style.display="block"
            
        }
      }

      let sentence="REGISTER A NEW CATEGORY";
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
    header("../../");
 }
?>

