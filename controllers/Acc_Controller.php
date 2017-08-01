<?php

/*
 * dev 113 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Acc_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("Employe_Model");
    }

    public function index() {
        $statutP = $this->Employe_Model->getStatutByPost();
        $statut = $this->session->userdata('identifiant');
        if($statut != ''){
            $data['statuts'] = $this->Employe_Model->getStatutByPost();
            $data['contents'] = 'content/accueil';
            $data['titre'] = 'Accueil';
            $this->load->view('templates/template', $data);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }
}
