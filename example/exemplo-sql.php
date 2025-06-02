<?php

use abilioj\ToolToDev\util\Sql;

require '../vendor/autoload.php';


$camposTabelas = array("u.nome_usuario", "s.tipo_status", "n.tipo_nivel", "u.data_cadastro_usuario", "u.id_usuario");
$nomeTabelas = array("u" => "usuario", "s" => "status_usuario", "n" => "nivel_usuario");
$condicoes = array("s.id_status=u.id_status", "n.id_nivel=u.id_nivel");

// Exemplo de uso da classe Sql para gerar uma consulta SQL

$sql = new Sql('');
$sql->arrayTable = $nomeTabelas;
$sql->camposTabelas = $camposTabelas;
$sql->ArryasTOMaiusculas = false;
$sql->condicoesTabela = $condicoes;
$sql->colunaOrdenada = null;
$sql->ordenacao = null;
$sql->limit = null;
$sql->TOP = null;


echo $sql->sqlPesquisar();
//resultado: SELECT u.nome_usuario, s.tipo_status, n.tipo_nivel, u.data_cadastro_usuario, u.id_usuario FROM usuario u, status_usuario s, nivel_usuario n WHERE s.id_status=u.id_status AND n.id_nivel=u.id_nivel;


echo "<br/><br/>";

// Exemplo de uso da classe Sql para gerar uma consulta SQL com JOIN
$camposTabelas = array("u.nome_usuario", "s.tipo_status", "n.tipo_nivel", "u.data_cadastro_usuario", "u.id_usuario");
$nomeTabelas = array("u" => "usuario");
$condicoes = array("u.id_usuario=1");
$conditionsLeftJoin = array("left join status_usuario s on s.id_status=u.id_status", "left join nivel_usuario n on n.id_nivel=u.id_nivel");

$sql = new Sql('');
$sql->arrayTable = $nomeTabelas;
$sql->camposTabelas = $camposTabelas;
$sql->ArryasTOMaiusculas = false;
$sql->conditionsLeftJoin = $conditionsLeftJoin;
$sql->condicoesTabela = $condicoes;
$sql->colunaOrdenada = null;
$sql->ordenacao = null;
$sql->limit = null;
$sql->TOP = null;

echo $sql->sqlPesquisar();
//resultado: SELECT u.nome_usuario, s.tipo_status, n.tipo_nivel, u.data_cadastro_usuario, u.id_usuario FROM usuario u left join status_usuario s on s.id_status=u.id_status left join nivel_usuario n on n.id_nivel=u.id_nivel WHERE u.id=1;

echo "<br/><br/>";

// Exemplo de uso da classe Sql para gerar uma isserção SQL
$colunas = array("nome_usuario", "id_status", "id_nivel");
$dados = array("Abilio", 1, 2);

$sql = new Sql('usuario');
$sql->camposTabelas = $colunas;
$sql->dados = $dados;


echo $sql->sqlInserir();
//resultado: INSERT INTO usuario (nome_usuario, id_status, id_nivel) VALUES ('Abilio', 1, 2);

echo "<br/><br/>";

// Exemplo de uso da classe Sql para gerar uma atualização SQL

$colunas = array("nome_usuario", "id_status", "id_nivel");
$dados = array("Abilio junior", 1, 2);
$where = "id_usuario=1";
$sql = new Sql('usuario');
$sql->camposTabelas = $colunas;
$sql->dados = $dados;

echo $sql->sqlAtualizar($where);
//resultado: UPDATE usuario SET nome_usuario='Abilio junior', id_status=1, id_nivel=2 WHERE id_usuario=1;

echo "<br/><br/>";

// Exemplo de uso da classe Sql para gerar uma exclusão SQL

$condicoes = array("id_usuario>1" , "id_status=1");
$sql = new Sql('usuario');
$sql->condicoesTabela = $condicoes;

echo $sql->sqlexcluir($condicoes);
//resultado: DELETE FROM usuario WHERE id_usuario=1 AND id_status=1;