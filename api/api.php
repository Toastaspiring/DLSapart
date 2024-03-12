<?php
namespace api;
// Projet TraceGPS - services web
// Fichier : api/api.php
// La classe Api hérite de la classe Rest (fichier api/rest.php)
// Dernière mise à jour : 21/11/2023 par Ethan DIVET

include_once ("rest.php");
include_once ('../modele/classes/DAO.php');

class Api extends Rest
{   
    // Le constructeur
    public function __construct()
    {   parent::__construct();      // appel du constructeur de la classe parente
    }
    
    
    // Cette méthode traite l'action demandée dans l'URI
    public function traiterRequete()
    {   // récupère le contenu du paramètre action et supprime les "/"
        $action = ( empty($this->request['action'])) ? "" : $this->request['action'];
        $action = strtolower(trim(str_replace("/", "", $action)));
        
        switch ($action) {
            // services web fournis
            case "connecter" : {$this->Connecter(); break;}
            case "changerdemdp" : {$this->ChangerDeMdp(); break;}

            case "getunutilisateur" : {$this->GetUnUtilisateur(); break;}
            case "creerunutilisateur" : {$this->CreerUnUtilisateur(); break;}
            case "supprimerunutilisateur" : {$this->SupprimerUnUtilisateur(); break;}

            case "gettouslesannonces" : {$this->GetToutesLesAnnonces(); break;}
            case "getmesannonces" : {$this->GetMesAnnonces(); break;}
            case "getuneannonce" : {$this->GetUneAnnonce(); break;}
            case "creeruneannonce" : {$this->CreerUneAnnonce(); break;}
            case "supprimeruneannonce" : {$this->SupprimerUneAnnonce(); break;}

            case "estcodevalide" : {$this->EstCodeValide(); break;}

            
            // services web restant à développer
            case "demandermdp" : {$this->DemanderMdp(); break;}
            
            // l'action demandée n'existe pas, la réponse est 404 ("Page not found") et aucune donnée n'est envoyée
            default : {
                $code_reponse = 404;            
                $donnees = '';
                $content_type = "application/json;  charset=utf-8";      // indique le format Json pour la réponse
                $this->envoyerReponse($code_reponse, $content_type, $donnees);    // envoi de la réponse HTTP
                break;
            }  
        } 
    } // fin de la fonction traiterRequete
    
    // services web fournis ===========================================================================================
    // Ce service permet permet à un utilisateur de s'authentifier
    private function Connecter()
    {   include_once ("services/Connecter.php");
    }
    
    // Ce service permet permet à un utilisateur de changer son mot de passe
    private function ChangerDeMdp()
    {   include_once ("services/ChangerDeMdp.php");
    }

    private function EstCodeValide()
    {   include_once("services/EstCodeValide.php");
    }


    // Ce service permet permet à un utilisateur de se créer un compte
    private function GetUnUtilisateur()
    {   include_once ("services/GetUnUtilisateur.php");
    }
    
    // Ce service permet permet à un utilisateur de se créer un compte
    private function CreerUnUtilisateur()
    {   include_once ("services/CreerUnUtilisateur.php");
    }
    
    // Ce service permet à un administrateur de supprimer un utilisateur (à condition qu'il ne possède aucune trace enregistrée)
    private function SupprimerUnUtilisateur()
    {   include_once ("services/SupprimerUnUtilisateur.php");
    }







    // Ce service permet à un utilisateur authentifié d'obtenir la liste de tous les utilisateurs (de niveau 1)
    private function GetToutesLesAnnonces()
    {   include_once ("services/GetTouteLesAnnonces.php");
    }
    
    private function GetUneAnnonce()
    {   include_once ("services/GetUneAnnonce.php");
    }
    
    private function GetMesAnnonces()
    {   include_once ("services/GetMesAnnonces.php");
    }

    // Ce service permet à un utilisateur de créer une annonce
    private function CreerUneAnnonce()
    {   include_once ("services/CreerUneAnonnce.php");
    }

    // Ce service permet à un utilisateur de créer une annonce
    private function SupprimerUneAnnonce()
    {   include_once ("services/SupprimerUneAnnonce.php");
    }
    
    // services web restant à développer ==============================================================================
    
    // Ce service génère un nouveau mot de passe, l'enregistre en sha1 et l'envoie par mail à l'utilisateur
    private function DemanderMdp()
    {   include_once ("services/DemanderMdp.php");
    }
    
} // fin de la classe Api

// Traitement de la requête HTTP
$api = new Api;
$api->traiterRequete();