<?php
/* * *********************************************************
 * @ Package Cadin 
 * @Pages Index
 * @ Date 20016/04/18 
 * @Created update 2016/04/18
 * @Last update 2016/04/18
 * @ Developer Elder Xavier
 * @ Email eldersxavier@gmail.com / contato@elderxavier.com
 * @Description: This is the view for page index 
 * ********************************************************* */
include_once 'include/config.php';
include_once 'include/conexao/conexao.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/cadin/include/helpers/helper.php';
$helper = New Helper();
/*if (isset($_COOKIE['cadin'])) {
    $helper->checkUser($_COOKIE['cadin']);
}*/

session_start();
if (isset($_SESSION['user'])) {
    $helper->GeraCookie($_SESSION['user']);    
    ?>
    <!DOCTYPE html>
    <!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="pt-br"> <![endif]-->
    <!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="pt-br"><![endif]-->
    <!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="pt-br"><![endif]-->
    <!--[if (IE 9)]><html class="no-js ie9" lang="pt-br"><![endif]-->
    <!--[if gt IE 8]><!--> <html lang="pt-br"> <!--<![endif]-->
        <?php include_once 'include/block/head.php' ?>    
        <body> 
            <input type="hidden" id="session-user-email" value="<?php echo $_SESSION['user']['email']?>"> 
            <input type="hidden" id="session-user-id" value="<?php echo $_SESSION['user']['id']?>"> 
            <div id="wrapper">        
                <?php include 'include/block/header.php' ?>        
                <?php include 'include/block/block_menu.php' ?>        
                <div id="page-wrapper" >
                    <div class="load">
                        <img src="<?php echo $_URLSITE ?>/assets/img/load.gif">
                    </div>
                    <?php
                    include './include/block/financas.php';
                    include './include/block/graficos.php';
                    include './include/block/conta.php';
                    include './include/block/apresentacao.php';
                    ?>
                </div>
                <!-- /. PAGE INNER  -->
            </div>            
            <!-- /. PAGE WRAPPER  -->
            <!-- /. WRAPPER  -->                
            <?php include_once 'include/block/footer.php' ?>             
            <script src="<?php echo $_URLSITE ?>/assets/js/lib/bootstrap.min.js"></script> 
            <script src="<?php echo $_URLSITE ?>/assets/js/lib/dataTables/jquery.dataTables.js"></script>
            <script src="<?php echo $_URLSITE ?>/assets/js/lib/dataTables/dataTables.bootstrap.js"></script>              
            <script src="<?php echo $_URLSITE ?>/assets/js/lib/jquery.maskMoney.min.js"></script>            
            <!-- CUSTOM SCRIPTS -->        
            <script src="<?php echo $_URLSITE ?>/assets/js/indexController.js"></script>
            <script src="<?php echo $_URLSITE ?>/assets/js/graficosController.js"></script>
        </body>
    </html>
    <?php
} else {
    header('Location: ./login');
}
