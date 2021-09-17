<!DOCTYPE html>
<html>
    <head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <img src="bilder/naring.png" alt="logo">
        <h1>Næringsmegleren Sædberg & Hodne</h1>
        
        <div class="container">
            <div class="box">

                <form action="index.php" method="get" id="form1">
                    <input type="text" name="søk" placeholder="Søk">
                </form><br>
                <button type="submit" form="form1" value="submit" onclick="location.href='filter.php'">Filter</button><br>
                <button type="submit" form="form1" value="submit">Søk</button>
            </div>
        </div>
    </body>
</html>