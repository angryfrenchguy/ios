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
    $precedent = mysqli_query($conx,
                 "SELECT MAX(idUnique),bus,contrat,client FROM feuille_de_temps WHERE idUnique LIKE '" . $idunique . "%%'");
    $precedent = mysqli_fetch_assoc($precedent);
    $maxid = $precedent['MAX(idUnique)'];
    $bus = $precedent['bus'];
    $contrat = $precedent['contrat'];
    $client = $precedent['client'];

    if( $maxid === null) {
        $maxid2 = $idunique . "00";
        $insertnvlleligne;
    } else {
        $maxid2 = $maxid + 1;
        $iddelaligneavant = $maxid;
        mysqli_query($conx,
                "INSERT INTO feuille_de_temps (date, bus, contrat, client, odoIN, etat, idUnique) VALUES ('"
                 . $_POST[date] .
                 "','" . $bus .
                 "','" . $contrat .
                 "','" . $client .
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
"precedent: " . json_encode($precedent) . "<br>" .
"bus: " . json_encode($bus) . "<br>" .
"IDUNIQUE: " . json_encode($idunique) . "<br>" .
"iddelaligneavant: " . json_encode($iddelaligneavant) . "<br>" .
"POST: " . json_encode($_POST) . "<br>";
//"égale 0?" . json_encode($xxx);
