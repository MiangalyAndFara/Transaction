<?php
/*
 * dev 112
 */
?>

<h3> Enregistrement nouvel employé : </h3>
<h3 id="error_span"> </h3>
<br/>
<table>
    <tr>
        <td><label>Nom : </label></td>
        <td><input type="text" id="nom" /></td>
    </tr>
    <tr>
        <td><label>Prénoms : </label></td>
        <td><input type="text" id="prenom" /></td>
    </tr>
    <tr>
        <td><label>Date de naissance : </label></td>
        <td><input type="text" id="naissance" /></td>
    </tr>
    <tr>
        <td><label>Sexe : </label></td>
        <td>
            <select id="sexe">
                <option value = ''>...</option>
                <option value = 'M'>Masculin</option>
                <option value = 'F'>Feminin</option>

            </select>
        </td>
    </tr>
    <tr>
        <td><label>Adresse : </label></td>
        <td><input type="text" id="adresse" /></td>
    </tr>
    <tr>
        <td><label>Date Entrée : </label></td>
        <td><input type="text" id="dateEntree" /></td>
    </tr>
    <tr>
        <td><label>CIN : </label></td>
        <td><input type="number" id="cin" /></td>
    </tr>
    <tr>
        <td><label>Téléphone : </label></td>
        <td><input type="text" id="telephone" /></td>
    </tr>

    <tr>
        <td><label>Email : </label></td>
        <td><input type="email" id="email" /></td>
    </tr>
    <tr>
        <td><label>Skype : </label></td>
        <td><input type="text" id="skype" /></td>
    </tr>
    <tr>
        <td><label>Statut : </label></td>
        <td>
            <select id="statut">
                <option value = ''>...</option>
                <?php foreach ($etats as $etat) { ?>
                    <option value = '<?php echo $etat ?>'><?php echo $tetats[$etat] ?></option>
                <?php } ?>
            </select>
        </td>
    </tr>
</table>
<table>
    <tr>
        <td><label>Identifiant : </label></td>
        <td><input type="text" id="pseudo" /></td>
    </tr>
    <tr>
        <td><label>Mot de passe : </label></td>
        <td><input type="password" id="passe" /></td>
    </tr>
    <tr>
        <td><label>Confirmer mot de passe : </label></td>
        <td><input type="password" id="conf_passe" /></td>
    </tr>
</table>
<table>
    <tr>
        <td><button onclick="save()"> Enregistrer </button></td>
    </tr>
</table>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.js'); ?>"></script>
<script>
    // DatePickers
    $(function () {
        $('#dateEntree').datepicker({dateFormat: 'yy-mm-dd'});
        $('#naissance').datepicker({dateFormat: 'yy-mm-dd'});
    });
    function save() {
        var nom = $('#nom').val();
        var prenom = $('#prenom').val();
        var naissance = $('#naissance').val();
        var sexe = $('#sexe').val();
        var adresse = $('#adresse').val();
        var dateEntree = $('#dateEntree').val();
        var cin = $('#cin').val();
        var statut = $('#statut').val();
        var telephone = $('#telephone').val();
        var email = $('#email').val();
        var skype = $('#skype').val();
        var pseudo = $('#pseudo').val();
        var passe = $('#passe').val();
        var conf_passe = $('#conf_passe').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() . "/Employe_Controller/save" ?>',
            dataType: 'json',
            data: {nom: nom, prenom: prenom, naissance: naissance, sexe: sexe, adresse: adresse, dateEntree: dateEntree,
                cin: cin, statut: statut, telephone: telephone, email: email, skype: skype,
                pseudo: pseudo, passe: passe, conf_passe: conf_passe},
            success: function (data)
            {
                if (data.success) {
                    window.location.reload();
                } else {
                    $('#nom').val(nom);
                    $('#prenom').val(prenom);
                    $('#naissance').val(naissance);
                    $('#sexe').val(sexe);
                    $('#adresse').val(adresse);
                    $('#dateEntree').val(dateEntree);
                    $('#cin').val('');
                    $('#statut').val('');
                    $('#telephone').val('');
                    $('#email').val('');
                    $('#skype').val('');
                    $('#pseudo').val(pseudo);
                    $('#passe').val('');
                    $('#conf_passe').val('');
                    $('#error_span').text(data.error);
                }
            }
        });
    }


</script>


