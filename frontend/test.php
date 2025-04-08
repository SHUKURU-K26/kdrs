<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <p>Checkbox Test</p>
        <form action="" method="post">
            <input type="checkbox" name="check" id="check"><label for="check">Check Me!</label>
            <input type="submit" value="Submit">
        </form>
        <?php
         if(isset($_POST["check"])){
            echo "Hello World";
         }
        ?>
    </div>
</body>
</html>
