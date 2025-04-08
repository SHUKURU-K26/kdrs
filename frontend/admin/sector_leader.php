<?php
session_start();
 if (isset($_SESSION["admin"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Sector Leader</title>
    <link rel="stylesheet" href="../../web_styles/new_sleaders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

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
      

        <div class="containers">
               
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
            <?php
                    include "../../web_connection/connection.php";
                     if (isset($_POST["SAVE"])){
                         $firstname=filter_var($_POST["firstname"], FILTER_SANITIZE_SPECIAL_CHARS);
                         $secondname=filter_var($_POST["secondname"], FILTER_SANITIZE_SPECIAL_CHARS);
                         $phone_number=filter_var($_POST["leader-phone"], FILTER_SANITIZE_NUMBER_INT);
                         $password=$_POST["password"];
                         $national_id=$_POST["national_id"];
                         $sector_name=$_POST["selected_sector"];
                         if (strlen($phone_number) < 10 && strlen($national_id)) {
                            echo"<p style='color: red; font-size: 24px;'>Invalid Phone-number & National-ID Detected</p>";

                        }
                         elseif (strlen($phone_number) < 10) {
                            echo"<p style='color: red; font-size: 24px;'>Phone number must be between 10 digits</p>";

                        }elseif(strlen($national_id) < 16) {
                            echo"<p style='color: red; font-size: 24px;'>National ID must be between 16 digits</p>";

                        }
                        else{
                            $sql="INSERT INTO sector_leaders VALUES('', '$firstname','$secondname','$phone_number','$password',
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
                <div class="new-leader-form">
                
                    <p>REGISTER A NEW SECTOR LEADER</p>
                        <input type="text" class="inputs" name="firstname" onclick="ToValidateChars(document.getElementById('first-name'))" id="first-name" placeholder="First Name"  required>
                        <input type="text" class="inputs" name="secondname" onclick="ToValidateChars(document.getElementById('second-name'))" id="second-name" placeholder="Second Name"  required>

                        <div class="input-pairs">
                            <input type="tel" class="inputs" id="phone" readonly required>
                            <input type="tel" style="margin-top: 0px;" class="inputs" name="leader-phone" placeholder="Enter your Mobile-Phone number" id="phone-input" required>
                        </div>

                        <input type="password" class="inputs" name="password" placeholder="Register Password" required>         
                        <input type="number" class="inputs" name="national_id"  placeholder="National ID" id="national-id" required>
                        <p style="font-weight:bold;font-size: 25px;">Select the Field of Office:</p>
                                
                    <select name="selected_sector" id="" required>
                            <option value="">Select the Field of Office</option>
                                                
                                <?php
                                    include "../../web_connection/connection.php";
                                    $Sql="SELECT sector_id, sector_name FROM sectors order by sector_name asc";            
                                    $query=$conn->query($Sql);
                                    if ($query->num_rows > 0 ) {
                                        while ($row=$query->fetch_assoc()){
                                ?>
                                <option value="<?php echo $row['sector_id']?>" name="<?php echo $row['sector_id']?>"><?php echo $row["sector_name"]?></option>
                                <?php
                                }
                                }
                               
                            ?>
                                            
                    </select>
                    <input type="submit" name="SAVE" value="SAVE" id="save">
                </div>
            </form>
           
        </div>
    </div>

    <footer>
            <img src="../../web_images/clear coat of arms.png" alt="Court of Arms" class="footer-logo">
            <p>Repubulika y’u Rwanda</p>
        </footer>
  <script>
      //Validations of My Inputs
        function ToValidateChars(InputField){
            InputField.addEventListener("input", function (event) {
                let inputValue = event.target.value;
                event.target.value = inputValue.replace(/[^a-zA-Z]/g, "");
                
            });
        } 
      function ToToggle(selectedOption, opt2, opt3){
        if (selectedOption.checked) {
            opt2.style.display="none";
            opt3.style.display="none";
        }else{
            opt2.style.display="block"
            opt3.style.display="block"
        }
      }
     
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
       initialCountry: "rw", 
       separateDialCode: true,
    });


   document.getElementById("phone-input").addEventListener("input", function (event) {
    this.value = this.value.replace(/\D/g, ""); 
});
document.getElementById("phone-input").addEventListener("input", function(){
    if (this.value.length>10) {
        this.value=this.value.slice(0, 10);
    }
})

document.getElementById("national-id").addEventListener("input", function(){
    if (this.value.length > 16) {
        this.value = this.value.slice(0, 16);
    }
});
document.getElementById("national-id").addEventListener("input", function (event){
            let myId=event.target.value;
            event.target.value=myId.replace('-',"");
            if (event.target.value.charAt(0)==0) {
                event.target.value=myId.replace('0', "");
                alert(`⚠ Invalid input Detected!.`);
        }
})

      let sentence="REGISTER A NEW LEADER";
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

