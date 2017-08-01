<?php

/*
 * dev 113 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Workflow {

    //put your code here
    private $idWf;
    private $sujet;
    private $description;
    private $pourcentage;
    private $statut;
    private $projet;

    function getIdWf() {
        return $this->idWf;
    }

    function getSujet() {

        return $this->sujet;
    }

    function getDescription() {
        return $this->description;
    }

    function getPourcentage() {
        return $this->pourcentage;
    }

    function getStatut() {
        return $this->statut;
    }

    function getProjet() {
        return $this->projet;
    }

    function setIdWf($idWf) {
        $this->idWf = $idWf;
    }

    function setSujet($sujet) {
        if ($sujet != '') {
            $this->sujet = $sujet;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setDescription($description) {
        if ($description != '') {
            $this->description = $description;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setPourcentage($pourcentage) {
        $this->pourcentage = $pourcentage;
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }

    function setProjet($projet) {
        $this->projet = $projet;
    }

}
