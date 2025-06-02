<?php

namespace abilioj\ToolToDev\util;

use abilioj\ToolToDev\util\Sql;

/**
 * Description of DaoFull
 * @package category util
 * @author Abílio José G Ferreira
 * Classe que implementa os metodos de CRUD
 */
class DaoFull {

    public $table;
    public $arrayTable;
    public $conditionsLeftJoin;
    public $GroupBY;
    private $numrows;
    private $lastInsertId;

    public function __construct() {
        $this->numrows = null;
        $this->conditionsLeftJoin = null;
    }

    public function inserir($dados, $colunas, $ArrayTo): bool {
        $conn = new Connect();
        $sql = new Sql($this->table);
        $sql->camposTabelas = $colunas;
        $sql->dados = $dados;
        $sql->ArryasTOMaiusculas = $ArrayTo;
        $conn->sql = $sql->sqlInserir();
        $rusult = $conn->updateQuery();
        if ($rusult) {
            return true;
        } else {
            return false;
        }
    }

    public function Multiplosinserir($dadosMultiplos, $colunas, $ArrayTo): bool {
        $conn = new Connect();
        $sql = new Sql($this->table);
        $sql->camposTabelas = $colunas;
        $sql->ArryasTOMaiusculas = $ArrayTo;
        $conn->sql = $sql->sqlInserirMultiplos($dadosMultiplos);
        $rusult = $conn->updateQuery();
        $this->lastInsertId = $conn->getLastInsertId();
        if ($rusult) {
            return true;
        } else {
            return false;
        }
    }

    public function selecionar($camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $TOP, $ArrayTo) {
        $conn = new Connect();
        $sql = new Sql($this->table);
        $sql->arrayTable = $this->arrayTable;
        $sql->camposTabelas = $camposTabelas;
        $sql->ArryasTOMaiusculas = $ArrayTo;
        $sql->tabela = $this->table;
        $sql->condicoesTabela = $condicoes;
        $sql->colunaOrdenada = $colunaOrdenada; //"nome"
        $sql->ordenacao = $ordenacao; //
        $sql->limit = $limit; //
        $sql->TOP = $TOP; // TOP é o limit do SQL Serve
        $conn->sql = $sql->sqlPesquisar();
        $arrayDados = $conn->montaArrayPesquisa();
        $d = new Dados();
        if ($arrayDados != null) {
            $objmonta = new MontaDados();
            $objmonta->colunas = $camposTabelas;
            $objmonta->dados = $arrayDados;
            $d = $objmonta->pegaDados();
        } else {
            $d = null;
        }
        return $d;
    }

    public function listar($camposTabelas, $condicoes, $colunaOrdenada, $ordenacao, $limit, $top, $ArrayTo): array {
        $arrayDados = array();
        $conn = new Connect();
        $sql = new Sql($this->table);
        $sql->arrayTable = $this->arrayTable;
        $sql->conditionsLeftJoin = $this->conditionsLeftJoin;
        $sql->camposTabelas = $camposTabelas;
        $sql->ArryasTOMaiusculas = $ArrayTo;
        $sql->condicoesTabela = $condicoes;
        $sql->colunaOrdenada = $colunaOrdenada; //"nome"
        $sql->ordenacao = $ordenacao; //
        $sql->limit = $limit; //
        $sql->TOP = $top; //
        $conn->sql = $sql->sqlPesquisar();
        return $arrayDados = (array) $conn->montaArrayPesquisa();
    }

    public function Verificar($where, $ArrayTo) : bool {
        $conn = new Connect();
        $sql = new Sql(null);
        $sql->arrayTable = $this->arrayTable;
        $sql->ArryasTOMaiusculas = $ArrayTo;
        $sql->condicoesTabela = $where;
        $sql->conditionsLeftJoin = $this->conditionsLeftJoin;
        $conn->sql = $sql->sqlPesquisar();
        $conn->CountRow();
        $this->numrows = $conn->getNumrows();
        if ($this->numrows >= 1) {
            return true;
        } else {
            return false;
        }
    }

    public function Atualizar($dado, $camposTabelas, $where, $ArrayTo) : bool {
        $conn = new Connect();
        $sql = new Sql($this->table);
        $sql->dados = $dado;
        $sql->ArryasTOMaiusculas = $ArrayTo;
        $sql->camposTabelas = $camposTabelas;
        $conn->sql = $sql->sqlAtualizar($where);
        $rusult = $conn->updateQuery();
        $this->lastInsertId = $conn->getLastInsertId();
        if ($rusult) {
            return true;
        } else {
            return false;
        }
    }

    public function AtualizarMultiplos($ArraydadosMultiplos, $camposTabelas, $camposPrimary, $where, $ArrayTo) : bool {
        $conn = new Connect();
        $sql = new Sql($this->table);
        $sql->ArryasTOMaiusculas = $ArrayTo;
        $sql->camposTabelas = $camposTabelas;
        $sql->camposPrimary = $camposPrimary;
        $conn->sql = $sql->sqlAtualizarMultiplos($ArraydadosMultiplos, $where);
        $rusult = $conn->updateQuery();        
        $this->lastInsertId = $conn->getLastInsertId();
        if ($rusult) {
            return true;
        } else {
            return false;
        }
    }

    public function excluir($where, $ArrayTo) : bool {
        $conn = new Connect();
        $sql = new Sql($this->table);
        $sql->ArryasTOMaiusculas = $ArrayTo;
        $sql->condicoesTabela = $where;
        $conn->sql = $sql->sqlexcluir();
        $result = $conn->updateQuery(); //aqui execluta a  sql informada
        $this->numrows = $conn->getNumrows();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getNumrows() {
        return $this->numrows;
    }

    public function getLastInsertId() {
        return $this->lastInsertId;
    }

}
