<?php
/*
 * dev 112
 */
?>

<h3> Modifier Emp : </h3>
<a href="<?php echo site_url('Employe_Controller'); ?>"> 
    <button> Retour </button>   
</a>
<br/>
<br/>
<h3 id="error_span"> </h3>
<br/>

<?php foreach ($employes as $emp) { ?>
    <input type="hidden" id="idemp" value="<?php echo $emp->getIdEmp(); ?>"/>
    <input type="hidden" id="iduser" value="<?php echo $emp->getUser()->getIdUser(); ?>"/>
    <table>
        <tr>
            <td><label>Nom : </label></td>
            <td><input type="text" id="nom" value="<?php echo $emp->getNom(); ?>"/></td>
        </tr>
        <tr>
            <td><label>Prénoms : </label></td>
            <td><input type="text" id="prenom" value="<?php echo $emp->getPrenom(); ?>"/></td>
        </tr>
        <tr>
            <td><label>Date de naissance : </label></td>
            <td><input type="text" id="naissance" value="<?php echo $emp->getNaissance(); ?>"/></td>
        </tr>
        <tr>
            <td><label>Sexe : </label></td>
            <td>
                <select id="sexe">
                    <?php if ($emp->getSexe() == 'M') {
                        ?>
                        <option value = 'M' selected >Masculin</option>
                        <option value = 'F'>Feminin</option>
                        <?php
                    } else if ($emp->getSexe() == 'F') {
                        ?>
                        <option value = 'M'  >Masculin</option>
                        <option value = 'F' selected>Feminin</option>
                    <?php }
                    ?>
                    <option value = ''>...</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Adresse : </label></td>
            <td><input type="text" id="adresse" value="<?php echo $emp->getAdresse(); ?>"/></td>
        </tr>
        <tr>
            <td><label>Date Entrée : </label></td>
            <td><input type="text" id="dateEntree" value="<?php echo $emp->getDateEntree(); ?>"/></td>
        </tr>
        <tr>
            <td><label>CIN : </label></td>
            <td><input type="text" id="cin" value="<?php echo $emp->getCin(); ?>"/></td>
        </tr>
        <tr>
            <td><label>Téléphone : </label></td>
            <td><input type="text" id="telephone" value="<?php echo $emp->getTelephone(); ?>" /></td>
        </tr>

        <tr>
            <td><label>Email : </label></td>
            <td><input type="email" id="email" value="<?php echo $emp->getEmail(); ?>"/></td>
        </tr>
        <tr>
            <td><label>Skype : </label></td>
            <td><input type="text" id="skype" value="<?php echo $emp->getSkype(); ?>"/></td>
        </tr>
        <tr>
            <td><label>Statut : </label></td>
            <td>
                <select id="statut">
                    <option value = ''>...</option>
                    <?php
                    foreach ($etats as $etat) {
                        if ($etat == $emp->getUser()->getStatut()) {
                            ?>
                            <option value = '<?php echo $etat ?>' selected><?php echo $tetats[$etat] ?></option>
                        <?php } else {
                            ?>
                            <option value = '<?php echo $etat ?>'><?php echo $tetats[$etat] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td><label>Identifiant : </label></td>
            <td><input type="text" id="pseudo" value="<?php echo $emp->getUser()->getIdentifiant(); ?>"/></td>
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
<?php } ?>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.js'); ?>"></script>

<script>
    // DatePickers
    $(function () {
        $('#dateEntree').datepicker({dateFormat: 'yy-mm-dd'});
        $('#naissance').datepicker({dateFormat: 'yy-mm-dd'});
    });
    function save() {
        var idemp = $('#idemp').val();
        var iduser = $('#iduser').val();
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
            url: '<?php echo site_url() . "/Employe_Controller/edit" ?>',
            dataType: 'json',
            data: {iduser: iduser, idemp: idemp,
                nom: nom, prenom: prenom, naissance: naissance, sexe: sexe, adresse: adresse, dateEntree: dateEntree,
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


