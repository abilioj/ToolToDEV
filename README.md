# Tool To DEV

Uma biblioteca PHP simples para fornecer várias classes de utilitários para desenvolvimento de projeto do zero.

A ideia é criar uma biblioteca com classes que sejam úteis em diferentes contextos de desenvolvimento, como por exemplo, classe para manipular strings, classe para manipular arrays, classe para manipular datas, etc...

A biblioteca é composta por classes que são auto-explicativas e fáceis de usar, sem depender de frameworks ou bibliotecas específicas.

## Instalação

A biblioteca pode ser instalada via composer:
```shell
composer  require abilioj/tool-to-dev
```
 
## Requisitos

- PHP >= 7.4
- Composer

### Libs necessária

- pdo
- mysqli
- postgres
- ldap 

### pacotes necessária

- vlucas/phpdotenv

## ENV Exemplos



### env conexão
```env
    # Configurações de banco de dados
    DB_DRIVERS=mysql
    DB_HOST=localhost
    DB_PREFIXOBD=
    DB_PORT=3306
    DB_DATABASE=
    DB_USER=
    DB_PASSWORD=
```

### env ldap
```env
    # Configurações de AD      
    AD_HOST = 
    AD_DNSNAME = 
    AD_GROUP_AD = ''
    AD_port = 389
    AD_USER = 
    AD_PWD = 
    AD_FILTER = ''
```

## Uso

Após instalar a biblioteca, você pode começar a usá-la da seguinte forma:

### exemplo da classe ToString
```php
    require 'vendor/autoload.php';

    use abilioj\ToolToDev\util\ToString;
    
    echo ToString::StringPraMaiusculas('hello world');
```

### exemplo de uso das conexão

No seu projeto criar um pagote de conexao e cria um class que estende a class de escolha 'ConnMysql,ConnPostgres ou ConnPDO'

exemplo em [exemplo-connection](https://github.com/abilioj/ToolToDEV/blob/main/example/exemplo-connection.php)
```php
    require 'vendor/autoload.php';

    use abilioj\ToolToDev\connection\ConnPDO;

    class connection extends ConnPDO
    {
    }
```

### exemplo de uso da class sql 

exemplo em [exemplo-sql](https://github.com/abilioj/ToolToDEV/blob/main/example/exemplo-sql.php)

```php
    require 'vendor/autoload.php';

    use abilioj\ToolToDev\util\Sql

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
    //resultado: SELECT u.nome_usuario, s.tipo_status, n.tipo_nivel, u.data_cadastro_usuario, u.id_usuario FROM usuario u left join status_usuario s on s.id_status=u.id_status left join nivel_usuario n on n.id_nivel=u.id_nivel WHERE u.id_usuario=1;

```

## Contribuição

Contribuições são bem-vindas! Siga as etapas abaixo para contribuir:

1. Faça um fork do repositório.
2. Crie uma branch para suas modificações: `git checkout -b minha-branch`.
3. Faça commit das suas alterações: `git commit -m 'Minha contribuição'`.
4. Faça push para a branch: `git push origin minha-branch`.
5. Envie um Pull Request.

## Licença

Esta biblioteca é licenciada sob a [MIT License](LICENSE). 