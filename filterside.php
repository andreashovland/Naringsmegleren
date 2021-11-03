<html>
<head>
        <title>Næringsmegleren</title>
        <link rel="stylesheet" href="css/filter.css">
        <link rel="stylesheet" href="css/styles.css">
    </head>
<body>

<div class="bg"></div>

<?php
    include("config.php");

    // Henter data fra databasen til dropdowns
    $lokasjonSet = $conn->query("SELECT lokasjon FROM lokasjon");
    $statusSet = $conn->query("SELECT status FROM status");
    $bransjeSet = $conn->query("SELECT bransje FROM bransje");
?>


<div class="filtere">
    <div class="title">Filtrer søk</div>
        <form method="post" action="filterresult.php">

        <div class="filter-knapper">
        <!-- Område -->
        <div class ="dropdown">
        <label for="område">Område</label>
        <select name="område">
            <option></option>
            <?php
                while ($rows = $lokasjonSet->fetch_assoc()){
                    $lokasjon = $rows['lokasjon'];
                    echo "<option value='$lokasjon'>$lokasjon</option>";
                }
            ?>
        </select>
        </div>
        
        <!-- Postnummer -->
        <div class="input-box">
        <label for="postnummer">Postnummer</label>
        <input type="text" name="postnummer">
        </div>
        
        <!-- Bransje -->
        <div class="dropdown">
        <label for="bransje">Bransje</label>
        <select name="bransje">
            <option></option>
            <?php
                while ($rows = $bransjeSet->fetch_assoc()){
                    $bransje = $rows['bransje'];
                    echo "<option value='$bransje'>$bransje</option>";
                }
            ?>
        </select>
        </div>
        
        <!-- Status -->
        <div class="dropdown">
        <label for="status">Status</label>
        <select name="status">
            <option></option>
            <?php
                while ($rows = $statusSet->fetch_assoc()){
                    $status = $rows['status'];
                    echo "<option value='$status'>$status</option>";
                }
            ?>
        </select>
        </div>

        <!-- Antall ansatte -->
        <div class="input-box">
        <label for="minAnsatte">Antall ansatte</label>
        <input type="text" name="minAnsatte" placeholder="min">
        <input type="text" name="maxAnsatte" placeholder="max"><br>
        </div>

        <!-- Siste adresseendring -->
        <div class="input-box">
        <label for="adrEndring">Siste adr. endring</label>
        <input type="text" name="adrEndring" placeholder="Senest"><br>
        </div>

        <!-- Inntekt -->
        <div class="input-box">
        <label for="minInntekt">Omsetning</label>
        <input type="text" name="minInntekt" placeholder="min">
        <input type="text" name="maxInntekt" placeholder="max"><br>
        </div>

        <!-- Next -->
        <div class="dropdown">
        <label for="next">Next?</label>
        <select name="next">
            <option></option>
            <option value="Ja">Ja</option>
            <option value="Nei">Nei</option>
        </select>
        </div>

        <!-- Submit -->
        <div class="filtrer">
        <input type="submit" value="Filtrer" name="filterbutton">
        </div>
        </div>
</form>
</div>
</body>
</html>

