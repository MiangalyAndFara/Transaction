<?php
/*
 * dev 113 
 */
?>
<div>
    <h1>Liste prospects</h1>
    <?php
    if (isset($liste_prospects) && !empty($liste_prospects)) {
        ?>
        <table border="1">
            <thead>
            <th>Nom</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Action</th>
            </thead>
            <?php
            foreach ($liste_prospects as $prospect) {
                ?>
                <tr>
                    <td><?php echo $prospect->getNom(); ?></td>
                    <td><?php echo $prospect->getContact()->getTelephone(); ?></td>
                    <td><?php echo $prospect->getContact()->getEmail(); ?></td>
                    <td><a href="<?php echo site_url() . '/Prospect_Controller/view/' . $prospect->getIdClient(); ?>">Voir</a> / <a href="<?php echo site_url() . '/Prospect_Controller/edit/' . $prospect->getIdClient(); ?>">Modifier</a> / <a href="javascript:suppr(<?php echo $prospect->getIdClient(); ?>)">Supprimer</a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <br>
        <a href="<?php echo site_url('Prospect_Controller/exportXls'); ?>"> 
            <button> Exporter en fichier excel </button>   
        </a>
        <?php
    } else {
        echo 'Aucun prospect dans votre base de donnees' . '<br>';
    }
    ?>
    <a href="<?php echo site_url('Prospect_Controller/create'); ?>"> 
        <button> Ajouter </button>   
    </a>

</div>
<script>
    function suppr(id) {
        var r = confirm("Voulez-vous vraiment supprimer ?");
        if (r == true) {
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url() . '/Prospect_Controller/delete/'; ?>',
                dataType: 'json',
                data: {id: id},
                success: function (data)
                {
                    if (data.success) {
                        var url = '<?php echo site_url() . "/Prospect_Controller"; ?>';
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