<?php
namespace modele;

use Exception;
// Projet TraceGPS
// fichier : modele/DAO.php   (DAO : Data Access Object)
// Rôle : fournit des méthodes d'accès à la bdd tracegps (projet TraceGPS) au moyen de l'objet \PDO
// modifié par Louis le 2/22/2024

// certaines méthodes nécessitent les classes suivantes :
include_once ('Utilisateur.php');
include_once ('Annonce.php');
include_once ('Outils.php');

// inclusion des paramètres de l'application
include_once ('parametres.php');

// début de la classe DAO (Data Access Object)
class DAO
{
    // Membres privés de la classe

    private $cnx; // la connexion à la base de données
    
    // Constructeur et destructeur 

    public function __construct() {
        global $PARAM_HOTE, $PARAM_PORT, $PARAM_BDD, $PARAM_USER, $PARAM_PWD;
        try
        {	
            $this->cnx = new \PDO("mysql:host=" . $PARAM_HOTE . ";port=" . $PARAM_PORT . ";dbname=" . $PARAM_BDD,
            $PARAM_USER,
            $PARAM_PWD);
            return true;
        }
        catch (Exception $ex)
        {	
            echo ("Echec de la connexion a la base de donnees <br>");
            echo ("Erreur numero : " . $ex->getCode() . "<br />" . "Description : " . $ex->getMessage() . "<br>");
            echo ("PARAM_HOTE = " . $PARAM_HOTE);
            return false;
        }
    }
    
    public function __destruct() {
        // ferme la connexion à MySQL :
        unset($this->cnx);
    }
    
   
    // fournit un Objet Utilisateur identifié par $idUtilisateur
    public function getUtilisateur($token) {
        // préparation de la requête de recherche
        $txt_req = "Select id, nom, prenom, mdpSha1, adrMail, dateCreation, nbAnnonces";
        $txt_req .= " from dls_utilisateur";
        $txt_req .= " join dls_token on dls_utilisateur.id = dls_token.idUtilisateur";
        $txt_req .= " where token = :token";
        $req = $this->cnx->prepare($txt_req);
        // liaison de la requête et de ses paramètres
        $req->bindValue("token", $token, \PDO::PARAM_STR);
        // extraction des données
        $req->execute();
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);
        // libère les ressources du jeu de données
        $req->closeCursor();
        
