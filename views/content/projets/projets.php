<?php
/*
 * dev 113 
 */
?>
<div>
    <h1>Liste projets</h1>
    <?php
    if (isset($liste_projets) && !empty($liste_projets)) {
        ?>
        <table border="1">
            <thead>
            <th>Nom du projet</th>
            <th>Date de debut</th>
            <th>Date de fin</th>
            <th>Ach&egrave;vement</th>
            <th>Actions</th>
            </thead>
            <?php
            foreach ($liste_projets as $projet) {
                ?>
                <tr>
                    <td><?php echo $projet->getNom(); ?></td>
                    <td><?php echo $projet->getDateDebut(); ?></td>
                    <td><?php echo $projet->getDateButoir(); ?></td>
                    <td><?php echo $this->Projet_Model->getPourcentage($projet->getWorkflows()); ?>%</td>
                    <td><a href="<?php echo site_url() . '/Projet_Controller/view/' . $projet->getIdProjet(); ?>">Voir</a> / <a href="<?php echo site_url() . '/Projet_Controller/edit/' . $projet->getIdProjet(); ?>">Modifier</a> / <a href="javascript:suppr(<?php echo $projet->getIdProjet() ?>)">Supprimer</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    } else {
        echo 'Aucun projet dans votre base de donnees';
    }
    ?>
    <a href="<?php echo site_url() . '/Projet_Controller/create' ?>"> 
        <button> Ajouter </button>   
    </a>
</div>
<script>
    function suppr(id) {
        var r = confirm("Voulez-vous vraiment supprimer ?");
        if (r == true) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url() . '/Projet_Controller/delete/'; ?>',
                dataType: 'json',
                data: {id: id},
                success: function (data)
                {
                    if (data.success) {
                        var url = '<?php echo site_url() . "/Projet_Controller"; ?>';
                                location.replace(url);
                    } else {
                        alert(data.error);
                    }
                }
            });
        } else {
            txt = "You pressed Cancel!";
        }
    }
</script>