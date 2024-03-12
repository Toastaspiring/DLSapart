<?php
namespace modele;
// Projet TraceGPS
// fichier : modele/Utilisateur.php
// Rôle : la classe Utilisateur représente les utilisateurs de l'application
// Dernière mise à jour : 9/7/2021 par dP
include_once ('Outils.php');
class Annonce
{
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------- Attributs privés de la classe -------------------------------------
    // ------------------------------------------------------------------------------------------------------
    private $id; // identifiant de l'utilisateur (numéro automatique dans la BDD)
    private $titre; // pseudo de l'utilisateur
    private $description; // mot de passe de l'utilisateur (hashé en SHA1)
    private $date; // adresse mail de l'utilisateur
    private $taille; // numéro de téléphone de l'utilisateur
    private $prix; // niveau d'accès : 1 = utilisateur (pratiquant ou proche) 2 = administrateur
    private $imageURL; // URl de l'image path1
    private $Utilisateur; // Objet Utilisateur lié au compte
    
    // ------------------------------------------------------------------------------------------------------
    // ----------------------------------------- Constructeur -----------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    public function __construct($unId, $unTitre, $uneDescription, $uneDate, $uneTaille, $unPrix, $uneImage, $unUtilisateur) {
            $this->id = $unId;
            $this->titre = $unTitre;
            $this->description = $uneDescription;
            $this->date = $uneDate;
            $this->taille = $uneTaille;
            $this->prix = $unPrix;
            $this->imageURL = $uneImage;
            $this->Utilisateur = $unUtilisateur;
    }
    
    // ------------------------------------------------------------------------------------------------------
    // ---------------------------------------- Getters et Setters ------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    public function getId() {return $this->id;}
    public function setId($unId) { $this->id = $unId;}
    
    public function getTitre() {return $this->titre;}
    public function setTitre($unTitre) {$this->titre = $unTitre;}
    
    public function getDescription() {return $this->description;}
    public function setDescription($uneDescription) {$this->description = $uneDescription;}
    
    public function getDate() {return $this->date;}
    public function setDate($uneDate) {$this->date = $uneDate;}
    
    public function getTaille() {return $this->taille;}
    public function setTaille($uneTaille) {$this->taille = $uneTaille;}
    
    public function getPrix() {return $this->prix;}    
    public function setPrix($unPrix) {$this->prix = $unPrix;}
    
    public function getImageURL() {return $this->imageURL;}    
    public function setImageURL($imageURL) {$this->imageURL = $imageURL;}
    
    public function getUtilisateur() {return $this->Utilisateur;}    
    public function setUtilisateur($unUtilisateur) {$this->Utilisateur = $unUtilisateur;}
    
    // ------------------------------------------------------------------------------------------------------
    // -------------------------------------- Méthodes d'instances ------------------------------------------
    // ------------------------------------------------------------------------------------------------------
    public function toString() {
        $msg = 'id : ' . $this->id . '<br>';
        $msg .= 'titre : ' . $this->titre . '<br>';
        $msg .= 'description : ' . $this->description . '<br>';
        $msg .= 'date : ' . $this->date . '<br>';
        $msg .= 'taille : ' . $this->taille . '<br>';
        $msg .= 'prix : ' . $this->prix . '<br>';
        $msg .= 'image : '. '<br>';
        $msg .= "image : <img src=". $this->imageURL ." .alt=". $this->titre ."> <br>";
        $msg .= 'idUtilisateur : ' . $this->Utilisateur->toString() . '<br>';
        return $msg;
    }
    
    
} // fin de la classe Utilisateur