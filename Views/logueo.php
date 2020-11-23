<html>
    <head>
        <meta charset="UTF-8"/>
        <title> Logeo </title>
        <script type="text/javascript" src="./Views/js/jQuery.js"></script>
       <!-- <script type="text/javascript" src="./Views/js/javascript.js"></script> -->
        <style>
            body {
                padding: 0px;
                margin: 0px;
            }

            .container {
                background-color: white;
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #login {
                width: 50%;
                height: 50%;
                display: flex;
            }

            #imagen {
                background-image: url("./Views/IMG/paquetes.PNG");
                 width: 60%;
                 height: 100%;
             }

            #formulario {
                width: 40%;
                padding-left: 10px;
                height: 40%;
            }

        </style>
    </head>
    <body>
        <div class="container">
                <div id="login">
                    <div id="imagen"></div>
                    <div id="formulario">
                        <h1> Login : </h1>
                        <form action="./index.php" method="POST">
                        usuario: <br/>
                        <input type="text" id="usuario" name="username" placeholder="nombre de usuario" required/>  <br/>
                        password: <br/>
                        <input type="text" id="password" name="password" placeholder="contraseña" required> <br/><br/>

                        No tiene cuenta <a id="registrarse" href="#">Registrate</a>.<br/>

                        <button id="enter">Entrar</button>
                        </form>
                        <div id="error">
                            <?php
                                if(isset($errorLogin)) {
                                    echo $errorLogin;
                                }
                            ?>
                        </div>
                    </div>
                </div>
        </div>

    </body>
</html>