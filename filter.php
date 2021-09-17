<!DOCTYPE html>
<html>
    <head>
        <title>Næringsmegleren</title>
    </head>
    <body>
        <h1>Næringsmegleren Sædberg & Hodne</h1><br>
        <h2> Filtrer</h2>

        <form method="post" action="">
            Område: <select id = "area" name="area">
                <option value="Select">Velg et område...</option>
                <option value="Kristiansand">Kristiansand</option>
                <option value="Flekkerøy">Flekkerøy</option>
                <option value="Y Vagsbygd">Ytre Vågsbygd</option>
                <option value="M Vagdbygd">Midtre Vågsbygd</option>
                <option value="Slettheia">Slettheia</option>
                <option value="Hellemyr">Hellemyr</option>
                <option value="Tinnheia">Tinnheia</option>
                <option value="Grim">Grim</option>
                <option value="Kvad-Eg">Kvadraturen-Eg</option>
                <option value="Lund">Lund</option>
                <option value="Gimlekollen">Gimlekollen</option>
                <option value="Stray">Stray</option>
                <option value="Mosby">Mosby</option>
                <option value="Justvik">Justvik</option>
                <option value="Tveit">Tveit</option>
                <option value="Hånes">Hånes</option>
                <option value="Søm">Søm</option>
                <option value="YRandesund">Ytre Randesund</option>
            </select><br>

            Postnummer: 
                <input type="text" name="postnr" placeholder="Postnummer"><br>

            Bransje: 
                <select id = "area" name="area">
                <option value="BA">Bygge- og annleggsvirksomhet</option>
                <option value="FT">Forretningsmessig tjenesteyting</option>
                <option value="FF">Finansiering og forsikring</option>
                <option value="HS">Helse og sosialetjenester</option>
                <option value="K">Kraftforsyning</option>
                </select><br>

            Status: 
                <select id = "status" name="status">
                <option value="Bygg">Eget Bygg</option>
                <option value="Kontrakt">Lang Kontrakt</option>
                <option value="Dialog">I dialog</option>
                <option value="Fkontrakt">Forlenget kontrakt</option>
                <option value="fåansatte">Få ansatte</option>
                </select><br>

            Antall ansatte: 
                <select id = "ansatte" name="ansatte">
                <option value="Bygg"> Mindre enn 10</option>
                <option value="Kontrakt">10-20</option>
                <option value="Dialog">20-30</option>
                <option value="Fkontrakt">30-40</option>
                <option value="fåansatte">40+</option>
                </select><br>

            Siste adr. endring: 
                <input type="text" name="endring" placeholder="Siste adresse endring"><br>

            Omsetning: 
                <input type="text" name="omsetning" placeholder="Skriv ønsket omsetning her"><br>

            Next (Ja/Nei): 
                <select id = "next" name="next">
                <option value="Ja"> Ja</option>
                <option value="Nei">Nei</option>

            <input type="submit" name="registrer" value="Registrér">
        </form>



    </body>
</html>