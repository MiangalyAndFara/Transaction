<?php
/*
* dev 112
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class Employe {

    private $idEmp;
    private $user;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $sexe;
    private $adresse;
    private $dateEntree;
    private $cin;
    private $etat;
    private $telephone;
    private $email;
    private $skype;
    private $age;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model("Employe_Model");
    }

    function getIdEmp() {
        return $this->idEmp;
    }

    function setIdEmp($idEmp) {
        $this->idEmp = $idEmp;
    }

    function getUser() {
        return $this->user;
    }

    function setUser($user) {
        $this->user = $user;
    }

    function getNom() {
        return $this->nom;
    }

    function setNom($nom) {
        if ($nom != '') {
            if (is_string($nom)) {
                $this->nom = $nom;
            } else {
                throw new Exception(Errors_RequiredStringChraracters);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function getPrenom() {
        return $this->prenom;
    }

    function setPrenom($prenom) {
        if ($prenom != '') {
            if (is_string($prenom)) {
                $this->prenom = $prenom;
            } else {
                throw new Exception(Errors_RequiredStringChraracters);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function getNaissance() {
        return $this->dateNaissance;
    }

    function setNaissance($naissance) {
        if ($naissance != '') {
            $dateYear = array(
                0 => DIFF_AGE_MAX, DIFF_AGE_MIN
            );
            if ($this->CI->Employe_Model->isDateValid($naissance, $dateYear)) {
                $this->dateNaissance = $naissance;
            } else {
                throw new Exception(Errors_DateInvalid);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function getSexe() {
        return $this->sexe;
    }

    function setSexe($sexe) {
        if ($sexe != '') {
            $this->sexe = $sexe;
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function getAdresse() {
        return $this->adresse;
    }

    function setAdresse($adresse) {
        if ($adresse != '') {
            if (is_string($adresse)) {
                $this->adresse = $adresse;
            } else {
                throw new Exception(Errors_RequiredStringChraracters);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function getDateEntree() {
        return $this->dateEntree;
    }

    function setDateEntree($dateEntree) {
        if ($dateEntree != '') {
           
            if ($this->CI->Employe_Model->is_Date($dateEntree)) {
                $this->dateEntree = $dateEntree;
            } else {
                throw new Exception(Errors_EntreeDateInvalid);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function getCin() {
        return $this->cin;
    }

    function setCin($cin) {
        if ($cin != '') {
            if (is_numeric($cin) && strlen($cin) == CIN_VALID) {
                $this->cin = $cin;
            } else {
                throw new Exception(Errors_CINInvalid);
            }
        }
    }

    function setCinPost($cin) {
        if ($cin != '') {
            if (is_numeric($cin) && strlen($cin) == CIN_VALID) {
                $data = array(
                    'cin' => $cin
                );
                if ($this->CI->Employe_Model->validateValeur(TAB_EMP, 'cin', $data)) {
                    $this->cin = $cin;
                } else {
                    throw new Exception(Errors_CINInvalid);
                }
            } else {
                throw new Exception(Errors_CINInvalid);
            }
        }
    }

    function getEtat() {
        return $this->etat;
    }

    function setEtat($etat) {
        if (is_numeric($etat)) {
            $this->etat = $etat;
        } else {
            throw new Exception(Errors_RequiredNumeric);
        }
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getEmail() {
        return $this->email;
    }

    function getSkype() {
        return $this->skype;
    }

    function setTelephone($telephone) {
        if (preg_match("/^[0-9 ]+$/", $telephone)) {
            $this->telephone = $telephone;
        } else {
            throw new Exception(Errors_InvalidNumber);
        }
    }

    function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            throw new Exception(Errors_InvalidEmail);
        }
    }

    function setSkype($skype) {
        $this->skype = $skype;
    }
    function getAge() {
        return $this->age;
    }

    function setAge($naissance) {
        if($naissance != ''){
            $dtNow = date('Y-m-d');
            try{
                $this->age = $this->CI->Employe_Model->getDifferenceDate($naissance,$dtNow,'%Y');
            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }
        }
    }
}
