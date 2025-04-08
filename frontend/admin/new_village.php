<?php
session_start();
 if (isset($_SESSION["admin"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New VILLAGE</title>
    <link rel="stylesheet" href="../../web_styles/new_village.css">
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
                                <li><a href="./cell_leader.php">+Cell Leaders</a></li>
                                <li><a href="./village_leader.php">+Village Leaders</a></li>
                                <li><a href="./new_category.php">+New Category</a></li>
                            </ul>
                    </li>
                    <li><i style="font-size: 30px;" class="fa-solid fa-list-check"></i><a href="#">Administration &#9660</a>
                            <ul class="dropdown">
                                <li><a href="./new_sector.php">Sectors</a></li>
                                <li><a href="./new_cell.php">Cell</a></li>
                                <li><a href="./new_village.php">Village</a></li>
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="new-village-form">
            <p>REGISTER A NEW VILLAGE</p>

            
            <select id="select" name="cell" required>
                <option value="">Select the Corresponding Cell</option>
                <?php
                include "../../web_connection/connection.php"; 

                $sql = "SELECT cell_id, cell_name FROM cells ORDER BY cell_name ASC"; 
                $query = $conn->query($sql);
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                        echo "<option value='" . $row['cell_id'] . "'>" . $row['cell_name'] . "</option>";
                    }
                }
                ?>
            </select>

            
            <input type="text" name="village_name" id="village" placeholder="Village Name" required>

            
            <input type="submit" name="save" value="SAVE" id="save">
        </div>
    </form>

    <?php
    if (isset($_POST["save"])) {
        include "../../web_connection/connection.php"; 

        
        $village_name = filter_var($_POST['village_name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $cell_id = intval($_POST['cell']); 

        
        if (!empty($village_name) && $cell_id > 0) {
            $sql = "INSERT INTO villages (village_id, village_name,cell_id) VALUES (NULL, ?, ?)"; 
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $village_name, $cell_id);

            if ($stmt->execute()) {
                echo "<p id='success-message' style='margin-top: 30px;'>New village Registered Successfully!</p>";
                echo"
                  <script>
                  setTimeout(()=>{
                    window.location.href='new_village.php';
                  }, 2000);
                  </script>
                ";
            } else {
                echo "<p id='error-message'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p id='error-message'>Invalid input. Please select a Cell and enter a village name.</p>";
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
      let sentence="REGISTER A NEW ADMNISTRATION VILLAGE";
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