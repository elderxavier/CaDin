<div id="page-inner-conta" class="page-inner hidden">
    <div class="row">
        <div class="col-md-12">
            <h2>Minha Conta</h2>   
            <h5>Bem vindo <strong><?php echo $_SESSION['user']['nome'] ?> </strong>! Acesse os dados da sua conta</h5>
        </div>
    </div>
    <!-- /. ROW  -->
    <hr />
    <div class="row"> 
        <div class="col-md-6 col-sm-12 col-xs-12">                     
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Adicionar uma Foto</h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                        <div class="col-md-6 col-sm-12 col-xs-12"> 
                            <?php
                            $foto = '/assets/img/find_user.png';
                            if (isset($_SESSION['user']['foto']) && $_SESSION['user']['foto'] != '' && !is_null($_SESSION['user']['foto'])) {
                                $foto = '/' . $_SESSION['user']['foto'];
                                $pass = explode('cadin', $foto);
                                $foto = $pass[1];
                            }
                            ?>
                            <img src="<?php echo $_URLSITE . $foto ?>" class="user-image img-responsive" id="user-foto"/>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12"> 
                        <input type="file" id="uploadimag" accept="image/*" class="btn btn-default">
                    </div>
                </div>
            </div>            
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">                     
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Alterar Senha</h3>
                </div>
                <div class="panel-body">
                    <div class="form-box">
                        <div class="form-top">
                            <div class="form-top-left">                                
                                <p>Alterare sua senha preenchendo os campos corretamente</p>                                
                            </div>                            
                        </div>
                        <br>
                        <div class="form-bottom col-md-12 col-sm-12 col-xs-12">
                            <form role="form" action="javascript:void(0)" method="post" class="newpassword-form">                                
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="form-email">Senha Atual</label>
                                    <input type="password" name="form-old-psw" placeholder="Senha Atual..." class="form-email form-control" id="form-old-psw">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="form-email">Nova Senha</label>
                                    <input type="password" name="form-new-psw" placeholder="Nova Senha..." class="form-email form-control" id="form-new-psw">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="form-email">confirmar Senha</label>
                                    <input type="password" name="form-add-psw-conf" placeholder="Confirmar..." class="form-email form-control" id="form-add-psw-conf">
                                </div>
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <span class="btn btn-info update-password">Criar Conta</span>                                
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div> 
    </div>
    <!-- /. ROW  -->
    <div class="row">                     
        <div class="col-md-12 col-sm-12 col-xs-12">   
            <?php $address = $helper->getEndereco()[0];?>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Alterar endereço</h3>
                </div>
                <div class="panel-body">
                    <div class="form-bottom col-md-12 col-sm-12 col-xs-12">
                            <form role="form" action="javascript:void(0)" method="post" class="address-form"> 
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <?php $cep = substr($address['cep'],0, -3)."-".$cep1 = substr($address['cep'], -3);?>
                                    <label class="sr-only" for="cidade">CEP</label>
                                    <input type="text" name="cep" placeholder="CEP..." class="form-email form-control" id="cep" value="<?php echo $cep ?>">
                                </div>
                                <div class="form-group col-md-8 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="logradouro">Endereço</label>
                                    <input type="text" name="logradouro" placeholder="Endereço..." class="form-email form-control" id="logradouro" value="<?php echo $address['logradouro']  ?>">
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="numero">Número</label>
                                    <input type="text" name="numero" placeholder="Numero..." class="form-email form-control" id="numero" value="<?php echo $address['numero']  ?>">
                                </div>                                
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="complemento">Complemento</label>
                                    <input type="text" name="complemento" placeholder="Complemento..." class="form-email form-control" id="complemento" value="<?php echo $address['complemento']  ?>">
                                </div>
                                <div class="form-group col-md-4 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="bairo">Bairo</label>
                                    <input type="text" name="bairo" placeholder="Bairo..." class="form-email form-control" id="bairo" value="<?php echo $address['bairo']  ?>">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="cidade">Cidade</label>
                                    <input type="text" name="cidade" placeholder="Cidade..." class="form-email form-control" id="cidade" value="<?php echo $address['cidade']  ?>">
                                </div> 
                                <div class="form-group col-md-2 col-sm-12 col-xs-12">
                                    <label class="sr-only" for="uf_estado">UF</label>
                                    <input type="text" name="uf_estado" placeholder="UF..." class="form-email form-control" id="uf_estado" value="<?php echo $address['uf_estado']  ?>">
                                </div> 
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <span class="btn btn-info update-adress">Salvar</span> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
        </div>         
    </div>
    <!-- /. ROW  -->
<!-- /. PAGE INNER  -->