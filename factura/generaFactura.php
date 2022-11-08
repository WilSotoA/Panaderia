<?php
	session_start();
	include "../php/include/conexion.php";
	require_once '../dompdf/vendor/autoload.php';
	use Dompdf\Dompdf;
	$noFactura =$_REQUEST['f'];
		$noCliente = $_REQUEST['cl'];

	 if(empty($_REQUEST['f']) || empty($_REQUEST['cl']))
	{
		echo "No es posible generar la factura.";
	}else{

		//datosfactura
		$queryfactura = mysqli_query($conex, "SELECT * FROM facturas WHERE Id_factura = '$noFactura'");
		$result = mysqli_num_rows($queryfactura);
		if( $result > 0){
			$arreglofactu = mysqli_fetch_assoc($queryfactura);
			$totalfactura = $arreglofactu['Total_factura'];
		}	

		//datos detalle
		$querydetalles = mysqli_query($conex, "SELECT * FROM insumosfactura WHERE ID_FACTURA = '$noFactura'");
		$resultdeta = mysqli_num_rows($querydetalles);


		//datos cliente
		$querycliente = mysqli_query($conex, "SELECT * FROM clientes WHERE Id_cliente = '$noCliente'");
		$resultcli = mysqli_num_rows($querycliente);
		if( $resultcli > 0){
			$arreglocli = mysqli_fetch_assoc($querycliente);

		}
			ob_start();
		    include(dirname(__FILE__).'/factura.php');
		    $html = ob_get_clean();
			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$options = $dompdf->getOptions();
			$options ->set(array('isRemoteEnabled' => true));
			$dompdf->setOptions($options);
			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('factura_'.$noFactura.'.pdf',array('Attachment'=> false));
			exit;
		}
?>