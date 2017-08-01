<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='utf-8'>
        <title><?php echo $titre ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.timepicker.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.ui.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    </head>
    <body>

        <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.min.js'); ?> "></script>
       <?php
            if($this->session->userdata('identifiant') != ''){
                echo $this->session->userdata('identifiant');?>
                  <a href="<?php echo site_url('Utilisateur_Controller/logout');?>"> 
                                <button> Logout </button>   
                </a> 
        <?php } ?>
