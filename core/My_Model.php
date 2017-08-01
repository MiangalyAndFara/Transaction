<?php

class My_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function create($table = '', $object = array(), $last_insert = FALSE) {
        if ($table != '' && !empty($object)) {
            $inserted = $this->db->insert($table, $object);
            if ($inserted) {
                if ($last_insert == TRUE) {
                    return $this->db->insert_id();
                } else {
                    return TRUE;
                }
            }
        }
        return FALSE;
    }

    function delete($table = '', $params = array()) {
        if ($table != '') {
            return $this->db->delete($table, $params);
        }
        return FALSE;
    }

    //fonction lister
    function read($table = '', $colRetour, $params = array(), $join = array(), $order = array(), $nblimit = array(),$groupBy = array() ) {
        if ($colRetour != '') {
            $query = $this->db->select($colRetour);
        }
        if (!empty($params)) {
            $query = $this->db->where($params);
        }
        if (!empty($join)) {
            foreach ($join as $t_join => $pivot) {
                $query = $this->db->join($t_join, $table . "." . $pivot . " = " . $t_join . "." . $pivot, 'left');
            }
        }
        if (!empty($order)) {
            $query = $this->db->order_by(key($order), current($order));
        }
        if(!empty($groupeBy)){
            $query = $this->db->group_by($groupeBy);
        }
        if (!empty($nblimit)) {
            $query = $this->db->limit($nblimit[0], $nblimit[1]);
        }
        $query = $this->db->get($table);
        if ($query->num_rows() > 0) {
            $result = $query->result();
            return $result;
        }
        return FALSE;
    }

    //fonction modification
    function update($table = '', $object = array(), $params = array()) {
        $query = $this->db->where($params);
        $query = $this->db->update($table, $object);
        return $query;
    }

//getDateValid
    function isDateValid($dateVerif, $diffYear = array(), $diffMonth = array(), $diffDay = array()) {
        $dateAVerif = '';
        $dateMax = '';
        $dateMin = '';
        $dateNow = date('Y-m-d');
        if (!empty($diffYear)) {
            $annee = date('Y', strtotime($dateNow));
            $dateMax = $annee - $diffYear[0];
            $dateMin = $annee - $diffYear[1];
            $dateAVerif = date('Y', strtotime($dateVerif));
        }
        if (!empty($diffMonth)) {
            $mois = date('m', strtotime($dateNow));
            $dateMax = $mois - $diffMonth[0];
            $dateMin = $mois - $diffMonth[1];
            $dateAVerif = date('m', strtotime($dateVerif));
        }
        if (!empty($diffDay)) {
            $jour = date('d', strtotime($dateNow));
            $dateMax = $jour - $diffDay[0];
            $dateMin = $jour - $diffDay[1];
            $dateAVerif = date('d', strtotime($dateVerif));
        }
        if ($dateMax >= $dateAVerif && $dateAVerif >= $dateMin) {
            return TRUE;
        } else
            return FALSE;
    }

    //dev 113
    public function is_Date($str) {
        $str = str_replace('/', '-', $str);
        $stamp = strtotime($str);
        if (is_numeric($stamp)) {
            $month = date('m', $stamp);
            $day = date('d', $stamp);
            $year = date('Y', $stamp);
            return checkdate($month, $day, $year);
        }
        return false;
    }

    //dev 112 
    // verifie si une valeur est en doublant dans la base
    function validateValeur($table, $colonne, $data) {
        if (!empty($data)) {
            $colonne = strtoupper($colonne);
            $colRetour = "COUNT(" . $colonne . ") AS " . $colonne;
            $result[0] = $this->read($table, $colRetour, $data, '', '');
            foreach ($result[0] as $res) {
                if ($res->$colonne == '0') {
                    return TRUE;
                }
            }
            return FALSE;
        }
    }

    //dev 112
    // difference entre 2 date avec format : %Y ou %m ou %d
    function getDifferenceDate($dateDebut, $dateFin, $differenceFormat) {
        $diff = '';
        if ($dateDebut != '' && $this->is_Date($dateDebut)) {
            $datetime1 = date_create($dateFin);
            $datetime2 = date_create($dateDebut);
            $diff = date_diff($datetime1, $datetime2);
        } else {
            throw new Exception(Errors_DateInvalid);
        }
        return $diff->format($differenceFormat);
    }

    function getListStatut() {
        $data = array(
            CADRE => 'Cadre',
            GERANT => 'Gérant',
            CHEF_DE_PROJET => 'Chef de projet',
            RESPONSABLE_TECH => 'Responsable technique',
            COMMERCIAL => 'Commercial',
            EMPLOYE => 'Employé',
            DEVELOPPEUR => 'Développeur',
            INTEGRATEUR => 'Intégrateur',
            TESTEUR => 'Testeur',
            ASSISTANT_DE_DIRECTION => 'Assistant de direction'
        );
        return $data;
    }

    function getValeurStatut() {
        $data = array(CADRE, GERANT, CHEF_DE_PROJET, RESPONSABLE_TECH, COMMERCIAL, EMPLOYE, DEVELOPPEUR, INTEGRATEUR, TESTEUR, ASSISTANT_DE_DIRECTION);
        return $data;
    }
    function getStatutByPost(){
        $data = array(
            CADRE => array(GERANT,CHEF_DE_PROJET,RESPONSABLE_TECH),
            COMMERCIAL => array(COMMERCIAL),
            EMPLOYE => array(DEVELOPPEUR,INTEGRATEUR, TESTEUR, ASSISTANT_DE_DIRECTION),
            CLIENT => array(CLIENT)
        );
        return $data;
    }

}
