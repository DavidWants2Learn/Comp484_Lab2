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
            //pass the salt
            $hash_pass = password_hash($pwd, PASSWORD_DEFAULT);

            echo $hash_pass;


            $sql = "INSERT INTO persons (username, password) VALUES ('".$uid."', '".$hash_pass."' )";

            mysqli_query($conn, $sql);

            session_start();
            $_SESSION['u_id'] = $_POST['uname'];
            $_SESSION['p_wd'] = $hash_pass;

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
    session_start();
    $_SESSION['login_session_btn'] = $_POST['log_btn'];
    $_SESSION['u_id'] = $_POST['uname'];
    $_SESSION['p_wd'] = $_POST['pword'];
    header("Location: ../Service/Login_Logic.php");
}
else
{
    echo "Something's wrong on the Registration.";
}