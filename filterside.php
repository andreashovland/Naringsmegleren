<?php
/*
session_start();

if($_SESSION["verified"] != true || !isset($_SESSION["verified"])) {
    header("Location: login.php");
    exit();
}
*/
?>

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
    $lokasjonSet = $conn->query("SELECT lokasjon FROM lokasjon ORDER BY lokasjon ASC");
    $statusSet = $conn->query("SELECT status FROM status ORDER BY status ASC");
    $bransjeSet = $conn->query("SELECT bransje FROM bransje ORDER BY bransje ASC");
    $bydelSet = $conn->query("SELECT bydel FROM bydel ORDER BY bydel ASC");
    ?>


    <div class="filtere farge">
        <header> Filtrer søk</header><br><br>
        <form method="post" action="filterresult.php">

            <div class="filter-knapper">
                <!-- Område -->
                <div class="dropdown">
                    <label for="område">By</label>
                    <select name="område">
                        <option></option>
                        <?php
                        while ($rows = $lokasjonSet->fetch_assoc()) {
                            $lokasjon = $rows['lokasjon'];
                            echo "<option value='$lokasjon'>$lokasjon</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Bydel -->
                <div class="dropdown">
                    <label for="bydel">Bydel</label>
                    <select name="bydel">
                        <option></option>
                        <?php
                        while ($rows = $bydelSet->fetch_assoc()) {
                            $bydel = $rows['bydel'];
                            echo "<option value='$bydel'>$bydel</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Bransje -->
                <div class="dropdown">
                    <label for="bransje">Bransje</label>
                    <select name="bransje">
                        <option></option>
                        <?php
                        while ($rows = $bransjeSet->fetch_assoc()) {
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
                        while ($rows = $statusSet->fetch_assoc()) {
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