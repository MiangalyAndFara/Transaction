<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Conge {

    private $idConge;
    private $employe;
    private $motif;
    private $dateConge;
    private $dateDebut;
    private $dateButoire;
    private $duree;
    private $statut;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model("Conge_Model");
        $this->CI->load->model("Employe_Model");
    }

    function getIdConge() {
        return $this->idConge;
    }

    function getIdEmp() {
        return $this->idemp;
    }

    function getMotif() {
        return $this->motif;
    }

    function getDateConge() {
        return $this->dateConge;
    }

    function getDateButoire() {
        return $this->dateButoire;
    }

    function getDuree() {
        return $this->duree;
    }

    function getStatut() {
        return $this->statut;
    }

    function setIdConge($idConge) {
        $this->idConge = $idConge;
    }

    function getEmploye() {
        return $this->employe;
    }

    function getDateDebut() {
        return $this->dateDebut;
    }

    function setDateDebut($dateDebut) {
        if ($this->CI->Conge_Model->is_Date($dateDebut)) {
            $this->dateDebut = $dateDebut;
        } else {
            throw new Exception(Errors_InvalidDate);
        }
    }

    function setEmploye($employe) {
        $this->employe = $employe;
    }

    function setMotif($motif) {
        $this->motif = $motif;
    }

    function setDateConge($dateConge) {
        if ($this->CI->Conge_Model->is_Date($dateConge)) {
            $this->dateConge = $dateConge;
        } else {
            throw new Exception(Errors_InvalidDate);
        }
    }

    function setDateButoire($dateButoire) {
        if ($this->CI->Conge_Model->is_Date($dateButoire)) {
            $this->dateButoire = $dateButoire;
        } else {
            throw new Exception(Errors_InvalidDate);
        }
    }

    function setDuree($duree) {
        if (is_numeric($duree)) {
            $this->duree = $duree;
        } else {
            throw new Exception(Errors_RequiredNumeric);
        }
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }

}
