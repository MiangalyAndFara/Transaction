<?php
/*
 * dev 113
 */
?>
<h1>Nouveau projet</h1>

<input type="text" id="nom" placeholder="Nom" />
<input type="text" id="dateDebut" placeholder="Date debut" />
<input type="text" id="dateButoir" placeholder="Date butoir" />
<input type="number" id="cout" placeholder="Cout" />
<select id="clients" multiple>
    <?php
    foreach ($liste_clients as $client) {
        ?>
        <option value="<?php echo $client->getIdClient(); ?>"><?php echo $client->getNom(); ?></option>
        <?php
    }
    ?>
</select> 
<button onclick="save()"> Ok </button>

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.js'); ?>"></script>
<script>
    $(function () {
        $('#dateDebut').datepicker({dateFormat: 'yy-mm-dd'});
        $('#dateButoir').datepicker({dateFormat: 'yy-mm-dd'});
    });
    function save() {
        var nom = $('#nom').val();
        var dateDebut = $('#dateDebut').val();
        var dateButoir = $('#dateButoir').val();
        var clients = $('#clients').val();
        var cout = $('#cout').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() . "/Projet_Controller/save" ?>',
            dataType: 'json',
            data: {dateDebut: dateDebut, dateButoir: dateButoir, nom: nom, clients: clients, cout: cout},
            success: function (data)
            {
                if (data.success) {
                    var url = '<?php echo site_url() . "/Projet_Controller/edit/"; ?>' + data.id;
                    location.replace(url);
                } else {
                    alert(data.error);
                }
            }
        });
    }


</script>
