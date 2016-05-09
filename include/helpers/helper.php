<?php

class Helper {

    public function GeraSenha($senha) {
        $gsenha = hash('md5', $senha);
        $gsenha .=':';
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $gsenha.= hash('md5', $randomString);
        return $gsenha;
    }

    public function ComparaSenha($senha, $compsenha) {
        $gsenha = hash('md5', $senha);
        $gcomp = explode(":", $compsenha);
        if ($gcomp[0] == $gsenha) {
            return true;
        } else {
            return false;
        }
    }

    public function GeraCookie($usuario) {
        if (is_array($usuario)) {
            foreach ($usuario as $key => $value) {
                setcookie("cadin[$key]", $value, time() + 86400);
            }
        }
    }

    public function checkUser($usuario) {
        try {
            $sql = "SELECT * FROM `cadin_usuario` WHERE `email` = '" . $usuario['email'] . "'";
            $query = Conexao::getInstance()->query($sql);
            $result = $query->fetchall(PDO::FETCH_ASSOC)[0];
            $senha = $result['senha'];
            $query = null;
            $comp = $this->ComparaSenha($usuario['senha'], $senha);
            if ($comp) {
                session_start();
                $_SESSION['user'] = $usuario;
            }
        } catch (Exception $ex) {
            $msg = "Ocorreu um erro ao tentar executar esta ação!";
            CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
        }
    }

    public function getTableFinanca() {
        $result = false;
        session_start();
        if (isset($_SESSION['user'])) {
            $usuario = $_SESSION['user'];

            $sql = "SELECT `id`, `financa_tipo_id`, `nome` FROM `cadin_usuario` WHERE `email` = '" . $usuario['email'] . "'";
            $sql = "SELECT 
                cf.id,
                cf.financa_tipo_id,
                cft.descricao,
                cf.valor,
                cf.local,
                cf.created
                FROM cadin_financa  AS cf
                LEFT JOIN cadin_financa_tipo as cft ON cf.financa_tipo_id = cft.id
                WHERE cf.usuario_id= " . $usuario['id'];
            try {
                $query = Conexao::getInstance()->query($sql);
                $result = array();
                if ($query) {
                    $result['input'] = $query->fetchall(PDO::FETCH_ASSOC);
                    $query = null;
                }

                $sql = "select `id`,`descricao` from `cadin_financa_tipo`";
                $query = Conexao::getInstance()->query($sql);
                if ($query) {
                    $result['select'] = $query->fetchall(PDO::FETCH_ASSOC);
                }
            } catch (Exception $ex) {
                $msg = "Ocorreu um erro ao tentar executar esta ação!";
                CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
            }
            return $result;
        }
    }

    public function getTableFinancaView() {
        $result = $this->getTableFinanca();
        if ($result['input']) {
            $printvalue = '';
            $printselect = '';
            foreach ($result['select'] as $key => $value) {
                $printselect.='<option value="' . $value['id'] . '">' . $value['descricao'] . '</option>';
            }

            foreach ($result['input'] as $key => $value) {
                $comp = $value['financa_tipo_id'];
                $printvalue.='<tr>';
                $printvalue.='<td><span class="id">' . $value['id'] . '</span></td>';
                $printvalue.='<td> ';
                $printvalue.='<select id="' . $value['id'] . '-descricao" class="descricao" name="' . $value['id'] . '-descricao">';
                if ($value['financa_tipo_id'] == 2) {
                    $pass = explode('2"', $printselect);
                    $pass = $pass[0] . '2" selected' . $pass[1];
                    $printvalue.=$pass;
                } else {
                    $printvalue.=$printselect;
                }
                $printvalue.='</select>';
                $printvalue.='</td>';
                $money = number_format($value['valor'], 2, ',', '.');
                $printvalue.='<td><input type="text" id="' . $value['id'] . '-valor" name="' . $value['id'] . '-valor" class="moneyvalue" value="' . $money . '"></td>';
                $printvalue.='<td><input type="text" id="' . $value['id'] . '-local" name=' . $value['id'] . '-local" class="local" value="' . $value['local'] . '"></td>';
                $date = explode(" ", $value['created']);
                $pass = explode("-", $date[0]);
                $date = $pass[2] . "/" . $pass[1] . "/" . $pass[0];
                $printvalue.='<td><input type="text" id="' . $value['id'] . '-created" name="' . $value['id'] . '-created" class="created" value="' . $date . '"></td>';
                $printvalue.='<script>(function ($) {$("#' . $value['id'] . '-created").datepicker({ dateFormat: "dd/mm/yy" });})(jQuery);</script>';
                $printvalue.='<td><span class="fa fa-check btn btn-success"></span></td>';
                $printvalue.='<td><span class="fa fa-times btn btn-danger"></span></td>';
                $printvalue.='</tr>';
            }
            $html = <<<HTML
<div class="panel panel-default">
    <div class="panel-heading">
            Dados
    </div>                
    <div class="panel-body">
        <div class="table-responsive">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Local</th>
                        <th>Data</th>
                        <th>&nbsp;&nbsp;&nbsp;Editar&nbsp;&nbsp;&nbsp;</th>
                        <th>Remover</th>
                    </tr>   
                </thead>
                <tbody>
                    {$printvalue}
                </tbody>
                <tfoot>
                    <tr>
                        <th>Item</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Local</th>
                        <th>Data</th>
                        <th>&nbsp;&nbsp;&nbsp;Editar&nbsp;&nbsp;&nbsp;</th>
                        <th>Remover</th>
                    </tr>   
                </tfoot>
            </table>
        </div>
    </div>
</div>
HTML;
        }
        return $html;
    }

