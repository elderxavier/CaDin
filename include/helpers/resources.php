<?php

/* * *********************************************************
 * @ Package Cadin
 * @ Pages All 
 * @ Date 20016/05/07 
 * @Created 20016/05/07
 * @Last update 20016/05/07
 * @ Developer Elder Xavier
 * @ Email eldersxavier@gmail.com / contato@elderxavier.com
 * @Description: This Class execute Resources function for ajax request;
 * ********************************************************* */

include_once $_SERVER['DOCUMENT_ROOT'] . '/cadin/include/config.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/cadin/include/conexao/conexao.class.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/cadin/include/helpers/crialog.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/cadin/include/helpers/helper.php';

class Resources {

    private $helper;

    public function __construct() {
        $this->helper = New Helper();
    }

    public function Execute() {
        if (isset($_REQUEST['funcao']) && !is_null($_REQUEST['funcao'])) {
            $exe = $_REQUEST['funcao'];
            $this->$exe();
        }
    }

    /*     * *********************************************************
     * Função AddUsers: responsavel por adcionar os itens da pagina finanças no banco de dados
     * ********************************************************* */

    private function AddUsers() {
        $status = 0;
        $msg = '';
        if (isset($_REQUEST['nome']) && isset($_REQUEST['email']) && isset($_REQUEST['senha'])):
            try {
                $sql = "SELECT COUNT(email) as count FROM `cadin_usuario` WHERE `email` = '" . $_REQUEST['email'] . "'";
                $query = Conexao::getInstance()->query($sql);
                $existmmail = $query->fetchall(PDO::FETCH_ASSOC)[0]['count'];
                $query = null;
                if ($existmmail > 0) {
                    $msg = 'Email ja cadastrado!';
                } else {
                    $senha = $this->helper->GeraSenha($_REQUEST['senha']);
                    $sql = "INSERT INTO `cadin_usuario` (`nome`,`email`,`senha`)
                      VALUE('" . $_REQUEST['nome'] . "','" . $_REQUEST['email'] . "','" . $senha . "');
                      ";
                    $query = null;
                    $query = Conexao::getInstance()->exec($sql);
                    if ($query) {
                        $status = 1;
                        $msg = 'Email cadastrado cadastrado com sucesso';
                    }
                    $query = null;
                }
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
        endif;
        $data = array('status' => $status, 'message' => $msg);
        echo json_encode($data);
    }

    /*     * *********************************************************
     * Função CheckUsers: responsavel por checar credenciais do usuario
     * ********************************************************* */

    private function CheckUsers() {
        $status = 0;
        $msg = '';
        if (isset($_REQUEST['email']) && isset($_REQUEST['senha'])) {
            try {
                $sql = "SELECT * FROM `cadin_usuario` WHERE `email` = '" . $_REQUEST['email'] . "'";
                $query = Conexao::getInstance()->query($sql);
                $result = $query->fetchall(PDO::FETCH_ASSOC)[0];
                $senha = $result['senha'];
                $query = null;
                $comp = $this->helper->ComparaSenha($_REQUEST['senha'], $senha);
                if ($comp) {                    
                    session_start();
                    $_SESSION['user']=$result;
                    $status = 1;
                }else{            
                    if(isset($_COOKIE['cadin'])){
                        unset($_COOKIE['cadin']);
                    }
                    $msg='Usuário e senha não coincidem!';
                }
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
            $data = array('status' => $status, 'message' => $msg);
            echo json_encode($data);
        }
    }

    /** *********************************************************
     * Função AddItem: responsavel por adcionar os itens da pagina finanças no banco de dados
     * ********************************************************* */

    private function AddItem() {
        $status = 0;
        $msg = '';
        if (isset($_REQUEST['usuario_id']) && isset($_REQUEST['financa_tipo_id']) && isset($_REQUEST['valor']) && isset($_REQUEST['local']) && isset($_REQUEST['created'])):
            try {
            //STR_TO_DATE('12-01-2014 00:00:00','%d/%m/%Y %H:%i:%s');
                $sql = "INSERT INTO `cadin_financa` (`usuario_id`,`financa_tipo_id`,`valor`,`local`,`created` )
                    VALUE('" . $_REQUEST['usuario_id'] . "','" . $_REQUEST['financa_tipo_id'] . "','" . $_REQUEST['valor'] . "','" . $_REQUEST['local'] . "','".$_REQUEST['created']."');
                 ";
                //VALUE('" . $_REQUEST['usuario_id'] . "','" . $_REQUEST['financa_tipo_id'] . "','" . $_REQUEST['valor'] . "','" . $_REQUEST['local'] . "'STR_TO_DATE('".$_REQUEST['created']."','%d/%m/%Y %H:%i:%s'));
                $query = Conexao::getInstance()->exec($sql);
                if ($query) {
                    $status = 1;
                }
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
        endif;
        $data = array('status' => $status, 'message' => $msg);
        echo json_encode($data);
    }
}

/* execute resource */
$resource = New Resources();
$resource->Execute();

