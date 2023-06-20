<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="miembros_equipo.css">
    <title>Miembros de Equipos</title>
</head>
<body>
    <?php
    //conectamos la base de datos
        $conexion=mysqli_connect("localhost","root","","sistema_tareas") or die("Problemas con la conexión");
    ?>
    <form method="post">

        <div class="header">
            <h1 class="titulo">MIEMBROS EQUIPOS</h1>
        </div>
        <button class="botonEquipos">Equipos</button>
        <table class="tabla">
            <tr>
                <th>ID</th>
                <th>Nombres</th>
                <th>Roles</th>
            </tr>
            <tr>
                <td><input type="number" style="width:40px" name="id"></td>
                <td><input type="text" style="width: 75px" name="nombres"></td>
                <td>
                    <select name="rol" style="width: 120px">
                    <option selected></option>
                    <option value="Analista">Analista</option>
                    <option value="Consultor">Consultor/a</option>
                    <option value="Desarrollador">Desarrollador/a</option>
                    <option value="Diseñador">Diseñador/a</option>
                    <option value="Gerente">Gerente</option>
                    <option value="Tester">Tester</option>
                    </select>
                </td>
            </tr>
            <tr>
            <?php
                if(isset($_POST["listar"])){
                    //llamamos todos los datos de la tabla y los mostramos en la pagina
                    $consulta="select * from miembros_equipo";
                    $resultado=mysqli_query($conexion,$consulta);
                    while($row=mysqli_fetch_assoc($resultado)){
                        echo "<tr>";
                        echo "<td>".$row['me_ID']."</td>";
                        echo "<td>".$row['Nombre']."</td>";
                        echo "<td>".$row['Rol']."</td>";
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
                if($_POST["id"]>=1 && strlen($_POST["nombres"])>=3 && strlen($_POST["rol"])>=3){
                    mysqli_query($conexion,"insert into miembros_equipo(me_ID,Nombre,Rol) 
                    values ($_REQUEST[id],'$_REQUEST[nombres]','$_REQUEST[rol]')")
                    or die("Problemas en la carga de datos".mysqli_error($conexion));
                    mysqli_close($conexion);
                    echo "<script>alert('Miembro creado con exito');</script>";
                }else{
                    echo "<script>alert('Por favor llene todos los campos');</script>";
                }
            }
            if(isset($_POST["actualizar"])){
                $id=$_REQUEST["id"];
                $nombres=$_REQUEST["nombres"];
                $rol=$_REQUEST["rol"];
                $consulta="update miembros_equipo SET me_ID='$id',Nombre = '$nombres',Rol='$rol'
                WHERE me_ID='$id';";
                mysqli_query($conexion,$consulta);
                echo "<script>alert('Miembro actualizado correctamente');</script>";
            }
            if (isset($_POST["eliminar"])){
                $parametro=$_REQUEST["id"];
                $consulta="delete from miembros_equipo where me_ID= '$parametro';";
                mysqli_query($conexion,$consulta);
                echo "<script>alert('El miembro se ha eliminado');</script>";
            }
        ?>  
        <table class="tabdes">
            <tr>
                <th>Tarea a desarrollar</th>
                <th>Proyecto</th>
            </tr>
            <tr>
                <?php
                    if(isset($_POST["buscar"])){
                        $id=$_REQUEST["id"];
                        $consulta="select tareas.Descripcion, proyectos.Nombre 
                        from tareas join proyectos on tareas.pro_ID=proyectos.pro_ID 
                        where tareas.me_ID='$id';";
                        $resultado=mysqli_query($conexion,$consulta);
                        while($row=mysqli_fetch_assoc($resultado)){
                            echo "<tr>";
                            echo "<td>".$row['Descripcion']."</td>";
                            echo "<td>".$row['Nombre']."</td>";
                            echo "</tr>";
                        } 
                    }
                ?>
            </tr>
        </table>
        <br>
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