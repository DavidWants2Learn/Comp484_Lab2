<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <script>
            function init ()
            {
                btn_click = document.getElementById("btn");

                btn_click.addEventListener("click", lightFade);
            }

            function lightFade (lightId)
            {
                var lightOn = true;
                var bri = 255;

                var urlStr = "http://130.166.45.108/api/";

                sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : true, "bri" : 255, "hue" : 53498 } ));

                for (var i = 0; i < 12; i++)
                {
                    if (bri <= 0) lightOn = false;
                    sendAJAX(urlStr, "PUT", JSON.stringify( {"bri" : bri, "on" : lightOn, "hue" : 53498  } ));
                    bri -= 25;
                    sleepMs(200);
                }
            }

            function sendAJAX (url, method, str)
            {
                var req = new XMLHttpRequest();
                req.open(method, url, true);
                req.setRequestHeader("Content-Type", "application/json");
                req.send(str);
            }

            function sleepMs (msec)
            {
                var start = new Date().getTime();
                while ( (new Date().getTime()) < (start + msec));
            }

            window.addEventListener("load", init, false);
        </script>
    </head>
    <body>

        <?php
        session_start();
        echo $_SESSION['u_id'];
        echo "Hashed Pass";
        echo $_SESSION['p_wd'];
        echo "Salted Pass";
        echo $_SESSION['s_pw'];
        session_write_close();
        ?>
        <p>To turn on the light, press the button.</p>
        <form>
            <input type="button" id="btn" value="Light Switch" onclick="lightFade(3)">
        </form>
    </body>
</html>