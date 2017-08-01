<?php

/*
 * dev 112
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Employe_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Employe_Model");
        $this->load->model("Utilisateur_Model");
        $this->load->library("Employe");
        $this->load->library("Utilisateur");
    }

    public function index() {
        $statutP = $this->Employe_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == ASSISTANT_DE_DIRECTION)) {
            $data['tetats'] = $this->Employe_Model->getListStatut();
            $data['employes'] = $this->Employe_Model->listEmploye('');
            $data['contents'] = 'content/employe/listEmp';
            $data['titre'] = 'Liste des employes';
            $this->load->view('templates/template', $data);
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function enregistrerEmp() {
        $statutP = $this->Employe_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == ASSISTANT_DE_DIRECTION)) {
            $data['etats'] = $this->Employe_Model->getValeurStatut();
            $data['tetats'] = $this->Employe_Model->getListStatut();
            $data['contents'] = 'content/employe/nouvelEmp';
            $data['titre'] = 'Enregistrer nouvel employe';
            $this->load->view('templates/template', $data);
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function modifierEmp($idemp = '') {
        $statutP = $this->Employe_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == ASSISTANT_DE_DIRECTION)) {
            $condition = array(TAB_EMP . ".IDEMP" => $idemp);
            $data['etats'] = $this->Employe_Model->getValeurStatut();
            $data['tetats'] = $this->Employe_Model->getListStatut();
            $data['employes'] = $this->Employe_Model->listEmploye($condition);
            $data['contents'] = 'content/employe/modifEmp';
            $data['titre'] = 'Modifier Emp';
            $this->load->view('templates/template', $data);
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function remove($idemp = '') {
        $statutP = $this->Employe_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == ASSISTANT_DE_DIRECTION)) {
            $rep = $this->Employe_Model->supEmploye($idemp);
            if ($rep) {
                $data['tetats'] = $this->Employe_Model->getListStatut();
                $data['employes'] = $this->Employe_Model->listEmploye('');
                $data['contents'] = 'content/employe/listEmp';
                $data['titre'] = 'Liste des employes';
                $this->load->view('templates/template', $data);
            }
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function profil($idemp = '') {
        $statutP = $this->Employe_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == ASSISTANT_DE_DIRECTION)) {
            $condition = array(TAB_EMP . ".IDEMP" => $idemp);
            $data['tetats'] = $this->Employe_Model->getListStatut();
            $data['employes'] = $this->Employe_Model->listEmploye($condition);
            $data['contents'] = 'content/employe/profilEmp';
            $data['titre'] = 'Profil Employe';
            $this->load->view('templates/template', $data);
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function save() {
        $statutP = $this->Employe_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == ASSISTANT_DE_DIRECTION)) {
            $posts = $this->input->post();
            $emp = new Employe();
            $user = new Utilisateur();
            if ($posts['passe'] == $posts['conf_passe']) {
                try {
                    //ajout identification et mot de passe
                    $user->setIdentifiantPost($posts['pseudo']);
                    $user->setPassePost($posts['passe']);
                    $user->setStatut($posts['statut']);
                    //ajout info employe
                    $emp->setNom($posts['nom']);
                    $emp->setPrenom($posts['prenom']);
                    $emp->setSexe($posts['sexe']);
                    $emp->setNaissance($posts['naissance']);
                    $emp->setAdresse($posts['adresse']);
                    $emp->setDateEntree($posts['dateEntree']);
                    $emp->setCinPost($posts['cin']);
                    $emp->setTelephone($posts['telephone']);
                    $emp->setEmail($posts['email']);
                    $emp->setSkype($posts['skype']);
                    $emp->setEtat(IS_EMP);
                    $id = $this->Utilisateur_Model->createUser($user);
                    if ($id != false) {
                        $user->setIdUser($id);
                        $emp->setUser($user);
                        $idemp = $this->Employe_Model->saveEmploye($emp);
                        if ($idemp != false) {
                            $result = array(
                                "success" => true
                            );
                            echo json_encode($result);
                        }
                    }
                } catch (Exception $ex) {
                    $result = array(
                        "success" => false,
                        "error" => $ex->getMessage()
                    );
                    echo json_encode($result);
                }
            } else {
                $result = array(
                    "success" => false,
                    "error" => "Mot de passe different"
                );
                echo json_encode($result);
            }
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function edit() {
        $statutP = $this->Employe_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == ASSISTANT_DE_DIRECTION)) {
            $posts = $this->input->post();
            $emp = new Employe();
            $user = new Utilisateur();
            if ($posts['passe'] == $posts['conf_passe']) {
                try {
                    //ajout identification et mot de passe
                    $user->setIdUser($posts['iduser']);
                    $user->setIdentifiant($posts['pseudo']);
                    $user->setPassePost($posts['passe']);
                    $user->setStatut($posts['statut']);
                    //ajout info employe
                    $emp->setIdEmp($posts['idemp']);
                    $emp->setNom($posts['nom']);
                    $emp->setPrenom($posts['prenom']);
                    $emp->setSexe($posts['sexe']);
                    $emp->setNaissance($posts['naissance']);
                    $emp->setAdresse($posts['adresse']);
                    $emp->setDateEntree($posts['dateEntree']);
                    $emp->setCin($posts['cin']);
                    $emp->setTelephone($posts['telephone']);
                    $emp->setEmail($posts['email']);
                    $emp->setSkype($posts['skype']);
                    $emp->setEtat(IS_EMP);
                    $emp->setUser($user);
                    $id = $this->Employe_Model->modifEmploye($emp);
                    if ($id != false) {
                        $result = array(
                            "success" => true
                        );
                        echo json_encode($result);
                    }
                } catch (Exception $ex) {
                    $result = array(
                        "success" => false,
                        "error" => $ex->getMessage()
                    );
                    echo json_encode($result);
                }
            } else {
                $result = array(
                    "success" => false,
                    "error" => "Mot de passe different"
                );
                echo json_encode($result);
            }
        } else {
            redirect('Utilisateur_Controller/');
        }
    }
} 
