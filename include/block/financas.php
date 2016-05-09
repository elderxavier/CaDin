
<div id="page-inner-financas" class="page-inner">
    <div class="row">
        <div class="col-md-12">
            <h2>Controle de finanças</h2>   
            <h5>Controle suas finanças de forma simples e rapida. </h5>
        </div>
    </div>
    <div class="form-box">        
        <div class="form-bottom">
            <form role="form" action="javascript:void(0)" method="post" class="additem-form">
                <div class="form-group col-md-2 col-xs-12">
                    <select class="form-password form-control" id="tipo">
                        <?php
                        $sql = "select `id`,`descricao` from `cadin_financa_tipo`";
                        $p_sql = Conexao::getInstance()->query($sql);
                        $itens = $p_sql->fetchAll(PDO::FETCH_ASSOC);
                        if ($itens) {
                            foreach ($itens as $key => $value) {
                                echo '<option value="' . $value['id'] . '">' . $value['descricao'] . '</option>';
                            }
                        }
                        ?>
                    </select>                    
                </div>
                <div class="form-group col-md-2 col-xs-12">
                    <label class="sr-only" for="valor">Valor</label>
                    <input type="text" name="valor" placeholder="R$" class="form-control" id="valor">
                </div>                
                <div class="form-group col-md-3 col-xs-12">
                    <label class="sr-only" for="valor">Local</label>
                    <input type="text" name="local" placeholder="Ex: Bar Lada Nigth " class="form-control" id="local">
                </div>
                <div class="form-group col-md-3 col-xs-12">
                    <label class="sr-only" for="created">Data</label>
                    <input type="text" name="created" placeholder="" class="form-control" id="created">
                    <script>
                        (function ($) {
                            $("#created").datepicker({ dateFormat: 'dd/mm/yy' });                            
                        })(jQuery);
                    </script>
                </div>
                <span class="btn btn-financas col-md-2 col-xs-4">Adicionar</button>
            </form>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row">
        <div class="col-md-12" id="table-insert">
            <!-- Advanced Tables -->
            
                <?php echo $helper->getTableFinancaView()?>
                <?php //echo '<pre>', print_r($helper->getTableFinanca()); ?>
            
            <!--End Advanced Tables -->
        </div>
    </div>    
    <!-- /. ROW  -->
</div>