<?php
namespace api\services;
use modele\DAO;
use modele\Outils;
use DOMDocument;

/*
Projet TraceGPS - services web
fichier : api/services/SupprimerUnUtilisateur.php
Derniere mise à jour : 21/11/2023 par Ethan DIVET
http://<hebergeur>/tracegps/api/SupprimerUnUtilisateur?adrMail=admin&mdp=ff9fff929a1292db1c00e3142139b22ee4925177
*/

// connexion du serveur web à la base MySQL
$dao = new DAO();
	
// Recuperation des donnees transmises
$token = ( empty($this->request['token'])) ? "" : $this->request['token'];
$lang = ( empty($this->request['lang'])) ? "" : $this->request['lang'];

// "xml" par defaut si le parametre lang est absent ou incorrect
if ($lang != "xml") $lang = "json";

// La methode HTTP utilisee doit etre GET
if ($this->getMethodeRequete() != "GET")
{	$msg = "Erreur : methode HTTP incorrecte.";
    $code_reponse = 406;
}
else {
    // Les parametres doivent etre presents
    if ( $token == "" )
    {	$msg = "Erreur : donnees incompletes.";
        $code_reponse = 400;
    }
    else
    {	// il faut etre administrateur pour supprimer un utilisateur
        if (!$dao->getConnexionToken($token))
        {   $msg = "Erreur : authentification incorrecte.";
            $code_reponse = 401;
        }
    	else 
    	{	// contrôle d'existence de pseudoAsupprimer
    	    $unUtilisateur = $dao->getUtilisateur($token);
    	    if ($unUtilisateur == null)
    	    {  $msg = "Erreur : pseudo utilisateur inexistant.";
    	       $code_reponse = 400;
    	    }
    	    else
    	    {   // si cet utilisateur possede encore des traces, sa suppression est refusee
    	        if ( $unUtilisateur->getNbAnnonce() > 0 ) {
    	            $msg = "Erreur : suppression impossible ; cet utilisateur possede encore des annonces.";
    	            $code_reponse = 400;
    	        }
    	        else {
    	            // suppression de l'utilisateur dans la BDD
    	            $ok = $dao->supprimerUtilisateur($token);
    	            if ( ! $ok ) {
                        $msg = "Erreur : probleme lors de la suppression de l'utilisateur.";
                        $code_reponse = 500;
                    }
                    else {
                        // tout a fonctionne
                        $msg = "Suppression effectuee";
                        $code_reponse = 200;
                    }
                }
    	    }
    	}
    }
}
// ferme la connexion à MySQL :
unset($dao);

// creation du flux en sortie
if ($lang == "xml") {
    $content_type = "application/xml; charset=utf-8";      // indique le format XML pour la reponse
    $donnees = creerFluxXML($msg);
}
else {
    $content_type = "application/json; charset=utf-8";      // indique le format Json pour la reponse
    $donnees = creerFluxJSON($msg);
}

// envoi de la reponse HTTP
$this->envoyerReponse($code_reponse, $content_type, $donnees);

// fin du programme (pour ne pas enchainer sur les 2 fonctions qui suivent)
exit;

// ================================================================================================

// creation du flux XML en sortie
function creerFluxXML($msg)
{	// cree une instance de DOMdocument (DOM : Document Object Model)
	$doc = new DOMDocument();
	
	// specifie la version et le type d'encodage
	$doc->version = '1.0';
	$doc->encoding = 'UTF-8';
	
	// cree un commentaire et l'encode en UTF-8
	$elt_commentaire = $doc->createComment('Service web SupprimerUnUtilisateur - BTS SIO - Lycee De La Salle - Rennes');
	// place ce commentaire à la racine du document XML
	$doc->appendChild($elt_commentaire);
	
	// cree l'element 'data' à la racine du document XML
	$elt_data = $doc->createElement('data');
	$doc->appendChild($elt_data);
	
	// place l'element 'reponse' dans l'element 'data'
	$elt_reponse = $doc->createElement('reponse', $msg);
	$elt_data->appendChild($elt_reponse);

	// Mise en forme finale
	$doc->formatOutput = true;
	
	// renvoie le contenu XML
	return $doc->saveXML();
}

// ================================================================================================

// creation du flux JSON en sortie
function creerFluxJSON($msg)
{
    /* Exemple de code JSON
         {
            "data": {
                "reponse": "Erreur : authentification incorrecte."
            }
         }
     */
    
    // construction de l'element "data"
    $elt_data = ["reponse" => $msg];
    
    // construction de la racine
    $elt_racine = ["data" => $elt_data];
    
    // retourne le contenu JSON (l'option JSON_PRETTY_PRINT gere les sauts de ligne et l'indentation)
    return json_encode($elt_racine, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

// ================================================================================================
?>
