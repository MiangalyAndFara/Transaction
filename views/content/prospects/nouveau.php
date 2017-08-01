<?php
/*
 * dev 113
 */
?>
<h1>Nouveau prospect</h1>

<input type="text" id="nif" placeholder="NIF" />
<input type="text" id="stat" placeholder="STAT" />
<input type="text" id="nom" placeholder="Nom" />
<input type="email" id="email" placeholder="Email" />
<input type="text" id="telephone" placeholder="Telephone" />
<input type="text" id="skype" placeholder="Skype" />
<button onclick="save()"> Ok </button>


<script>
    function save() {
        var nif = $('#nif').val();
        var stat = $('#stat').val();
        var nom = $('#nom').val();
        var email = $('#email').val();
        var telephone = $('#telephone').val();
        var skype = $('#skype').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() . "/Prospect_Controller/save" ?>',
            dataType: 'json',
            data: {nif: nif, stat: stat, nom: nom, email: email, telephone: telephone, skype: skype},
            success: function (data)
            {
                if (data.success) {
                    $('#nif').val('');
                    $('#stat').val('');
                    $('#nom').val('');
                    $('#email').val('');
                    $('#telephone').val('');
                    $('#skype').val('');
                    alert("success");
                } else {
                    alert(data.error);
                }
            }
        });
    }
</script>
