<!DOCTYPE html>
<html>
    <head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="header">
            <img src="bilder/logo_senter_hvit.png" class="logo">
        </div>
        
        <div class="box">

            <form action="resultat.php" method="get" id="form1">
                <input type="text" name="søk" placeholder="Søk">
                <input type="submit" value="Søk" name="søkeknapp">
            </form><br>
            <a href="filter.php" style="text-decoration: none;">
            <button class="filter">Filter</button>
            </a>
        </div>
    </body>
</html>