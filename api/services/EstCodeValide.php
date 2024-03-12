<?php
namespace api\services;
use modele\DAO;
use DOMDocument;

// connexion du serveur web à la base MySQL
$dao = new DAO();

// Recuperation des donnees transmises
$codeEntre = ( empty($this->request['code'])) ? "" : $this->request['code'];
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
    if ( $codeEntre == "" )
    {	
        $msg = "Erreur : donnees incompletes.";
        $code_reponse = 400;
    }
    else
    {	$code = $dao->getCodeAcces();
    
        if ($code != $codeEntre)
        {
            $msg = "Erreur : codeIncorrect";
            $code_reponse = 401;
        }else{
            $msg = "code Correct.";
            $code_reponse = 200;
        }
    }
}
// ferme la connexion à MySQL :
unset($dao);

// creation du flux en sortie
if ($lang == "xml") {
    $content_type = "application/xml; charset=utf-8";      // indique le format XML pour la reponse
    $donnees = creerFluxXML ($msg);
}
else {
    $content_type = "application/json; charset=ISO-8859-15";      // indique le format Json pour la reponse
    $donnees = creerFluxJSON ($msg);
}

// envoi de la reponse HTTP
$this->envoyerReponse($code_reponse, $content_type, $donnees);

// fin du programme (pour ne pas enchainer sur les 2 fonctions qui suivent)
exit;

// ================================================================================================

// creation du flux XML en sortie
function creerFluxXML($msg)
{	
    /* Exemple de code XML
         <?xml version="1.0" encoding="UTF-8"?>
         <!--Service web Connecter - BTS SIO - Lycee De La Salle - Rennes-->
         <data>
            <reponse>Erreur : donnees incompletes.</reponse>
         </data>
     */
    
    // cree une instance de DOMdocument (DOM : Document Object Model)
	$doc = new DOMDocument();
	
	// specifie la version et le type d'encodage
	$doc->version = '1.0';
	$doc->encoding = 'UTF-8';
	
	// cree un commentaire et l'encode en UTF-8
	$elt_commentaire = $doc->createComment('Service web Connecter - BTS SIO - Lycee De La Salle - Rennes');
	// place ce commentaire à la racine du document XML
	$doc->appendChild($elt_commentaire);
	
	// cree l'element 'data' à la racine du document XML
	$elt_data = $doc->createElement('data');
	$doc->appendChild($elt_data);
	
	// place l'element 'reponse' juste apres l'element 'data'
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
             "data":{
                "reponse": "authentification incorrecte."
             }
         }
     */
    
    // 2 notations possibles pour creer des tableaux associatifs (la deuxieme est en commentaire)
    
    // construction de l'element "data"
    $elt_data = ["reponse" => $msg];
//     $elt_data = array("reponse" => $msg);
    
    // construction de la racine
    $elt_racine = ["data" => $elt_data];
//     $elt_racine = array("data" => $elt_data);
    
    // retourne le contenu JSON (l'option JSON_PRETTY_PRINT gere les sauts de ligne et l'indentation)
    return json_encode($elt_racine, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    
}

// ================================================================================================
?>