        // traitement de la réponse
        if ( ! $uneLigne) {
            return null;
        }
        else {
            // création d'un objet Utilisateur
            $unId = mb_convert_encoding($uneLigne->id, "UTF-8");
            $unNom = mb_convert_encoding($uneLigne->nom, "UTF-8");
            $unPrenom = mb_convert_encoding($uneLigne->prenom, "UTF-8");
            $unMdpSha1 = mb_convert_encoding($uneLigne->mdpSha1, "UTF-8");
            $uneAdrMail = mb_convert_encoding($uneLigne->adrMail, "UTF-8");
            $uneDateCreation = mb_convert_encoding($uneLigne->dateCreation, "UTF-8");
            $unNbAnnonces = mb_convert_encoding($uneLigne->nbAnnonces, "UTF-8");

            $unUtilisateur = new Utilisateur($unId, $unNom, $unPrenom, $unMdpSha1, $uneAdrMail, $uneDateCreation, $unNbAnnonces);
            return $unUtilisateur;
        }
    }

    public function isTokenTaken($token){
        // Define the SQL query
        $txt_req = "select COUNT(*) as token_count from dls_token where token = :token";

        // Prepare the statement
        $req = $this->cnx->prepare($txt_req);

        $req->bindValue('token', $token, \PDO::PARAM_STR);

        // Execute the statement
        $req->execute();

        // Fetch the result
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);

        // Directly return true if token exists, false otherwise
        return $uneLigne->token_count > 0;
    }

    private function UtilisateurHasToken($UID){
        // Define the SQL query
        $txt_req = "select COUNT(*) as token_count from dls_token where idUtilisateur = :UID";

        // Prepare the statement
        $req = $this->cnx->prepare($txt_req);

        // Bind the token parameter
        $req->bindValue('UID', $UID, \PDO::PARAM_STR);

        // Execute the statement
        $req->execute();

        // Fetch the result
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);

        // Directly return true if token exists, false otherwise
        return $uneLigne->token_count > 0;
    }

    private function AddTokenToDB($token, $UID) {
        // préparation de la requête
        $txt_req1 = "insert into dls_token (token, idUtilisateur)";
        $txt_req1 .= " values (:token, :UID)";
        $req1 = $this->cnx->prepare($txt_req1);
        // liaison de la requête et de ses paramètres
        $req1->bindValue("token", mb_convert_encoding($token, "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("UID", mb_convert_encoding($UID, "ISO-8859-1"), \PDO::PARAM_STR);
        // exécution de la requête
        $ok = $req1->execute();
        // sortir en cas d'échec
        echo $ok;
        if ( ! $ok) { return false; }
        
        return true;
    }

    private function getTokenUtilisateur($UID) {
        $txt_req = "select token from dls_token where idUtilisateur = :UID";

        // Prepare the statement
        $req = $this->cnx->prepare($txt_req);

        // Bind the token parameter
        $req->bindValue('UID', $UID, \PDO::PARAM_STR);

        // Execute the statement
        $req->execute();

        // Fetch the result
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);

        return $uneLigne->token;
    }

    private function generateToken($UID){
        // Define character set for alphanumeric characters
        $charSet = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $tokenLength = 32;
        $token = "";

        while (strlen($token) < $tokenLength) {
            // Use random_int to generate a random index within the character set
            $randomIndex = random_int(0, strlen($charSet) - 1);

            // Append the random character to the token
            $token .= $charSet[$randomIndex];
        }

        if($this->isTokenTaken($token, $UID)){
            return $this->generateToken($UID);
        }else{
            if($this->AddTokenToDB($token, $UID)){
                return $token;
            }
            return null;
        }
    }

    // Connecte un utilisateur identifié par $AdrMail et $mdpSha1
    public function getConnexionToken($token) {
        // préparation de la requête de recherche
        $txt_req = "Select * from dls_token";
        $txt_req .= " where token = :token";

        $req = $this->cnx->prepare($txt_req);
        // liaison de la requête et de ses paramètres
        $req->bindValue("token", $token, \PDO::PARAM_STR);
        // extraction des données
        $req->execute();
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);
        // traitement de la réponse
        $reponse = false;

        if ($uneLigne) {
            $reponse = true;
        }
        // libère les ressources du jeu de données
        $req->closeCursor();
        // fourniture de la réponse
        return $reponse;
    }

    // Connecte un utilisateur identifié par $AdrMail et $mdpSha1
    public function getConnexion($adrMail, $mdpSha1) {
        // préparation de la requête de recherche
        $txt_req = "Select id from dls_utilisateur";
        $txt_req .= " where adrMail = :adrMail";
        $txt_req .= " and mdpSha1 = :mdpSha1";
        $req = $this->cnx->prepare($txt_req);
        // liaison de la requête et de ses paramètres
        $req->bindValue("adrMail", $adrMail, \PDO::PARAM_STR);
        $req->bindValue("mdpSha1", $mdpSha1, \PDO::PARAM_STR);
        // extraction des données
        $req->execute();
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);
        // traitement de la réponse
        $reponse = null;

        if ($uneLigne) {
            if (!$this->UtilisateurHasToken($uneLigne->id))
                $reponse = $this->generateToken($uneLigne->id);
            else{
                $reponse = $this->getTokenUtilisateur($uneLigne->id);
            }
        }
        // libère les ressources du jeu de données
        $req->closeCursor();
        // fourniture de la réponse
        return $reponse;
    }
    

    // enregistre l'utilisateur $unUtilisateur dans la bdd
    public function creerUnUtilisateur($unUtilisateur) {
        
        // préparation de la requête
        $txt_req1 = "insert into dls_utilisateur (nom, prenom, mdpSha1, adrMail, dateCreation)";
        $txt_req1 .= " values (:nom, :prenom, :mdpSha1, :adrMail, :dateCreation)";
        $req1 = $this->cnx->prepare($txt_req1);
        // liaison de la requête et de ses paramètres
        $req1->bindValue("nom", mb_convert_encoding($unUtilisateur->getNom(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("prenom", mb_convert_encoding($unUtilisateur->getPrenom(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("mdpSha1", $unUtilisateur->getMdpsha1(), \PDO::PARAM_STR);
        $req1->bindValue("adrMail", mb_convert_encoding($unUtilisateur->getAdrmail(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("dateCreation", mb_convert_encoding($unUtilisateur->getDateCreation(), "ISO-8859-1"), \PDO::PARAM_STR);
        // exécution de la requête
        $ok = $req1->execute();
        // sortir en cas d'échec
        if ( ! $ok) { return false; }
        
        // recherche de l'identifiant (auto_increment) qui a été attribué à la trace
        $unId = $this->cnx->lastInsertId();
        $unUtilisateur->setId($unId);
        $this->generateToken($unId);
        return true;
    }
    

    public function modifierMdpUtilisateur($adrMail, $nouveauMdp) {
        // préparation de la requête
        $txt_req = "update dls_utilisateur set mdpSha1 = :nouveauMdp";
        $txt_req .= " where adrMail = :adrMail";
        $req = $this->cnx->prepare($txt_req);
        // liaison de la requête et de ses paramètres
        $req->bindValue("nouveauMdp", sha1($nouveauMdp), \PDO::PARAM_STR);
        $req->bindValue("adrMail", $adrMail, \PDO::PARAM_STR);
        // exécution de la requête
        $ok = $req->execute();
        return $ok;
    }

    public function AjouterAnnonceUtilisateur($token) {
        $txt_req = "update dls_utilisateur";
        $txt_req = " JOIN dls_token ON dls_token.idUtilisateur = dls_utilisateur.id";
        $txt_req .= " SET dls_utilisateur.nbAnnonces = dls_utilisateur.nbAnnonces + 1";
        $txt_req .= " WHERE dls_token.token = :token;";
        $req = $this->cnx->prepare($txt_req);
        // liaison de la requête et de ses paramètres
        $req->bindValue("token", $token, \PDO::PARAM_STR);
        // exécution de la requête
        $ok = $req->execute();
        return $ok;
    }
    

    public function envoyerCodeMdp($pseudo, $nouveauMdp) {
        // ????
    }


    public function existeAdrMailUtilisateur($adrMail) {
        // préparation de la requête de recherche
        $txt_req = "Select count(*) from dls_utilisateur where adrMail = :adrMail";
        $req = $this->cnx->prepare($txt_req);
        // liaison de la requête et de ses paramètres
        $req->bindValue("adrMail", $adrMail, \PDO::PARAM_STR);
        // exécution de la requête
        $req->execute();
        $nbReponses = $req->fetchColumn(0);
        // libère les ressources du jeu de données
        $req->closeCursor();
        
        // fourniture de la réponse
        if ($nbReponses == 0) {
            return false;
        }
        else {
            return true;
        }
    }
    

    // fournit la collection des traces de l'utilisateur $idUtilisateur
    // le résultat est fourni sous forme d'une collection d'objets Trace
    public function getLesAnnonces($searchParam) {

        if ($searchParam == null) {
            $searchParam = "";
        }
        // préparation de la requête de recherche
        $patern = "%" . $searchParam . "%";
        $params = array();

        $txt_req = "Select dls_annonces.id, titre, description, date, taille, prix, imageURL, token";
        $txt_req = $txt_req . " from dls_annonces";
        $txt_req = $txt_req . " join dls_token on dls_annonces.idUtilisateur = dls_token.idUtilisateur";
        if ($searchParam != ""){
            $txt_req = $txt_req . " where titre LIKE :searchParam OR description LIKE :searchParam1";
            $params = array(':searchParam' => $patern, ':searchParam1' => $patern);
        }
        $txt_req = $txt_req . " order by date desc";
        
        $req = $this->cnx->prepare($txt_req);

        
        // extraction des données
        $req->execute($params);
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);
        
        // construction d'une collection d'objets Trace
        $lesAnnonces = array();
        // tant qu'une ligne est trouvée :
        while ($uneLigne) {
            // création d'un objet Trace
            $unId = mb_convert_encoding($uneLigne->id, "UTF-8");
            $unTitre = mb_convert_encoding($uneLigne->titre, "UTF-8");
            $uneDescription = mb_convert_encoding($uneLigne->description, "UTF-8");
            $uneDateCreation = mb_convert_encoding($uneLigne->date, "UTF-8");
            $uneTaille = mb_convert_encoding($uneLigne->taille, "UTF-8");
            $unPrix = mb_convert_encoding($uneLigne->prix, "UTF-8");
            $unImageURL = mb_convert_encoding($uneLigne->imageURL, "UTF-8");
            $unUtilisateur = $this->getUtilisateur($uneLigne->token);
            
            $uneAnnonce = new Annonce($unId, $unTitre, $uneDescription, $uneDateCreation, $uneTaille, $unPrix, $unImageURL, $unUtilisateur);
            
            // ajout de la trace à la collection
            $lesAnnonces[] = $uneAnnonce;
            // extrait la ligne suivante
            $uneLigne = $req->fetch(\PDO::FETCH_OBJ);
        }
        // libère les ressources du jeu de données
        $req->closeCursor();
        // fourniture de la collection
        return $lesAnnonces;
    }
    

    public function getLesAnnoncesUtilisateur($token) {
        // préparation de la requête de recherche
        $txt_req = "Select dls_annonces.id, titre, description, date, taille, prix, imageURL, token";
        $txt_req = $txt_req . " from dls_annonces";
        $txt_req = $txt_req . " join dls_token";
        $txt_req = $txt_req . " on dls_annonces.idUtilisateur = dls_token.idUtilisateur";
        $txt_req = $txt_req . " where token = :token";
        $txt_req = $txt_req . " order by date desc";
        
        $req = $this->cnx->prepare($txt_req);

        $req->bindValue("token", $token, \PDO::PARAM_STR);
        // extraction des données
        $req->execute();
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);
        
        // construction d'une collection d'objets Trace
        $lesAnnonces = array();
        // tant qu'une ligne est trouvée :
        while ($uneLigne) {
            // création d'un objet Trace
            $unId = mb_convert_encoding($uneLigne->id, "UTF-8");
            $unTitre = mb_convert_encoding($uneLigne->titre, "UTF-8");
            $uneDescription = mb_convert_encoding($uneLigne->description, "UTF-8");
            $uneDateCreation = mb_convert_encoding($uneLigne->date, "UTF-8");
            $uneTaille = mb_convert_encoding($uneLigne->taille, "UTF-8");
            $unPrix = mb_convert_encoding($uneLigne->prix, "UTF-8");
            $unImageURL = mb_convert_encoding($uneLigne->imageURL, "UTF-8");
            $unUtilisateur = $this->getUtilisateur($uneLigne->token);
            
            $uneAnnonce = new Annonce($unId, $unTitre, $uneDescription, $uneDateCreation, $uneTaille, $unPrix, $unImageURL, $unUtilisateur);
            
            // ajout de la trace à la collection
            $lesAnnonces[] = $uneAnnonce;
            // extrait la ligne suivante
            $uneLigne = $req->fetch(\PDO::FETCH_OBJ);
        }
        // libère les ressources du jeu de données
        $req->closeCursor();
        // fourniture de la collection
        return $lesAnnonces;
    }

    public function getCodeAcces() {
        // préparation de la requête de recherche
        $txt_req = "Select *";
        $txt_req = $txt_req . " from dls_codeacces";

        $req = $this->cnx->prepare($txt_req);
        $req->execute();
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);

        // tant qu'une ligne est trouvée :
        if ($uneLigne) {
            // création d'un objet Trace
            $unCode = mb_convert_encoding($uneLigne->codeAcces, "UTF-8");
        }

        $req->closeCursor();
        return intval($unCode);
    }

    public function getUneAnnonce($idAnnonce) {
        // préparation de la requête de recherche
        $txt_req = "Select id, titre, description, date, taille, prix, imageURL, token";
        $txt_req = $txt_req . " from dls_annonces";
        $txt_req = $txt_req . " join dls_token on dls_token.idUtilisateur = dls_annonces.idUtilisateur";
        $txt_req = $txt_req . " where id = :idAnnonce";
        $txt_req = $txt_req . " order by date desc";
        
        $req = $this->cnx->prepare($txt_req);

        $req->bindValue("idAnnonce", $idAnnonce, \PDO::PARAM_STR);
        // extraction des données
        $req->execute();
        $uneLigne = $req->fetch(\PDO::FETCH_OBJ);
        
        // tant qu'une ligne est trouvée :
        if ($uneLigne) {
            // création d'un objet Trace
            $unId = mb_convert_encoding($uneLigne->id, "UTF-8");
            $unTitre = mb_convert_encoding($uneLigne->titre, "UTF-8");
            $uneDescription = mb_convert_encoding($uneLigne->description, "UTF-8");
            $uneDateCreation = mb_convert_encoding($uneLigne->date, "UTF-8");
            $uneTaille = mb_convert_encoding($uneLigne->taille, "UTF-8");
            $unPrix = mb_convert_encoding($uneLigne->prix, "UTF-8");
            $unImageURL = mb_convert_encoding($uneLigne->imageURL, "UTF-8");
            $unUtilisateur = $this->getUtilisateur($uneLigne->token);
            
            $uneAnnonce = new Annonce($unId, $unTitre, $uneDescription, $uneDateCreation, $uneTaille, $unPrix, $unImageURL, $unUtilisateur);
            
            // extrait la ligne suivante
            $uneLigne = $req->fetch(\PDO::FETCH_OBJ);

            return $uneAnnonce;
        }
        // libère les ressources du jeu de données
        $req->closeCursor();
        // fourniture de la collection
        return null;
    }


    // enregistre l'utilisateur $unUtilisateur dans la bdd
    public function creerUneAnnonce($uneAnnonce) {
        
        // préparation de la requête
        $txt_req1 = "insert into dls_annonces (titre, description, date, taille, prix, imageURL, idUtilisateur)";
        $txt_req1 .= " values (:titre, :description, :date, :taille, :prix, :imageURL, :idUtilisateur)";
        $req1 = $this->cnx->prepare($txt_req1);
        // liaison de la requête et de ses paramètres
        $req1->bindValue("titre", mb_convert_encoding($uneAnnonce->getTitre(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("description", mb_convert_encoding($uneAnnonce->getDescription(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("date", mb_convert_encoding($uneAnnonce->getDate(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("taille", mb_convert_encoding($uneAnnonce->getTaille(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("prix", mb_convert_encoding($uneAnnonce->getPrix(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("imageURL", mb_convert_encoding($uneAnnonce->getImageURL(), "ISO-8859-1"), \PDO::PARAM_STR);
        $req1->bindValue("idUtilisateur", mb_convert_encoding($uneAnnonce->getUtilisateur()->getId(), "ISO-8859-1"), \PDO::PARAM_STR);

        // exécution de la requête
        $ok = $req1->execute();
        // sortir en cas d'échec
        if ( ! $ok) { return false; }
        
        // recherche de l'identifiant (auto_increment) qui a été attribué à l'Annonce
        $unId = $this->cnx->lastInsertId();
        $uneAnnonce->setId($unId);
        return true;
    }

    public function supprimerUneAnnonce($idAnnonce) {
        // Préparation de la requête
        $txt_req = "delete from dls_annonces where id = :idAnnonce";
        $req = $this->cnx->prepare($txt_req);
        // Liaison de la requête et de ses paramètres
        $req->bindValue("idAnnonce", $idAnnonce, \PDO::PARAM_STR);
        // Exécution de la requête
        $ok = $req->execute();
        return $ok;
    }

    public function supprimerUtilisateur($token) {
        // Préparation de la requête
        $txt_req = "delete dls_utilisateur from dls_utilisateur join dls_token on dls_token.idUtilisateur = dls_utilisateur.id where token = :token";
        $req = $this->cnx->prepare($txt_req);
        // Liaison de la requête et de ses paramètres
        $req->bindValue("token", $token, \PDO::PARAM_STR);
        // Exécution de la requête
        $ok = $req->execute();
        return $ok;
    }
    
} // fin de la classe DAO

// ATTENTION : on ne met pas de balise de fin de script pour ne pas prendre le risque
// d'enregistrer d'espaces après la balise de fin de script !!!!!!!!!!!!


// ?? getPhoto($idAnnonce)

// ?? ModifierMdp($idUtilisateur, $nouveauMdp)

//$this->getLesAnnonces();

//$this->getLesAnnoncesUtilisateur($idUtilisateur);

//$this->getUtilisateur($idUtilisateur);

//$this->creerUnUtilisateur($UnUtilisateur);

//$this->creerUneAnnonce($UneAnnonce);

//$this->existeAdrMailUtilisateur($adrMail);

?>