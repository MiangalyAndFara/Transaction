<?php

class Projet_Model extends My_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Client_Model');
    }

    function save($projet) {
        $object = array('NOM' => $projet->getNom(), 'DATEDEBUT' => $projet->getDateDebut(), 'DATEBUTOIR' => $projet->getDateButoir(), 'COUT' => $projet->getCout());
        $id = $this->create('projet', $object, TRUE);
        if ($id != false) {
            $clients = $projet->getClients();
            foreach ($clients as $cl) {
                $object = array('IDCLIENT' => $cl->getIdClient(), 'IDPROJET' => $id);
                $this->create('client_projet', $object);
            }
        }
        return $id;
    }

    function modif($projet) {
        $where = array('IDPROJET' => $projet->getIdProjet());
        $object = array('NOM' => $projet->getNom(), 'DATEDEBUT' => $projet->getDateDebut(), 'DATEBUTOIR' => $projet->getDateButoir(), 'COUT' => $projet->getCout());
        return $this->update('projet', $object, $where);
    }

    function supprimer($projet) {
        $where = array('IDPROJET' => $projet->getIdProjet());
        $object = array('ETAT' => IS_DELETED);
        return $this->update('projet', $object, $where);
    }

    function getAll() {
        $where = array('etat' => IS_ACTIVE);
        $rset = $this->read('projet', '*',$where);
        $rep = array();
        if (isset($rset) && !empty($rset)) {
            foreach ($rset as $rec) {
                $temp = new Projet();
                $temp->setIdProjet($rec->IDPROJET);
                $temp->setNom($rec->NOM);
                $temp->setDateDebut($rec->DATEDEBUT);
                $temp->setDateButoir($rec->DATEBUTOIR);
                $temp->setCout($rec->COUT);
                $temp->setWorkflows($this->getWorkflow($rec->IDPROJET));
                $rep[] = $temp;
            }
        }
        return $rep;
    }

    function getById($id) {
        $where = array('projet.IDPROJET' => $id, 'etat' => IS_ACTIVE);
        $rset = $this->read('projet', '*', $where);
        $rec = $rset[0];
        $rep = new Projet();
        $rep->setIdProjet($rec->IDPROJET);
        $rep->setNom($rec->NOM);
        $rep->setDateDebut($rec->DATEDEBUT);
        $rep->setDateButoir($rec->DATEBUTOIR);
        $rep->setCout($rec->COUT);
        $rep->setClients($this->getClients($rec->IDPROJET));
        $rep->setWorkflows($this->getWorkflow($id));
        return $rep;
    }

    function getClients($id) {
        $where = array('IDPROJET' => $id);
        $rset = $this->read('client_projet', '*', $where);
        $clients = array();
        if (isset($rset) && !empty($rset)) {
            foreach ($rset as $rec) {
                $temp = $this->Client_Model->getById($rec->IDCLIENT);
                $clients[] = $temp;
            }
        }
        return $clients;
    }

    function getWorkflow($id) {
        $where = array('IDPROJET' => $id);
        $rset = $this->read('workflow', '*', $where);
        $wf = array();
        if (isset($rset) && !empty($rset)) {
            foreach ($rset as $rec) {
                $temp = new Workflow();
                $temp->setIdWf($rec->IDWF);
                $temp->setDescription($rec->DESCRIPTION);
                $temp->setSujet($rec->SUJET);
                $temp->setPourcentage($rec->POURCENTAGE);
                $temp->setStatut($rec->STATUT);
                $wf[] = $temp;
            }
        }
        return $wf;
    }

    function getPourcentage($workflows) {
        $pourc = 0;
        foreach ($workflows as $wf) {
            if ($wf->getStatut() == FAIT) {
                $pourc+=$wf->getPourcentage();
            }
        }
        return $pourc;
    }

}
