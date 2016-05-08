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
            $sql = "SELECT `email`, `senha`, `nome` FROM `cadin_usuario` WHERE `email` = '" . $usuario['email'] . "'";
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

}
