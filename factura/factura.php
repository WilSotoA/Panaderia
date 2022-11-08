<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/Panaderia/factura/style.css">
	<link rel="shortcut icon" href="http://<?php echo $_SERVER['HTTP_HOST'];?>/Panaderia/images/icon.png">
</head>
<body>
<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/Panaderia/images/icon.jpeg" width="200px" height="200px">
				</div>
			</td>

			<td class="info_factura">
				<div class="round">
					<span class="h3">Factura</span>
					<p>No. Factura: <strong><?php echo $arreglofactu['Id_factura']; ?></strong></p>
					<p>Descripcion: <?php echo $arreglofactu['Descripcion_factura']; ?></p>
					<p>Fecha: <?php echo $arreglofactu['Fecha_factura']; ?></p>
					<p>Vendedor: <?php echo $_SESSION['user'];?></p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
					<tr>
							<td><label>Nit:</label><p><?php echo $arreglocli['Id_cliente']; ?></p></td>
							<td><label>Teléfono:</label><p><?php echo $arreglocli['Telefono_cliente']; ?></p></td>
						</tr>
						<tr>
							<td><label>Nombre:</label> <p><?php echo $arreglocli['Nombre_cliente']; ?></p></td>
							<td><label>Dirección:</label> <p><?php echo $arreglocli['Direccion_cliente']; ?></p></td>
						</tr>
						<tr>
							<td><label>Apellido:</label> <p><?php echo $arreglocli['Apellido_cliente']; ?></p></td>
							<td><label>Email:</label> <p><?php echo $arreglocli['Correo_cliente']; ?></p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					<th width="50px">Cant.</th>
					<th class="textcenter" width="100px">Descripción</th>
					<th class="textright" width="50px">Precio</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">

			<?php

			if ($resultdeta > 0) {

					while ($arreglodeta = mysqli_fetch_assoc($querydetalles)){
						$Idprod = $arreglodeta['ID_PRODUCTO'];
						//datos producto 
					$queryprods = mysqli_query($conex, "SELECT Nombre_producto FROM insumos WHERE Id_producto = '$Idprod'");
					$resultprod = mysqli_num_rows($queryprods);
						$arrayprod = mysqli_fetch_assoc($queryprods);
						$nombreprod = $arrayprod['Nombre_producto'];
			 ?>
				<tr>
					<td class="textcenter"><?php echo $arreglodeta['Cantidad']; ?></td>
					<td class="textcenter"><?php echo $nombreprod; ?></td>
					<td class="textright"><?php echo $arreglodeta['Precio']; ?></td>
				</tr>
			<?php
					}
				}
			?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="2" width="180px" class="textright"><span>TOTAL A PAGAR:</span></td>
				<td colspan="1" width="20px"><span class="textright"><?php echo $totalfactura; ?></span></td>
				</tr>
		</tfoot>
	</table>
	<div>
		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>

</div>

</body>
</html>