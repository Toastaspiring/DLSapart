<?php
namespace modele;
// Projet TraceGPS
// fichier : modele/Utilisateur.test.php
// Rôle : test de la classe Utilisateur.class.php
// Dernière mise à jour : 18/7/2021 par dPlanchet

include_once ('../classes/Utilisateur.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Utilisateur</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
echo "<h3>Test de la classe Utilisateur</h3>";

// tests du constructeur et des accesseurs (get)
$utilisateur1 = new Utilisateur(1, "Tuniter", "Tess", sha1("mdputilisateur"), "tess.tuniter@gmail.com", "1122334455", 5, date('Y-m-d H:i:s', time()));

echo "<h4>objet utilisateur1 : </h4>";
echo ('id : ' . $utilisateur1->getId() . '<br>');
echo ('nom : ' . $utilisateur1->getNom() . '<br>');
echo ('prenom : ' . $utilisateur1->getPrenom() . '<br>');
echo ('mdpSha1 : ' . $utilisateur1->getMdpSha1() . '<br>');
echo ('adrMail : ' . $utilisateur1->getAdrMail() . '<br>');
echo ('dateCreation : ' . $utilisateur1->getDateCreation() . '<br>');
echo ("nbAnnonce : " . $utilisateur1->getNbAnnonce() . '<br>');

echo ('<br>');

// test de la méthode toString
echo "<h4>méthode toString sur objet utilisateur1 : </h4>";
echo ($utilisateur1->toString());
echo ('<br>');

// tests des mutateurs (set)
$utilisateur1->setId(4);
$utilisateur1->setNom("Fonfec");
$utilisateur1->setPrenom("Sophie");
$utilisateur1->setMdpSha1(sha1("mdpadmin"));
$utilisateur1->setAdrMail("sophie.fonfec@gmail.com");
$utilisateur1->setDateCreation(date('Y-m-d H:i:s', time() - 7200));
$utilisateur1->setNbAnnonce(2);

echo "<h4>objet utilisateur1 : </h4>";
echo ('id : ' . $utilisateur1->getId() . '<br>');
echo ('nom : ' . $utilisateur1->getNom() . '<br>');
echo ('prenom : ' . $utilisateur1->getPrenom() . '<br>');
echo ('mdpSha1 : ' . $utilisateur1->getMdpSha1() . '<br>');
echo ('adrMail : ' . $utilisateur1->getAdrMail() . '<br>');
echo ('dateCreation : ' . $utilisateur1->getDateCreation() . '<br>');
echo ("nbAnnonce : " . $utilisateur1->getNbAnnonce() . '<br>');

echo ('<br>');
?>

</body>
</html>