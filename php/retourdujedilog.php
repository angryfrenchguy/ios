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
    $maxid = mysqli_fetch_assoc($maxid);
    $maxid = $maxid['MAX(idUnique)'];

    if( $maxid === null) { 
        $maxid2 = $idunique . "00";
        $insertnvlleligne;
    } else {
        $maxid2 = $maxid + 1;
        $iddelaligneavant = $maxid;
        mysqli_query($conx, 
                "INSERT INTO feuille_de_temps (date, odoIN, etat, idUnique) VALUES ('" 
                 . $_POST[date] .
                 "','" . $_POST[odoIN] .
                 "','" . $_POST[etat] .
                 "','" . $maxid2 . 
                 "')" );
        $insertligneavant = mysqli_query($conx, 
                "UPDATE feuille_de_temps SET odoOUT='" . $_POST[odoIN] . "' WHERE idUnique='" . $iddelaligneavant . "'");
    }

$conx->close();

echo "maxid: " . json_encode($maxid) . "<br>" .
"maxid1: " . json_encode($maxid1) . "<br>" .
"maxid2: " . json_encode($maxid2) . "<br>" .
"IDUNIQUE: " . json_encode($idunique) . "<br>" .
"iddelaligneavant: " . json_encode($iddelaligneavant) . "<br>" .
"POST: " . json_encode($_POST) . "<br>";
//"égale 0?" . json_encode($xxx);