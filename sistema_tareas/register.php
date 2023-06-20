<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

    <title>Register</title>
</head>
<body>
    <h1 class="titulo">REGISTER</h1><br><br>
    <div class="centrado">
        <div class="container">
            <br><br>
            <form method="post">
                <div class="form-group">
                    <label for="name"></label>
                    <img src="iconos/registerusuario.svg" alt="" class="icono">
                    <input type="name" id="name" name="name" placeholder="Name">
                    
                </div>
                <div class="form-group">
                    <label for="email"></label>
                    <img src="iconos/registeremail.svg" alt="" class="icono">
                    <input type="email" id="email" name="email"  placeholder="Email">
                    
                </div>
                <div class="form-group">
                    <label for="password"></label>
                    <img src="iconos/registercandado.svg" alt="" class="icono">
                    <input type="password" id="password" name="password"  placeholder="Password">
                    
                </div><br><br>
                <div class="separador-cupado">
                    <div class="form-group">
                        <label class="check">
                            <input type="checkbox" id="remember" name="remember" class="bx-check">
                            Remember me
                        </label><br>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="ingresar">Ingresar<br>
                        <?php
                            if(isset($_POST["ingresar"])){
                                if(strlen($_POST["name"]) >=3 && strlen($_POST["email"]) >=5 && 
                                strlen($_POST["password"]) >=5){
                                    //Conectamos con la base de datos
                                    $conexion=mysqli_connect("localhost","root","","sistema_tareas") or die("problemas con la conexion");

                                    //creamos la consulta para ingresar los datos a la tabla en nuestra base de datos
                                    mysqli_query($conexion,"insert into users(email,password) values ('$_REQUEST[email]','$_REQUEST[password]')")
                                    or die("Problemas con la insercion de datos".mysqli_error($conexion));

                                    //cerramos la conexion con la base de datos
                                    mysqli_close($conexion);
                                    echo "<script>alert('Usuario creado con éxito');</script>";
                                }else{
                                    echo "<script>alert('Por favor llene todos los campos');</script>";
                                }       
                            }
                        ?>
                    </div> 
                </div>
                <center><div class="form-group-1">
                    <button type="submit" name="cancelar">Cancelar 
                    <?php
                        if(isset($_POST["cancelar"])){
                            header("location:index.php");
                        }
                    ?>
                </div></center>
                <br><br><br>
            </form>
        </div>
    </div>

</body>
</html>
