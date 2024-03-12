<?php
namespace modele;
// Projet TraceGPS
// fichier : modele/Utilisateur.test.php
// Rôle : test de la classe Utilisateur.class.php
// Dernière mise à jour : 18/7/2021 par dPlanchet

include_once ('../classes/Annonce.php');
include_once ('../classes/Utilisateur.php');

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Test de la classe Annonce</title>
	<style type="text/css">body {font-family: Arial, Helvetica, sans-serif; font-size: small;}</style>
</head>
<body>

<?php
echo "<h3>Test de la classe Annonce</h3>";

$utilisateur1 = new Utilisateur(1, "Tuniter", "Tess", sha1("mdputilisateur"), "tess.tuniter@gmail.com", "1122334455", 5, date('Y-m-d H:i:s', time()));

$annonce = new Annonce(1, "Titre de l'annonce", "Description de l'annonce", "2023-11-14", "Taille de l'annonce", 100, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSYscfUBUbqwGd_DHVhG-ZjCOD7MUpxp4uhNe7toUg4ug&s', $utilisateur1);

echo "<h4>objet utilisateur1 : </h4>";
echo ('id : ' . $annonce->getId() . '<br>');
echo ('Titre : ' . $annonce->getTitre() . '<br>');
echo ('Description : ' . $annonce->getDescription() . '<br>');
echo ('Date : ' . $annonce->getDate() . '<br>');
echo ('Taille : ' . $annonce->getTaille() . '<br>');
echo ('Prix : ' . $annonce->getPrix() . '<br>');
echo ('Image : ' . '<img src='.$annonce->getImageURL().'>' . '<br>');
echo ("IdUtilisateur : " . $annonce->getUtilisateur()->getId() . '<br>');

echo ('<br>');

// test de la méthode toString
echo "<h4>méthode toString sur objet utilisateur1 : </h4>";
echo ($annonce->toString());
echo ('<br>');

// tests des mutateurs (set)
$annonce->setId(4);
$annonce->setTitre("Un appart Pas cher");
$annonce->setDescription("wow Dexcrip^tion");
$annonce->setDate(date('Y-m-d H:i:s', time() - 7200));
$annonce->setTaille(40);
$annonce->setPrix(250);
$annonce->setImageURL('https://images.ctfassets.net/hrltx12pl8hq/28ECAQiPJZ78hxatLTa7Ts/2f695d869736ae3b0de3e56ceaca3958/free-nature-images.jpg?fit=fill&w=1200&h=630');
$annonce->setUtilisateur($utilisateur1);

echo "<h4>objet utilisateur1 : </h4>";
echo ('id : ' . $annonce->getId() . '<br>');
echo ('Titre : ' . $annonce->getTitre() . '<br>');
echo ('Description : ' . $annonce->getDescription() . '<br>');
echo ('Date : ' . $annonce->getDate() . '<br>');
echo ('Taille : ' . $annonce->getTaille() . '<br>');
echo ('Prix : ' . $annonce->getPrix() . '<br>');
echo ('Image : ' . '<img src='.$annonce->getImageURL().'>' . '<br>');
echo ("IdUtilisateur : " . $annonce->getUtilisateur()->getId() . '<br>');

echo ('<br>');

?>
