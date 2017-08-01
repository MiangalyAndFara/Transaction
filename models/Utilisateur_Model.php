<?php

/*
 * dev 112
 */

class Utilisateur_Model extends My_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library("Utilisateur");
    }

    function authentification($user) {
        $tuser = new Utilisateur();
        $params = array(
            "identifiant" => $user->getIdentifiant(),
            "motdepasse" => $user->getPasse()
        );
        $result = $this->read(TAB_USER, '', $params);
        if (!empty($result)) {
            foreach ($result as $us){
                $tuser->setIdUser($us->IDUSER);
                $tuser->setIdentifiant($us->IDENTIFIANT);
                $tuser->setPasse($us->MOTDEPASSE);
                $tuser->setStatut($us->STATUT);
            }
            return $tuser;
        } else {
            return FALSE;
        }
    }

    function createUser($user) {
        if (!empty($user)) {
            $toInsert = array(
                "identifiant" => $user->getIdentifiant(),
                "motdepasse" => $user->getPasse(),
                "statut" => $user->getStatut()
            );
            return $this->create(TAB_USER, $toInsert, TRUE);
        } else {
            throw new Exception(Errors_AllFiledRequired);
        }
    }

    function getUtilisateur($id) {
        $condition = array();
        if ($id > 0) {
            $condition = array('IDUSER' => $id);
        }
        $rset[0] = $this->read(TAB_USER, '', $condition);
        $user = new Utilisateur();
        if (isset($rset[0]) && !empty($rset[0])) {
            foreach ($rset[0] as $lce) {
                $user->setIdUser($lce->IDUSER);
                $user->setIdentifiant($lce->IDENTIFIANT);
                $user->setStatut($lce->STATUT);
            }
        }
        return $user;
    }

    function modifUtilisateur($user) {
        $condition = array('IDUSER' => $user->getIdUser());
        $object = array(
            'IDENTIFIANT' => $user->getIdentifiant(),
            'MOTDEPASSE' => $user->getPasse(),
            'STATUT' => $user->getStatut()
        );
        return $this->update(TAB_USER, $object, $condition);
    }

    function supUtilisateur($id) {
        $condition = array('IDUSER' => $id);
        $object = array(
            'STATUT' => NON_EMP
        );
        return $this->update(TAB_USER, $object, $condition);
    }

}
