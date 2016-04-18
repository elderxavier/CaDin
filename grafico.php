<?php
include_once 'include/config.php';
$_PAGETITLE = 'Cadin - Gráficos';
?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="pt-br"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js lt-ie9 lt-ie8" lang="pt-br"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js lt-ie9" lang="pt-br"><![endif]-->
<!--[if (IE 9)]><html class="no-js ie9" lang="pt-br"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="pt-br"> <!--<![endif]-->
    <?php include_once 'include/block/head.php' ?> </head>
<body>
    <div id="wrapper">
        <?php include 'include/block/header.php'?>        
        <?php include 'include/block/block_menu.php'?> 
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Morris Charts</h2>   
                        <h5>Welcome Jhon Deo , Love to see you back. </h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row"> 
                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Bar Chart Example
                            </div>
                            <div class="panel-body">
                                <div id="morris-bar-chart"></div>
                            </div>
                        </div>            
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Area Chart Example
                            </div>
                            <div class="panel-body">
                                <div id="morris-area-chart"></div>
                            </div>
                        </div>            
                    </div> 
                </div>
                <!-- /. ROW  -->
                <div class="row">                     
                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Donut Chart Example
                            </div>
                            <div class="panel-body">
                                <div id="morris-donut-chart"></div>
                            </div>
                        </div>            
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">                     
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Line Chart Example
                            </div>
                            <div class="panel-body">
                                <div id="morris-line-chart"></div>
                            </div>
                        </div>            
                    </div> 
                </div>
                <!-- /. ROW  -->
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <?php include_once 'include/block/footer.php' ?>     
    <!-- MORRIS CHART SCRIPTS -->
    <script src="<?php echo $_URLSITE?>/assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="<?php echo $_URLSITE?>/assets/js/morris/morris.js"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="<?php echo $_URLSITE?>/assets/js/graficoController.js"></script>
</body>
</html>
