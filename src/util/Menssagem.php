<?php

namespace abilioj\ToolToDev\util;

/**
 * Description of menssagem
 * @package category util
 * @author Abílio José G Ferreira
 * Classe que implementa os metodos de Menssagem
 */
class Menssagem {
 
    public function MenssagemToPAGE(int $paramMSG): string {
        $RETURNmsgText = "";
        switch ($paramMSG):
            case 1:
                $RETURNmsgText = '<div id="msg"><div class="alert alert-success  alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                        . '<i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Operação Realizada com Suceesso.</div></div>';
                break;
            case 2:
                $RETURNmsgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                        . '<i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>';
                break;
            case 3:
                $RETURNmsgText = '<div id="msg"><div class="alert alert-warning alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                        . '<i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Esse Regitro já existe.</div></div>';
                break;
            case 502:
                $RETURNmsgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                        . '<i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Estamos implementando essa Operação ou erro interno.</div></div>';
                break;
            default :
                $RETURNmsgText = "&nbsp; &nbsp; &nbsp;";
                break;
        endswitch;
        return $RETURNmsgText;
    }

    public function MenssagemToPAGESuaConta(int $paramMSG): string {
        $RETURNmsgText = "";
        switch ($paramMSG):
            case 1:
                $RETURNmsgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                        . '<strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>';
                break;
            case 2:
                $RETURNmsgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                        . '<strong>Atenção!</strong> Senha Não conresponde!</div></div>';
                break;
            case 3:
                $RETURNmsgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                        . '<strong>Atenção!</strong>Senha incorreta!</div></div>';
                break;
            case 10:
                $RETURNmsgText = '<div id="msg"><div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
                        . '<strong>Atenção!</strong>**</div></div>';
                break;
            default :
                $RETURNmsgText = "&nbsp; &nbsp; &nbsp;";
                break;
        endswitch;
        return $RETURNmsgText;
    }

    public function MenssagemToPAGELogin (int $paramMSG): string {
        $RETURNmsgText = "";
        if ($paramMSG == 0) {
            $RETURNmsgText = '';
        }
        if ($paramMSG == 1) {
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-warning">Aviso: Login invalido!</div></div>';
        }
        if ($paramMSG == 2) {
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-warning">Aviso: Sua Senha é invalida!</div></div>';
        }
        if ($paramMSG == 3) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-warning">Informação: Sem acesso temporariamente!</div></div>';
        }
        if ($paramMSG == 4) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-info">Informação: Usuário sem acesso temporariamente, por motivo de Segurança!</div></div>';
        }
        if ($paramMSG == 5) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-warning">Aviso: Sessão Foi Fechada!</div></div>';
        }
        if ($paramMSG == 6) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-success">Email envido! Só aguarda alguns minutos sua senha!</div></div>';
        }
        if ($paramMSG == 7) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-info">Informação: Usuário Cancelado, por motivo de Segurança!</div></div>';
        }
        if ($paramMSG == 8) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-danger">Erro: Não existe Usuário com esse Email em nosso sistema!!</div></div>';
        }
        if ($paramMSG == 9) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-info">Informação! Sessão Expirada!</div></div>';
        }
        if ($paramMSG == 10) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-danger">Informação! insire o login!</div></div>';
        }
        if ($paramMSG == 11) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-info">Informação! Usuários Não Cadastrado !</div></div>';
        }
        if ($paramMSG == 12) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-info">Informação! Usuários Não Habilitado No Sistema !</div></div>';
        }
        if ($paramMSG == 13) {
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-warning">Aviso: Login ou Senha é invalido!</div></div>';
        }
        if ($paramMSG == 17) {//alert-info alert-warning alert-danger alert-success
            $RETURNmsgText = '<div id="msg" class="msg"><div  class="alert-info">Informação! Usuários Não Habilitado Nas Funções Do Sistema !</div></div>';
        }
        return (string) $RETURNmsgText;
    }

    public function MenssagemToWS (int $paramMSG): string {
        $RETURNmsgText = "";
        if ($paramMSG == -1) {
            $RETURNmsgText = 'Informação: Login Ou Senha estão corretos!';
        }
        if ($paramMSG == 0) {
            $RETURNmsgText = 'Erro: Login Ou Senha são invalido!';
        }
        if ($paramMSG == 1) {
            $RETURNmsgText = 'Aviso: Login invalido!';
        }
        if ($paramMSG == 2) {
            $RETURNmsgText = 'Aviso: Sua Senha é invalida!';
        }
        if ($paramMSG == 3) {
            $RETURNmsgText = 'Informação: Sem acesso temporariamente!';
        }
        if ($paramMSG == 4) {
            $RETURNmsgText = 'Informação: Usuário sem acesso temporariamente, por motivo de Segurança!';
        }
        if ($paramMSG == 5) {
            $RETURNmsgText = 'Aviso: Sessão Foi Fechada!';
        }
        if ($paramMSG == 6) {
            $RETURNmsgText = 'Email envido! Só aguarda alguns minutos sua senha!';
        }
        if ($paramMSG == 7) {
            $RETURNmsgText = 'Informação: Usuário Cancelado, por motivo de Segurança!';
        }
        if ($paramMSG == 8) {
            $RETURNmsgText = 'Erro: Não existe Usuário com esse Email em nosso sistema!!';
        }
        if ($paramMSG == 9) {
            $RETURNmsgText = 'Informação! Sessão Expirada!';
        }
        if ($paramMSG == 10) {
            $RETURNmsgText = 'Informação! insire o login!';
        }
        return (string) $RETURNmsgText;
    }

}
 