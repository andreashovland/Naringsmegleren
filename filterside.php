<html>
<head>
        <title>Næringsmegleren</title>
        
    </head>
<body>

<?php
    include("config.php");
    //$conn = mysqli_connect("localhost", "root", "", "NæringsmeglerenDB");
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Henter data fra databasen til dropdowns
    $lokasjonSet = $conn->query("SELECT lokasjon FROM lokasjon");
    $statusSet = $conn->query("SELECT status FROM status");
    $bransjeSet = $conn->query("SELECT bransje FROM bransje");
?>


<div class="filtere">
<form method="post" action="filterresult.php">


        <!-- Område -->
        <label for="område">Område</label>
        <select name="område">
            <option></option>
            <?php
                while ($rows = $lokasjonSet->fetch_assoc()){
                    $lokasjon = $rows['lokasjon'];
                    echo "<option value='$lokasjon'>$lokasjon</option>";
                }
            ?>
        </select><br>
        
        <!-- Postnummer -->
        <label for="postnummer">Postnummer</label>
        <input type="text" name="postnummer"><br>
        
        <!-- Bransje -->
        <label for="bransje">Bransje</label>
        <select name="bransje">
            <option></option>
            <?php
                while ($rows = $bransjeSet->fetch_assoc()){
                    $bransje = $rows['bransje'];
                    echo "<option value='$bransje'>$bransje</option>";
                }
            ?>
        </select><br>
        
        <!-- Status -->
        <label for="status">Status</label>
        <select name="status">
            <option></option>
            <?php
                while ($rows = $statusSet->fetch_assoc()){
                    $status = $rows['status'];
                    echo "<option value='$status'>$status</option>";
                }
            ?>
        </select><br>

        <!-- Antall ansatte -->
        <label for="minAnsatte">Antall ansatte</label>
        <input type="text" name="minAnsatte" placeholder="min">
        <input type="text" name="maxAnsatte" placeholder="max"><br>

        <!-- Siste adresseendring -->
        <label for="adrEndring">Siste adr. endring</label>
        <input type="text" name="adrEndring" placeholder="Senest"><br>
        
        <!-- Inntekt -->
        <label for="minInntekt">Omsetning</label>
        <input type="text" name="minInntekt" placeholder="min">
        <input type="text" name="maxInntekt" placeholder="max"><br>
        
        <!-- Next -->
        <label for="next">Next?</label>
        <select name="next">
            <option></option>
            <option value="Ja">Ja</option>
            <option value="Nei">Nei</option>
        </select><br>

        <!-- Submit -->
        <br><input type="submit" value="Filtrer" name="filterbutton">
</form>
</div>
</body>
</html>

