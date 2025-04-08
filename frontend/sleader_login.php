<?php
 session_start();
?>
<!DOCTYPE html>
<html lang="rw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KDRS - CELL LEADER LOGIN</title>
    <link rel="stylesheet" href="../web_styles/leaders_login.css">
</head>
<body>
    <div class="container">
        <header>
            <img src="../web_images/District.png" alt="District Logo" class="top-left">
            <h2>KDRS|<span style="color: grey;font-size:20px;">Kicukiro Disputes Resolving System</span></h2>
            <img src="../web_images/Kckr.jpg" alt="Kicukiro Logo" class="top-right">
        </header>
        
        <main>
            <div class="login-form">
            <?php
                include "../web_connection/connection.php";
                if (isset($_POST["Login"])) {
                    $phone = $_POST["tel"];
                    $password = $_POST["password"];
                
                    $stmt = $conn->prepare('SELECT *  FROM sector_leaders WHERE sleader_password=? AND sleader_phone= ? ');
                    $stmt->bind_param('ss',$password, $phone);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                
                    if ($row){
                            $_SESSION["sector_leader"] = $row["sleader_password"];
                            $_SESSION["sleader_id"]=$row["sleader_id"];
                            header("location: ./sector_leaders/sleader_home.php");
                            exit();
                    } 
                    else{
                        echo "<p style='color:red; width:400px;text-align:center;
                        padding:10px 5px;background-color: hsl(0, 75.80%, 87.10%);
                        border: 2px solid  hsl(0, 100%, 60%);font-size: 17px;border-radius:10px;'>Oops..Incorrect Credentials!!</p>";
                        echo"
                        <script>
                          setTimeout(()=>{
                           window.location.href='./sleader_login.php';
                          }, 2000)
                        </script>
                        ";
                    }
            }elseif(isset($_POST["back"])){
                 header("location: ../index.php");
            }
          
        ?>
                <h2>Muhisemo Kwinjira nk’ Umuyobozi W'Umurenge</h2>
                <p>Injiza Umwirondoro wawe:</p>
                
                    <div class="fields">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
                                <div class="for-phone-input">
                                    <label for="label-for-phone-input">Injiza Nimero ya Telephone 
                                    <span style="font-size:20px;color:red;font-weight:bold;">*</span></label>
    
                                    <div class="telcode-input">
                                        <div class="box-250">+250</div>
                                        <input type="tel" placeholder="Mobile-Number" name="tel" id="telphone" autofocus >
                                    </div>
                                </div>
    
    
                                <div class="for-password-input">
                                    <label for="label-for-phone-input">Injiza ijambo Banga 
                                    <span style="font-size:20px;color:red;font-weight:bold;">*</span></label>
    
                                    <div class="password-input">
                                     <div class="eye" id="lock" style="background-color: white;font-size: 20px;border:1px solid black;cursor:pointer;" onclick="TogglePassword()">🔒</div>
                                        <input type="password" name="password" id="password" placeholder="Password" >
                                    </div>
                                </div>
                        
                            <div class="div-btn">
                                <button name="back" onclick="Todisable()" id="back" style="background-color: orange;">Ahabanza</button>
                                <button type="submit" name="Login">Injira</button>
                            </div>
                        </form>
                    </div>
            </div>
    </main>
        
        <footer>
            <img src="../web_images/clear coat of arms.png" alt="Court of Arms" class="footer-logo">
            <p>Repubulika y’u Rwanda</p>
        </footer>
    </div>
    <script>
        function Todisable(){
            let myElement=document.querySelector("#back")
            myElement.required=false;
        }
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
