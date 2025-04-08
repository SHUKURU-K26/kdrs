<!DOCTYPE html>
<html lang="rw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KDRS - Citizen Login</title>
    <link rel="stylesheet" href="../web_styles/citizen_login.css">
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
                <h2>Muhisemo Kwinjira nk’ Umuturage</h2>
                <p>Injiza Umwirondoro wawe:</p>
                <div class="fields">


                            <div class="for-phone-input">
                                <label for="label-for-phone-input">Injiza Nimero ya Telephone 
                                <span style="font-size:20px;color:red;font-weight:bold;">*</span></label>

                                <div class="telcode-input">
                                    <div class="box-250">+250</div>
                                    <input type="tel" name="tel" id="telphone" autofocus>
                                </div>
                            </div>


                            <div class="for-password-input">
                                <label for="label-for-phone-input">Injiza ijambo Banga 
                                <span style="font-size:20px;color:red;font-weight:bold;">*</span></label>

                                <div class="password-input">
                                 <div class="eye" id="lock" style="background-color: white;font-size: 20px;border:1px solid black;cursor:pointer;" onclick="TogglePassword()">🔒</div>
                                    <input type="password" name="password" id="password">
                                </div>
                            </div>

                        <div class="div-btn">
                            <button type="submit" onclick="window.location.href='../index.php'" name="myBtn" style="background-color: orange;">Ahabanza</button>
                            <button  name="myBtn">Injira</button>
                        </div>


                </div>
        </main>
        
        <footer>
            <img src="../web_images/clear coat of arms.png" alt="Court of Arms" class="footer-logo">
            <p>Repubulika y’u Rwanda</p>
        </footer>
    </div>
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
