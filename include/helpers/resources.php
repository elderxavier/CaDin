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
                    $query = Conexao::getInstance()->exec($sql);
                    $query = null;

                    $sql = "SELECT `id` FROM `cadin_usuario` ORDER BY `id` desc LIMIT 0,1";
                    $query = Conexao::getInstance()->query($sql);
                    $id = $query->fetchall(PDO::FETCH_ASSOC)[0]['id'];
                    $query = null;

                    $sql = "INSERT INTO `cadin_endereco` (`usuario_id`)
                         VALUE(" . $id . ");
                      ";
                    $query = Conexao::getInstance()->exec($sql);
                    if ($query) {
                        $status = 1;
                        $msg = 'Seu cadastro foi realizado com sucesso ! ';
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
                    $_SESSION['user'] = $result;
                    $status = 1;
                } else {
                    $msg = 'Usuário e senha não coincidem!';
                }
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
            $data = array('status' => $status, 'message' => $msg);
            echo json_encode($data);
        }
    }

    /**     * ********************************************************
     * Função Logout: responsavel exluir sessão do criente
     * ********************************************************* */
    private function Logout() {
        $status = 1;
        $msg = '';
        unset($_SESSION['user']);
        session_start();
        session_destroy();
        $data = array('status' => $status, 'message' => $msg);
        echo json_encode($data);
    }

    /**     * ********************************************************
     * Função AddItem: responsavel por adcionar os itens da pagina finanças no banco de dados
     * ********************************************************* */
    private function AddItem() {
        $status = 0;
        $msg = '';
        if (isset($_REQUEST['usuario_id']) && isset($_REQUEST['financa_tipo_id']) && isset($_REQUEST['valor']) && isset($_REQUEST['local']) && isset($_REQUEST['created'])):
            try {
                $sql = "INSERT INTO `cadin_financa` (`usuario_id`,`financa_tipo_id`,`valor`,`local`,`created` )
                    VALUE('" . $_REQUEST['usuario_id'] . "','" . $_REQUEST['financa_tipo_id'] . "','" . $_REQUEST['valor'] . "','" . $_REQUEST['local'] . "','" . $_REQUEST['created'] . "');
                 ";
                //VALUE('" . $_REQUEST['usuario_id'] . "','" . $_REQUEST['financa_tipo_id'] . "','" . $_REQUEST['valor'] . "','" . $_REQUEST['local'] . "'STR_TO_DATE('".$_REQUEST['created']."','%d/%m/%Y %H:%i:%s'));
                $query = Conexao::getInstance()->exec($sql);
                if ($query) {
                    $status = 1;
                }
                $query = null;
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
        endif;
        $data = array('status' => $status, 'message' => $msg);
        echo json_encode($data);
    }

    private function EditItem() {
        $status = 0;
        $msg = '';
        if (isset($_REQUEST['id']) && isset($_REQUEST['financa_tipo_id']) && isset($_REQUEST['valor']) && isset($_REQUEST['local']) && isset($_REQUEST['created'])):
            try {

                $sql = "UPDATE `cadin_financa` SET 
                    `financa_tipo_id` = '" . $_REQUEST['financa_tipo_id'] . "',
                    `valor` = " . $_REQUEST['id'] . ",
                    `local` = '" . $_REQUEST['valor'] . "',
                    `created` = '" . $_REQUEST['created'] . "'
                    WHERE `id` = '" . $_REQUEST['id'] . "'                    
                 ";
                $query = Conexao::getInstance()->exec($sql);
                if ($query) {
                    $status = 1;
                }
                $query = null;
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
        endif;
        $data = array('status' => $status, 'message' => $msg);
        echo json_encode($data);
    }

    private function DeleteIitem() {
        $status = 0;
        $msg = '';
        if (isset($_REQUEST['id'])):
            try {
                $sql = "DELETE FROM `cadin_financa` 
                    WHERE `id` = '" . $_REQUEST['id'] . "'                    
                 ";
                $query = Conexao::getInstance()->exec($sql);
                if ($query) {
                    $status = 1;
                }
                $query = null;
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
        endif;
        $data = array('status' => $status, 'message' => $msg);
        echo json_encode($data);
    }

    public function fileUpload() {
        $status = 0;
        $msg = '';
        $values = '';
        $values = false;
        if (isset($_FILES['foto']) && isset($_REQUEST['usuario_id'])) {
            $foto = $_FILES['foto'];
            try {
                $conc = date('HisYmd');
                $folder = $this->helper->folder_image($foto['name'], $_SERVER['DOCUMENT_ROOT'] . '/cadin/uploads/');
                $file = $folder . "/" . $conc . $foto['name'];
                if (move_uploaded_file($foto['tmp_name'], $file)) {
                    $values = $file;
                    session_start();
                    $_SESSION['user']['foto'] = $values;
                }
                if ($values) {
                    $sql = "UPDATE `cadin_usuario` SET 
                    `foto` = '" . $values . "' WHERE `id` = " . $_REQUEST['usuario_id'];
                    $query = Conexao::getInstance()->exec($sql);
                    if ($query) {
                        $status = 1;
                    }
                    $query = null;
                }
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
        }
        $pass = explode('cadin/', $values);
        $url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s://" : "://") . $_SERVER['HTTP_HOST'];
        $values = $url . "/cadin/" . $pass[1];
        $data = array('status' => $status, 'message' => $msg, 'values' => $values);
        echo json_encode($data);
    }

    public function editAddress() {
        $status = 0;
        $msg = '';
        if (isset($_REQUEST['usuario_id']) && isset($_REQUEST['cep']) && isset($_REQUEST['logradouro']) && isset($_REQUEST['numero']) && isset($_REQUEST['complemento']) && isset($_REQUEST['cidade']) && isset($_REQUEST['uf_estado']) && isset($_REQUEST['bairo'])):
            try {

                $sql = "UPDATE `cadin_endereco` SET 
                    `cep`= '".$_REQUEST['cep']."',
                    `logradouro` = '".$_REQUEST['logradouro']."',
                    `numero` = '".$_REQUEST['numero']."',
                    complemento = '".$_REQUEST['complemento']."',
                    cidade = '".$_REQUEST['cidade']."',
                    uf_estado = '".$_REQUEST['uf_estado']."',
                    bairo = '".$_REQUEST['bairo']."'
                    WHERE `usuario_id` = '" . $_REQUEST['usuario_id'] . "'
                 ";
                $msg = $sql;
                $query = Conexao::getInstance()->exec($sql);
                if ($query) {
                    $status = 1;
                }
                $query = null;
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
        endif;
        $data = array('status' => $status, 'message' => $msg,'valuues' =>$_REQUEST );
        echo json_encode($data);
    }

}

/* execute resource */
$resource = New Resources();
$resource->Execute();

