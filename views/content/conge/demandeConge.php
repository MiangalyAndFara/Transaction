<?php
//113
?>

<h3> Demande de congé : </h3>

<label>Date et heure début : </label>
<input type="text" id="dateDebut" />
<input type="text" id="heureDebut" />
<br>
<label>Date et heure fin : </label>
<input type="text" id="dateFin" />
<input type="text" id="heureFin" />
<br>
<button onclick="save()"> Ok </button>


<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.ui.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.timepicker.min.js'); ?>"></script>
<script>
    // DatePickers
    $(function () {
        $('#dateDebut').datepicker({dateFormat: 'yy-mm-dd'});
        $('#dateFin').datepicker({dateFormat: 'yy-mm-dd'});
        $('#heureDebut').timepicker({
            'minTime': '8:00am',
            'maxTime': '7:00pm',
            'showDuration': true
        });
        $('#heureFin').timepicker({
            'minTime': '8:00am',
            'maxTime': '7:00pm',
            'showDuration': true
        });
    });


    function save() {
        var dateDebut = $('#dateDebut').val();
        var dateFin = $('#dateFin').val();
        var heureDebut = $('#heureDebut').val();
        var heureFin = $('#heureFin').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url() . "/Conge_Controller/save" ?>',
            dataType: 'json',
            data: {dateDebut: dateDebut, dateFin: dateFin, heureDebut: heureDebut, heureFin: heureFin},
            success: function (data)
            {
                if (data.success) {
                    $('#dateDebut').val('');
                    $('#dateFin').val('');
                    $('#heureDebut').val('');
                    $('#heureFin').val('');
                } else {
                    alert(data.error);
                }
            }
        });
    }


</script>


