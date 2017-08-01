<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Conge_Model");
        $this->load->model("Account_Model");
        $this->load->model("Projet_Model");
        $this->load->library("Employe");
    }

    public function index($id = '') {
        $statutP = $this->Account_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant !='' && in_array($statut,$statutP[CADRE])){
        $data['accountPaye'] = $this->Account_Model->getAccountProjet($id);
        $data['Taccount'] = $this->Account_Model->getAllPayement($id);
        $data['contents'] = 'content/account/liste_account';
        $data['titre'] = 'Liste des payements';
        $this->load->view('templates/template', $data);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }
    
    public function addPaye($id = '') {
        $statutP = $this->Account_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && in_array($statut,$statutP[CADRE])){
        
        $data['projet'] = $id;
        $data['contents'] = 'content/account/addPaye';
        $data['titre'] = 'Payement';
        $this->load->view('templates/template', $data);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function paiement() {
        $statutP = $this->Account_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant != '' && in_array($statut,$statutP[CADRE])){
        $posts = $this->input->post();
        if (!empty($posts)) {
            $projet = $this->Projet_Model->getById($posts['idprojet']);
            try {
                $account = new Account();
                $account->setProjet($projet);
                $account->setDatePaye($posts['datePaye']);
                $account->setMontantPaye($posts['montantPaye']);
                $rep = $this->Account_Model->enregistrerAccount($account);
                if ($rep == true) {
                    $rep = array('success' => true);
                    echo json_encode($rep);
                } else {
                    $rep = array('success' => false, 'error' => "Erreur dans l'insertion dans la base");
                    echo json_encode($rep);
                }
            } catch (Exception $e) {
                $rep = array('success' => false, 'error' => $e->getMessage());
                echo json_encode($rep);
            }
        }
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

}
