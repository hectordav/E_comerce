$(document).on("ready".inicio);
function inicio(){
	//mostrardatos();
	$("form").submit(function(event){
		event.preventDefault();
		$.ajax({
			url:$("form").attr("action"),
			type:$("form").attr("method"),
			type:$("form").serialize(),
			success:function(respuesta){
				alert(respuesta);
			}
		});
	});
}
function mostrardatos(datos) {
    $.ajax({
        url: "../presupuesto/mostrar_det_presupuesto",
        type: 'POST',
        data: $("#form-guardar").serialize(),
        success: function(respuesta) {
            var registro = eval(respuesta);
            html = "<hr><table id='mytable' class='table table-condensed table-bordered table-hover'>";
            html += "<thead><tr>";
            html += "<th class='info col-md-6'>Articulo</th>"; //la columna de articulo
            html += "<th class='info'>Cantidad</th>"; //la columna de cantidad
             html += "<th class='info'>P Unitario</th>"; //la columna de Precio Unitario.
              html += "<th class='info'>Total</th>"; //la columna de Total.
            html += "<th class='info '>Acciones</th>"; //la columna de las accion borrar.
            html += "</thead><tbody>";
            //si hay un registro
            if (registro) {
        	for (var i = 0; i < registro.length; i++) {
            html += "<tr><td>" + registro[i]["descripcion"] + "</td>";
            html += "<td>" + registro[i]["cantidad"] + "</td>";
            html += "<td>" + registro[i]["precio"] + "</td>";
            html += "<td>" + registro[i]["total"] + "</td>";
            html += "<td><button class='btn btn-default glyphicon glyphicon-trash ' name='btn_eliminar'id='btn_eliminar'OnClick='eliminar_det_presupuesto(this)' type='button' value='" + registro[i]["id"] + "' title='ELiminar Item'></button></td>";
            $("#det_presupuesto").html(html);
			document.getElementById('txt_cantidad').value = '';
            }
            tabla = document.getElementById("mytable");
            iva=Number(document.getElementById("valor_iva").value);
            var sub_total = 0;
				for(var i = 1; tabla.rows[i]; i++) {
				sub_total+=Number(tabla.rows[i].cells[3].innerHTML);
				}
				var iva= (sub_total*iva)/100;
				var total=iva+sub_total;
				$("#sub_total").html(sub_total);
				$("#iva").html(iva);
				$("#total").html(total);
			document.getElementById("txt_sub_total").value =(sub_total);
			document.getElementById("txt_iva").value =(iva);
			document.getElementById("txt_total").value =(total);
            //si no lo hay XD
            }else{
			var sub_total = 0;
			var iva= 0;
			var total=0;
            	html += "<tr><td></td>";
            	html += "<td></td>";
            	html += "<td></td>";
            	html += "<td></td>";
            	html += "<td></td></tr>";
            	$("#det_presupuesto").html(html);
            	$("#sub_total").html(sub_total);
				$("#iva").html(iva);
				$("#total").html(total);
			document.getElementById("txt_sub_total").value =(sub_total);
			document.getElementById("txt_iva").value =(iva);
			document.getElementById("txt_total").value =(total);
			document.getElementById('txt_cantidad').value = '';
            };
        }
    });
}
function guardar_det_producto(datos){
	event.preventDefault();
	$.ajax({
		url: "../presupuesto/guardar_det_presupuesto_item",
		type:"POST",
		data: $("#form-guardar").serialize(),
		success:function(respuesta){
		mostrardatos("");
	}
});
}
function actualizar_instalacion(){
	event.preventDefault();
	$.ajax({
		url: "/hotel/instalacion/actualizar_instalacion",
		type:"POST",
		data: $("#form-actualizar").serialize(),
		success:function(respuesta){
			mostrardatos("");
	}
});
}
function eliminar_det_presupuesto(boton){
	ID=boton.value;
	$.ajax({
		url: "../presupuesto/eliminar_det_presupuesto",
		type:"POST",
		data:{id:ID},
		success:function(respuesta){
			mostrardatos("");
		}
});
}

