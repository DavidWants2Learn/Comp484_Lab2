<?php

//require_once 'Connection.php';

session_start();
$_POST['log_btn'] = $_SESSION['login_session_btn'];
$_POST['uname'] = $_SESSION['u_id'];
$_POST['pword'] = $_SESSION['p_wd'];

if (isset($_POST['log_btn']))
{
    $uid = $_POST['uname'];
    $pwd = $_POST['pword'];

    if ((empty($uid) && empty($uid)) || empty($uid) || empty($pwd))
    {
        echo "Username and Password must be filled. Login";
    }
    else
    {
        header("Location: ../Client/homepage.php");
    }
}
else
{
    echo "Error Login page.";
}

