<?php

/*
 * dev 112
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Employe_Model");
        $this->load->model("Utilisateur_Model");
        $this->load->library("Employe");
        $this->load->library("Utilisateur");
    }

    public function index() {
        $data['contents'] = 'content/administration/login';
        $data['titre'] = 'Authentification';
        $this->load->view('templates/template', $data);
    }

    public function authentification() {
        $posts = $this->input->post();
        $emp = new Employe();
        $user = new Utilisateur();
        try {
            //ajout identification et mot de passe
            $user->setIdentifiant($posts['pseudo']);
            $user->setPassePost($posts['passe']);
            $values = $this->Utilisateur_Model->authentification($user);
            if ($values != false) {
                
                $auth = array(
                   'identifiant'  => $values->getIdentifiant(),
                   'statut'     => $values->getStatut()
                );
                $this->session->set_userdata($auth);
                $result = array(
                    "success" => true
                );
                echo json_encode($result);
            }
            else{
                $result = array(
                "success" => false,
                "error" => "Mot de passe ou identifiant incorrect"
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
    }
    public function logout(){
        $this->Utilisateur_Model->logout();
        $this->load->view('content/administration/login');
    }

}
