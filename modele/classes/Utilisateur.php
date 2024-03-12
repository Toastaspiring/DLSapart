<?php
namespace modele;
// Projet TraceGPS
// fichier : modele/Utilisateur.php
// Rôle : la classe Utilisateur représente les utilisateurs de l'application
// Dernière mise à jour : 9/7/2021 par dP
include_once ('Outils.php');
class Utilisateur
{
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------- Attributs privés de la classe -------------------------------------
    // ------------------------------------------------------------------------------------------------------
    private $id; // identifiant de l'utilisateur (numéro automatique dans la BDD)
    private $nom; // nom de l'utilisateur
    private $prenom; // prenom de l'utilisateur
    private $mdpSha1; // mot de passe de l'utilisateur (hashé en SHA1)
    private $adrMail; // adresse mail de l'utilisateur
    private $dateCreation; // date de création du compte
    private $nbAnnonce; // nombre de traces stockées actuellement
    
    // ------------------------------------------------------------------------------------------------------
    // ----------------------------------------- Constructeur -----------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    public function __construct($unId, $unNom, $unPrenom, $unMdpSha1, $uneAdrMail,$uneDateCreation, $unNbAnnonce) {
            $this->id = $unId;
            $this->nom = $unNom;
            $this->prenom = $unPrenom;
            $this->mdpSha1 = $unMdpSha1;
            $this->adrMail = $uneAdrMail;
            $this->dateCreation = $uneDateCreation;
            $this->nbAnnonce = $unNbAnnonce;
    }
    
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------------- Getters et Setters ------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    public function getId() {return $this->id;}
    public function setId($unId) { $this->id = $unId;}
    
    public function getNom() {return $this->nom;}
    public function setNom($unNom) {$this->nom = $unNom;}

    public function getPrenom() {return $this->prenom;}
    public function setPrenom($unPrenom) {$this->prenom = $unPrenom;}
    
    public function getMdpSha1() {return $this->mdpSha1;}
    public function setMdpSha1($unMdpSha1) {$this->mdpSha1 = $unMdpSha1;}
    
    public function getAdrMail() {return $this->adrMail;}
    public function setAdrMail($uneAdrMail) {$this->adrMail = $uneAdrMail;}
    
    public function getDateCreation() {return $this->dateCreation;}    
    public function setDateCreation($uneDateCreation) {$this->dateCreation = $uneDateCreation;}
    
    public function getNbAnnonce() {return $this->nbAnnonce;}    
    public function setNbAnnonce($unNbTraces) {$this->nbAnnonce = $unNbTraces;}
    
    // ------------------------------------------------------------------------------------------------------
    // -------------------------------------- Méthodes d'instances ------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    public function toString() {
        $msg = 'id : ' . $this->id . '<br>';
        $msg .= 'nom : ' . $this->nom . '<br>';
        $msg .= 'prenom : ' . $this->prenom . '<br>';
        $msg .= 'mdpSha1 : ' . $this->mdpSha1 . '<br>';
        $msg .= 'adrMail : ' . $this->adrMail . '<br>';
        $msg .= 'dateCreation : ' . $this->dateCreation . '<br>';
        $msg .= 'nbAnnonce : ' . $this->nbAnnonce . '<br>';
        return $msg;
    }
    
    
} // fin de la classe Utilisateur