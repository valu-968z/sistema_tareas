<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title></title>
</head>
<body>

    <h1 class="titulo">GESTOR DE TAREAS</h1><br><br>
    <div class="centrado">
        <div class="container">
            <br><br>
            <form method="post">
                <div class="form-group">
                    <img src="iconos/input-1.svg" alt="">
                    <label for=" email"></label>
                    <input type="email" id="email" name="email"  placeholder="Email or Document">
                </div>
                <div class="form-group">
                    <img src="iconos/input-2.svg" alt="" >
                    <label for="password"></label>
                    <input type="password" id="password" name="password" placeholder="Password">
                </div><br><br>
                <div class="separador-cupado">
                    <div class="form-group">
                        <label class="check">
                            <input type="checkbox" id="remember" name="remember" class="bx-check">
                            Remember me
                        </label>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="register">Register</button>
                    </div>
                    <div class="form-group-1">
                        <button type="submit" name="login">LOGIN</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
<?php
    //damos funcionalidad al boton register
    if (isset($_POST["register"])){
        header("location:register.php");
    }

    //damos funcionalidad al boton login
    if (isset($_POST["login"])){

        //establecemos conexion con la base de datos
        $conexion=mysqli_connect("localhost","root","","sistema_tareas") or die("Problemas con la conexion");

        //declaramos las variables que utilizaremos para nuestro login
        $email=$_POST["email"];
        $password=$_POST["password"];
        
        //creamos la consulta sql
        $query=mysqli_query($conexion,"select * from users where email='$email' and password='$password'");

        //contamos el numero total de filas que nos arroja la consulta de arriba 
        $nr=mysqli_num_rows($query);

        //hacemos un condicional, donde si nos arroja 1 fila, podemos ingresar, de lo contrario no
        if($nr==1){
            header("location:pag_principal.php");
        }else if($nr!=1){
            echo "<script>alert('Error de Inicio de Sesión');</script>";
        }
    }
?>
</html>