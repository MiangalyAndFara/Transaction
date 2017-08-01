<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration_Controller extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model("Conge_Model");
        $this->load->model("Account_Model");
		$this->load->library("Employe");
    }
	
	public function index()
	{
            $result = $this->Account_Model->getAccountProjet(1);
            echo $result->getMontantPaye();
            echo "<br>";
            echo $result->getRestePaye();
	}
        
}
