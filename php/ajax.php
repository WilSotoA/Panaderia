<?php 
include "include/conexion.php";
session_start();


//buscar cliente
if($_POST['action'] == 'searchCliente')
{
    if (!empty($_POST['cliente'])) {
        $nit = $_POST['cliente'];

        $query = mysqli_query($conex, "SELECT * FROM clientes WHERE Id_cliente LIKE '$nit'");
        mysqli_close($conex);
        $result = mysqli_num_rows($query);

        $data = '';
        if($result > 0){
            $data = mysqli_fetch_assoc($query);
        } else {
            $data = 0;
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    exit;
}

//registra cliente ventas
if($_POST['action'] == 'aggcliente')
{
    $nit = $_POST['nitcliente'];
    $nombre = $_POST['nomcliente'];
    $apellido = $_POST['apcliente'];
    $direccion = $_POST['dircliente'];
    $telefono = $_POST['telcliente'];
    $correo = $_POST['emailcliente'];

    $query = mysqli_query($conex, "INSERT INTO clientes(Id_cliente, Nombre_cliente, Apellido_cliente, Direccion_cliente, Telefono_cliente, Correo_cliente) VALUES ('$nit','$nombre','$apellido','$direccion','$telefono','$correo')"); 

    mysqli_close($conex);
    exit;
}
//buscar producto
if($_POST['action'] == 'infoProducto')
{
    if (!empty($_POST['producto'])) {
        $id = $_POST['producto'];

        $query = mysqli_query($conex, "SELECT * FROM insumos WHERE Id_producto LIKE '$id'");
        mysqli_close($conex);
        $result = mysqli_num_rows($query);

        $data = '';
        if($result > 0){
            $data = mysqli_fetch_assoc($query);
        } else {
            $data = 0;
        }
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
    }
    exit;
}
//agg productotemp
if($_POST['action'] == 'aggProductotemp')
{
    if (!empty($_POST['producto'])) {
        
            $codprod = $_POST['codprod'];
            $producto = $_POST['producto'];
            $cantprod = $_POST['cantprod'];
            $precio = $_POST['precio'];
            $preciototal = $_POST['preciototal'];
       
            $query = mysqli_query($conex, "INSERT INTO insumotemp( ID_PRODUCTO, Producto, Cantidad, Precio, Precio_total) VALUES ('$codprod','$producto','$cantprod','$precio','$preciototal') ");
            $consultar = mysqli_query($conex, "SELECT * FROM insumotemp");

            $result = mysqli_num_rows($consultar);

            $detalleTabla = '';
            $total = 0;
            $arrayData = array();

            if ($result > 0){
                while ($data = mysqli_fetch_assoc($consultar)){
                    $total = round($total + $data['Precio_total']);
                    
                    $detalleTabla .= '
                    <tr class="prod">
                        <td class="prods">'.$data['ID_PRODUCTO'].'</td>
                        <td class="prods">'.$data['Producto'].'</td>
                        <td class="prods">'.$data['Cantidad'].'</td>
                        <td class="prods">'.$data['Precio'].'</td>
                        <td class="prods">'.$data['Precio_total'].'</td>
                        <td class="prods">
                            <a href="eliminar/elimdetalles.php?id='.$data['Id_temp'].'" class="btnborrar" onclick="confirmacion();">borrar</a>
                        </td>
                    </tr>
                    ';
                }
                $total = round($total);

                $detalleTotales = '
                <tr class="trfoot">
                    <td class="totales">TOTAL</td>
                </tr>
                <tr class="trfoot">
                    <td class="totales" id="total">'.$total.'</td>
                </tr>
                ';
                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
        } else {
            echo 'error';
        }
        mysqli_close($conex);
    } else {
        echo 'error';
    }
    exit;
    
}
//extrae datos del detalletemp
if($_POST['action'] == 'serchForDetalle')
{
        
            $consultar = mysqli_query($conex, "SELECT * FROM insumotemp");

            $result = mysqli_num_rows($consultar);

            $detalleTabla = '';
            $total = 0;
            $arrayData = array();

            if ($result > 0){
                while ($data = mysqli_fetch_assoc($consultar)){
                    $total = round($total + $data['Precio_total']);
                    
                    $detalleTabla .= '
                    <tr class="prod">
                        <td class="prods">'.$data['ID_PRODUCTO'].'</td>
                        <td class="prods">'.$data['Producto'].'</td>
                        <td class="prods">'.$data['Cantidad'].'</td>
                        <td class="prods">'.$data['Precio'].'</td>
                        <td class="prods">'.$data['Precio_total'].'</td>
                        <td class="prods">
                            <a href="eliminar/elimdetalles.php?id='.$data['Id_temp'].'" class="btnborrar" onclick="confirmacion();">borrar</a>
                        </td>
                    </tr>
                    ';
                }
                $total = round($total);

                $detalleTotales = '
                <tr class="trfoot">
                    <td class="totales">TOTAL</td>
                </tr>
                <tr class="trfoot">
                    <td class="totales" id="total">'.$total.'</td>
                </tr>
                ';
                $arrayData['detalle'] = $detalleTabla;
                $arrayData['totales'] = $detalleTotales;

                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
        } else {
            echo 'error';
        }
        mysqli_close($conex);
    
    exit;
    
}

//cancelarventa
if($_POST['action'] == 'cancelarVenta'){

    $query = mysqli_query($conex, "DELETE FROM insumotemp");
    mysqli_close($conex);
    if ($query) {
        echo 'ok';
    } else {
        echo 'error';
    }
    exit;
}

//factura
if($_POST['action'] == 'facturar')
{
    if (!empty($_POST['nitcliente']) && !empty($_POST['descripcion'])) {

    $nitcliente = $_POST['nitcliente'];
    $descripcion = $_POST['descripcion'];
    $vendedor = $_SESSION['idempleado'];
    $fecha = $_POST['fecha'];
    $total = $_POST['total'];
       $select = mysqli_query($conex, "SELECT Id_factura FROM facturas");
       $result = mysqli_num_rows($select);
       $idfactura = $result + 1;
        $arrayData = array();
       $arrayData['idfactura'] = $idfactura;
       $arrayData['nitcliente'] = $nitcliente;

        $query = mysqli_query($conex, "INSERT INTO facturas(Id_factura, Descripcion_factura, Fecha_factura, Total_factura, ID_PERSONAL, ID_CLIENTE) VALUES ('$idfactura','$descripcion','$fecha','$total','$vendedor','$nitcliente')");
        $querytem = mysqli_query($conex,"SELECT * FROM insumotemp");
        $resultem = mysqli_num_rows($querytem);
        if($resultem > 0){
            while ($arreglo = mysqli_fetch_assoc($querytem)) {
                $idproducto = $arreglo['ID_PRODUCTO'];
                $cantidad = $arreglo['Cantidad'];
                $precio = $arreglo['Precio'];
                $queryde = mysqli_query($conex, "INSERT INTO insumosfactura(ID_PRODUCTO, ID_FACTURA, Cantidad, Precio) VALUES ('$idproducto','$idfactura','$cantidad','$precio')");
                
            }
            $query = mysqli_query($conex, "DELETE FROM insumotemp");
            
                } else {
                    echo 'error';
                }
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);   
                mysqli_close($conex);
            } else {
                echo 'campo vacio';
            }
}

exit;