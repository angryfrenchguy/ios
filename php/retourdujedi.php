<?php
$serveur = "localhost";
$useur = "root";
$contrapass = "root";
$bd = "tada";

$conx = new mysqli($serveur, $useur, $contrapass, $bd);

if ($conx->connect_error) {
    die("échec de la connexion: " . $conx->connect_error);
}

    $idunique = $_POST['idUnique'];

    $maxid = mysqli_query($conx, 
                "SELECT MAX(idUnique) FROM feuille_de_temps WHERE idUnique LIKE '" . $idunique . "%%'");
    $responseanswer = mysqli_fetch_assoc($maxid);

if( $responseanswer['MAX(idUnique)'] == 0) {
//    $idunique = $idunique + "00"; 
    $xxx = "oui";
    $idunique = $idunique . "00";
} else {
    $xxx = "non";
    $idunique = $responseanswer['MAX(idUnique)'] + 1;
}

    


    mysqli_query($conx, 
                "INSERT INTO feuille_de_temps (date, tempsIN, odoIN, etat, idUnique) VALUES ('"
                . $_POST[date] .
                "','" . $_POST[tempsIN] .
                "','" . $_POST[odoIN] .
                "','" . $_POST[etat] .
                "','" . $idunique .
                "');" 
    );

$conx->close();

echo "RESPONSEANSWER: " . json_encode($responseanswer['MAX(idUnique)']) . "<br>" . 
"IDUNIQUE: " . json_encode($idunique) . "<br>" .
"POST: " . json_encode($_POST) . "<br>" .
"égale 0?" . json_encode($xxx);