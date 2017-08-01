<?php

class Workflow_Model extends My_Model {

    function __construct() {
        parent::__construct();
    }

    function save($wf) {
        $object = array('IDPROJET' => $wf->getProjet()->getIdProjet(), 'SUJET' => $wf->getSujet(), 'DESCRIPTION' => $wf->getDescription(), 'POURCENTAGE' => $wf->getPourcentage(), 'STATUT' => $wf->getStatut());
        return $this->create('workflow', $object, true);
    }

    function modif($wf) {
        $where = array('IDWF' => $wf->getIdWf());
        $object = array('IDPROJET' => $wf->getProjet()->getIdProjet(), 'SUJET' => $wf->getSujet(), 'DESCRIPTION' => $wf->getDescription(), 'POURCENTAGE' => $wf->getPourcentage(), 'STATUT' => $wf->getStatut());
        return $this->update('workflow', $object, $where);
    }

    function del($id) {
        $where = array('IDWF' => $id);
        $this->delete('workflow', $where);
    }

}
