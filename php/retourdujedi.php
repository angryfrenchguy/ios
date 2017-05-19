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
//                "SELECT MAX(idUnique) FROM feuille_de_temps WHERE idUnique LIKE '" . $idunique . "%%'");
    "SELECT MIN(idUnique) FROM feuille_de_temps WHERE date=0000-00-00 AND contrat=0");
    $responseanswer = mysqli_fetch_assoc($maxid);

//if( $responseanswer['MAX(idUnique)'] == 0) {
////    $idunique = $idunique + "00"; 
//    $xxx = "oui";
//    $idunique = $idunique . "00";
//} else {
//    $xxx = "non";
//    $idunique = $responseanswer['MAX(idUnique)'] + 1;
//}
    $idunique = $responseanswer['MIN(idUnique)'];

    


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

$conx->close();

echo "RESPONSEANSWER: " . json_encode($responseanswer['MAX(idUnique)']) . "<br>" . 
"IDUNIQUE: " . json_encode($idunique) . "<br>" .
"POST: " . json_encode($_POST) . "<br>" .
"égale 0?" . json_encode($xxx);