<?php
/*
 * dev 112
 */
?>

<h3>Profil Utilisateur : </h3>
<a href="<?php echo site_url('Employe_Controller'); ?>"> 
    <button> Retour </button>   
</a>
<?php
foreach ($employes as $emp) {
    $genre = array('M' => 'Homme', 'F' => 'Femme');
    ?>

    <table>
        <tr>
            <td><label>Nom : </label></td>
            <td><label><?php echo $emp->getNom(); ?></label></td>
        </tr>
        <tr>
            <td><label>Prénoms : </label></td>
            <td><label><?php echo $emp->getPrenom(); ?></label></td>
        </tr>
        <tr>
            <td><label>Date de naissance : </label></td>
            <td><label><?php echo $emp->getNaissance() . " (" . $emp->getAge() . ' ans)'; ?></label></td>
        </tr>
        <tr>
            <td><label>Genre : </label></td>
            <td><label><?php echo $genre[$emp->getSexe()]; ?></label></td>
        </tr>
        <tr>
            <td><label>Adresse : </label></td>
            <td><label><?php echo $emp->getAdresse(); ?></label></td>
        </tr>
        <tr>
            <td><label>Date Entrée : </label></td>
            <td><label><?php echo $emp->getDateEntree(); ?></label></td>
        </tr>
        <tr>
            <td><label>CIN : </label></td>
            <td><label><?php echo $emp->getCin(); ?></label></td>
        </tr>
        <tr>
            <td><label>Téléphone : </label></td>
            <td><label><?php echo $emp->getTelephone(); ?></label></td>
        </tr>

        <tr>
            <td><label>Email : </label></td>
            <td><label><?php echo $emp->getEmail(); ?></label></td>
        </tr>
        <tr>
            <td><label>Skype : </label></td>
            <td><label><?php echo $emp->getSkype(); ?></label></td>
        </tr>
        <tr>
            <td><label>Statut : </label></td>
            <td><label><?php echo $tetats[$emp->getUser()->getStatut()]; ?></label></td>
        </tr>
        <tr>
            <td><label>Identifiant : </label></td>
            <td><label><?php echo $emp->getUser()->getIdentifiant(); ?></label></td>
        </tr>
    </table>

<?php } ?>



