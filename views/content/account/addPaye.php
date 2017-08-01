<?php
/*
 * dev 112
 */
?>
<link href="<?php echo base_url() ?>assets/css/style_validation.css" rel="stylesheet">
<link href = "<?php echo base_url(); ?>assets/css/jquery-ui.css" rel = "stylesheet">
<script src = "<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
<script src = "<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
<h3> Payement : </h3>
<a href="<?php echo site_url() . 'Account_Controller/index/' . $projet; ?>"> 
    <button> Retour </button>   
</a>
<br>
<br>
<br>
<span id="error"></span>

<label> Date de payement : </label>
<input id="datePaye" type="text"/>
<label> Montant a paye : </label>
<input id="montantPaye" type="number"/>
<input id="idprojet" type="hidden" value="<?php echo $projet; ?>"/>
<button onclick="paie()"> Payement </button>
</tbody>
<script>
    $(function () {
        $("#datePaye").datepicker({
            dateFormat: "yy-mm-dd"
        });
    });
    function paie() {
        var idprojet = $('#idprojet').val();
        var datePaye = $('#datePaye').val();
        var montantPaye = $('#montantPaye').val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url("Account_Controller/paiement"); ?>',
            dataType: 'json',
            data: {idprojet: idprojet, datePaye: datePaye, montantPaye: montantPaye},
            success: function (data)
            {
                if (data.success) {
                    window.location.reload();

                } else {
                    $('#error').append('data.error');
                }
            }
        });

    }

</script>
</table>