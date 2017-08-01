<?php
/*
 * dev 113
 */
?>
<h1><?php echo $projet->getNom(); ?></h1>
<label>Pourcentage effectu&eacute; : <?php echo $pourcentage.'%'; ?></label>
<br>
<label>Date de debut : <?php echo $projet->getDateDebut(); ?></label>
<br>
<label>Date butoir : <?php echo $projet->getDateButoir(); ?></label>
<br>
<label>Cout : <?php echo $projet->getCout(); ?></label>
<br>
<h3> Les clients propri&eacute;taires : </h3>
<?php
foreach ($clients as $cl) {
    ?>
    <label><?php echo $cl->getNom(); ?></label>
    <?php
}
?>
<h3> Les etapes du projet : </h3>
<table border="1" id="workflow">
    <thead>
    <th>Sujet</th>
    <th>Description</th>
    <th>Etat</th>
</thead>
<tbody>
    <?php
    $etats = array(FAIT => 'Fait', EN_COURS => 'En cours');

    foreach ($workflows as $wf) {
        ?>
        <tr>
            <td><?php echo $wf->getSujet(); ?></td>
            <td><?php echo $wf->getDescription(); ?></td>
            <td><?php echo $etats[$wf->getStatut()]; ?></td>
        </tr>
        <?php
    }
    ?>
</tbody>
</table>