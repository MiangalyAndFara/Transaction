<?php

class Account_Model extends My_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('Account');
        $this->load->library('Projet');
        $this->load->model('Projet_Model');
    }

    function getAllPayement($id) {
        $where = array(
            TAB_PROJET . '.IDPROJET' => $id
        );
        $join = array(TAB_ACCOUNT => 'IDPROJET');
        $listAccount = $this->read(TAB_PROJET, '*', $where, $join);
        $rep = array();
        if (isset($listAccount) && !empty($listAccount)) {
            foreach ($listAccount as $lacc) {
                $temp = new Account();
                $temp->setIdaccount($lacc->IDACCOUNT);
                $temp->setProjet($this->Projet_Model->getById($lacc->IDPROJET));
                $temp->setDatePaye($lacc->DATEPAIE);
                $temp->setMontantPaye($lacc->MONTANT);
                $rep[] = $temp;
            }
        }
        return $rep;
    }

    function getAccountProjet($id) {
        $where = array(
            TAB_PROJET . '.IDPROJET' => $id
        );
        $join = array(TAB_ACCOUNT => 'IDPROJET');
        $colRetour = "SUM(" . TAB_ACCOUNT . ".MONTANT) as MONTANT," . TAB_ACCOUNT . ".IDPROJET," . TAB_PROJET . ".COUT";
        $groupBy = array(TAB_ACCOUNT . '.IDPROJET');
        $accountPaye = $this->readGP(TAB_PROJET, $colRetour, $where, $join, '', '', $groupBy);
        $temp = new Account();
        if (isset($accountPaye) && !empty($accountPaye)) {
            foreach ($accountPaye as $acc) {
                $temp->setProjet($this->Projet_Model->getById($acc->IDPROJET));
                $temp->setMontantPaye($acc->MONTANT);
                $temp->setRestePaye($acc->COUT - $acc->MONTANT);
            }
        }
        return $temp;
    }

    function enregistrerAccount($account) {
        try {
            $acc = $this->getAccountProjet($account->getProjet()->getIdProjet());
            if ($acc->getRestePaye() >= $account->getMontant()) {
                $toInsert = array(
                    "idprojet" => $account->getProjet()->getIdProjet(),
                    "datepaie" => $account->getDatePaye(),
                    "montant" => $account->getMontant()
                );
                $id = $this->create(TAB_ACCOUNT, $toInsert, TRUE);
                if ($id != false) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } else {
                throw new Exception("invalid montant");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    function paieAccount($account) {
        if ($account != '') {
            
        } else {
            throw new Exception(Errors_AllFiledRequired);
        }
    }

}
