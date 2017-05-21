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
                "SELECT MIN(idUnique) FROM feuille_de_temps WHERE date=0000-00-00 AND contrat=0 AND client='' AND bus=0 AND odoIN=0 AND odoOUT=0 AND odoTOTAL=0 AND tempsIN='' AND tempsOUT='' AND tempsTOTAL='' AND etat=''");
    $minireponse = mysqli_fetch_assoc($minid);

    $maxid = mysqli_query($conx, 
                 "SELECT MAX(idUnique) FROM feuille_de_temps WHERE idUnique LIKE '" . $idunique . "%%'");
    $reponsemax = mysqli_fetch_assoc($maxid);

    if( $reponsemax['MAX(idUnique)'] == null) {
    //    $idunique = $idunique + "00"; 
        $xxx = "oui";
        $idunique = $idunique . "00";
    } else {
        $xxx = "non";
        $idunique = $reponsemax['MAX(idUnique)'] + 1;
    }

//    $idunique = $minireponse['MIN(idUnique)'];

    $iddelaligneavant = $idunique - 1;

    mysqli_query($conx, 
                "UPDATE feuille_de_temps SET odoOUT='" . $_POST[odoOUT] . "', tempsOUT='" . $_POST[tempsOUT] . "' WHERE idUnique='" . $iddelaligneavant . "'");

$conx->close();

echo "reponsemax: " . json_encode($reponsemax) . "<br>" . 
"IDUNIQUE: " . json_encode($idunique) . "<br>" .
"minireponse: " . json_encode($minid) . "<br>" .
"minid: " . json_encode($minireponse) . "<br>" .
"reponsemax: " . json_encode($reponsemax) . "<br>" .
"maxid: " . json_encode($maxid) . "<br>" .
"iddelaligneavant: " . json_encode($iddelaligneavant) . "<br>" .
"POST: " . json_encode($_POST) . "<br>" .
"égale 0?" . json_encode($xxx);