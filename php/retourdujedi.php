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
    $minid = mysqli_fetch_assoc($minid);

    $maxid = mysqli_query($conx, 
                 "SELECT MAX(idUnique) FROM feuille_de_temps WHERE idUnique LIKE '" . $idunique . "%%'");
    $maxid = mysqli_fetch_assoc($maxid);

    if( $maxid['MAX(idUnique)'] == null) {
        $idunique = $idunique . "00";
    } else {
        $idunique = $maxid['MAX(idUnique)'] + 1;
    }

//    $idunique = $minireponse['MIN(idUnique)'];

    $iddelaligneavant = $idunique - 1;

    mysqli_query($conx, 
                "INSERT INTO feuille_de_temps (date, tempsIN, tempsOUT, contrat, client, bus, odoIN, odoOUT, etat, idUnique) VALUES ('"
                . $_POST[date] .
                "','" . $_POST[tempsIN] .
                "','" . $_POST[tempsOUT] .
                "','" . $_POST[contrat] .
                "','" . $_POST[client] .
                "','" . $_POST[bus] .
                "','" . $_POST[odoIN] .
                "','" . $_POST[odoOUT] .
                "','" . $_POST[etat] .
                "','" . $idunique .
                "')
                ON DUPLICATE KEY UPDATE
                date='" . $_POST[date] .
                "', contrat='" . $_POST[contrat] .
                "', client='" . $_POST[client] .
                "', bus ='" . $_POST[bus] .
                "', odoIN ='" . $_POST[odoIN] .
                "', odoOUT ='" . $_POST[odoOUT] .
                "', odoTOTAL ='" . $_POST[odoTOTAL] .
                "', tempsIN ='" . $_POST[tempsIN] .
                "', tempsOUT ='" . $_POST[tempsOUT] .
                "', tempsTOTAL ='" . $_POST[tempsTOTAL] .
                "', etat ='" . $_POST[etat] .
                "'" 
    );

    mysqli_query($conx, 
                "UPDATE TABLE feuille_de_temps SET odoOUT =" . $_POST[odoOUT] . " WHERE idUnique=" . $iddelaligneavant);

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