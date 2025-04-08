<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - KDRS</title>
    <link rel="stylesheet" href="../web_styles/admin_login.css">
</head>
<body>

        <header>
                <img src="../web_images/District.png" alt="District Logo" class="header-logo">
                <h2>KDRS|<span style="color: grey;font-size:20px;">Kicukiro Disputes Resolving System</span></h2>
                <img src="../web_images/Kckr.jpg" alt="Arm Court Logo" class="header-logo">
        </header>
        <?php
          include "../web_connection/connection.php";
          if (isset($_POST["login"])) {
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $password = $_POST["password"];
        
            $stmt = $conn->prepare('SELECT *  FROM admins WHERE admin_password=? AND admin_phone=? AND admin_email=?');
            $stmt->bind_param('sss',$password, $phone, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
        
            if ($row) {
                    $_SESSION["admin"] = $row["admin_password"];
                    header("location: ./admin/admin_home.php");
                    exit();
            } 
            else{
                   echo "<p style='color:red; width:400px;
                   padding:10px 5px;background-color: hsl(0, 75.80%, 87.10%);
                   border: 2px solid  hsl(0, 100%, 60%);font-size: 17px;border-radius:10px;'>Oops..Incorrect Credentials!!</p>";
            }
    }
          
        ?>

    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST" id="login-form">
            <div class="input-group">
                <input type="email" placeholder="E-mail" required name="email">
            </div>
            <div class="input-group">
                <input type="tel" placeholder="Phone Number" required name="phone">
            </div>
            <div class="input-group" style="display: flex; justify-content: space-between;">
                <div class="eye" id="lock" style="width:50px;background-color: white;font-size: 20px; border-radius:5px ;border:1px solid black;cursor:pointer;" onclick="TogglePassword()">🔒</div>
                <input type="password" style="width: 270px;" placeholder="Password" required name="password" id="password">
            </div>
                <div class="buttons">
                    <button onclick="window.location.href='../index.php'" id="back-button">Back</button>
                    <button type="submit" id="login-button" name="login">Login</button>
                </div>
        </form>
        
    </div>

    <footer>
        <img src="../web_images/clear coat of arms.png" alt="arm cout" class="footer-arm-of-court">
        <p>Republika y'u Rwanda</p>
    </footer>
    <script>
        function TogglePassword(){
            let pswd=document.getElementById('password');
            let lock=document.getElementById('lock');
            if (pswd.type==='password') {
                pswd.type='text';
                lock.textContent='🔓';
            }else{
                pswd.type='password';
                lock.textContent='🔒';
            }
        }
        
    </script>
</body>
</html>
