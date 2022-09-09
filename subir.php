<?php
include_once('functions/bd_conn.php');
if(isset($_POST['submit'])){
    if(is_uploaded_file($_FILES['archivo']['tmp_name'])){
        //print_r ($_FILES);//podemos ver la estructura del arreglo creado
        //crear las variables para subir el archivo a la BD
        $ruta = "upload/";
        $nombre1 = str_replace (' ', '',($_FILES['archivo']['name']));//sirve para eliminar espacios en blanco
       
        $upload= $ruta . $nombre1;

        if(move_uploaded_file($_FILES['archivo']['tmp_name'], $upload))   //se mueve el archivo a la ubicacion
        {
            echo "<b>Cargue exitoso!!. Datos:</b><br>";
            
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $query="INSERT INTO subir_dtos (nombres, descripcion, ruta, tipo, tamano) VALUES ('$nombre', '$descripcion', '".$nombre1."', '".$_FILES['archivo']['type']."', '".$_FILES['archivo']['size']."')";
            $subir = mysqli_query($con,$query);
            echo "El archivo '".$nombre1."' se ha guardado con exito <br>";
        }
    }
}

	
?>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    Seleccione el Archivo: <input name="archivo" type="file" size="200" maxlength="150">
    <br><br>Nombres: <input name="nombre" type="text" size="20" maxlength="70">
    <br><br>Descripción: <input name="descripcion" type="text" size="100" maxlength="200">
<input name="submit" type="submit" value="Cargar Archivo">
</form>

<br><br>MOSTRAR LISTA DE ARCHIVOS CARGADOS

<table>
<tr>
    <td align="center">Codigo</td>
    <td align="center">Nombre Arhcivo</td>
    <td align="center">Tipo Arhcivo</td>
    <td align="center">Accion</td>
    
</tr>
</table>
<?php
//consulta para mostrar los registros
$sql= "SELECT * FROM subir_dtos";
if ($resultado = $con->query($sql))
{
    while ($fila = $resultado->fetch_assoc())
    {
        
    

?>
<table>
<tr>
  <td><?php echo $fila['id'] ?></td>
    <td><?php echo $fila['ruta'] ?></td>
    <td><?php echo $fila['tamano'] ?></td>
    <td><a href="modify.php?accion=modificar&cod='.$fila['id'].'"?>Ver</a></td>
    </tr>
    </table>
<?php }} ?>
</body>