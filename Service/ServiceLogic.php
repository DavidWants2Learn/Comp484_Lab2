<?php
require_once 'Connection.php';


if (isset($_POST['reg_btn']))
{
    $uid = $_POST['uname'];
    $pwd = $_POST['pword'];

    if ((empty($uid) && empty($pwd)) || empty($uid) || empty($pwd))
    {
        //if username or password field is not set.
        echo "Username and password cannot be empty.";
        exit();
    }
    else
    {
        //query name
        $sql = "SELECT * FROM persons WHERE username = '$uid'";
        $result = mysqli_query($conn, $sql);
        $result_check = mysqli_num_rows($result);

        if ($result_check)
        {
            //if username already exists.
            echo "Username already exists, please choose another name.";
            exit();
        }
        else
        {
            $salt = hash("sha512", $uid);

            //salt the pass
            $hash = hash("sha512", $salt.$pwd);

            $sql = "INSERT INTO persons (username, salt, hash) VALUES ('".$uid."', '".$salt."', '".$hash."')";

            mysqli_query($conn, $sql);

            session_start();
            $_SESSION['u_id'] = $uid;

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
        //If username // password field is empty.
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
            //If username does not exist.
            echo "No user by that name, please register.";
            exit();
        }
        else
        {
            $salt = hash("sha512", $uid);

            //pass the salt
            $hash = hash("sha512", $salt.$pwd);

            $sql = "SELECT username FROM persons WHERE username = '$uid'";
            $result = mysqli_query($conn, $sql);
            $result_check = mysqli_num_rows($result);

            $sqlp = "SELECT hash FROM persons WHERE hash = '$hash'";
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
                header("Location: ../Client/homepage.php");
            }
        }
    }
}
else
{
    echo "Something's wrong with this page.";
}
