<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<!--action="../Service/Registration.php"-->
    <form id="form" action="../Service/Registration.php" method="POST">
        Username: <input type="text" name="uname" /><br>
        Password: <input type="password" name="pword" /><br>
        <button type="submit" name="reg_btn" id="reg_btn">Registration</button>
        <button type="submit" name="log_btn" id="log_btn">Login</button>
    </form>
</body>
</html>