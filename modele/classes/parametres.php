<?php
// Projet DLSapart - version web mobile
// fichier : modele/parametres.localhost.php
// Rôle : inclure les paramètres de l'application (hébergement en localhost)
// Dernière mise à jour : 2/24/2024 par LM
// paramètres de connexion -----------------------------------------------------------------------------------
global $PARAM_HOTE, $PARAM_PORT, $PARAM_BDD, $PARAM_USER, $PARAM_PWD;
$PARAM_HOTE = "localhost";		// si le sgbd est sur la même machine que le serveur php
$PARAM_PORT = "3306";			// le port utilisé par le serveur MySql
$PARAM_BDD = "u478239468_dlsapart";		// nom de la base de données
$PARAM_USER = "u478239468_dlsapart";		// nom de l'utilisateur
$PARAM_PWD = "S2F/QAp4!@n";		// son mot de passe

// Autres paramètres -----------------------------------------------------------------------------------------

// adresse de l'émetteur lors d'un envoi de courriel
$ADR_MAIL_EMETTEUR = "delasalle.sio.crib@gmail.com";

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!