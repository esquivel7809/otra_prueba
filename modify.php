<?php
 include_once('functions/bd_conn.php');
$name = $_GET['cod']; 
$sql="SELECT * FROM productos WHERE id = '$name'";
$cs = mysqli_query($con, $sql);

$sqldates="SELECT DATEDIFF(CURDATE(), (select MAX(date) from productos where productos.id = '$name'))";
    $csdates = mysqli_query($con,$sqldates);
    while($resul=mysqli_fetch_array($csdates))
			{
                $fecha=$resul[0];
                if ($fecha >= 90)
			        {
                        $msj = "Contactar al Aprendiz";
                    }
                    else{
                        $msj = "Tiempo pertienen de legalización";
                    }
                    

while($item = mysqli_fetch_assoc($cs))  //para devolver todo un arreglo de la consulta, es decir las columnas
        {
            echo '
                <li class="item">
                <div class="title">
                        <h4>'.$item['id'].'</h4>
                    </div>
                    <div class="img">
                        <img src="'.$item['img'].'">
                    </div>
                    <div class="title">
                        <h4>'.$item['name'].'</h4>
                    </div>
                    <div class="price">
                        <span>'.$item['date'].'</span>
                    </div>
                    
                    <div class="fecfin">
                    <h4>Dias transcurridos desde que inicio la legalización de la etapa productiva  '.$fecha.'  dias '.$msj.' </h4>
                </div>
                </li>
            ';
        }}
?>