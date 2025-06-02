<?php

namespace abilioj\ToolToDev\util;

/**
 * Description of FromLog
 * @author Abílio José
 */
class FromLog {

    function logMsg($msg, $level = 'info', $file = 'main.log') {
        $levelStr = '';// verifica o nível do log
        switch ($level) {
            case 'info':
                $levelStr = 'INFO';
                break;
            case 'warning':
                $levelStr = 'WARNING';
                break;
            case 'error':
                $levelStr = 'ERROR';
                break;
        }
        $date = date('Y-m-d H:i:s');        
        /*
            - formata a mensagem do log
            - 1o: data atual
            - 2o: nível da mensagem (INFO, WARNING ou ERROR)
            - 3o: a mensagem propriamente dita
            - 4o: uma quebra de linha
         */
        $msg = sprintf("[%s] [%s]: %s%s", $date, $levelStr, $msg, PHP_EOL);
        /*
            - escreve o log no arquivo
            - é necessário usar FILE_APPEND para que a mensagem seja escrita
            - no final do arquivo, preservando o conteúdo antigo do arquivo
        */
        file_put_contents($file, $msg, FILE_APPEND);
    }

}
