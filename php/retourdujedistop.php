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

    $minid = mysqli_query($conx,
                "SELECT MIN(idUnique) FROM feuille_de_temps WHERE idUnique LIKE '" . $idunique . "%%' AND date='" . $_POST[date] . "'");
    $minid = mysqli_fetch_assoc($minid);
    $minid = $minid['MIN(idUnique)'];

    $maxid = mysqli_query($conx, 
                 "SELECT MAX(idUnique) FROM feuille_de_temps WHERE idUnique LIKE '" . $idunique . "%%'");
    $maxid = mysqli_fetch_assoc($maxid);

    if( $maxid['MAX(idUnique)'] == null) {
        $idunique = $idunique . "00";
    } else {
        $idunique = $maxid['MAX(idUnique)'] + 1;
    }

    $iddelaligneavant = $idunique - 1;

    mysqli_query($conx, 
                "UPDATE feuille_de_temps SET odoOUT='" . $_POST[odoOUT] . "' WHERE idUnique='" . $iddelaligneavant . "'");
    
    mysqli_query($conx, 
                 "UPDATE feuille_de_temps SET tempsOUT='" .$_POST[tempsOUT] . "' WHERE idUnique='" . $minid . "'");

$conx->close();

echo "reponsemax: " . json_encode($reponsemax) . "<br>" . 
"IDUNIQUE: " . json_encode($idunique) . "<br>" .
"minid: " . json_encode($minid) . "<br>" .
"maxid: " . json_encode($maxid) . "<br>" .
"reponsemax: " . json_encode($reponsemax) . "<br>" .
"iddelaligneavant: " . json_encode($iddelaligneavant) . "<br>" .
"POST: " . json_encode($_POST) . "<br>";