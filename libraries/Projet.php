<?php

/*
 * dev 113 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Projet {

    //put your code here
    private $idProjet;
    private $nom;
    private $dateDebut;
    private $dateButoir;
    private $cout;
    private $clients;
    private $workflows;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('Projet_Model');
    }

    function getIdProjet() {
        return $this->idProjet;
    }

    function getNom() {
        return $this->nom;
    }

    function getDateDebut() {
        return $this->dateDebut;
    }

    function getDateButoir() {
        return $this->dateButoir;
    }

    function getCout() {
        return $this->cout;
    }

    function getClients() {
        return $this->clients;
    }

    function setIdProjet($idProjet) {
        if (is_numeric($idProjet)) {
            $this->idProjet = $idProjet;
        } else {
            throw new Exception(Errors_RequiredNumeric);
        }
    }

    function setNom($nom) {
        if ($nom != '') {
            $this->nom = $nom;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setDateDebut($dateDebut) {
        if ($this->CI->Projet_Model->is_Date($dateDebut)) {
            $this->dateDebut = $dateDebut;
        } else {
            throw new Exception(Errors_InvalidDate);
        }
    }

    function setDateButoir($dateButoir) {
        if ($this->CI->Projet_Model->is_Date($dateButoir)) {
            $this->dateButoir = $dateButoir;
        } else {
            throw new Exception(Errors_InvalidDate);
        }
    }

    function setCout($cout) {
        if (is_numeric($cout)) {
            $this->cout = $cout;
        } else {
            throw new Exception(Errors_RequiredNumeric);
        }
    }

    function setClients($clients) {
        $this->clients = $clients;
    }

    function getWorkflows() {
        return $this->workflows;
    }

    function setWorkflows($workflows) {
        $this->workflows = $workflows;
    }

}
