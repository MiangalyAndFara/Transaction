<?php
/*
 * dev 112
 */
?>
<link href="<?php echo base_url() ?>assets/css/style_validation.css" rel="stylesheet">
<h3> Liste des demandes de congé : </h3>
<h2 id="error"></h2>
<table border="1" id="workflow">
    <thead>
    <th>Employe</th>
    <th>Motif</th>
    <th>Date de demande</th>
    <th>Date debut</th>
    <th>Durée</th>
    <th>Statut</th>
    <th>Validation</th>
</thead>
<tbody>    
    <?php
    $etats = array(VALIDE => 'Validé', EN_ATTENTE => 'En attente', REFUSE => 'Refusé');

    foreach ($dmd_conge as $dc) {
        $dateDebut = new DateTime($dc->getDateDebut(), new DateTimeZone('UTC'));
        ?>
        <tr>
            <td><?php echo $dc->getEmploye()->getPrenom() . ' ' . $dc->getEmploye()->getNom(); ?></td>
            <td><?php echo $dc->getMotif(); ?></td>
            <td><?php echo $dc->getDateConge(); ?></td>
            <td><?php echo $dc->getDateDebut(); ?></td>
            <td><?php echo $dc->getDuree() . " jour(s)"; ?></td>
            <td><?php echo $etats[$dc->getStatut()]; ?></td>
    <input id="idemp" type="hidden" value="<?php echo $dc->getEmploye()->getIdEmp() ?>"/>
    <input id="idconge" type="hidden" value="<?php echo $dc->getIdConge() ?>"/>
    <td> <button onclick="demande_validation(<?php echo VALIDE ?>)"> Valider </button>
        <button id="myBtnSupp" > Refuser </button>
        <div id="myModalSupp" class="modal">
            <div class="modal-content">
                <span class="close" id="closeSupp">&times;</span>
                <label>Motif:</label>
                <br>
                <textarea id="motifSupp" rows="3" cols="50"></textarea>
                <br>
                <br>
                <button onclick="demande_validation(<?php echo REFUSE ?>)"> Refuser </button>

            </div>
        </div>
        <button id="myBtn" > Valider avec condition </button></td>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close">&times;</span>
            <label>Motif:</label>
            <br>
            <textarea id="motif" rows="3" cols="50"></textarea>
            <br>
            <br>
            <label>Date debut congé:</label>
            <input id="dateDebutConge" type="text" value="<?php echo $dateDebut->format('Y-m-d'); ?>"/>
            <input id="heureDebut" type="text" value="<?php echo $dateDebut->format('h:i A'); ?>"/>
            <br>
            <br>
            <label>Durée:</label>
            <input id="duree" type="text" value="<?php echo $dc->getDuree(); ?>"/>
            <br>
            <br>

            <button onclick="demande_validation(<?php echo VALIDE_CONDITION ?>)"> Valider </button>

        </div>
    </div>
    </tr>
    <?php
}
?>
</tbody>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.timepicker.min.js'); ?>"></script>
<script>
            $(function () {
                $("#dateDebutConge").datepicker({
                    dateFormat: "yy-mm-dd"
                });
                $('#heureDebut').timepicker({
                    'minTime': '8:00am',
                    'maxTime': '7:00pm',
                    'showDuration': true
                });
            });
            // Get the modal
            var modal = document.getElementById('myModal');
            var modalSupp = document.getElementById('myModalSupp');

// Get the button that opens the modal
            var btn = document.getElementById("myBtn");
            var btnSupp = document.getElementById("myBtnSupp");

// Get the <span> element that closes the modal
            var span = document.getElementById("close");
            var spanSupp = document.getElementById("closeSupp");

// When the user clicks the button, open the modal 
            btn.onclick = function () {
                modal.style.display = "block";
            }
            btnSupp.onclick = function () {
                modalSupp.style.display = "block";
            }

// When the user clicks on <span> (x), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }
            spanSupp.onclick = function () {
                modalSupp.style.display = "none";
            }

// When the user clicks anywhere outside of the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
                if (event.target == modalSupp) {
                    modalSupp.style.display = "none";
                }
            }
            function demande_validation(rep) {
                var idconge = '';
                var idemp = '';
                var motif = '';
                var dureeConge = '';
                var dateDebutConge = '';
                var heureDebutConge = '';
                if (rep == <?php echo VALIDE_CONDITION ?>) {
                    motif = $('#motif').val();
                    dureeConge = $('#duree').val();
                    dateDebutConge = $('#dateDebutConge').val();
                    heureDebutConge = $('#heureDebut').val();
                    //   alert(motif);
                    //    alert(dureeConge);
                    // alert(dateDebutConge);
                }
                idconge = $('#idconge').val();
                idemp = $('#idemp').val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url("Conge_Controller/validation"); ?>',
                    dataType: 'json',
                    data: {reponse: rep, idconge: idconge, idemp: idemp, motif: motif, dureeConge: dureeConge, dateDebutConge: dateDebutConge, heureDebutConge: heureDebutConge},
                    success: function (data)
                    {
                        if (data.success) {
                            window.location.reload();
                        } else {
                            $('#error').text('data.error');
                        }
                    }
                });

            }

</script>
</table>