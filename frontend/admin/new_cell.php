<?php
session_start();
 if (isset($_SESSION["admin"])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register New Cell</title>
    <link rel="stylesheet" href="../../web_styles/new_cell.css">
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="new-cell-form">
            <p>REGISTER A NEW CELL</p>            
            <select id="select" name="sector_id" required>
                <option value="">Select the Corresponding Sector</option>
                <?php
                include "../../web_connection/connection.php"; 
                $sql = "SELECT sector_id, sector_name FROM sectors ORDER BY sector_name ASC"; 
                $query = $conn->query($sql);
                if ($query->num_rows > 0) {
                    while ($row = $query->fetch_assoc()) {
                        echo "<option value='" . $row['sector_id'] . "'>" . $row['sector_name'] . "</option>";
                    }
                }
                ?>
            </select>      

            <input type="text" name="cell_name" id="cell" placeholder="Cell Name" required>
            <input type="submit" name="save" value="SAVE" id="save">
        </div>
    </form>

    <?php
    if (isset($_POST["save"])) {
        include "../../web_connection/connection.php"; 

        
        $cell_name = filter_var($_POST['cell_name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $sector_id = intval($_POST['sector_id']); 

        
        if (!empty($cell_name) && $sector_id > 0) {
            $sql = "INSERT INTO cells (cell_id, cell_name, sector_id) VALUES (NULL, ?, ?)"; 
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $cell_name, $sector_id);

            if ($stmt->execute()) {
                echo "<p id='success-message'>New Cell Registered Successfully!</p>";
                header("refresh: 3");
            } else {
                echo "<p id='error-message'>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p id='error-message'>Invalid input. Please select a sector and enter a cell name.</p>";
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
      let sentence="REGISTER A NEW ADMNISTRATION CELL";
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