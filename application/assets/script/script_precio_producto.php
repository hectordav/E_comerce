<script>
function fncSumar(){
var precio_neto = Number(document.getElementById("txt_precio_neto").value);
var valor_iva = Number(document.getElementById("txt_iva").value);
var iva =(precio_neto*valor_iva)/100;
var total=precio_neto+iva;
document.getElementById("txt_iva_2").value =(iva);
document.getElementById("txt_total").value =(total);
}
function fncSumarCantidad(){
var cantidad_vieja = Number(document.getElementById("txt_cantidad").value);
var cantidad_agregar = Number(document.getElementById("txt_cantidad_1").value);
var nueva_cantidad=cantidad_vieja+cantidad_agregar;
document.getElementById("txt_cantidad_2").value =(nueva_cantidad);
}
function fncRestarCantidad(){
var cantidad_vieja = Number(document.getElementById("txt_cantidad").value);
var cantidad_agregar = Number(document.getElementById("txt_cantidad_1").value);
var nueva_cantidad=cantidad_vieja-cantidad_agregar;
if (nueva_cantidad<0) {
	alert("Cantidad Negativa");
}else{
document.getElementById("txt_cantidad_2").value =(nueva_cantidad);

}
}
</script>