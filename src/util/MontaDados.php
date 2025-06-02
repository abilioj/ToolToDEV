<?php

namespace abilioj\ToolToDev\util;

use abilioj\ToolToDev\util\Date;
use abilioj\ToolToDev\util\Dados;

/**
 * Description of MontaDados
 *
 * @author Abílio José G Ferreira
 */
class MontaDados {

    public $colunas;
    public $dados;
    public $CampoData;
    public $ArrayCampos;
    public $ArrayCamposOcutar;
    public $ArrayCamposValor;

    public function deListar($opcao, $link, $con, $LinkParametros) {
        if ($LinkParametros == null)
            $LinkParametros = "";
        $qtdColunas = count($this->colunas); //QUANTIDADE DE COLUNAS
        $qtdDados = count($this->dados); //QUANTIDADE  DE DADOS
        $t = "";
        $Con = null;
        $a = 0;
        if ($opcao == 1) {
            foreach ($this->dados as $dados) {
                $t .= "<tr>";
                $i = 0;
                $a = 0;
                $b = 0;
                for ($y = 0; $y < $qtdColunas; $y++) {
                    $col = $this->colunas[$y];
                    list($apelido, $nome) = explode(".", $col);
                    if ($this->ArrayCamposOcutar[$b] == $nome):
                        $t .= "<td class='column_hidden'>";
                        $b++;
                    else:
                        $t .= "<td>";
                    endif;
                    if ($this->ArrayCampos[$i] == $nome):
                        foreach ($this->ArrayCamposValor[$i] as $d):
                            if ($dados["{$nome}"] == $d["VALOR"]):
                                $t .= $d["TEXT"];
                            endif;
                        endforeach;
                        $i++;
                    else:
                        if ($this->CampoData[$a] == $nome) {
                            $d = new Date();
                            $t .= $d->data_mysql_para_user($dados["{$nome}"]);
                            $a++;
                        } else {
                            $t .= $dados["{$nome}"];
                        }
                    endif;
                    $t .= "</td>";
                }
                $t .= "</tr>";
            }
        }
        if ($opcao == 2) {
            foreach ($this->dados as $dados) {
                $t .= "<tr>  ";
                $i = 0;
                $a = 0;
                $b = 0;
                for ($y = 0; $y < $qtdColunas; $y++) {
                    $col = $this->colunas[$y];
                    list($apelido, $nome) = explode(".", $col);
                    if ($this->ArrayCamposOcutar[$b] == $nome):
                        $t .= "<td class='column_hidden'>";
                        $b++;
                        $Con = 0;
                    else:
                        $t .= "<td>";
                    endif;
                    if ($y == $qtdColunas - 1) {
                        if($col == -1){
                            $t .= "";
                        }
                        if ($con == 0) {
                            $t .= "<input type='hidden' class='IDRa' value='" . $dados["{$nome}"] . "'>";
                            $t .= "<button type='button' id='' class='btn btn-primary Opcoes' > Opções </button>";
                        }
                        if ($con == 1) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                            $t .= "<a href='" . $link . "?acao=d&id=" . $dados["{$nome}"] . $LinkParametros . "' title='ativar/Desativar'><li class='fa fa-check-circle fa-2x fa-cor-blue'></li></a> ";
                        }
                        if ($con == 2) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                            $t .= "<a href='" . $link . "?acao=v&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Visualizar'><li class='fa fa-eye fa-2x fa-cor-grey'></li></a> ";
                        }
                        if ($con == 3) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                            $t .= "<a href='" . $link . "?acao=v&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Visualizar'><li class='fa fa-eye fa-2x fa-cor-grey'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=e&id=" . $dados["{$nome}"] . $LinkParametros . "'" . 'onclick="return confirm(' . "'Deseja realmente Excluir?'" . ')"' . "  title='Remover'><li class='fa fa-trash-o fa-2x fa-cor-red'></li></a>";
                        }
                        if ($con == 4) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                            $t .= "<a href='" . $link . "?acao=v&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Visualizar'><li class='fa fa-eye fa-2x fa-cor-grey'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=e&id=" . $dados["{$nome}"] . $LinkParametros . "'" . 'onclick="return confirm(' . "'Deseja realmente Excluir?'" . ')"' . "  title='Remover'><li class='fa fa-trash-o fa-2x fa-cor-red'></li></a>";
                            $t .= "<a href='" . $link . "?acao=im&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Imprimir'><li class='fa fa-print fa-2x fa-cor-black'></li></a>";
                        }
                        if ($con == 5) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                            $t .= "<a href='" . $link . "?acao=v&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Visualizar'><li class='fa fa-eye fa-2x fa-cor-grey'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=up&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Upload'><li class='fa fa-file-image-o fa-2x fa-cor-yellow'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=e&id=" . $dados["{$nome}"] . $LinkParametros . "'" . 'onclick="return confirm(' . "'Deseja realmente Excluir?'" . ')"' . "  title='Remover'><li class='fa fa-trash-o fa-2x fa-cor-red'></li></a>";
                        }
                        if ($con == 6) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                            $t .= "<a href='" . $link . "?acao=v&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Visualizar'><li class='fa fa-eye fa-2x fa-cor-grey'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=d&id=" . $dados["{$nome}"] . $LinkParametros . "' title='ativar/Desativar'><li class='fa fa-check-circle fa-2x fa-cor-blue'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=im&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Imprimir'><li class='fa fa-print fa-2x fa-cor-black'></li></a>";
                        }
                        if ($con == 7) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                            $t .= "<a href='" . $link . "?acao=v&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Visualizar'><li class='fa fa-eye fa-2x fa-cor-grey'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=d&id=" . $dados["{$nome}"] . $LinkParametros . "' title='ativar/Desativar'><li class='fa fa-check-circle fa-2x fa-cor-blue'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=e&id=" . $dados["{$nome}"] . $LinkParametros . "'" . 'onclick="return confirm(' . "'Deseja realmente Excluir?'" . ')"' . "  title='Remover'><li class='fa fa-trash-o fa-2x fa-cor-red'></li></a>";
                            $t .= "<a href='" . $link . "?acao=im&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Imprimir'><li class='fa fa-print fa-2x fa-cor-black'></li></a>";
                        }
                        if ($con == 8) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                            $t .= "<a href='" . $link . "?acao=v&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Visualizar'><li class='fa fa-eye fa-2x fa-cor-grey'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=d&id=" . $dados["{$nome}"] . $LinkParametros . "' title='ativar/Desativar'><li class='fa fa-check-circle fa-2x fa-cor-blue'></li></a> ";
                            $t .= "<a href='" . $link . "?acao=e&id=" . $dados["{$nome}"] . $LinkParametros . "'" . 'onclick="return confirm(' . "'Deseja realmente Excluir?'" . ')"' . "  title='Remover'><li class='fa fa-trash-o fa-2x fa-cor-red '></li></a>";
                        }
                        if ($con == 9) {
                            $t .= "<a href='" . $link . "?acao=a&id=" . $dados["{$nome}"] . $LinkParametros . "' title='Editar'><li class='fa fa-edit fa-2x fa-cor-green'></li></a>";
                        }
                        if($Con == 10){
                            $t .= "<a href='" . $link . "?acao=e&id=" . $dados["{$nome}"] . $LinkParametros . "'" . 'onclick="return confirm(' . "'Deseja realmente Excluir?'" . ')"' . "  title='Remover'><li class='fa fa-trash-o fa-2x fa-cor-red '></li></a>";                            
                        }
                    } else {
                        if ($this->ArrayCampos[$i] == $nome):
                            foreach ($this->ArrayCamposValor[$i] as $d):
                                if ($dados["{$nome}"] == $d["id"]):
                                    $t .= $d["value"];
                                endif;
                            endforeach;
                            $i++;
                        else:
                            if ($this->CampoData[$a] == $nome) {
                                $d = new Date();
                                $t .= $d->data_mysql_para_user($dados["{$nome}"]);
                                $a++;
                            } else {
                                $t .= $dados["{$nome}"];
                            }
                        endif;
                    }
                    $t .= "</td>";
                }

                $t .= "</tr>";
            }
        }
        $t .= "";
        return $t;
    }

    public function pegaDados() : Dados {
        $d = new Dados();
        $qtdColunas = count($this->colunas); //QUANTIDADE DE COLUNAS
        $qtdDados = count($this->dados); //QUANTIDADE  DE DADOS
        foreach ($this->dados as $dados) {
            for ($y = 0; $y < $qtdColunas; $y++) {
                $col = $this->colunas[$y];
                list($apelido, $nome) = explode(".", $col);
                $d->dado[$y] = $dados["{$nome}"];
            }
        }
        return $d;
    }

}
