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
            var lightId = 3;

            btn_click = document.getElementById("btn");

            btn_click.addEventListener("click", blink, false);
        }

        function lightFade (lightId)
        {
            var lightOn = true;
            var bri = 255;
            var hue = 53498;
            var authCode = "ljgGD5V-e8RWeyi0BF5FxAAfRNQCP2-H7AH41vfG"

            var urlStr = "http://130.166.45.108/api/";
            urlStr += authCode;
            urlStr += "/lights/" + lightId + "/state";

            sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : true, "bri" : 255} ));

            for (var i = 0; i < 12; i++)
            {
                if (bri <= 0) lightOn = false;
                sendAJAX(urlStr, "PUT", JSON.stringify( {"bri" : bri, "on" : lightOn} ));
                bri -= 25;
                sleepMs(200);
            }
            //console.log(urlStr);
        }

        function lightOffOn()
        {
            var blinks = 4;
            var lightOn = true;
            var bri = 255;
            var hue = 33498;  //53498
            var urlStr = "http://130.166.45.108/api/ljgGD5V-e8RWeyi0BF5FxAAfRNQCP2-H7AH41vfG/lights/" + 3 + "/state";
            sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : true, "bri" : 255 } ));
            sleepMs();
            sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : false, "bri" : 255} ));
            sleepMs();
            sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : true, "bri" : 255 } ));
            sleepMs();
            sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : false, "bri" : 255} ));
            sleepMs();

            for (var index = 1; i < blinks; i++) {
                if (lightOn = true) {
                    sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : true, "bri" : 255 } ));
                    lightOn = false;
                }
                else {
                    sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : false, "bri" : 255} ));
                    lightOn = true;
                }
            }
        }

        function blink()
        {
            var lightOn = true;
            var bri = 255;
            var hue = 33498;  //53498
            var urlStr = "http://130.166.45.108/api/ljgGD5V-e8RWeyi0BF5FxAAfRNQCP2-H7AH41vfG/lights/" + 3 + "/state";
            for (var i=0; i<4; i++)
            {
                sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : true, "hue" : hue , "bri" : 255  } ));
                sleepMs(1000);
                sendAJAX(urlStr, "PUT", JSON.stringify( { "on" : false, "hue" : hue , "bri" : 255 } ));
                sleepMs(1000);
            }
        }

        function sendAJAX (url, method, str)
        {
            var req = new XMLHttpRequest();
            req.open(method, url, true);
            req.setRequestHeader("Content-Type", "application/json ");
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
        session_write_close();
    ?>
    <p>To turn on the light, press the button.</p>
        <form>
            <input type="button" id="btn" value="Light Switch">
        </form>
    </body>
</html>