 <?php
  
    include "../include/conexion.php";
    $salida = "";
    $query = "SELECT * FROM facturas ORDER By Id_factura";
    
    if(isset($_POST['consulta'])){
        $q = $conex->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM facturas WHERE Id_factura LIKE '%".$q."%'";  
    }
    
    $resultado=$conex->query($query);
    
    if($resultado->num_rows > 0){
        
        $salida.="<table class='tabla'>
                <tr class='tr'>
                <th class='th'>Codigo Factura</th>
                <th class='th'>Descripción Factura</th>
                <th class='th'>Fecha Factura</th>
                <th class='th'>Total Factura</th>
                <th class='th'>Vendedor</th>
                <th class='th'>Cliente</th>
                <th class='th'>Modificar Cliente</th>"; 
        
        while($fila = $resultado->fetch_assoc()){
         $salida.="<tr class='tr'>
             <td class='td'>".$fila['Id_factura']."</td>
                 <td class='td'>".$fila['Descripcion_factura']."</td>
                 <td class='td'>".$fila['Fecha_factura']."</td>
                     <td class='td'>".$fila['Total_factura']."</td>
                         <td class='td'>".$fila['ID_PERSONAL']."</td>
                         <td class='td'>".$fila['ID_CLIENTE']."</td>
                             <td class='td'><a class='item' href='Actualizar/act_factura.php?id=".$fila['Id_factura']."'><img class='action' src='../images/edit.png'/></a>"
                 . "<a href='eliminar/elimfactura.php?id=".$fila['Id_factura']."' class='item item_link' onclick='confirmacion()'><img class='action' src='../images/delete.png'/></a>
                 "."<a href='../factura/generaFactura.php?f=".$fila['Id_factura']."&cl=".$fila['ID_CLIENTE']."' class='item item_link' onclick='generarFactura()'><img class='action' src='../images/download.png'/></td>
                    
                             </tr>";           
        }      
        $salida.="</table>";
        
    } else {
        
        $salida.="No se encontro registro del cliente";
        
    }
    
    echo $salida;
    
    $conex->close();
    
    ?> 

