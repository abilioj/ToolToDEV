<?php

namespace abilioj\ToolToDev\util;

/**
 * Description of SQL
 *
 * @author Abílio José G Ferreira
 */
class Sql {

    public $tabela;
    public $arrayTable;
    public $dados;
    public $valoresSql;
    public $instrucaoSql;
    public $endInstrucaoSql;
    public $camposTabelas;
    public $camposPrimary;
    public $condicoesTabela;
    public $conditions;
    public $conditionsLeftJoin;
    public $sqlMultiplos;
    public $ordenacao;
    public $colunaOrdenada;
    public $GroupBY;
    public $limit;
    public $TOP;
    public $ArryasTOMaiusculas;

    /**
     * <b>Metodo construto SQLr</b>
     * @param string $tabela - Parâmetro que difine o nome da tabela que vai ser Trabalhar
     * No Insert,UpDate e Delete. 
     */
    public function __construct($tabela) { // construtor, nome da tabela como parametro
        $this->tabela = (string) $tabela;
        $this->arrayTable = null;
        $this->ArryasTOMaiusculas = false;
        $this->endInstrucaoSql = true;
        $this->conditionsLeftJoin = null;
        $this->condicoesTabela = null;
        $this->conditions = null;
        $this->GroupBY = null;
    }

    private function ArryasSQLTOMaiusculas() {
        $PArrays = new PreparaArrays();
        $qdd = count($this->tabela);
        if ($qdd > 1):
            if (isset($this->tabela) || $this->tabela != null):
                $arraytabela = $PArrays->ArryasTOMaiusculas($this->tabela);
                $this->tabela = $arraytabela;
            endif;
        endif;
        if (isset($this->camposTabelas) || $this->camposTabelas != null):
            $arrayColunas = $PArrays->ArryasTOMaiusculas($this->camposTabelas);
            $this->camposTabelas = $arrayColunas;
        endif;
    }
    
    private function confEnd() {
        if($this->endInstrucaoSql) $this->instrucaoSql .= ";";
    }

    public function sqlInserir() {
        if (isset($this->ArryasTOMaiusculas) && $this->ArryasTOMaiusculas == TRUE)$this->ArryasSQLTOMaiusculas();
        $coluna = "";
        $tamanhoArray = count($this->dados);
        $interacoes = 1;
        foreach ($this->dados as $valor) {
            if ($interacoes < $tamanhoArray) {
                if ($valor == '' || $valor == null):
                    if(is_null($valor)):
                        $this->valoresSql .= "NULL,";
                    else:
                        $this->valoresSql .= "0,";
                    endif;
                else:
                    if(is_int($valor)):
                        $this->valoresSql .= "" . $valor . ",";
                    else:
                        $this->valoresSql .= "'" . $valor . "',";
                    endif;
                endif;
            } else {
                if ($valor == '' || $valor == null):
                    if (is_null($valor)):
                        $this->valoresSql .= "NULL";
                    else:
                        $this->valoresSql .= "0";
                    endif;
                else:
                    if(is_int($valor)):
                        $this->valoresSql .= "" . $valor . "";
                    else:
                        $this->valoresSql .= "'" . $valor . "'";
                    endif;
                endif;
            }
            $interacoes++;
        }
        if (isset($this->camposTabelas) || $this->camposTabelas != NULL) {
            $tamanhoTabela = count($this->camposTabelas);
            $interacoes = 0;
            foreach ($this->camposTabelas as $campo) {
                if ($interacoes < $tamanhoTabela - 1) {
                    $coluna .= "" . $campo . ", ";
                } else {
                    $coluna .= "" . $campo . "";
                }
                $interacoes++;
            }
        }
        $this->instrucaoSql = "INSERT INTO {$this->tabela} ({$coluna}) VALUES({$this->valoresSql})";
        $this->confEnd();
        return $this->instrucaoSql;
    }

