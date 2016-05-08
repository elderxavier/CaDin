<?php
/* * *********************************************************
 * @ Package Cadin 
 * @Pages Index
 * @ Date 20016/04/18 
 * @Created update 2016/04/18
 * @Last update 2016/04/18
 * @ Developer Elder Xavier
 * @ Email eldersxavier@gmail.com / contato@elderxavier.com
 * @Description: This page for login users or create new accounts
 * ********************************************************* */
session_start();
if (isset($_SESSION['user'])) { 
    header('Location: ./index.php');
    } else {        
include_once 'include/config.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cadin Login</title>
        <!-- CSS -->        
        <link rel="stylesheet" href="./assets/css/bootstrap.css">
        <link rel="stylesheet" href="./assets/css/font-awesome.css">
        <link rel="stylesheet" href="./assets/css/form-elements.css">
        <link rel="stylesheet" href="./assets/css/loginstyle.css">      
        <link rel="stylesheet" href="./assets/css/sweetalert.css">        
        <!-- Favicon and touch icons -->       

    </head>
    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="load">
                <img src="<?php echo $_URLSITE ?>/assets/img/load.gif">
            </div>            
            <div class="inner-bg page-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1>Login</h1>
                            <div class="description">
                                <p>
                                    Use o CaDin para controlar suas finanças, é simples prático e feito para você!
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">

                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Entrar</h3>
                                        <p>Entre com seu usuário e senha:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-key"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="javascript:void(0)" method="post" class="login-form">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-username">Usuário</label>
                                            <input type="text" name="form-username" placeholder="Usuário..." class="form-username form-control" id="form-username">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-password">Senha</label>
                                            <input type="password" name="form-password" placeholder="Senha..." class="form-password form-control" id="form-password">
                                        </div>
                                        <button type="submit" class="btn btn-login">Entrar</button>
                                    </form>
                                </div>
                            </div>
                            <!--
                            <div class="social-login">
                                <h3>...or login with:</h3>
                                <div class="social-login-buttons">
                                    <a class="btn btn-link-1 btn-link-1-facebook" href="http://azmind.com/demo/bootstrap-login-register-forms/form-3/index.html#">
                                        <i class="fa fa-facebook"></i> Facebook
                                    </a>
                                    <a class="btn btn-link-1 btn-link-1-twitter" href="http://azmind.com/demo/bootstrap-login-register-forms/form-3/index.html#">
                                        <i class="fa fa-twitter"></i> Twitter
                                    </a>
                                    <a class="btn btn-link-1 btn-link-1-google-plus" href="http://azmind.com/demo/bootstrap-login-register-forms/form-3/index.html#">
                                        <i class="fa fa-google-plus"></i> Google Plus
                                    </a>
                                </div>
                            </div>
                            -->

                        </div>

                        <div class="col-sm-1 middle-border"></div>
                        <div class="col-sm-1"></div>

                        <div class="col-sm-5">

                            <div class="form-box">
                                <div class="form-top">
                                    <div class="form-top-left">
                                        <h3>Criar conta</h3>
                                        <p>Crie sua conta e aproteote o CaDin:</p>
                                    </div>
                                    <div class="form-top-right">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                </div>
                                <div class="form-bottom">
                                    <form role="form" action="javascript:void(0)" method="post" class="registration-form">
                                        <div class="form-group">
                                            <label class="sr-only" for="form-first-name">Nome</label>
                                            <input type="text" name="form-first-name" placeholder="Nome..." class="form-first-name form-control" id="form-first-name">
                                        </div>                                        
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Email</label>
                                            <input type="text" name="form-email" placeholder="Email..." class="form-email form-control" id="form-email">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">Senha</label>
                                            <input type="password" name="form-add-psw" placeholder="Senha..." class="form-email form-control" id="form-add-psw">
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="form-email">confirmar Senha</label>
                                            <input type="password" name="form-add-psw-conf" placeholder="Confirmar..." class="form-email form-control" id="form-add-psw-conf">
                                        </div>                                        
                                        <button type="submit" class="btn btn-adduser">Criar Conta</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">

                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="footer-border"></div>
                        <p>Made by Anli Zaimi at <a href="http://azmind.com/" target="_blank"><strong>AZMIND</strong></a> 
                            having a lot of fun. <i class="fa fa-smile-o"></i></p>
                    </div>

                </div>
            </div>
        </footer>

        <!-- Javascript -->
        <script src="<?php echo $_URLSITE ?>/assets/js/lib/jquery-2.2.3.min.js"></script>
        <script src="<?php echo $_URLSITE ?>/assets/js/lib/bootstrap.min.js"></script> 
        <script src="<?php echo $_URLSITE ?>/assets/js/lib/sweetalert.min.js"></script>            
        <script src="<?php echo $_URLSITE ?>/assets/js/loginController.js"></script>
    </body>
</html>
 <?php
}
