<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account {

    private $idaccount;
    private $projet;
    private $datePaye;
    private $montantPaye;
    private $restePaye;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model("Account_Model");
    }

    function getIdaccount() {
        return $this->idaccount;
    }

    function getProjet() {
        return $this->projet;
    }

    function getDatePaye() {
        return $this->datePaye;
    }

    function getMontantPaye() {
        return $this->montantPaye;
    }

    function getRestePaye() {
        return $this->restePaye;
    }

    function setIdaccount($idaccount) {
        $this->idaccount = $idaccount;
    }

    function setProjet($projet) {
        $this->projet = $projet;
    }

    function setDatePaye($datePaye) {
        if ($datePaye != '') {
            if ($this->CI->Account_Model->is_Date($datePaye)) {
                $this->datePaye = $datePaye;
            } else {
                throw new Exception(Errors_DateInvalid);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setMontantPaye($montantPaye) {
        if ($montantPaye != '') {
            if (is_numeric($montantPaye)) {
                $this->montantPaye = $montantPaye;
            } else {
                throw new Exception(Errors_RequiredNumeric);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

    function setRestePaye($restePaye) {
        if ($restePaye != '') {
            if (is_numeric($restePaye)) {
                $this->restePaye = $restePaye;
            } else {
                throw new Exception(Errors_RequiredNumeric);
            }
        } else {
            throw new Exception(Errors_RequiredField);
        }
    }

}
