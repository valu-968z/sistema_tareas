<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="tareas.css">
    <title>Tareas</title>
</head>
<body>
    <?php
        //conectamos la base de datos
        $conexion=mysqli_connect("localhost","root","","sistema_tareas") or die("Problemas con la conexión");
    ?>
    <form method="post">
        <div class="header">
            <h1 class="titulo">TAREAS</h1>
        </div>
        <button class="botonEquipos">Tareas Asignadas</button>
        <table class="tabla">
            <tr>
                <th>ID</th>
                <th>Proyecto</th>
                <th>Encargado</th>
            </tr>
            <tr>
                <td><input type="number" style="width:40px" name="id"></td>
                <td>
                    <select name="proyecto" style="width:100px">
                        <option selected></option>
                        <?php
                            $consulta="select pro_ID, Nombre_proyecto from proyectos";
                            $resultado=mysqli_query($conexion,$consulta);
                            if (mysqli_num_rows($resultado)>0){
                                while($row=mysqli_fetch_assoc($resultado)){
                                    $id=$row["pro_ID"];
                                    $nombre=$row["Nombre_proyecto"];
                                    echo '<option value="'.$id.'">'.$nombre.'</option>';
                                }
                            }
                        ?> 
                    </select>
                </td>
                <td>
                <select name="encargado" style="width:100px">
                        <option selected></option>
                        <?php
                            $consulta="select me_ID, Nombre, Rol from miembros_equipo";
                            $resultado=mysqli_query($conexion,$consulta);
                            if (mysqli_num_rows($resultado)>0){
                                while($row=mysqli_fetch_assoc($resultado)){
                                    $id=$row["me_ID"];
                                    $nombre=$row["Nombre"];
                                    $rol=$row["Rol"];
                                    echo '<option value="'.$id.'">'.$nombre.'/'.$rol.'</option>';
                                }
                            }
                        ?> 
                    </select>
                </td>
            </tr>
            <tr>
                <?php
                    if(isset($_POST["listar"])){
                        //llamamos todos los datos de la tabla y los mostramos en la pagina
                        $consulta="SELECT tareas.tar_ID, proyectos.Nombre_proyecto, miembros_equipo.Nombre
                        FROM tareas
                        JOIN miembros_equipo ON tareas.me_ID = miembros_equipo.me_ID
                        JOIN proyectos ON tareas.pro_ID = proyectos.pro_ID
                        ORDER BY tareas.tar_ID;";
                        $resultado=mysqli_query($conexion,$consulta);
                        while($row=mysqli_fetch_assoc($resultado)){
                            echo "<tr>";
                            echo "<td>".$row['tar_ID']."</td>";
                            echo "<td>".$row['Nombre_proyecto']."</td>";
                            echo "<td>".$row['Nombre']."</td>";
                            echo "</tr>";
                        }  
                    }
                ?>
            </tr>
        </table>
            <div class="botones-container">
                <button type="submit" class="boton" name="listar">Listar</button>
                <button type="submit" class="boton" name="crear">Crear</button>
                <button type="submit" class="boton" name="actualizar">Actualizar</button>
                <button type="submit" class="boton" name="eliminar">Eliminar</button>
            </div>
            <?php
                if(isset($_POST["crear"])){
                    if($_POST["id"]>=1 && strlen($_POST["proyecto"])>=1 && strlen($_POST["encargado"])>=1
                    && strlen($_POST["descripcion"])>=5){
                        mysqli_query($conexion,"insert into tareas(tar_ID,Descripcion,pro_ID,me_ID) 
                        values ($_REQUEST[id],'$_REQUEST[descripcion]',$_REQUEST[proyecto],$_REQUEST[encargado])")
                        or die("Problemas en la carga de datos".mysqli_error($conexion));
                        mysqli_close($conexion);
                        echo "<script>alert('Tarea creada con exito');</script>";
                    }else{
                        echo "<script>alert('Por favor llene todos los campos');</script>";
                    }
                }
                if(isset($_POST["actualizar"])){
                    $id=$_REQUEST["id"];
                    $descripcion=$_REQUEST["descripcion"];
                    $proyecto=$_REQUEST["proyecto"];
                    $encargado=$_REQUEST["encargado"];
                    $consulta="update tareas SET tar_ID='$id',Descripcion = '$descripcion',
                    pro_ID='$proyecto',me_ID='$encargado'
                    WHERE tar_ID='$id';";
                    mysqli_query($conexion,$consulta);
                    echo "<script>alert('Tarea actualizado correctamente');</script>";
                }
                if (isset($_POST["eliminar"])){
                    $parametro=$_REQUEST["id"];
                    $consulta="delete from tareas where tar_ID= '$parametro';";
                    mysqli_query($conexion,$consulta);
                    echo "<script>alert('La tarea se ha eliminado');</script>";
                }
            ?>
        <table class="tabdes">
        <tr>
            <th>Descripcion de Tarea</th>

        </tr>
        <tr>
            <td><input type="text" name="descripcion" style="width:96%"></td>
        </tr>
        <tr>
            <?php
                if(isset($_POST["buscar"])){
                    $id=$_REQUEST["id"];
                    $consulta="select Descripcion from tareas where tar_ID='$id';";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($row=mysqli_fetch_assoc($resultado)){
                        echo "<tr>";
                        echo "<td>".$row['Descripcion']."</td>";
                        echo "</tr>";
                    } 
                }
            ?>
        </tr>
        </table><br>
        <center>
            <button type="submit" class="boton" name="buscar">Buscar</button>
        </center>
        <button type="submit" class="salir-btn" name="salir">Salir</button>
        <?php
            if(isset($_POST["salir"])){
                header("location:pag_principal.php");
            }
        ?>
    </form>
    <img src="iconospie/casita.svg" alt="" class="iconocasita" width="30" height="30">
    <footer class="contendoraFooter">
                <div class="iconop"><br><br>
                    <img src="iconospie/email.svg" alt="" class="iconop" width="30" height="30">
                    <img src="iconospie/youtube.svg" alt="" class="iconop" width="30" height="30">
                    <img src="iconospie/linkedin.svg" alt="" class="iconop" width="30" height="30">
                    <img src="iconospie/comprobacion.svg" alt="" class="iconop" width="30" height="30">
                </div>
                <div class="rectangulo">
                    <p>@Example.com</p>
                    <p>Telefono <img src="iconospie/telefono.svg" alt="">
                    <br><br><br></p>
                    <p>&copy;Copyright</p>
                </div>
    </footer>
</body>
</html>