<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Conge_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Conge_Model");
        $this->load->library("Employe");
        $this->load->library("Conge");
    }

    public function index() {
        $statutP = $this->Conge_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && in_array($statut, $statutP[CADRE])) {
            $condition = array(
                "STATUT" => EN_ATTENTE
            );
            $data['dmd_conge'] = $this->Conge_Model->getAllDemandeConge($condition);
            $data['contents'] = 'content/conge/Validation';
            $data['titre'] = 'Demande conge';
            $this->load->view('templates/template', $data);
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function demande() {
        $statutP = $this->Conge_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && !in_array($statut, $statutP[CLIENT])) {
            $data['contents'] = 'content/conge/demandeConge';
            $data['titre'] = 'Demande conge';
            $this->load->view('templates/template', $data);
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function validation() {
        $statutP = $this->Conge_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && in_array($statut, $statutP[CADRE])) {
            $posts = $this->input->post();
            try {
                $conge = new Conge();
                $conge->setIdConge($posts['idconge']);
                $idemp = $posts['idemp'];
                $reponse = $posts['reponse'];
                $condition = $posts['motif'];
                $dureeConge = $posts['dureeConge'];
                $dateDebutConge = $posts['dateDebutConge'];
                $heureDebutConge = $posts['heureDebutConge'];
                $dateDebutConge = new DateTime($dateDebutConge . ' ' . $heureDebutConge, new DateTimeZone('UTC'));
                $result_validation = $this->Conge_Model->validerConge($conge, $reponse, $condition, $dureeConge, $dateDebutConge, $idemp);
                if ($result_validation != '') {
                    $result = array(
                        "success" => true,
                        "statut" => $result_validation
                    );
                    echo json_encode($result);
                } else {
                    $result = array(
                        "success" => false,
                        "error" => "Erreur au niveau de la base de donnée"
                    );
                    echo json_encode($result);
                }
            } catch (Exception $e) {
                $result = array(
                    "success" => false,
                    "error" => $e->getMessage()
                );
                echo json_encode($result);
            }
        }
    }

    public function save() {
        $post = $this->input->post();
        try {
            $emp = $this->Employe_Model->getById(1); // a changer session
            // check si employe + 1 an //
            $now = date('y-m-d');
            $now = new DateTime($now, new DateTimeZone('UTC'));

            $dateEmp = $emp->getDateEntree();
            $dateEmp = new DateTime($dateEmp, new DateTimeZone('UTC'));

            $dureeEmp = $dateEmp->diff($now);

            if ($dureeEmp->y < 1) {
                throw new Exception("Employe ne datant pas encore plus d'un an");
            }

            // calcul duree conge //
            $dateDebut = new DateTime($post['dateDebut'], new DateTimeZone('UTC'));
            $dateFin = new DateTime($post['dateFin'], new DateTimeZone('UTC'));
            $heureDebut = new DateTime($post['heureDebut'], new DateTimeZone('UTC'));
            $heureFin = new DateTime($post['heureFin'], new DateTimeZone('UTC'));
            $diffDate = $dateDebut->diff($dateFin);
            $dureeConge = $diffDate->d;

            $dureeConge++; // compter le premier jour 

            if ($heureDebut->format('G') > 12) { // debut conge apres midi : compter 1/2 jour le 1er jour de conge
                $dureeConge-=0.5;
            }
            if ($heureFin->format('G') <= 12) { // fin conge avant midi : compter 1/2 jour le dernier jour de conge
                $dureeConge-=0.5;
            }

            // check nb conge restant //
            $nbRestant = $this->Conge_Model->getNbCongeRestant($emp, $now->format('Y-m-d'));

            if ($nbRestant < $dureeConge) {
                throw new Exception("Il ne vous reste que " . $nbRestant . " jours de conge.");
            }

            // si tout est ok 
            $heureDebut->setDate($dateDebut->format('Y'), $dateDebut->format('m'), $dateDebut->format('d'));
            $conge = new Conge();
            $conge->setDateConge($now->format('Y-m-d H:i:s'));
            $conge->setDateDebut($heureDebut);
            $conge->setDuree($dureeConge);
            $conge->setEmploye($emp);
            $conge->setStatut(EN_ATTENTE);
            if ($this->Conge_Model->save($conge)) {
                $result = array(
                    "success" => true
                );
                echo json_encode($result);
            } else {
                redirect('Utilisateur_Controller/');
            }
        } catch (Exception $e) {
            $result = array(
                "success" => false,
                "error" => $e->getMessage()
            );
            echo json_encode($result);
        }
    }

}
