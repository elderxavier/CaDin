<?php

date_default_timezone_set('America/Sao_Paulo');

class CriaLog {

    private function __construct() { // 
    }

    public static function Logger($msg) {
        $data = date("d-m-y");
        $hora = date("H:i:s");
        $ip = $_SERVER['REMOTE_ADDR'];
        //Nome do arquivo:
        $arquivo = "Erro-$data.txt";
        //Texto a ser impresso no log:
        //.debug_backtrace().
        $texto = "[$hora] > $msg \n";
        $manipular = fopen($_SERVER['DOCUMENT_ROOT'] . '/cadin/logs/'.$arquivo, "a+b");
        fwrite($manipular, $texto);
        fclose($manipular);
    }

}
