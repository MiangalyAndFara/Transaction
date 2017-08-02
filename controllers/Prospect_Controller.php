<?php

/*
 * dev 113 
 */
defined('BASEPATH') OR exit('No direct script access allowed');
include APPPATH . 'third_party/PHPExcel/IOFactory.php';

class Prospect_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Prospect_Model');
        $this->load->library('Client');
        $this->load->library('Contact');
    }

    public function index() {
        $statutP = $this->Prospect_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == COMMERCIALE)) {
            $data['liste_prospects'] = $this->Prospect_Model->getAll();
            $data['contents'] = 'content/prospects/prospects';
            $data['titre'] = 'Prospects';
            $this->load->view('templates/template', $data);
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function view($id = '') {
        $statutP = $this->Prospect_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == COMMERCIALE)) {
            if ($id != '') {
                $data['prospect'] = $this->Prospect_Model->getById($id);
                $data['contents'] = 'content/prospects/fiche';
                $data['titre'] = $data['prospect']->getNom();
                $this->load->view('templates/template', $data);
            }
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function edit($id = '') {
        $statutP = $this->Prospect_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == COMMERCIALE)) {
            if ($id != '') {
                $data['prospect'] = $this->Prospect_Model->getById($id);
                $data['contents'] = 'content/prospects/edit';
                $data['titre'] = $data['prospect']->getNom();
                $this->load->view('templates/template', $data);
            }
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function delete() {
        $statutP = $this->Prospect_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == COMMERCIALE)) {
            try {
                $prospect = new Client();
                $prospect->setIdClient($this->input->post('id'));
                if ($this->Prospect_Model->supprimer($prospect)) {
                    $rep = array('success' => true);
                    echo json_encode($rep);
                }
            } catch (Exception $e) {
                $rep = array('success' => false, 'error' => $e->getMessage());
                echo json_encode($rep);
            }
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function create() {
        $statutP = $this->Prospect_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == COMMERCIALE)) {
            $data['contents'] = 'content/prospects/nouveau';
            $data['titre'] = "Nouveau prospect";
            $this->load->view('templates/template', $data);
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function save() {
        $statutP = $this->Prospect_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == COMMERCIALE)) {
            $posts = $this->input->post();
            if ($posts['email'] == '' && $posts['skype'] == '' && $posts['telephone'] == '') {
                $rep = array('success' => false, 'error' => 'Entrez au moins un contact');
                echo json_encode($rep);
            } else {
                try {
                    $prospect = new Client();
                    $prospect->setNif($posts['nif']);
                    $prospect->setStat($posts['stat']);
                    $prospect->setNom($posts['nom']);
                    $contact = new Contact();
                    $contact->setEmail($posts['email']);
                    $contact->setTelephone($posts['telephone']);
                    $contact->setSkype($posts['skype']);
                    $prospect->setContact($contact);
                    if ($this->Prospect_Model->save($prospect)) {
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
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    public function save_modif() {
        $statutP = $this->Prospect_Model->getStatutByPost();
        $statut = $this->session->userdata('statut');
        $identifiant = $this->session->userdata('identifiant');
        if ($identifiant != '' && (in_array($statut, $statutP[CADRE]) || $statut == COMMERCIALE)) {
            $posts = $this->input->post();
            if ($posts['email'] == '' && $posts['skype'] == '' && $posts['telephone'] == '') {
                $rep = array('success' => false, 'error' => 'Entrez au moins un contact');
                echo json_encode($rep);
            } else {
                try {
                    $prospect = new Client();
                    $prospect->setIdClient($posts['idClient']);
                    $prospect->setNif($posts['nif']);
                    $prospect->setStat($posts['stat']);
                    $prospect->setNom($posts['nom']);
                    $contact = new Contact();
                    $contact->setEmail($posts['email']);
                    $contact->setTelephone($posts['telephone']);
                    $contact->setSkype($posts['skype']);
                    $prospect->setContact($contact);

                    if ($this->Prospect_Model->modif($prospect)) {
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
        } else {
            redirect('Utilisateur_Controller/');
        }
    }

    function exportXls() {
        $data = $this->Prospect_Model->getAll();

        $sep = ';';
        $fp = fopen(APPPATH . "views/documents/prospects.csv", "w+");
        $fin = 'NOM' . $sep . 'NIF' . $sep . 'STAT' . $sep . 'EMAIL' . $sep . 'TELEPHONE' . $sep . 'SKYPE';
        fputs($fp, $fin);
        fputs($fp, "\r\n");
        foreach ($data as $row) {

            $fin = $row->getNom() . $sep . $row->getNif() . $sep . $row->getStat() . $sep . $row->getContact()->getEmail() . $sep . $row->getContact()->getTelephone() . $sep . $row->getContact()->getSkype();
            fputs($fp, $fin);
            fputs($fp, "\r\n");
        }
        fclose($fp);

        $objReader = PHPExcel_IOFactory::createReader('CSV');
        $objReader->setDelimiter(";");
        $objPHPExcel = $objReader->load(APPPATH . "views/documents/prospects.csv");
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save(APPPATH . 'views/documents/prospects.xls');

        $file = APPPATH . 'views/documents/prospects.xls';
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
    }

}
