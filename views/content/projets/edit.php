<?php
/*
 * dev 113
 */
?>
<input type="hidden" id="id" value="<?php echo $projet->getIdProjet(); ?>" />
<label>Nom</label>
<input type="text" id="nom" value="<?php echo $projet->getNom(); ?>" />
<br>
<label>Date de debut</label>
<input type="text" id="dateDebut" value="<?php echo $projet->getDateDebut(); ?>" />
<br>
<label>Date butoir</label>
<input type="text" id="dateButoir" value="<?php echo $projet->getDateButoir(); ?>" />
<br>
<label>Cout</label>
<input type="number" id="cout" value="<?php echo $projet->getCout(); ?>" />
<br>

<br>
<label> Les etapes du projet : </label>
<br>
<input type="text" id="sujet" placeholder="Sujet" />
<input type="text" id="description" placeholder="Description" />
<button onclick="ajouter()"> Ajouter </button>
<br>

<table border="1" id="workflow">
    <thead>
    <th>Sujet</th>
    <th>Description</th>
    <th>Action</th>
</thead>
<tbody>
    <?php
    $workflows = $projet->getWorkflows();
    foreach ($workflows as $wf) {
        ?>
        <tr>
            <td><?php echo $wf->getSujet(); ?></td>
            <td><?php echo $wf->getDescription(); ?></td>
            <td><a href="<?php echo site_url() . "/Projet_Controller/delete_workflow/" . $wf->getIdWf() . "/" . $projet->getIdProjet() ?>">Supprimer</a></td>
        </tr>
        <?php
    }
    ?>
</tbody>
</table>
<br>
<button onclick="save()"> Ok </button>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.js'); ?>"></script>
<script>
    $(function () {
        $('#dateDebut').datepicker({dateFormat: 'yy-mm-dd'});
        $('#dateButoir').datepicker({dateFormat: 'yy-mm-dd'});
    });
    function ajouter() {
        var sujet = $('#sujet').val();
        var description = $('#description').val();
        var id = $('#id').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() . "/Projet_Controller/add_workflow" ?>',
            dataType: 'json',
            data: {sujet: sujet, description: description, id: id},
            success: function (data)
            {
                if (data.success) {
                    $('#sujet').val('');
                    $('#description').val('');
                    $('#workflow').append('<tr><td>' + sujet + '</td><td>' + description + '</td><td><a href="<?php echo site_url() . "/Projet_Controller/delete_workflow/" ?>' + data.id + '/' + id + '">Supprimer</td>');
                } else {
                    alert(data.error);
                }
            }
        });
    }
    function save() {
        var id = $('#id').val();
        var nom = $('#nom').val();
        var dateDebut = $('#dateDebut').val();
        var dateButoir = $('#dateButoir').val();
        var clients = $('#clients').val();
        var cout = $('#cout').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() . "/Projet_Controller/save_modif" ?>',
            dataType: 'json',
            data: {id: id, dateDebut: dateDebut, dateButoir: dateButoir, nom: nom, clients: clients, cout: cout},
            success: function (data)
            {
                if (data.success) {
                    var url = '<?php echo site_url() . "/Projet_Controller/view/"; ?>' + data.id;
                    location.replace(url);
                } else {
                    alert(data.error);
                }
            }
        }
        );
    }
</script>