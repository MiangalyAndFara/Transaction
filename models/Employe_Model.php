<?php

/*
 * dev 112
 */

class Employe_Model extends My_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("Employe");
        $this->load->library("Utilisateur");
        $this->load->model("Utilisateur_Model");
    }

    function saveEmploye($newEmp) {
        if (!empty($newEmp)) {
            try {
                $toInsert = array(
                    "iduser" => $newEmp->getUser()->getIdUser(),
                    "nom" => $newEmp->getNom(),
                    "prenom" => $newEmp->getPrenom(),
                    "datenaissance" => $newEmp->getNaissance(),
                    "sexe" => $newEmp->getSexe(),
                    "adresse" => $newEmp->getAdresse(),
                    "dateentree" => $newEmp->getDateEntree(),
                    "cin" => $newEmp->getCin(),
                    "etat" => $newEmp->getEtat()
                );
                if ($this->validateValeur(TAB_EMP, 'idemp', $toInsert)) {
                    $id = $this->create(TAB_EMP, $toInsert, TRUE);
                    if ($id != false) {
                        $object = array('IDEMP' => $id, 'MAIL' => $newEmp->getEmail(), 'TELEPHONE' => $newEmp->getTelephone(), 'SKYPE' => $newEmp->getSkype());
                        return $this->create(TAB_CONTACT, $object, TRUE);
                    } else {
                        throw new Exception("Erreur au niveau de la base de donnee");
                    }
                } else {
                    throw new Exception(Errors_UserAlreadyInsert);
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        } else {
            throw new Exception(Errors . AllFiledRequired);
        }
    }

    function listEmploye($condition) {
        $where = array(
            TAB_EMP . '.ETAT' => IS_EMP
        );
        if (!empty($condition)) {
            foreach ($condition as $name => $value) {
                $where[$name] = $value;
            }
        }
        $join = array(TAB_CONTACT => 'IDEMP');
        $listEmp = $this->read(TAB_EMP, '*', $where, $join);
        $rep = array();
        if (isset($listEmp) && !empty($listEmp)) {
            foreach ($listEmp as $lce) {
                $temp = new Employe();
                $temp->setIdEmp($lce->IDEMP);
                $temp->setUser($this->Utilisateur_Model->getUtilisateur($lce->IDUSER));
                $temp->setNom($lce->NOM);
                $temp->setPrenom($lce->PRENOM);
                $temp->setNaissance($lce->DATENAISSANCE);
                $temp->setSexe($lce->SEXE);
                $temp->setAdresse($lce->ADRESSE);
                $temp->setDateEntree($lce->DATEENTREE);
                $temp->setCin($lce->CIN);
                $temp->setEtat($lce->ETAT);
                $temp->setAge($lce->DATENAISSANCE);
                $temp->setTelephone($lce->TELEPHONE);
                $temp->setEmail($lce->MAIL);
                $temp->setSkype($lce->SKYPE);
                $rep[] = $temp;
            }
        }
        return $rep;
    }

    function modifEmploye($emp) {
        $condition = array('IDEMP' => $emp->getIdEmp());
        $where = array('IDUSER' => $emp->getUser()->getIdUser());
        $iduser = 0;
        $tUser = array(
            'IDENTIFIANT' => $emp->getUser()->getIdentifiant(),
            'MOTDEPASSE' => $emp->getUser()->getPasse(),
            'STATUT' => $emp->getUser()->getStatut()
        );
        $result = $this->update(TAB_USER, $tUser, $where);
        if ($result) {
            $object = array(
                'IDUSER' => $emp->getUser()->getIdUser(),
                'NOM' => $emp->getNom(),
                'PRENOM' => $emp->getPrenom(),
                'DATENAISSANCE' => $emp->getNaissance(),
                'SEXE' => $emp->getSexe(),
                'ADRESSE' => $emp->getAdresse(),
                'DATEENTREE' => $emp->getDateEntree(),
                'CIN' => $emp->getCin(),
                'ETAT' => $emp->getEtat());
            $value = $this->update(TAB_EMP, $object, $condition);
            if ($value) {
                $object = array('MAIL' => $emp->getEmail(), 'TELEPHONE' => $emp->getTelephone(), 'SKYPE' => $emp->getSkype());
                return $this->update(TAB_CONTACT, $object, $condition);
            }
        }
    }

    function supEmploye($id) {
        $condition = array('IDEMP' => $id);
        $object = array(
            'ETAT' => NON_EMP
        );
        return $this->update(TAB_EMP, $object, $condition);
    }

}
