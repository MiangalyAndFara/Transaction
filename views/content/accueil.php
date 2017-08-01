<?php
/*
 * dev 113
 */
?>
<?php $statut = $this->session->userdata('statut');
if(in_array($statut,$statuts[COMMERCIAL]) || in_array($statut, $statuts[CADRE])){
?>
<a href="<?php echo site_url('Prospect_Controller');?>"> 
    <button> Prospects </button>   
</a>
<br>
<a href="<?php echo site_url('Projet_Controller');  ?>"> 
    <button> Projets </button>   
</a>
<br>
<?php }
if(in_array($statut, $statuts[CADRE])){ ?>
<a href="<?php echo site_url('Projet_Controller/statistiques'); ?>"> 
    <button> Statistiques </button>   
</a>
<br>
<a href="<?php echo site_url('Conge_Controller'); ?>"> 
    <button> Conges </button>   
</a><br>
<?php } 
if(!in_array($statut,$statuts[CLIENT])){?>
<a href="<?php echo site_url('Conge_Controller/demande'); ?>"> 
    <button> Demande conge </button>   
</a><br>
<?php }
if(in_array($statut,$statuts[CADRE]) || $statut == ASSISTANT_DE_DIRECTION){?>
<a href="<?php echo site_url('Employe_Controller') ?>"> 
    <button> Employes </button>   
</a><br>
<a href="<?php echo site_url('Employe_Controller/enregistrerEmp'); ?>"> 
    <button> Nouvel Emp </button>   
</a><br>
<?php } ?>
