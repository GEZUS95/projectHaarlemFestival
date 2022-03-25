<html>
<body>
<h1 style="font-size:xx-large;color:white;background-color:#1A222A;text-align:center;padding:1%;">Haarlem Festival</h1>
<h1 style="background-color:white;color:black;text-align:center;padding:20px;">Hi {{$name}} Testpersoon!</h1>

<p style="background-color:white;color:#222222;text-align:center;">We would like to let you know that the festival has
    added the following items that may interest you:</p>
<div class="ad_tiles">
    <div id="ad_tile1">
        Caprera openluchtsessie<br>
        tile with festival info
    </div>
    <div id="ad_tile2">
        Caprera openluchtsessie<br>
        tile with festival info
    </div>
    <div id="ad_tile3">
        Caprera openluchtsessie<br>
        tile with festival info
    </div>
    <div id="ad_tile4">
        Caprera openluchtsessie<br>
        tile with festival info
    </div>
</div>
<p class="footer">This email was sent to you to inform
    about the festival.<br>The email-address that this email has been sent from cannot receive replies.<br>Don't want
    automated emails? Click <a href="www.haarlemfestival.com/opt_out">here</a> to opt out<br>For help, visit:
    www.haarlemfestival.com/contact</p>
</body>
</html>

<style>
    body {
        margin: 0;
        padding: 0;
    }
    .footer{
        font-size: x-small;background-color:#ECEFF1;text-align:center;padding:2%
    }
    .ad_tiles {
        font-size: large;
        text-align: center;
        align-content: center;
        display: grid;
        grid-template-rows:auto auto;
        grid-template-columns: 15% 35% 35% 15%;
        padding-bottom: 2%;
    }

    #ad_tile1 {
        grid-column-start: 2;
        grid-column-end: span 1;
    }

    #ad_tile2 {
        grid-column-start: 3;
        grid-column-end: span 1;
    }

    #ad_tile3 {
        grid-column-start: 2;
        grid-column-end: span 1;
    }

    #ad_tile4 {
        grid-column-start: 3;
        grid-column-end: span 1;
    }
</style>