<?php
require_once 'Connection.php';

if (isset($_POST['reg_btn']))
{
    $uid = $_POST['uname'];
    $pwd = $_POST['pword'];

    if (empty($uid) && (empty($pwd)))
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
            //pass the salt
            $hash_pass = password_hash($pwd, PASSWORD_DEFAULT);

            echo $hash_pass;


            $sql = "INSERT INTO persons (username, password) VALUES ('".$uid."', '".$hash_pass."' )";

            mysqli_query($conn, $sql);

            session_start();
            $_SESSION['u_id'] = $_POST['uname'];
            $_SESSION['p_wd'] = $hash_pass;

            header("Location: ../Client/homepage.php");
        }
    }
}
else
{
    echo "Hello world.";
}