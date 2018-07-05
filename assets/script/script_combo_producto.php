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
               $(document).ready(function() {
                $("#id_categoria").change(function() {
                    $("#id_categoria option:selected").each(function() {
                        id_categoria = $('#id_categoria').val();
                        $.post("<?php echo base_url(); ?>sub_categoria/fill_sub_categoria", {
                            id_categoria : id_categoria
                        }, function(data) {
                            $("#id_sub_categoria").html(data);
                        });
                    });
                });
            });
              $(document).ready(function() {
                $("#id_sub_categoria").change(function() {
                    $("#id_sub_categoria option:selected").each(function() {
                        id_sub_categoria = $('#id_sub_categoria').val();
                        $.post("<?php echo base_url(); ?>producto/fill_producto", {
                            id_sub_categoria : id_sub_categoria
                        }, function(data) {
                            $("#id_producto").html(data);
                        });
                    });
                });
            });
        </script>