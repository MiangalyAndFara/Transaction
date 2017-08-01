<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur {

    private $idUser;
    private $identifiant;
    private $passe;
    private $statut;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model("Utilisateur_Model");
    }

    function getIdUser() {
        return $this->idUser;
    }

    function setIdUser($iduser) {
        $this->idUser = $iduser;
    }

    function getIdentifiant() {
        return $this->identifiant;
    }

    function setIdentifiant($identifiant) {
        if ($identifiant != '') {
            $this->identifiant = $identifiant;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setIdentifiantPost($identifiant) {
        if ($identifiant != '') {
            $data = array(
                "identifiant" => $identifiant
            );
            if ($this->CI->Utilisateur_Model->validateValeur(TAB_USER, 'identifiant', $data)) {
                $this->identifiant = $identifiant;
            } else {
                throw new Exception(Errors_identifiantUtilise);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function getPasse() {
        return $this->passe;
    }

    function setPasse($passe) {
        if ($passe != '') {
            $this->passe = $passe;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setPassePost($passe) {
        if ($passe != '') {
            if (strlen($passe) >= 8) {
                $this->passe = hash('sha512', $passe);
            } else {
                throw new Exception(Errors_ToShortField);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function getStatut() {
        return $this->statut;
    }

    function setStatut($statut) {
        if (is_numeric($statut)) {
            $this->statut = $statut;
        } else {
            throw new Exception(Errors_RequiredNumeric);
        }
    }

}
