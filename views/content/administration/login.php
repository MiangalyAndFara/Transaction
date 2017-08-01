<?php
/*
 * dev 112
 */
?>

<h3> Authentification : </h3>
<h2  id="error_span"></h2>
<br/>
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
        <td><button onclick="login()"> login </button></td>
    </tr>
</table>



<script>
    function login() {
        var pseudo = $('#pseudo').val();
        var passe = $('#passe').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("Utilisateur_Controller/authentification"); ?>',
            dataType: 'json',
            data: {pseudo: pseudo, passe: passe},
            success: function (data)
            {
                if (data.success) {
                    var url = '<?php echo site_url("Acc_Controller/"); ?>';
                    location.replace(url);
                } else {
                    $('#pseudo').val('');
                    $('#passe').val('');
                    $('#error_span').text(data.error);
                }
            }
        });
    }


</script>
<script src="<?php echo base_url() ?>assets/js/jquery-3.1.1.min.js"></script>