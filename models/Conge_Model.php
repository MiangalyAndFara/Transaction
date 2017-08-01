<?php

class Conge_Model extends My_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("Conge");
        $this->load->library("Employe");
        $this->load->model("Employe_Model");
    }

    function getAllDemandeConge($condition) {
        $listeDmd = $this->read(TAB_CONGE, '', $condition, '', '', '');
        $rep = array();
        if (isset($listeDmd) && !empty($listeDmd)) {
            foreach ($listeDmd as $lcdmd) {
                $temp = new Conge();
                $temp->setIdConge($lcdmd->IDCONGE);
                $employe = $this->Employe_Model->listEmploye(array('employe.IDEMP' => $lcdmd->IDEMP));
                $temp->setEmploye($employe[0]);
                $temp->setDateConge($lcdmd->DATECONGE);
                $temp->setDateDebut($lcdmd->DATEDEBUT);
                $temp->setDuree($lcdmd->DUREE);
                $temp->setStatut($lcdmd->STATUT);
                $rep[] = $temp;
            }
        }
        return $rep;
    }

    function getDateEntreeEmp($emp) {
        $params = array(
            "IDEMP" => $emp->getIdEmp()
        );
        $result = $this->read(TAB_EMP, '', $params, '', '', '');
        $dateEntree = '';
        if (count($result) != 0) {
            foreach ($result as $lce) {
                $dateEntree = $lce->DATEENTREE;
            }
        }
        return $dateEntree;
    }

    function isValid($emp, $datedemande) {
        if ($this->getDifferenceDate($emp->getDateEntree(), $datedemande, '%Y') >= 1) {
            return TRUE;
        }
        RETURN FALSE;
    }

    function getPremierConge($emp) {
        $dateEntree = $this->getDateEntreeEmp($emp);
        $jourEntree = date('d', strtotime($dateEntree));
        $anneeEntree = date('Y', strtotime($dateEntree));
        $dateFinEntree = $anneeEntree . "-12-31";
        $diff_format = '%m';
        $nbConge = 0;
        if ($jourEntree < 25) {
            $nbConge = ($this->getDifferenceDate($dateEntree, $dateFinEntree, $diff_format)) * CONGE_MOIS;
        } else {
            $date = new DateTime($dateEntree);
            $interval = new DateInterval('P1M');
            $date->add($interval);
            $dateEntree = $date->format('Y-m-d');
            $nbConge = ($this->getDifferenceDate($dateEntree, $dateFinEntree, $diff_format)) * CONGE_MOIS;
        }
        return $nbConge;
    }

    function getSommePremierConge($emp) {
        $nbConge = $this->getPremierConge($emp) + CONGE_ANNEE;
        return $nbConge;
    }

    function validerConge($conge, $reponse, $motif, $dureeConge, $dateDebut, $idemp) {
        $result = '';
        if ($reponse != '') {
            $parametre = array('IDCONGE' => $conge->getIdConge());
            if ($reponse == VALIDE) {
                $object = array(
                    'STATUT' => $reponse
                );
                $value = $this->update(TAB_CONGE, $object, $parametre);
                if ($value) {
                    $result = $reponse;
                }
                $motif = "Conge Validé";
            } else if ($reponse == VALIDE_CONDITION) {
                if ($dureeConge != '') {
                    $object = array(
                        'DATEDEBUT' => $dateDebut->format('Y-m-d H:i:s'),
                        'DUREE' => $dureeConge,
                        'STATUT' => VALIDE
                    );
                    $value = $this->update(TAB_CONGE, $object, $parametre);
                    if ($value) {
                        $result = VALIDE;
                    }
                }
            } else {
                $object = array(
                    'STATUT' => $reponse
                );
                $value = $this->update(TAB_CONGE, $object, $parametre);
                if ($value) {
                    $result = $reponse;
                }
            }
            //$this->Mail_Model->sendMail($idemp, $motif);
        }
        return $result;
    }

    function getNbCongeRestant($employe, $dateDemande) {
        $dateConge = new DateTime($dateDemande, new DateTimeZone('UTC'));
        $dateEmp = new DateTime($employe->getDateEntree(), new DateTimeZone('UTC'));
        // si 1ere annee de conge : 1 an apres entree
        if ($dateConge->format('Y') == ($dateEmp->format('Y') + 1)) {
            return $this->getPremierConge($employe);
        }
        // annee entre +2 => 1er conge + conge d'un an
        else if ($dateConge->format('Y') == ($dateEmp->format('Y') + 2)) {
            return $this->getSommePremierConge($employe);
        }
        // conge normal
        else {
            $sql = "select sum(duree) as nb from conge where idemp=" . $employe->getIdEmp();
            $query = $this->db->query($sql);
            $result = $query->result();
            return CONGE_ANNEE - $result[0]->nb;
        }
        return 5;
    }

    function save($conge) {
        $object = array('IDEMP' => $conge->getEmploye()->getIdEmp(), 'DATECONGE' => $conge->getDateConge(), 'DATEDEBUT' => $conge->getDateDebut()->format('Y-m-d H:i:s'), 'DUREE' => $conge->getDuree(), 'STATUT' => $conge->getStatut());
        return $this->create('conge', $object);
    }

}
