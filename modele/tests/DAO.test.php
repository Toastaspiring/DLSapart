<?php
namespace modele;

// Inclusion de la classe DAO à tester
include_once('../classes/DAO.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test de la classe DAO</title>
    <style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
// Instanciation de la classe DAO
$dao = new DAO();

// Test de la méthode getUtilisateur
echo '<b>Test de la méthode getUtilisateur :</b><br>';
$idUtilisateur = '1';
$utilisateur = $dao->getUtilisateur($idUtilisateur);
echo 'Utilisateur avec l\'ID ' . $idUtilisateur . ': ' . var_dump($utilisateur) . '<br><br>';

// Test de la méthode getConnexion
echo '<b>Test de la méthode getConnexion :</b><br>';
$adrMail = 'delasalle.sio.marec.l@gmail.com';
$mdpSha1 = sha1('admin');
$connexion = $dao->getConnexion($adrMail, $mdpSha1);
echo 'Connexion avec l\'adresse mail ' . $adrMail . ' et le mot de passe sha1 : ' . var_export($connexion, true) . '<br><br>';

// Test de la méthode creerUnUtilisateur
// Test Optionnel

// Test de la méthode modifierMdpUtilisateur
// Test Optionnel

// Test de la méthode existeAdrMailUtilisateur
echo '<b>Test de la méthode existeAdrMailUtilisateur :</b><br>';
$existingAdrMail = 'delasalle.sio.marec.l@gmail.com';
$nonExistingAdrMail = 'nonexisting@example.com';
$existingResult = $dao->existeAdrMailUtilisateur($existingAdrMail);
$nonExistingResult = $dao->existeAdrMailUtilisateur($nonExistingAdrMail);
echo 'Adresse mail existante : ' . var_export($existingResult, true) . '<br>';
echo 'Adresse mail non existante : ' . var_export($nonExistingResult, true) . '<br><br>';

// Test de la méthode getLesAnnonces
echo '<b>Test de la méthode getLesAnnonces :</b><br>';
$annonces = $dao->getLesAnnonces("");
echo 'Annonces : ' . var_export($annonces, true) . '<br><br>';

// Test de la méthode creerUneAnnonce
echo '<b>Test de la méthode creerUneAnnonce :</b><br>';
// Création d'une nouvelle annonce
$unUtilisateur = new Utilisateur(1, "Tuniter", "Tess", sha1("mdputilisateur"), "tess.tuniter@gmail.com", "1122334455", 5, date('Y-m-d H:i:s', time()));
$nouvelleAnnonce = new Annonce(null, 'Titre de l\'annonce', 'Description de l\'annonce', date('Y-m-d H:i:s'), 10.5, 100, 'image.jpg', $unUtilisateur);
$resultatCreationAnnonce = $dao->creerUneAnnonce($nouvelleAnnonce);
echo 'Création de la nouvelle annonce : ' . var_export($resultatCreationAnnonce, true) . '<br><br>';

// Test de la méthode getLesAnnoncesUtilisateur
echo '<b>Test de la méthode getLesAnnoncesUtilisateur :</b><br>';
$adrMail = 'delasalle.sio.martinet.theo@gmail.com'; // ID de l'utilisateur pour lequel récupérer les annonces
$annoncesUtilisateur = $dao->getLesAnnoncesUtilisateur($adrMail);
echo 'Annonces de l\'utilisateur avec l\'email ' . $adrMail . ': ' . var_export($annoncesUtilisateur, true) . '<br><br>';


echo '<b>Test de la méthode supprimerUneAnnonce :</b><br>';
$idAnnonce = 1;
$ok = $dao->supprimerUneAnnonce($idAnnonce);
echo 'Annonce de avec l\'ID '. $idAnnonce . ' a été supprimé : ' .var_export($ok, true) . '<br><br>';


echo '<b>Test de la méthode getCodeAcces :</b><br>';
$ok = $dao->getCodeAcces();
echo 'le code d\'acces est : ' .var_export($ok, true) . '<br><br>';

echo '<b>Test generation token :</b><br>';
$ok = $dao->getConnexionToken('AVewOpq2Pv');
echo 'le token est : ' .var_export($ok, true) . '<br><br>';
?>

</body>
</html>
