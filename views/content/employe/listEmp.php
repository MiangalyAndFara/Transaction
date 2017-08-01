<?php
/*
 * dev 112
 */
?>
<link href="<?php echo base_url() ?>assets/css/style_validation.css" rel="stylesheet">
<h3> Liste des Employés : </h3>
<span id="error"></span>
<table border="1" id="workflow">
    <thead>
    <th>Num Emp</th>
    <th>Nom</th>
    <th>Age</th>
    <th>Genre</th>
    <th>Date Entree</th>
    <th>Statut</th>
    <th>Modification</th>
</thead>
<tbody>    
    <?php
    $genre = array('M' => 'Homme', 'F' => 'Femme');
    foreach ($employes as $emp) {
        ?>
        <tr>
            <td><?php echo 'EMP_' . $emp->getIdEmp(); ?></td>
            <td><?php echo $emp->getPrenom() . ' ' . $emp->getNom(); ?></td>
            <td><?php echo $emp->getAge() . ' ans'; ?></td>
            <td><?php echo $genre[$emp->getSexe()]; ?></td>
            <td><?php echo $emp->getDateEntree(); ?></td>
            <td><?php echo $tetats[$emp->getUser()->getStatut()]; ?></td>
            <td>
                <a href="<?php echo site_url() . '/Employe_Controller/profil/' . $emp->getIdEmp(); ?>"> 
                    <button> Profil </button>   
                </a>
                <a href="<?php echo site_url() . '/Employe_Controller/modifierEmp/' . $emp->getIdEmp(); ?>"> 
                    <button> Modifier </button>   
                </a>
                <a href="<?php echo site_url() . '/Employe_Controller/remove/' . $emp->getIdEmp(); ?>"> 
                    <button> Supprimer </button>   
                </a>
            </td>


        </tr>
        <?php
    }
    ?>
</tbody>
</table>
