<?php
require_once 'Connection.php';


//var_dump($_POST);

if (isset($_POST['reg_btn']))
{
    $uid = $_POST['uname'];
    $pwd = $_POST['pword'];

    if ((empty($uid) && empty($pwd)) || empty($uid) || empty($pwd))
    {
        echo "Username and password cannot be empty.";
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
            $byte_i = 4;
            $bytes = openssl_random_pseudo_bytes($byte_i);
            $salt = bin2hex($bytes);

            //pass the salt
            $salt_pass = hash("sha512", $salt.$pwd);

            $sql = "INSERT INTO persons (username, password, hashPW) VALUES ('".$uid."', '".$pwd."', '".$salt_pass."' )";

            mysqli_query($conn, $sql);

            session_start();
            $_SESSION['u_id'] = $uid;
            $_SESSION['p_wd'] = $pwd;
            $_SESSION['s_pw'] = $salt_pass;

            header("Location: ../Client/homepage.php");
        }
    }
}
else if (isset($_POST['log_btn']))
{
    $uid = $_POST['uname'];
    $pwd = $_POST['pword'];

    if ((empty($uid) && empty($pwd)) || empty($uid) || empty($pwd))
    {
        echo "Username and password cannot be empty.";
        exit();
    }
    else
    {
        $sql = "SELECT * FROM persons WHERE username = '$uid'";

        $result = mysqli_query($conn, $sql);
        $result_check = mysqli_num_rows($result);
        if (!$result_check)
        {
            echo "No user by that name, please register.";
            exit();
        }
        else
        {
            //pass the salt
            $salt_pass = hash("sha512", $salt.$pwd);

            $sql = "SELECT username FROM persons WHERE username = '$uid'";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);

            $sqlp = "SELECT password FROM persons WHERE password = '$pwd'";
            $resultp = mysqli_query($conn, $sqlp);
            $result_checkp = mysqli_num_rows($resultp);

            if (!$result_check || !$result_checkp)
            {
                echo "Incorrect username or password!";
                exit();
            }
            else
            {
                session_start();
                $_SESSION['login_session_btn'] = $_POST['log_btn'];
                $_SESSION['u_id'] = $_POST['uname'];
                $_SESSION['p_wd'] = $_POST['pword'];
                $_SESSION['s_pw'] = $salt_pass;
                header("Location: ../Service/Login_Logic.php");
            }
        }
    }
}
else
{
    echo "Something's wrong with this page.";
}
