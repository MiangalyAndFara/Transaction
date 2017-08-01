<?php

/*
 * dev 113 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Client {

    //put your code here
    private $idClient;
    private $nif;
    private $stat;
    private $nom;
    private $contact;
    private $statut;

    function getNif() {
        return $this->nif;
    }

    function getStat() {
        return $this->stat;
    }

    function getNom() {
        return $this->nom;
    }

    function getStatut() {
        return $this->statut;
    }

    function getIdClient() {
        return $this->idClient;
    }

    function getContact() {
        return $this->contact;
    }

    function setContact($contact) {
        $this->contact = $contact;
    }

    function setNif($nif) {
        if ($nif != '') {
            $this->nif = $nif;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setStat($stat) {
        if ($stat != '') {
            $this->stat = $stat;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setNom($nom) {
        if ($nom != '') {
            $this->nom = $nom;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setStatut($statut) {
        if (is_numeric($statut)) {
            $this->statut = $statut;
        } else {
            throw new Exception(Errors_RequiredNumeric);
        }
    }

    function setIdClient($idClient) {
        if (is_numeric($idClient)) {
            $this->idClient = $idClient;
        } else {
            throw new Exception(Errors_RequiredNumeric);
        }
    }

}
