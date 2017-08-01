<?php
/*
 * dev 112
 */
?>
<h3> Liste account: </h3>
<a href="<?php echo site_url() . '/Acc_Controller/'; ?>"> 
    <button> Retour </button>   
</a>
<br/>
<br/>
<span id="error"></span>
<?php $projet = new Projet();
$projet = $Taccount[0]->getProjet();
?>
<input id="idprojet" type="hidden" value="<?php echo $projet->getIdProjet(); ?>"/>
<label>Nom : <?php echo $projet->getNom(); ?></label>
<br>
<label>Proprietaire(s) : </label><?php foreach ($projet->getClients() as $cli) { ?>
    <p><?php echo $cli->getNom(); ?></p><br>
<?php } ?>
<br>
<label>Montant du projet : <?php echo $projet->getCout(); ?></label>
<br>
<label>Reste a paye : <?php echo $accountPaye->getRestePaye(); ?></label>
<br>
<br>
<table border="1" >

    <thead>
    <th>Date de paiement</th>
    <th>Montant paye</th>
</thead>
<tbody>    
    <?php
    foreach ($Taccount as $acc) {
        ?>
        <tr>
            <td><?php echo $acc->getDatePaye(); ?></td>
            <td><?php echo $acc->getMontantPaye(); ?></td>

            <?php }
        ?> 
    </tr>
</tbody>
</table>
<?php if ($accountPaye->getRestePaye() != 0) {
    ?>

    <a href="<?php echo site_url() . '/Account_Controller/addPaye/' . $projet->getIdProjet(); ?>"> 
        <button> Ajout paye </button>   
    </a></td>
<?php } else { ?>
    <td><label>Projet paye</label>
    <?php } ?>