    public function clean_url($name) {
        $match = array("À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "ß", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "ÿ", "A", "a", "A", "a", "A", "a", "C", "c", "C", "c", "C", "c", "C", "c", "D", "d", "Ð", "d", "E", "e", "E", "e", "E", "e", "E", "e", "E", "e", "G", "g", "G", "g", "G", "g", "G", "g", "H", "h", "H", "h", "I", "i", "I", "i", "I", "i", "I", "i", "I", "i", "?", "?", "J", "j", "K", "k", "L", "l", "L", "l", "L", "l", "?", "?", "L", "l", "N", "n", "N", "n", "N", "n", "?", "O", "o", "O", "o", "O", "o", "Œ", "œ", "R", "r", "R", "r", "R", "r", "S", "s", "S", "s", "S", "s", "Š", "š", "T", "t", "T", "t", "T", "t", "U", "u", "U", "u", "U", "u", "U", "u", "U", "u", "U", "u", "W", "w", "Y", "y", "Ÿ", "Z", "z", "Z", "z", "Ž", "ž", "?", "ƒ", "O", "o", "U", "u", "A", "a", "I", "i", "O", "o", "U", "u", "U", "u", "U", "u", "U", "u", "U", "u", "?", "?", "?", "?", "?", "?");
        $replace = array("A", "A", "A", "A", "A", "A", "AE", "C", "E", "E", "E", "E", "I", "I", "I", "I", "D", "N", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "Y", "s", "a", "a", "a", "a", "a", "a", "ae", "c", "e", "e", "e", "e", "i", "i", "i", "i", "n", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y", "y", "A", "a", "A", "a", "A", "a", "C", "c", "C", "c", "C", "c", "C", "c", "D", "d", "D", "d", "E", "e", "E", "e", "E", "e", "E", "e", "E", "e", "G", "g", "G", "g", "G", "g", "G", "g", "H", "h", "H", "h", "I", "i", "I", "i", "I", "i", "I", "i", "I", "i", "IJ", "ij", "J", "j", "K", "k", "L", "l", "L", "l", "L", "l", "L", "l", "l", "l", "N", "n", "N", "n", "N", "n", "n", "O", "o", "O", "o", "O", "o", "OE", "oe", "R", "r", "R", "r", "R", "r", "S", "s", "S", "s", "S", "s", "S", "s", "T", "t", "T", "t", "T", "t", "U", "u", "U", "u", "U", "u", "U", "u", "U", "u", "U", "u", "W", "w", "Y", "y", "Y", "Z", "z", "Z", "z", "Z", "z", "s", "f", "O", "o", "U", "u", "A", "a", "I", "i", "O", "o", "U", "u", "U", "u", "U", "u", "U", "u", "U", "u", "A", "a", "AE", "ae", "O", "o");
        $name = str_replace($match, $replace, $name);
        $name = strtolower(preg_replace(array("/\//", "/[^a-zA-Z0-9 -]/", "/[ -]+/", "/^-|-$/"), array("-", "", "-", ""), $name));
        return $name;
    }

    public function folder_image($image_name, $caminho) {
        $clear_name = $this->clean_url($image_name);
        $folder = "";
        $folder .= "$caminho$clear_name[0]/$clear_name[1]";
        if (!is_dir("$folder")) {
            mkdir("$folder", 0777, true);
        }
        return "$folder/" . basename($this->FileName);
    }

    public function getEndereco() {
        $result = false;
        session_start();
        try {
            $sql = "SELECT * FROM `cadin_endereco` WHERE `usuario_id` = " . $_SESSION['user']['id'];
            $query = Conexao::getInstance()->query($sql);            
            if ($query) {
                $result = $query->fetchall(PDO::FETCH_ASSOC);                
            }
            $query = null;            
        } catch (Exception $ex) {            
            CriaLog::Logger('Erro: Código: ' . $ex->getCode() . ' Mensagem: ' . $ex->getMessage());
        }
        return $result;
    }

}
