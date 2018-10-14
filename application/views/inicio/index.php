<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ENREDA - Felipe</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
		$( function() {
			$("#dialog").dialog({
				autoOpen: false,
				width: 500,
				height: "auto"
			});

			$("#opener").on( "click", function() {
				$('input').val('');
				$('#boton').val('Enviar');
				
				// Fecha actual
				var d = new Date();
				var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
				$("#fechaCont").val(strDate);
				$("#dialog").dialog("open");
			});
				

			$(document).ready(function(){
				// Fecha actual
				var d = new Date();
				var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
				$("#fechaCont").val(strDate);

				// Checkbox contrato
				$("#checkbox").click(function(){
					var cb = $("#checkbox").prop('checked');
					if (cb == true) {
						$("#select").show();
					} else {
						$("#select").hide();
					}
				})

				// Precio
				$("#precioFac").change(function(){
					var precio = $("#precioFac").val();
					var calculoIva = (precio * 21) / 100;
					var total = parseFloat(precio) + parseFloat(calculoIva);
					$("#ivaFac").val(calculoIva);
					$("#totalFac").val(total);
					if (precio>15000) {
						$("#spanPrecio").html(" Debe seleccionar un contrato");
					}
				})



				// Funciones editar y borrar
				function obtener_datos(id){
					$.post('<?=base_url()?>inicio/obtener_datos', {id:id}, function(data){
						data = JSON.parse(data);
						for (i in data[0]) {
							$("[name="+i+"]").val(data[0][i])
						}
					});
				}

				function borrar_datos(id){
					$.post('<?=base_url()?>inicio/borrar_datos', {id:id}, function(data){
						location.reload();
					});
				}
				
				// Cargar tabla
				function obtener_tabla() {
					$.post('<?=base_url()?>inicio/obtener_tabla', {}, function(data){
						data = JSON.parse(data);
						var content = " "
						for(i=0; i< data.length; i++){
							content += "<tr>";
							content += "<td>"+data[i].nombreCont+"</td>";
							content += "<td>"+data[i].fechaCont+"</td>";
							content += "<td>"+data[i].nombreFac+"</td>";
							content += "<td>"+data[i].fechaFac+"</td>";
							content += "<td>"+data[i].licitacion+"</td>";
							content += "<td>"+data[i].adjunto+"</td>";
							content += "<td>"+data[i].precio+"</td>";
							content += "<td>"+data[i].iva+"</td>";
							content += "<td>"+data[i].total+"</td>";
							content += "<td style='text-align: center;'> \
							<button data='"+data[i].contrato+"' class='btn_editar' style='margin-right: 5px;'>Editar</button> \
							<button data='"+data[i].contrato+"' class='btn_borrar' style='margin-right: 5px;'>Eliminar</button> </td>";
							content += "</tr>";
						}
						$("#cuerpo_tabla").append(content);

						$(".btn_editar").click(function(){
							var id = $(this).attr("data");
							obtener_datos(id);
							$("#dialog").dialog("open");
						});

						$(".btn_borrar").click(function(){
							var id = $(this).attr("data")
							borrar_datos(id)
						});
					})
				}
				obtener_tabla();

			})
		} );
	</script>
	<style type="text/css">
		input, select {
			width: 100%;
			margin: 5px 0px 15px 0px;
		    height: 20px;
		}
		#boton {
		    background-color: #FF9800;
		    height: 40px;
		    border: 2px solid #fff;
		}
		#tabla {
			width: 1150px;
			position: relative;
			top: 50%;
			left: 50%;
			margin-left: -575px;
			margin-top: -126px;	
		}
	</style>
	</head>
	<body>

	<div style="position: absolute; width: 100%; height: 100%">
		<button id="opener">Agregar</button>
		<div id="tabla">
			<table id="table_id" style="width: 100%">
				<thead>
					<tr style="font-size: 20px;">
						<th>Nombre Contrato</th>
						<th>Fecha Contrato</th>
						<th>Nombre Factura</th>
						<th>Fecha Factura</th>
						<th>Licitación</th>
						<th>Adjunto</th>
						<th>Precio</th>
						<th>IVA</th>
						<th>Total</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody id="cuerpo_tabla">

				</tbody>
			</table>
		</div>
	</div>

	<div id="dialog" title="Registro">
		<form action="<?=base_url()?>inicio/registro" method="post" enctype="multipart/form-data">
			<h2>Factura</h2>
			<hr>
			<span>Nombre</span>
			<input type="text" name="nombreFac">
			<span>Fecha</span>
			<input type="date" name="fechaFac">
			<span>Adjunto</span>
			<input type="file" name="archivoFac">
			<span>¿Tiene licitación?</span>
			<input type="checkbox" name="checkbox" style="width: 30px; margin: 5px 30px;" id="checkbox">
			<br>
			<br>
			<div style="display: none;" id="select">
				<span>Contrato</span><br>
				<select style="height: 27px !important" name="contrato">
					<option>-</option>
					<option value="Contrato 1">Contrato 1</option>
					<option value="Contrato 2">Contrato 2</option>
					<option value="Contrato 3">Contrato 3</option>
				</select>
			</div>
			<span>Precio</span><span style="color:red" id="spanPrecio"></span>
			<input type="text" name="precioFac" id="precioFac" value="">
			<span>IVA</span>
			<input type="text" name="ivaFac" id="ivaFac" readonly="readonly" value="">
			<span>Total</span>
			<input type="text" name="totalFac" id="totalFac" readonly="readonly" value="">
			<h2>Contrato</h2>
			<hr>
			<span>Nombre</span>
			<input type="text" name="nombreCont">
			<span>Fecha</span>
			<input type="date" name="fechaCont" readonly="readonly" id="fechaCont">
			<input type="hidden" name="contrato">
			<input type="submit" id="boton" value="Enviar">
		</form>
	</div>

	</body>
</html>