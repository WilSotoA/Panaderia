 <?php
  
    include "../include/conexion.php";
    $salida = "";
    $query = "SELECT * FROM clientes ORDER By Id_cliente";
    
    if(isset($_POST['consulta'])){
        $q = $conex->real_escape_string($_POST['consulta']);
        $query = "SELECT * FROM clientes WHERE Id_cliente LIKE '%".$q."%'";  
    }
    
    $resultado=$conex->query($query);
    
    if($resultado->num_rows > 0){
        
        $salida.="<table class='tabla'>
                <tr class='tr'>
                <th class='th'>Codigo Cliente</th>
                <th class='th'>Nombre Cliente</th>
                <th class='th'>Apellido Cliente</th>
                <th class='th'>Direccion Cliente</th>
                <th class='th'>Telefono Cliente</th>
                <th class='th'>Correo Cliente</th>
                <th class='th'>Modificar Cliente</th>"; 
        
        while($fila = $resultado->fetch_assoc()){
         $salida.="<tr class='tr'>
             <td class='td'>".$fila['Id_cliente']."</td>
                 <td class='td'>".$fila['Nombre_cliente']."</td>
                 <td class='td'>".$fila['Apellido_cliente']."</td>
                     <td class='td'>".$fila['Direccion_cliente']."</td>
                         <td class='td'>".$fila['Telefono_cliente']."</td>
                         <td class='td'>".$fila['Correo_cliente']."</td>
                             <td class='td'><a class='item' href='Actualizar/act_cliente.php?id=".$fila['Id_cliente']."'><img class='action' src='../images/edit.png'/></a>"
                 . "<a href='eliminar/cliente.php?id=".$fila['Id_cliente']."' class='item item_link' onclick='confirmacion()'><img class='action' src='../images/delete.png'/></a></td>
                             </tr>";           
        }      
        $salida.="</table>";
        
    } else {
        
        $salida.="No se encontro registro del cliente";
        
    }
    
    echo $salida;
    
    $conex->close();
    
    ?> 

