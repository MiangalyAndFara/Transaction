<?php

class Client_Model extends My_Model {

    function __construct() {
        parent::__construct();
        $this->load->library('Client');
         $this->load->library('Contact');
    }

    function getAll() {
        $where = array('client.statut' => CLIENT_FIXE);
        $join = array('contact' => 'IDCLIENT');
        $rset = $this->read('client', '*', $where, $join);

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

    function getById($id = '') {
        $where = array('client.statut' => CLIENT_FIXE, 'client.idclient' => $id);
        $join = array('contact' => 'IDCLIENT');
        $rset = $this->read('client', '*', $where, $join);

        $rep = new Client();
        if (isset($rset) && !empty($rset)) {
            $rec = $rset[0];
            $rep = new Client();
            $rep->setIdClient($rec->IDCLIENT);
            $rep->setNif($rec->NIF);
            $rep->setStat($rec->STAT);
            $rep->setNom($rec->NOM);
            $contact = new Contact();
            $contact->setEmail($rec->MAIL);
            $contact->setTelephone($rec->TELEPHONE);
            $contact->setSkype($rec->SKYPE);
            $rep->setContact($contact);
        }
        return $rep;
    }

}
