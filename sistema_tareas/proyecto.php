<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="proyecto.css">
    <title>Proyectos</title>
</head>
<body>
    <?php
        //conectamos la base de datos
        $conexion=mysqli_connect("localhost","root","","sistema_tareas") or die("Problemas con la conexión");
    ?>
        <form method="post">
        <div class="header">
            <h1 class="titulo">PROYECTOS</h1>
        </div>
        <button class="botonEquipos">Proyectos Asignados</button>
        <table class="tabla">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
            </tr>
            <tr>
            <td><input type="number" style="width:40px" name="id"></td>
                <td><input type="text" style="width: 75px" name="nombre"></td>
            </tr>
            <tr>
                <?php
                    if(isset($_POST["listar"])){
                        //llamamos todos los datos de la tabla y los mostramos en la pagina
                        $consulta="select pro_ID,Nombre_proyecto from proyectos";
                        $resultado=mysqli_query($conexion,$consulta);
                        while($row=mysqli_fetch_assoc($resultado)){
                            echo "<tr>";
                            echo "<td>".$row['pro_ID']."</td>";
                            echo "<td>".$row['Nombre_proyecto']."</td>";
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
                if($_POST["id"]>=1 && strlen($_POST["nombre"])>=3 && strlen($_POST["descripcion"])>=3){
                    mysqli_query($conexion,"insert into proyectos(pro_ID,Nombre_proyecto,Descripcion) 
                    values ($_REQUEST[id],'$_REQUEST[nombre]','$_REQUEST[descripcion]')")
                    or die("Problemas en la carga de datos".mysqli_error($conexion));
                    mysqli_close($conexion);
                    echo "<script>alert('Proyecto creado con exito');</script>";
                }else{
                    echo "<script>alert('Por favor llene todos los campos');</script>";
                }
            }
            if(isset($_POST["actualizar"])){
                $id=$_REQUEST["id"];
                $nombres=$_REQUEST["nombre"];
                $desc=$_REQUEST["descripcion"];
                $consulta="update proyectos SET pro_ID='$id',Nombre_proyecto = '$nombre',Descripcion='$desc'
                WHERE pro_ID='$id';";
                mysqli_query($conexion,$consulta);
                echo "<script>alert('Proyecto actualizado correctamente');</script>";
            }
            if (isset($_POST["eliminar"])){
                $parametro=$_REQUEST["id"];
                $consulta="delete from proyectos where pro_ID= '$parametro';";
                mysqli_query($conexion,$consulta);
                echo "<script>alert('El proyecto se ha eliminado');</script>";
            }
        ?>
        <table class="tabdes">
        <tr>
            <th>Descripcion de proyecto</th>

        </tr>
        <tr>
            <td><input type="text" name="descripcion" id="descripcion" style="width:96%"></td>
        </tr>
        <tr>
            <?php
                if(isset($_POST["buscar"])){
                    $id=$_REQUEST["id"];
                    $consulta="select Descripcion from proyectos where pro_ID='$id';";
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