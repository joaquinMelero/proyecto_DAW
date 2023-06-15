<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Acceso</title>
        <link rel=stylesheet href="styles/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script src="operability/login.js"></script>
    </head>
    <body class="body">
        
        <div id='body' class="container">

        <div id="contenedor" class=" wrapper lato fontSizeMedio">


            <div id="divlogin">
                
                <img src="resources/logo-trans.png" width="40%">

                <h1 class="fontWhite">Accede a tu cuenta</h1>
                
                <table class="tableReg">
                    
                    <tr><td><input class="camposLogin " type="text" name="userAcceso"  id="user" placeholder="Usuario" autocomplete="off" maxlength="60" required></td></tr>
                    <tr><td><input class="camposLogin" type="password" name="passAcceso" id="pass" placeholder="Contraseña" autocomplete="off" maxlength="60" required></td></tr>
 
                </table>
                
                <button class="block-btn-green button1" id="acceso">Acceder</button>
                <br>
                <br>

                <h5 id="newUser" class="colorWhite">Registar Nuevo Usuario</h5> 
                
                   <br> 

                <p id="registerOk" style="color:white"></p>

            </div>
            
            <div id="register" class="visibility">
                
                <h2 class="fontWhite">Registro de Nuevo Usuario</h2>

                <table class="tableReg">

                    <tr><td><input class="camposLogin" type="text" id="newName" placeholder="Descripción de usuario" required></td>
                        <td><input class="camposLogin" type="text" id="newUserRe" placeholder="Nuevo Usuario" required></td></tr>
                    <tr><td><input class="camposLogin" type="password" id="newPass" placeholder="Nueva Contraseña" required></td>
                        <td><select id="certification" name="select" class="form-select selectForm camposLogin">
                                <option disabled="disabled" selected>Selecciona </option>
                                <option value="programacion">Programación</option>
                                <option value="administracion">Administración</option>
                                <option value="marketing">Marketing</option>
                                <option value="empleado">Empleado</option>
                            </select></td></tr>
                </table>
                
                <input id="buttonRe" class="block-btn-green button1" type="submit" value="Registar">
  
            </div>
            
            <div style="margin-top: 4%; color:white;">
                <p>© 2023</p>
                <p>Joaquín Melero</p>
            </div>

        </div>

       

        </div>

        <!-- creo un div oculto que se habilita cuando se pulsa registrar añadir desde style  -->

    </body>
</html>

