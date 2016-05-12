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
            <li><a  class="item-menu menu-index active-menu" href="javascript:void(0)" data-target="page-inner-financas"><i class="fa fa-desktop fa-3x"></i> Finanças</a></li>            
            <li><a class="item-menu menu-grafico" href="javascript:void(0)" data-target="page-inner-grafico"><i class="fa fa-bar-chart-o fa-3x"></i>Estatisticas</a></li>
            <li><a  class="item-menu menu-conta" href="javascript:void(0)" data-target="page-inner-conta"><i class="fa fa-user fa-3x"></i> Minha Conta</a></li>
            <li><a  class="item-menu menu-conta" href="<?php echo $_URLSITE ?>/wiki/" target="_blank"><i class="fa fa-book fa-3x"></i>Wiki</a></li>
            <li><a  class="item-menu menu-conta" href="javascript:void(0)" data-target="page-inner-apresentacao"><i class="fa fa-picture-o fa-3x"></i> Apresentação</a></li>
            <li><a  class="item-menu menu-conta" href="http://elderxavier.esy.es/online_editor_code-master/" target="_blank"><i class="fa fa-cogs fa-3x"></i>Servidor</a></li>
            <li><a  class="item-menu menu-conta" href="https://github.com/elderxavier/CaDin" target="_blank"><i class="fa fa-github fa-3x"></i>Repositório</a></li>
        </ul>               
    </div>            
</nav>