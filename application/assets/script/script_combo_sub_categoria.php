<script type="text/javascript">
            $(document).ready(function() {
                $("#id_genero").change(function() {
                    $("#id_genero option:selected").each(function() {
                        id_genero = $('#id_genero').val();
                        $.post("<?php echo base_url(); ?>sub_categoria/fill_categoria", {
                            id_genero : id_genero
                        }, function(data) {
                            $("#id_categoria").html(data);
                        });
                    });
                });
            });
        </script>