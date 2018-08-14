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
        $sql = "SELECT username, password FROM persons where username=? ORDER BY username, password ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $uid);

        if (! $stmt->execute())
        {
           die("The statement did not execute.");
        }

        $stmt->bind_result($uid, $pwd);

        while ($stmt->fetch())
        {
            ?><tr><td><?php print $uid; ?></td>
                  <td><?php print $pwd; ?></td>
    <?php
        }
        $conn->close();
    }
}
else
{
    echo "Error Login page.";
}

