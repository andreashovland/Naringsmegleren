<!DOCTYPE html>
<html>


<head>
    <title>Næringsmegleren</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/header.css">
</head>


<body>

    <div class="bg"></div>
    <div class="header">
        <img src="bilder/logo.dark.png" alt="logo-dark" width="15%" height="60%">
    </div>

    <section class="content">
        <div class="box">
            <form method="post" id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="bnavn" placeholder="Brukernavn">
                <input type="password" name="pord" placeholder="Passord">
                <input type="submit" value="Søk" name="searchbutton">
            </form><br>
        </div>
    </section>

    <?php

    session_start();
    $_SESSION['verified'] = false;

    include('config.php');

    $brukernavn = $_REQUEST['bnavn'];
    $passord = $_REQUEST['pord'];

    if (isset($_REQUEST['searchbutton'])) {

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {

            $stmt = $conn->prepare("SELECT brukernavn, passord FROM user WHERE brukernavn =?");

            $stmt->bind_param("s", $brukernavn);

            /* execute query */
            $stmt->execute();

            /* Store the result (to get properties) */
            $resultat = $stmt->get_result();

            if ($row = $resultat->fetch_assoc()) {
                if (password_verify($_REQUEST['pord'], $row['passord'])) {
                    session_start();
                    $_SESSION["verified"] = true;
                    $_SESSION["brukernavn"] = $_REQUEST['bnavn'];
                    header("Location: index.php");
                    exit();
                } else {
                    echo "Brukernavn eller passord er ikke riktig";
                }
            } else {
                echo "Brukernavn eller passord er ikke riktig";
            }

            $stmt->close();
        }
    }

    ?>



</body>

</html>