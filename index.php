<!DOCTYPE html>
<html>
    <head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <img src="bilder/logo_senter_hvit.png" class="logo">

        <div class="box">

            <form action="resultat.php" method="get" id="form1">
                <input type="text" name="søk" placeholder="Søk">
                <input type="submit" value="Søk" name="søkeknapp">
            </form><br>

            <form action="filter.php" method="POST" id="form2">
                <input type="submit" value="Filter" name="filter">
            </form>
        </div>
    </body>
</html>