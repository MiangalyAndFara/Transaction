<?php

class Prospect_Model extends My_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('Contact');
    }

    function save($prospect) {
        $object = array('NIF' => $prospect->getNif(), 'STAT' => $prospect->getStat(), 'NOM' => $prospect->getNom(), 'STATUT' => EST_PROSPECT);
        $id = $this->create('client', $object, TRUE);
        if ($id != false) {
            $contact = $prospect->getContact();
            $object = array('IDCLIENT' => $id, 'MAIL' => $contact->getEmail(), 'TELEPHONE' => $contact->getTelephone(), 'SKYPE' => $contact->getSkype());
            return $this->create('contact', $object);
        }
        return false;
    }

    function modif($prospect) {
        $object = array('NIF' => $prospect->getNif(), 'STAT' => $prospect->getStat(), 'NOM' => $prospect->getNom(), 'STATUT' => $prospect->getStatut());
        $where = array('IDCLIENT' => $prospect->getIdClient());
        if ($this->update('client', $object, $where)) {
            $contact = $prospect->getContact();
            $object = array('MAIL' => $contact->getEmail(), 'TELEPHONE' => $contact->getTelephone(), 'SKYPE' => $contact->getSkype());
            return $this->update('contact', $object, $where);
        }
        return false;
    }

    function getById($id) {
        $where = array('client.IDCLIENT' => $id);
        $join = array('contact' => 'IDCLIENT');
        $rset = $this->read('client', '*', $where, $join);

        if (isset($rset) && !empty($rset)) {
            $rep = new Client();
            $rec = $rset[0];
            $rep->setIdClient($rec->IDCLIENT);
            $rep->setNif($rec->NIF);
            $rep->setStat($rec->STAT);
            $rep->setNom($rec->NOM);
            $contact = new Contact();
            $contact->setEmail($rec->MAIL);
            $contact->setTelephone($rec->TELEPHONE);
            $contact->setSkype($rec->SKYPE);
            $rep->setContact($contact);
            return $rep;
        }
        return false;
    }

    function getAll($bool = '') {
        $query = $this->db->query('SELECT * FROM `client` LEFT JOIN `contact` ON `client`.`IDCLIENT` = `contact`.`IDCLIENT` WHERE `client`.`statut`=' . EST_PROSPECT);
        if ($bool) {
            $query = $this->db->query('SELECT * FROM `client` LEFT JOIN `contact` ON `client`.`IDCLIENT` = `contact`.`IDCLIENT` WHERE `client`.`statut`=' . EST_PROSPECT . ' or `client`.`statut`=' . CLIENT_FIXE);
        }
        $rset = $query->result();
        $rep = array();

        if (isset($rset) && !empty($rset)) {
            foreach ($rset as $rec) {
                $temp = new Client();
                $temp->setIdClient($rec->IDCLIENT);
                $temp->setNif($rec->NIF);
                $temp->setStat($rec->STAT);
                $temp->setNom($rec->NOM);
                $contact = new Contact();
                $contact->setEmail($rec->MAIL);
                $contact->setTelephone($rec->TELEPHONE);
                $contact->setSkype($rec->SKYPE);
                $temp->setContact($contact);
                $rep[] = $temp;
            }
        }
        return $rep;
    }

}