    public function sqlInserirMultiplos($dadosMultiplos) {
        if (isset($this->ArryasTOMaiusculas) && $this->ArryasTOMaiusculas == TRUE)
            $this->ArryasSQLTOMaiusculas();
        $coluna = "";
        $tamanhoArrayMultiplos = count($dadosMultiplos);
        $interacoesII = 0;
        foreach ($dadosMultiplos as $valorMultiplos) {
            $interacoes = 0;
            if ($interacoesII < $tamanhoArrayMultiplos - 1) {
                $this->valoresSql .= '(';
                $tamanhovalorMultiplos = count($valorMultiplos);
                foreach ($valorMultiplos as $valor) {
                    if ($interacoes < $tamanhovalorMultiplos - 1) {
                        if ($valor == '' || $valor == null):
                            $this->valoresSql .= (is_int($valor))? "0," : "NULL,";
                        else:
                            $this->valoresSql .= (is_int($valor))? "".$valor."," : "'" . $valor . "',";
                        endif;
                    } else {
                        if ($valor == '' || $valor == null || $valor === 0):
                            $this->valoresSql .= (is_int($valor))? "0" : "NULL";
                        else:
                            $this->valoresSql .= (is_int($valor))? "" . $valor . "" : "'" . $valor . "'";
                        endif;
                    }
                    $interacoes++;
                }
                $this->valoresSql .= '),';
            } else {
                $interacoes = 0;
                $this->valoresSql .= '(';
                $tamanhovalorMultiplos = count($valorMultiplos);
                foreach ($valorMultiplos as $valor) {
                    if ($interacoes < $tamanhovalorMultiplos - 1) {
                        if ($valor == '' || $valor == null):
                            $this->valoresSql .= (is_int($valor))? "0," : "NULL,";
                        else:
                            $this->valoresSql .= (is_int($valor))? "".$valor."," : "'" . $valor . "',";
                        endif;
                    } else {
                        if ($valor == '' || $valor == null || $valor === 0):
                            $this->valoresSql .= (is_int($valor))? "0" : "NULL";
                        else:
                            $this->valoresSql .= (is_int($valor))? "" . $valor . "" : "'" . $valor . "'";
                        endif;
                    }
                    $interacoes++;
                }
                $this->valoresSql .= ')';
            }
            $interacoesII++;
        }
        if (isset($this->camposTabelas) || $this->camposTabelas != NULL) {
            $tamanhoTabela = count($this->camposTabelas);
            $interacoes = 0;
            foreach ($this->camposTabelas as $campo) {
                if ($interacoes < $tamanhoTabela - 1) {
                    $coluna .= "" . $campo . ", ";
                } else {
                    $coluna .= "" . $campo . "";
                }
                $interacoes++;
            }
        }
        $this->instrucaoSql = "INSERT INTO {$this->tabela} ({$coluna}) VALUES {$this->valoresSql}";
        $this->confEnd();
        return $this->instrucaoSql;
    }

    public function sqlAtualizar($where = NULL) {
        $varValor = "";
        if (isset($this->ArryasTOMaiusculas) && $this->ArryasTOMaiusculas == TRUE)
            $this->ArryasSQLTOMaiusculas();
        $tamanhoTabela = count($this->camposTabelas);
        $interacoes = 0;
        foreach ($this->camposTabelas as $campo) {
            $varValor = $this->dados[$interacoes];
            if ($interacoes < $tamanhoTabela - 1):
                if (is_string($varValor)):
                    $this->valoresSql .= $campo . " = '" . $varValor . "', ";
                else:
                    $this->valoresSql .= $campo . " = " . $varValor . ", ";
                endif;
            else:
                if (is_string($varValor)):
                    $this->valoresSql .= $campo . " = '" . $varValor . "' ";
                else:
                    $this->valoresSql .= $campo . " = " . $varValor . " ";
                endif;
            endif;
            $interacoes++;
        }
        if ($where) {
            $this->instrucaoSql = "UPDATE  " . $this->tabela . " SET " . $this->valoresSql . " WHERE " . $where . " ";
        } else {
            $this->instrucaoSql = "UPDATE  " . $this->tabela . " SET " . $this->valoresSql . " ";
        }
        $this->confEnd();
        return $this->instrucaoSql;
    }

    public function sqlAtualizarMultiplos($dadosMultiplos, $where = NULL) {
        if (isset($this->ArryasTOMaiusculas) && $this->ArryasTOMaiusculas == TRUE):
            $this->ArryasSQLTOMaiusculas();
        endif;
        $tamanhoTabela = count($this->camposTabelas);
        $tamanhoDados = count($dadosMultiplos);
        $tamanhoWhere = count($where);
        $interacoes = 0;
        $interacoesDados = 0;
        $interacoesWHERE = 0;
        foreach ($dadosMultiplos as $dadoarray) :
            $this->valoresSql = "";
            $interacoes = 0;
            foreach ($dadoarray as $dado):
                foreach ($this->camposTabelas as $campo):
                    if ($interacoes < $tamanhoTabela - 1):
                        $this->valoresSql .= $campo . " = " . $dado . ", ";
                    else:
                        $this->valoresSql .= $campo . " = " . $dado . " ";
                    endif;
                    $interacoes++;
                endforeach;
            endforeach;
            if ($where):
                if ($tamanhoWhere == $tamanhoDados):
                    $this->instrucaoSql .= "UPDATE  " . $this->tabela . " SET " . $this->valoresSql . " WHERE " . $this->camposPrimary . " = " . $where[$interacoesDados][$interacoesWHERE] . " ;";
                else:
                    $this->instrucaoSql .= "UPDATE  " . $this->tabela . " SET " . $this->valoresSql . " WHERE " . $this->camposPrimary . " = " . $where[0] . "";
                endif;
            else:
                $this->instrucaoSql .= "UPDATE  " . $this->tabela . " SET " . $this->valoresSql . "";
            endif;
            $interacoesDados++;
        endforeach;
        $this->confEnd();
        return $this->instrucaoSql;
    }

