<?php

/*
 * dev 113 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Projet_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Projet_Model');
        $this->load->model('Client_Model');
        $this->load->model('Workflow_Model');
        $this->load->library('Projet');
        $this->load->library('Client');
        $this->load->library('Workflow');
        $this->load->model('Account_Model');
    }

    public function index() {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant !='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
            $data['liste_projets'] = $this->Projet_Model->getAll();
            $data['contents'] = 'content/projets/projets';
            $data['titre'] = 'Projets';
            $this->load->view('templates/template', $data);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function create() {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $data['liste_clients'] = $this->Client_Model->getAll();
        $data['contents'] = 'content/projets/nouveau';
        $data['titre'] = "Nouveau projet";
        $this->load->view('templates/template', $data);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function save() {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $posts = $this->input->post();

        try {
            $projet = new Projet();
            $projet->setIdProjet($posts['id']);
            $projet->setNom($posts['nom']);
            $projet->setCout($posts['cout']);
            $projet->setDateDebut($posts['dateDebut']);
            $projet->setDateButoir($posts['dateButoir']);

            $clients = array();
            foreach ($posts['clients'] as $cl) {
                $temp = new Client();
                $temp->setIdClient($cl);
                $clients[] = $temp;
            }
            $projet->setClients($clients);

            $id = $this->Projet_Model->save($projet);
            if ($id != false) {
                $rep = array('success' => true, 'id' => $id);
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
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function liste($id = '') {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
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
    public function save_modif() {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $posts = $this->input->post();

        try {
            $projet = new Projet();
            $projet->setNom($posts['nom']);
            $projet->setCout($posts['cout']);
            $projet->setDateDebut($posts['dateDebut']);
            $projet->setDateButoir($posts['dateButoir']);

            $id = $this->Projet_Model->modif($projet);
            if ($id != false) {
                $rep = array('success' => true, 'id' => $id);
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
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function edit($id = '') {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $data['contents'] = 'content/projets/edit';
        $data['projet'] = $this->Projet_Model->getById($id);
        $data['titre'] = "Edition projet";
        $this->load->view('templates/template', $data);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function statistiques() {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $data['contents'] = 'content/statistiques/stat_projets';
        $data['liste_projets'] = $this->Projet_Model->getAll();
        $data['titre'] = "Statistique projets";
        $this->load->view('templates/template', $data);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function view($id = '') {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $data['contents'] = 'content/projets/fiche';
        $data['projet'] = $this->Projet_Model->getById($id);
        $data['clients'] = $data['projet']->getClients();
        $data['titre'] = $data['projet']->getNom();
        $data['workflows'] = $data['projet']->getWorkflows();
        $data['pourcentage'] = $this->Projet_Model->getPourcentage($data['workflows']);
        $this->load->view('templates/template', $data);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function add_workflow() {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $posts = $this->input->post();
        try {
            $wf = new Workflow();
            $projet = new Projet();
            $projet->setIdProjet($posts['id']);
            $wf->setProjet($projet);
            $wf->setSujet($posts['sujet']);
            $wf->setDescription($posts['description']);
            $wf->setPourcentage(0);
            $wf->setStatut(EN_COURS);

            $id = $this->Workflow_Model->save($wf);
            if ($id != false) {
                $rep = array('success' => true, 'id' => $id);
                $this->update_pourc($projet->getIdProjet());
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
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function delete_workflow($id = '', $idProjet = '') {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $this->Workflow_Model->del($id);
        $this->update_pourc($idProjet);
        redirect('Projet_Controller/edit/' . $idProjet);
        }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

    public function update_pourc($idProjet) {
        $statutP = $this->Projet_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if($identifiant!='' && (in_array($statut,$statutP[CADRE]) || $statut == COMMERCIALE)){
        $projet = $this->Projet_Model->getById($idProjet);
        $workflows = $projet->getWorkflows();
        $nb = count($workflows);
        $pourc = 100 / $nb;
        //update de tous les pourcentages
        for ($i = 0; $i < count($workflows); $i++) {
            $workflow = $workflows[$i];
            $workflow->setPourcentage($pourc);
            $workflow->setProjet($projet);
            $this->Workflow_Model->modif($workflow);
        }
         }
        else{
            redirect('Utilisateur_Controller/');
        }
    }

}
