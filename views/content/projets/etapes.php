<?php
/*
 * dev 113
 */
?>
<input type="text" id="nom" placeholder="Nom" />
<input type="date" id="dateDebut" placeholder="Date debut" />
<input type="date" id="dateButoir" placeholder="Date butoir" />
<input type="number" id="cout" placeholder="Cout" />
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
<tbody></tbody>
</table>
<script>
    function ajouter() {
        var sujet = $('#sujet').val();
        var description = $('#description').val();
        $('#workflow').html('<thead><th>Sujet</th><th>Description</th><th>Action</th></thead><tr><td>' + sujet + '</td><td>' + description + '</td><td>supprimer</td></tr>');
        /* $.ajax({
         type: 'POST',
         url: '<?php echo site_url() . "/Projet_Controller/add_workflow" ?>',
         dataType: 'json',
         data: {sujet: sujet, description: description},
         success: function (data)
         {
         if (data.success) {
         $('#dateDebut').val('');
         $('#dateButoir').val('');
         $('#nom').val('');
         alert("success");
         } else {
         alert(data.error);
         }
         }
         }); */
    }
</script>