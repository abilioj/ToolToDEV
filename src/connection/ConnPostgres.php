<?php

namespace abilioj\ToolToDev\connection;
 
use abilioj\ToolToDev\config\ConfigBD;

use Exception; 

/**
 * Classe ConexaoPostgres
 * @package abilioj\ToolToDev\connection
 * 
 * Classe para conexao com banco de dados PostgreSQL
 * Fornece métodos para executar consultas, transações e manipulação de dados.
 */
class ConnPostgres
{

    private $database;
    private $user;
    private $host;
    private $pwd;
    private $port;
    private $conn;
    private $result;
    private $numrows;
    private $isOK;
    private $string;
    public $error;
    public $sql;

    function __construct()
    {
        $configBD = new ConfigBD();
        $this->database = $configBD->getDatabase();
        $this->user = $configBD->getUser();
        $this->host = $configBD->getHost();
        $this->pwd = $configBD->getPassword();
        $this->port = $configBD->getPort();
        $this->numrows = 0;
        $this->isOK = false;
        $this->string = "";
        $this->error = "";
        $this->result = null;
        $this->sql = "";
    }

    private function getConnect()
    {
        $this->conn = pg_connect("host=" . $this->host . " port=" . $this->port . " dbname=" . $this->database . " user=" . $this->user . " password=" . $this->pwd . "");
        if ($this->conn) {
            return $this->conn;
        } else {
            throw new Exception("Erro ao conectar ao banco de dados.");
        }
    }

    public function executaQuery()
    {
        try {
            $this->getConnect();
        } catch (Exception $erro) {
            return false;
        }
        pg_exec($this->conn, "SET NAMES 'utf8'");
        $this->result = pg_exec($this->conn, $this->sql);
        if (!$this->result) {
            $this->error = "Erro na execução da query: " . pg_last_error($this->conn);
            $this->disconnects();
            return false;
        }
        $this->disconnects();
        return $this->result;
    }

    public function updateQuery()
    {
        try {
            $this->getConnect();
        } catch (Exception $erro) {
            $this->error = $erro->getMessage();
        }
        pg_query($this->conn, "BEGIN;");
        $this->result = pg_query($this->conn, $this->sql);
        if ($this->result) {
            pg_exec($this->conn, "COMMIT;");
            $this->disconnects();
            return $this->result;
        } else {
            pg_exec($this->conn, "ROLLBACK;");
            $this->disconnects();
            return false;
        }
    }

    // Salva no array $line resultados retornados
    function MostrarResultados()
    {
        $result = $this->executaQuery();
        $line = pg_fetch_array($result);
        return $line;
    }

    public function RsutArrayFetch()
    {
        $arrayDados = null;
        $result = $this->executaQuery();
        $i = 0;
        while ($a = pg_fetch_array($result)) {
            $arrayDados[$i] = $a;
            $i++;
        }
        return $arrayDados;
    }

    public function RsutArrayAssoc()
    {
        $result = $this->executaQuery();
        //        if(is_array($result)):
        return pg_fetch_array($result, PGSQL_ASSOC);
        //        else:
        //            return null;
        //        endif;
    }

    // Numero de linhas retornada na consulta
    public function countRows()
    {
        $this->numrows = pg_num_rows($this->result);
        return $this->numrows;
    }

    // Fecha conn
    private function disconnects()
    {
        pg_flush($this->conn);
        pg_close($this->conn);
    }

    // Libera consulta da memoria
    public function ClearResult()
    {
        pg_free_result($this->result);
    }

    public function Rows_Affected($tipo)
    {
        $this->isOK = $this->executaQuery();
        if ($this->isOK == true):
            $tipo = strtolower($tipo);
            if ($tipo == "select"):
                $this->numrows = pg_num_rows($this->result);
            else:
                $this->numrows = pg_affected_rows($this->conn);
            endif;
        endif;
        return (bool) $this->isOK;
    }

    public function TestConect()
    {
        $this->conn = pg_connect("host=" . $this->host . " port=" . $this->port . " dbname=" . $this->database . " user=" . $this->user . " password=" . $this->pwd . "");
        if ($this->conn) {
            $this->string = "conectado";
            $this->disconnects();
            return true;
        } else {
            $this->error = "Erro ao conectar ao banco de dados.";
            $this->disconnects();
            return false;
        }
    }

    public function getNumrows()
    {
        return $this->numrows;
    }

    public function getString()
    {
        return $this->string;
    }

    public function getError()
    {
        return $this->error;
    }
}
