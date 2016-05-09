<!-- /. NAV TOP  -->
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">                
                <?php                
                $foto = '/assets/img/find_user.png';
                if (isset($_SESSION['user']['foto']) && $_SESSION['user']['foto'] != '' && !is_null($_SESSION['user']['foto'])) {
                    $foto = '/' . $_SESSION['user']['foto'];
                    $pass = explode('cadin', $foto);                    
                    $foto =$pass[1];
                }
                ?>
                <img src="<?php echo $_URLSITE . $foto ?>" class="user-image img-responsive"/>
            </li>
            <li><a  class="item-menu menu-index active-menu" href="javascript:void(0)" data-target="page-inner-financas"><i class="fa fa-table fa-3x"></i> Finanças</a></li>            
            <li><a class="item-menu menu-grafico" href="javascript:void(0)" data-target="page-inner-grafico"><i class="fa fa-bar-chart-o fa-3x"></i>Gráficos</a></li>
            <li><a  class="item-menu menu-conta" href="javascript:void(0)" data-target="page-inner-conta"><i class="fa fa-desktop fa-3x"></i> Minha Conta</a></li>                      
        </ul>               
    </div>            
</nav>