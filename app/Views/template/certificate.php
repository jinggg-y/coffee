<html>
    <head>
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                
                font-size: 24px;
                text-align: center;
            }
            .container {
                border: 20px solid tan;
                width: 750px;
                height: 563px;
                vertical-align: middle;
            }
            .logo {
                color: tan;
            }

            .marquee {
                color: tan;
                font-size: 48px;
                margin: 20px;
            }
            .assignment {
                margin: 20px;
            }
            .person {
                border-bottom: 2px solid black;
                font-size: 32px;
                font-style: italic;
                margin: 20px auto;
                width: 400px;
            }
            .reason {
                font-size: 16px;
                margin: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="logo">Coffee Sensation</div>

            <div class="marquee">
                Certificate of Instructor
            </div>

            <div class="assignment">
                This certificate is presented to
            </div>

            <div class="person">
            <?= $firstname. ' '. $lastname ?>
            </div>

            <div class="reason">
                For teaching <?= $coursename ?> on <br>
                Coffee Sensation - online learning platform
            </div>
        </div>
    </body>
</html>