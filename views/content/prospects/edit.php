<?php
/*
 * dev 113
 */
?>
<h1>Edition prospect</h1>
<input type="hidden" id="idClient"  value="<?php echo $prospect->getIdClient(); ?>"/>
<input type="text" id="nom" placeholder="Nom" value="<?php echo $prospect->getNom(); ?>"/>
<input type="text" id="nif" placeholder="NIF" value="<?php echo $prospect->getNif(); ?>"/>
<input type="text" id="stat" placeholder="STAT" value="<?php echo $prospect->getStat(); ?>"/>
<input type="email" id="email" placeholder="Email" value="<?php echo $prospect->getContact()->getEmail(); ?>"/>
<input type="text" id="telephone" placeholder="Telephone" value="<?php echo $prospect->getContact()->getTelephone(); ?>"/>
<input type="text" id="skype" placeholder="Skype" value="<?php echo $prospect->getContact()->getSkype(); ?>"/>
<button onclick="save()"> Ok </button>


<script>
    function save() {
        var nif = $('#nif').val();
        var stat = $('#stat').val();
        var nom = $('#nom').val();
        var email = $('#email').val();
        var telephone = $('#telephone').val();
        var skype = $('#skype').val();
        var idClient = $('#idClient').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() . "/Prospect_Controller/save_modif" ?>',
            dataType: 'json',
            data: {nif: nif, stat: stat, nom: nom, email: email, telephone: telephone, skype: skype, idClient: idClient},
            success: function (data)
            {
                if (data.success) {
                    alert("success");
                } else {
                    alert(data.error);
                }
            }
        });
    }
</script>
