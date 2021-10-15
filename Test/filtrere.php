<html>
<head>
        <title>Næringsmegleren</title>
        
    </head>
<body>

<?php
    $con = mysqli_connect("localhost", "root", "", "Næringsmegleren");

    // Henter data fra databasen til dropdowns

    $lokasjonSet = $con->query("SELECT lokasjon FROM lokasjon");
    $statusSet = $con->query("SELECT status FROM status");
    $bransjeSet = $con->query("SELECT bransje FROM bransje");
?>

<div class="filtere">
<form method="post" action="filterresultat.php">

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
        
        <!-- Omsetning -->
        <label for="minOmsetning">Omsetning</label>
        <input type="text" name="minOmsetning" placeholder="min">
        <input type="text" name="maxOmsetning" placeholder="max"><br>
        
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
<?php
/*
$sql = "SELECT firmaNavn, antallAnsatte, kontaktPerson, kommentarDetalj, fornavn, status
            FROM firma
            JOIN kontaktinfo
            ON kontaktinfo.orgNum=firma.orgNum
            JOIN firmakommentar
            ON firmakommentar.orgNum=firma.orgNum
            JOIN status
            ON status.statusId=firmakommentar.statusId
            JOIN ansatte
            ON ansatte.ansattId=firmakommentar.ansattId
            JOIN lokasjon 
            ON lokasjon.lokasjonId=firma.lokasjonId
            JOIN bransje
            ON bransje.bransjeId=firma.bransjeId
            WHERE lokasjon LIKE '%$lokasjon%' and bransje LIKE '%$bransje%'";


$result = $con->query($sql);
            echo "<div class='container'>
            <table>
            <tr>
            <th>Firmanavn</th>
            <th>Kontaktperson</th>
            <th>Antall ansatte</th>
            <th>Status</th>
            <th>Vår kontaktperson</th>
            <th>Kommentar</th>
            <th></th>
            <th></th>
            </tr>";

            while ($row = $result->fetch_assoc()){

                echo "<tr>
                <td>" . $row['firmaNavn'] . "</td>
                <td>" . $row['kontaktPerson'] . "</td>
                <td>" . $row['antallAnsatte'] . "</td> 
                <td>" . $row['status'] . "</td>
                <td>" . $row['fornavn'] . "</td>
                <td>" . $row['kommentarDetalj'] . "</td>
                <td><button class='visMer'>Vis mer</button></td>
                <td><button class='rediger'>Rediger</button></td>
                </tr></div>";
            }*/
/*
            <select name="bransje">
            <?php
                while ($rows = $bransjeSet->fetch_assoc()){
                    $bransje = $rows['bransje'];
                    echo "<option value='$bransje'>$bransje</option>";
                }
            ?>
        </select>
        */
?>