    public function sqlexcluir() {
        if (isset($this->ArryasTOMaiusculas) && $this->ArryasTOMaiusculas == TRUE)
            $this->ArryasSQLTOMaiusculas();
        $this->instrucaoSql = "DELETE FROM " . $this->tabela;
        if ($this->condicoesTabela != null):
            $this->instrucaoSql .= " WHERE ";
            $interacoesCampos = 1;
            $qtdcondicoesTabela = count($this->condicoesTabela);
            foreach ($this->condicoesTabela as $condicoes) {
                if ($interacoesCampos < $qtdcondicoesTabela):
                    $this->instrucaoSql .= $condicoes . " AND ";
                else:
                    $this->instrucaoSql .= $condicoes . " ";
                endif;
            }
        else:
            $this->instrucaoSql .= " ";
        endif;
        return $this->instrucaoSql . "";
    }

    public function sqlPesquisar() {
        if (isset($this->ArryasTOMaiusculas) && $this->ArryasTOMaiusculas == TRUE)
            $this->ArryasSQLTOMaiusculas();
        $this->instrucaoSql = "SELECT ";
        if (isset($this->TOP) && $this->TOP >= 1) {
            $this->instrucaoSql = "SELECT TOP " . $this->TOP . " ";
        }
        // Campos
        if (isset($this->camposTabelas)) {
            $qtdCampos = count($this->camposTabelas);
            $interacoesCampos = 1;
            foreach ($this->camposTabelas as $campos) {
                if ($interacoesCampos < $qtdCampos) {
                    $this->instrucaoSql .= $campos . ", ";
                } else {
                    $this->instrucaoSql .= $campos . " FROM ";
                }
                $interacoesCampos++;
            }
        } else {
            $this->instrucaoSql .= " * FROM ";
        }
        //tabela
        $qtdTabelas = count($this->arrayTable);
        $interacoesTabelas = 1;
        foreach ($this->arrayTable as $apelido => $nomeTb) {
            if ($interacoesTabelas < $qtdTabelas) {
                $this->instrucaoSql .= $nomeTb . " AS " . $apelido . ", ";
            } else {
                $this->instrucaoSql .= $nomeTb . " AS " . $apelido;
            }
            $interacoesTabelas++;
        }
        //condicoes(left_join)
        if ($this->conditionsLeftJoin != null):
            $qtdConditionsLeftJoin = count($this->conditionsLeftJoin);
            $interacoesConditionsLeftJoin = 1;
            foreach ($this->conditionsLeftJoin as $rowLeftJoin) {
                $this->instrucaoSql .= " " . $rowLeftJoin . " ";
            }
        endif;
        //condicoes(where)
        if ($this->condicoesTabela != null) {
            $qtdcondicoesTabela = count($this->condicoesTabela);
            $interacoescondicoesTabela = 1;
            $this->instrucaoSql .= " WHERE ";
            foreach ($this->condicoesTabela as $condicoes) {
                if ($interacoescondicoesTabela < $qtdcondicoesTabela):
                    $this->instrucaoSql .= $condicoes . " AND ";
                else:
                    $this->instrucaoSql .= $condicoes . " ";
                endif;
                $interacoescondicoesTabela++;
            }
        }
        if ($this->conditions != null) {
            $qddConditions = count($this->conditions);
            $interacaoConditions = 1;
            foreach ($this->conditions as $rowConditions):
                if ($interacaoConditions < $qddConditions):
                    $this->instrucaoSql .= " AND " . $rowConditions . " ";
                else:
                    $this->instrucaoSql .= " AND " . $rowConditions . " ";
                endif;
                $interacaoConditions++;
            endforeach;
        }
        //Group by
        if ($this->GroupBY != null):
            $this->instrucaoSql .= " group by ";
            $qddGroupBY = count($this->GroupBY);
            $interacaoGroupBY = 1;
            foreach ($this->GroupBY as $rowGroupBY):
                if ($interacaoGroupBY < $qddGroupBY):
                    $this->instrucaoSql .= $rowGroupBY . ",";
                else:
                    $this->instrucaoSql .= $rowGroupBY . " ";
                endif;
                $interacaoGroupBY++;
            endforeach;
        endif;
        //colunas Ordenada
        if ($this->colunaOrdenada != null) {
            if ($this->ordenacao == "DESC") {
                $this->instrucaoSql .= " ORDER BY " . $this->colunaOrdenada . " DESC ";
            } elseif ($this->ordenacao == "ASC") {
                $this->instrucaoSql .= " ORDER BY " . $this->colunaOrdenada . " ASC ";
            }
        }
        //Limit
        if ($this->limit != null) {
            $this->instrucaoSql .= " LIMIT " . $this->limit . "";
        }
        return $this->instrucaoSql . " ;";
    }

    public function cleanAll() {
        $this->tabela = null;
        $this->instrucaoSql = "";
    }

    public function cleanSQL() {
        $this->instrucaoSql = "";
    }

}
