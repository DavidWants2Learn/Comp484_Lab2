<?php
require_once 'Connection.php';

//var_dump($_POST);

if (isset($_POST['reg_btn']))
{
    $uid = $_POST['uname'];
    $pwd = $_POST['pword'];

    if ((empty($uid) && empty($uid)) || empty($uid) || empty($pwd))
    {
        echo "Username and password cannot be empty. Registration";
        exit();
    }
    else
    {
        //echo $_POST['uname'];
        $sql = "SELECT * FROM persons WHERE username = '$uid'";

        $result = mysqli_query($conn, $sql);
        $result_check = mysqli_num_rows($result);

        if ($result_check)
        {
            echo "Username already exists, please choose another name.";
            exit();
        }
        else
        {
            $salt = 'buckaroo';
            //hash the pass
            $hash_pass = password_hash($pwd, PASSWORD_DEFAULT);
            //pass the salt
            $salt_pass = md5($salt, $hash_pass);

            $sql = "INSERT INTO persons (username, password) VALUES ('".$uid."', '".$salt_pass."' )";

            mysqli_query($conn, $sql);

            session_start();
            $_SESSION['u_id'] = $_POST['uname'];
            $_SESSION['p_wd'] = $salt_pass;

//            var_dump($uid);

//            $sql = "SELECT username FROM persons;
//            for ( reset($sql); $element = 'key'; next($sql) )
//            {
//              echo "Hello World.";
//            }

            header("Location: ../Client/homepage.php");
        }
    }
}
else if (isset($_POST['log_btn']))
{
    $salt = '?!/b-u%c#k*a@r(o(o)+/';
    $pwd = $_POST['pword'];
    $hash_pass = password_hash($pwd, PASSWORD_DEFAULT);
    $salt_pass = md5($salt, $hash_pass);

    session_start();
    $_SESSION['login_session_btn'] = $_POST['log_btn'];
    $_SESSION['u_id'] = $_POST['uname'];
    $_SESSION['s_pw'] = $salt_pass;
    $_SESSION['p_wd'] = $hash_pass;
    header("Location: ../Service/Login_Logic.php");
}
else
{
    echo "Something's wrong with the Registration.";
}