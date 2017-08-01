<?php

/*
 * dev 113 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact {

    //put your code here
    private $idContact;
    private $email;
    private $telephone;
    private $skype;
    private $employe;
    private $client;

    function getIdContact() {
        return $this->idContact;
    }

    function getEmail() {
        return $this->email;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getSkype() {
        return $this->skype;
    }

    function getEmploye() {
        return $this->employe;
    }

    function getClient() {
        return $this->client;
    }

    function setIdContact($idContact) {
        $this->idContact = $idContact;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setSkype($skype) {
        $this->skype = $skype;
    }

    function setEmploye($employe) {
        $this->employe = $employe;
    }

    function setClient($client) {
        $this->client = $client;
    }

}
